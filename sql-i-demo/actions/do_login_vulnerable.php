<?php
// Selalu panggil bootstrap untuk session dan $db
require_once __DIR__ . '/../src/bootstrap.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$_SESSION['debug_query'] = $sql; // Simpan query untuk ditampilkan

try {
    $result = $db->query($sql);
    $user = $result->fetch(); 

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        // Alihkan ke dashboard via router
        header("Location: ../public/index.php?page=dashboard");
        exit;
    } else {
        $_SESSION['error_message'] = "LOGIN GAGAL! Username atau password salah.";
    }
} catch (PDOException $e) {
    // Tampilkan error SQL ke pengguna (In-band Error-based)
    $_SESSION['error_message'] = "<b>SQL-i Sukses (Error-based)!</b><br>Database mengeluh: <br>" . htmlspecialchars($e->getMessage());
}

// Jika gagal, kembali ke halaman login rentan
header("Location: ../public/index.php?page=login_vulnerable");
exit;
?>