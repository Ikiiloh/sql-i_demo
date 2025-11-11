<?php
// Memuat file konfigurasi
require_once __DIR__ . '/config.php';

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    // Variabel $db akan tersedia untuk file lain yang memuat bootstrap.php
    $db = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage() . "<br>Pastikan Anda sudah menjalankan 'setup_baru.sql' di phpMyAdmin.");
}
?>