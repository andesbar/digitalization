<?php
namespace App\Middleware;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class SecurityHeadersMiddleware {
    /**
     * Menyuntikkan Header Keamanan ke Browser
     */
    public static function handle() {
        // Mencegah web kamu dibuka di dalam frame/iframe situs lain (Anti-Clickjacking)
        header("X-Frame-Options: DENY");

        // Memaksa browser hanya menggunakan koneksi aman (HSTS)
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

        // Mencegah browser menebak-nebak tipe file (Anti-MIME Sniffing)
        header("X-Content-Type-Options: nosniff");

        // Pagar Betis (CSP): Hanya izinkan script & gaya dari server kita sendiri
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data:;");

        // Menghilangkan jejak asal URL saat klik link keluar (Privacy)
        header("Referrer-Policy: strict-origin-when-cross-origin");
    }
}
