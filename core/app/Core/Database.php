<?php
namespace App\Core;

use PDO;
use PDOException;

if (!defined('CORE_SECURED_INDONESIA')) exit;

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
    $host = $_ENV['DB_HOST'] ?? 'localhost';
    $port = $_ENV['DB_PORT'] ?? '5432';
    $name = $_ENV['DB_NAME'] ?? '';
    $user = $_ENV['DB_USER'] ?? '';
    $pass = $_ENV['DB_PASS'] ?? '';

    // Pastikan variabel penting tidak kosong
    if (empty($name)) {
        die("<h1>KONFIGURASI CACAT _INDONESIA</h1><p>Nama Database (DB_NAME) belum diatur di .env</p>");
    }

    $dsn = "pgsql:host=$host;port=$port;dbname=$name";

        try {
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("<h1>KEGAGALAN KONEKSI _INDONESIA</h1><p>Database tidak merespon: " . $e->getMessage() . "</p>");
        }
    }

    /**
     * Mendapatkan instance koneksi tunggal (Singleton)
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    /**
     * FITUR FATAL: Pindah jalur data antar wilayah
     * Menggunakan 'search_path' PostgreSQL untuk isolasi data
     */
    public function switchSchema($schemaName) {
        // Sanitasi nama schema agar tidak kena SQL Injection
        $safeSchema = preg_replace('/[^a-zA-Z0-9_]/', '', $schemaName);
        $this->conn->exec("SET search_path TO $safeSchema, public");
    }
}
