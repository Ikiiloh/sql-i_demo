<?php
require_once __DIR__ . '/../src/bootstrap.php';

$username = $_POST['username'];
$password_input = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$_SESSION['debug_query'] = "Query Template: " . $sql . "\nData: [" . $username . "]";

try {
    $user = $stmt->fetch();

    if ($user && password_verify($password_input, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../public/index.php?page=dashboard");
        exit;
    } else {
        $_SESSION['error_message'] = "LOGIN GAGAL! (SQL-i GAGAL)<br>Username atau password salah.";
    }
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error SQL: " . $e->getMessage();
}

header("Location: ../public/index.php?page=login_secure");
exit;
?>