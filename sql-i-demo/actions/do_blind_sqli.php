<?php
// Memulai session dan koneksi $db
require_once __DIR__ . '/../src/bootstrap.php';

$product_id = $_POST['product_id'];

// --- INI ADALAH BAGIAN YANG RENTAN ---
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$_SESSION['debug_query'] = $sql;

try {
    $result = $db->query($sql);
    $product = $result->fetch();

    if ($product) {
        // Respon 'True'
        $_SESSION['message'] = "Respons Boolean: <b>DITEMUKAN</b>.";
    } else {
        // Respon 'False'
        $_SESSION['error_message'] = "Respons Boolean: <b>TIDAK DITEMUKAN</b>.";
    }

} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error SQL (seharusnya tidak terjadi di Blind SQLi, tapi ini dia): " . $e->getMessage();
}

// Kembali ke halaman demo blind sqli
header("Location: ../public/index.php?page=blind_sqli");
exit;
?>