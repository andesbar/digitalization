<?php
/**
 * ==============================================================================
 * ANDESBAR SECURED DIGITAL ECOSYSTEM - INDONESIA
 * ==============================================================================
 * File: Router.php (Otak Navigasi & Multi-Tenant)
 * ==============================================================================
 */

namespace App\Core;

// Memanggil Model Tenant untuk validasi wilayah
use App\Models\TenantMaster;

if (!defined('CORE_SECURED_INDONESIA')) exit('Akses Ilegal _INDONESIA');

class Router {
    private $host, $level, $subdomain, $uri;

    public function __construct() {
        // Ambil host (misal: core.localhost)
        $this->host = $_SERVER['HTTP_HOST'] ?? '';

        // Ambil path URL (misal: /login/submit)
        $this->uri  = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

        // Deteksi apakah ini level CORE, PROV, atau DESA
        $this->detectLevel();
    }

    /**
     * Mendeteksi Level Berdasarkan Subdomain
     */
    private function detectLevel() {
        $parts = explode('.', $this->host);
        $prefix = strtolower($parts[0]);
        $this->subdomain = $prefix;

        if ($prefix === 'core') {
            $this->level = 'CORE';
        } elseif (strpos($this->host, '.prov.') !== false) {
            $this->level = 'PROV';
        } else {
            $this->level = 'DESA';
        }
    }

    /**
     * Menjalankan Sistem Routing
     */
    public function run() {
        // 1. VALIDASI TENANT & SWITCH SCHEMA (Khusus PROV/DESA)
        if ($this->level !== 'CORE') {
            $master = new TenantMaster();
            $tenant = $master->getTenantBySubdomain($this->subdomain);

            if ($tenant) {
                // Pindah ke schema wilayah tersebut (misal: desa_1103)
                Database::getInstance()->switchSchema($tenant['schema_name']);
            } else {
                die("<div style='padding:50px; text-align:center; font-family:sans-serif;'>
                        <h1 style='color:#c53030;'>403 - AKSES WILAYAH DITOLAK</h1>
                        <p>Subdomain <b>{$this->subdomain}</b> tidak terdaftar dalam sistem nasional.</p>
                     </div>");
            }
        }

        // 2. PARSING URL UNTUK CONTROLLER & ACTION
        $urlParts = explode('/', $this->uri);

        // Default Controller adalah Dashboard, Default Action adalah Index
        $controllerReq = (!empty($urlParts[0])) ? $urlParts[0] : 'index';
        $action = (!empty($urlParts[1])) ? $urlParts[1] : 'index';

        // Format nama file dan class: login -> LoginController
        $controllerName = ucfirst($controllerReq) . 'Controller';

        // NAMESPACE LENGKAP: Inilah kunci agar class_exists bekerja!
        $fullClassName = "App\\Controllers\\" . $controllerName;

        // Tentukan path file berdasarkan level (core/prov/desa)
        $baseFolder = strtolower($this->level);
        $controllerPath = __DIR__ . "/../../../{$baseFolder}/app/Controllers/{$controllerName}.php";

        // 3. EKSEKUSI CONTROLLER
        if (file_exists($controllerPath)) {
            require_once $controllerPath;

            // Cek apakah class dengan namespace tersebut ada
            if (class_exists($fullClassName)) {
                $controllerInstance = new $fullClassName();

                // Cek apakah fungsi (action) yang diminta ada di dalam class
                if (method_exists($controllerInstance, $action)) {
                    $controllerInstance->$action();
                } else {
                    die("<h1>404 - ACTION TIDAK DITEMUKAN</h1><p>Gagal memanggil fungsi <b>{$action}</b> di dalam {$controllerName}.</p>");
                }
            } else {
                die("<h1>500 - NAMESPACE ERROR</h1><p>Class <b>{$fullClassName}</b> gagal dimuat. Periksa deklarasi <i>namespace App\Controllers;</i> di file tersebut.</p>");
            }
        } else {
            // Jika file controller tidak ada
            die("<div style='padding:50px; font-family:sans-serif; background:#f8fafc; border:1px solid #e2e8f0;'>
                    <h2 style='color:#1e293b;'>⚠️ MODUL TIDAK DITEMUKAN</h2>
                    <p>Sistem tidak menemukan file: <br><code style='background:#fff; padding:5px;'>{$controllerPath}</code></p>
                    <hr>
                    <small>ANDESBAR SECURED SYSTEM - 2026</small>
                 </div>");
        }
    }

    public function getLevel() {
        return $this->level;
    }
}
