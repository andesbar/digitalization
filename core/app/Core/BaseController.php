<?php
namespace App\Core;

if (!defined('CORE_SECURED_INDONESIA')) exit('Forbidden');

class BaseController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    protected function view($page, $data = [], $withHeader = true, $withFooter = true) {
        extract($data);

        // --- TAHAP 1: KUNCI SEMUA OUTPUT ---
        ob_start();

        $router = new Router();
        $level = strtolower($router->getLevel());
        $base_path = realpath(__DIR__ . "/../../../{$level}/templates");

        // Panggil Header
        if ($withHeader === true) {
            $h_file = "{$base_path}/layouts/header.php";
            if (file_exists($h_file)) include $h_file;
        }

        // Panggil Halaman (Login/Index)
        $v_file = "{$base_path}/pages/{$page}.php";
        if (file_exists($v_file)) {
            include $v_file;
        }

        // Panggil Footer
        if ($withFooter === true) {
            $f_file = "{$base_path}/layouts/footer.php";
            if (file_exists($f_file)) include $f_file;
        }

        // --- TAHAP 2: AMBIL & HANCURKAN FORMATNYA ---
        $html = ob_get_clean();

        // 1. Minify: Hapus Enter, Tab, dan Spasi berlebih
        $search = [
            '/\>[^\S ]+/s',     // hapus spasi setelah tag
            '/[^\S ]+\</s',     // hapus spasi sebelum tag
            '/(\s)+/s',         // gabung spasi berlebih
            '//' // hapus komentar HTML
        ];
        $replace = ['>', '<', '\\1', ''];
        $output = preg_replace($search, $replace, $html);

        // 2. Trik "Lautan Putih": Tambahkan 2000 baris kosong di atas
        // Biar pas Ctrl+U, layarnya putih polos (harus scroll jauh ke bawah)
        $anti_kepo_padding = str_repeat("\n", 2000);

        // --- TAHAP 3: SAJIKAN KE BROWSER ---
        echo $anti_kepo_padding . $output;
    }
}
