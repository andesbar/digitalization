<?php
namespace App\Core;

if (!defined('CORE_SECURED_INDONESIA')) exit('Forbidden');

class BaseController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    /**
     * Memanggil View dengan Kontrol Granular
     * @param string $page Nama file view
     * @param array $data Data untuk view
     * @param bool $h Sertakan Header?
     * @param bool $f Sertakan Footer?
     */
    protected function view($page, $data = [], $h = true, $f = true) {
        extract($data);

        $router = new Router();
        $level = strtolower($router->getLevel());
        $base_path = __DIR__ . "/../../../{$level}/templates";

        // 1. Panggil Header jika diminta
        if ($h === true && file_exists("{$base_path}/layouts/header.php")) {
            include "{$base_path}/layouts/header.php";
        }

        // 2. Panggil Halaman Utama
        if (file_exists("{$base_path}/pages/{$page}.php")) {
            include "{$base_path}/pages/{$page}.php";
        }

        // 3. Panggil Footer jika diminta
        if ($f === true && file_exists("{$base_path}/layouts/footer.php")) {
            include "{$base_path}/layouts/footer.php";
        }
    }
}
