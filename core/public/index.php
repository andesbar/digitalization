<?php
/**
 * ANDESBAR SECURED DIGITAL ECOSYSTEM
 * File: index.php (Entry Point)
 */

define('CORE_SECURED_INDONESIA', true);

// Nyalakan Session di paling atas
if (session_status() === PHP_SESSION_NONE) session_start();

// Panggil Autoloader
require_once __DIR__ . '/../bootstrap.php';

use App\Core\Router;

// Jalankan Router
try {
    $router = new Router();
    $router->run();
} catch (\Exception $e) {
    die("SISTEM PROTEKSI AKTIF: " . $e->getMessage());
}
