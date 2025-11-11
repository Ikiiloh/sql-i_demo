<?php
require_once __DIR__ . '/../src/bootstrap.php';

session_unset();
session_destroy();

// Mulai ulang session hanya untuk menyimpan pesan flash
session_start();
$_SESSION['message'] = "Anda telah berhasil logout.";
header("Location: ../public/index.php?page=index");
exit;
?>