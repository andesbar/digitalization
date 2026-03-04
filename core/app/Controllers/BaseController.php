<?php
namespace App\Core;

if (!defined('CORE_SECURED_INDONESIA')) exit('Forbidden');

class BaseController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    /**
     * @param string $page Nama file di folder pages
     * @param array $data Data untuk dikirim ke view
     * @param bool $withHeader Tampilkan Header?
     * @param bool $withFooter Tampilkan Footer?
     */
    protected function view($page, $data = [], $withHeader = true, $withFooter = true) {
        extract($data);

        $router = new Router();
        $level = strtolower($router->getLevel());
        $base_path = __DIR__ . "/../../../{$level}/templates";

        // 1. Sertakan Header HANYA JIKA diminta
        if ($withHeader === true && file_exists("{$base_path}/layouts/header.php")) {
            include "{$base_path}/layouts/header.php";
        }

        // 2. Sertakan Konten Utama (Wajib Ada)
        $file_view = "{$base_path}/pages/{$page}.php";
        if (file_exists($file_view)) {
            include $file_view;
        }

        // 3. Sertakan Footer HANYA JIKA diminta
        if ($withFooter === true && file_exists("{$base_path}/layouts/footer.php")) {
            include "{$base_path}/layouts/footer.php";
        }
    }
}
