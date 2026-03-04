<?php
// desa/index.php

$host = $_SERVER['HTTP_HOST']; // Hasilnya: 1103142020.desa.localhost
$parts = explode('.', $host);
$kode_desa = $parts[0]; // Hasilnya: 1103142020

echo "<h1>Selamat Datang di Portal Desa</h1>";
echo "<p>Kode Wilayah Anda: <strong>" . $kode_desa . "</strong></p>";

// Nanti di sini tinggal tarik data dari Postgres:
// $sql = "SELECT * FROM villages WHERE id = '$kode_desa'";
?>
