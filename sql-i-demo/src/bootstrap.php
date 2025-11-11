<?php
// Mulai session di paling atas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memuat koneksi database
require_once __DIR__ . '/db.php';
?>