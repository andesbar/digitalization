<?php
/**
 * DIGITALIZATION SYSTEM BOOTSTRAP
 * Lokasi: core/bootstrap.php
 */

spl_autoload_register(function ($class) {
    // Prefix untuk namespace kita
    $prefix = 'App\\';

    // Basis folder untuk namespace tersebut (core/app/)
    $base_dir = __DIR__ . '/app/';

    // Cek apakah class menggunakan prefix App\
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Ambil sisa nama class
    $relative_class = substr($class, $len);

    // Ubah \ ke / untuk path file Linux/Docker
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
