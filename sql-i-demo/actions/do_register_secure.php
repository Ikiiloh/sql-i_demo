<?php
// Memulai session dan koneksi $db
require_once __DIR__ . '/../src/bootstrap.php';

$username = $_POST['username'];
$password = $_POST['password'];

// --- INI ADALAH BAGIAN YANG AMAN ---
// 1. Hash password dengan aman
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 2. Gunakan Prepared Statements
$sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')";
$_SESSION['debug_query'] = "Query Template: " . $sql . "\nData: [" . $username . ", (hashed_password), 'user']";

try {
    $stmt = $db->prepare($sql);
    $stmt->execute([$username, $hashed_password]);
    $_SESSION['message'] = "Registrasi aman berhasil! Akun <code>" . htmlspecialchars($username) . "</code> dibuat.";
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) { // Error duplikat
         $_SESSION['error_message'] = "Registrasi Gagal: Username <code>" . htmlspecialchars($username) . "</code> sudah ada.";
    } else {
         $_SESSION['error_message'] = "Error: " . htmlspecialchars($e->getMessage());
    }
}

// Kembali ke halaman register aman
header("Location: ../public/index.php?page=register_secure");
exit;
?>