<?php
// Memulai session dan koneksi $db
require_once __DIR__ . '/../src/bootstrap.php';

$username = $_POST['username'];
$password = $_POST['password']; // Di sini, penyerang tidak peduli passwordnya

// --- INI ADALAH BAGIAN YANG RENTAN ---
$sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')";
$_SESSION['debug_query'] = $sql;

try {
    $db->query($sql);
    $_SESSION['message'] = "<b>SQL-i SUKSES!</b> Akun <code>" . htmlspecialchars($username) . "</code> berhasil dibuat! (Cek tabel di Home untuk melihat rolenya).";
} catch (PDOException $e) {
     $_SESSION['error_message'] = "<b>SQL-i GAGAL ATAU ERROR!</b><br>" . htmlspecialchars($e->getMessage());
}

// Kembali ke halaman register rentan
header("Location: ../public/index.php?page=register_vulnerable");
exit;
?>