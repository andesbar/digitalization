<?php
// D:\MEGAPROJECT\includes\db.php

$host = "db-digitalization"; // <--- SESUAIKAN DENGAN YAML DI ATAS
$db   = "mega_db";
$user = "mega_admin";
$pass = "Megadmin";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    // ...
} catch (PDOException $e) {
    die("Koneksi Error: " . $e->getMessage());
}
