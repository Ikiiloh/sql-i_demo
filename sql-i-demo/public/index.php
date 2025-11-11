<?php
// Memulai semua: session dan koneksi $db
require_once __DIR__ . '/../src/bootstrap.php';

// --- LOGIKA ROUTING (PENGALIHAN HALAMAN) ---
$page = $_GET['page'] ?? 'index';

// Ambil pesan dari session untuk ditampilkan
$message = $_SESSION['message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;
unset($_SESSION['message'], $_SESSION['error_message']);

// Ambil query debug dari session
$debug_query = $_SESSION['debug_query'] ?? null;
unset($_SESSION['debug_query']);


// --- (PEMBARUAN) Proteksi Halaman Dashboard ---
// Jika user mencoba mengakses dashboard TAPI belum login
if ($page === 'dashboard' && !isset($_SESSION['username'])) {
    $_SESSION['error_message'] = "Anda harus login untuk mengakses dashboard.";
    // Paksa alihkan ke halaman login
    header("Location: index.php?page=login_secure");
    exit;
}
// --- Akhir Proteksi Halaman ---


// Tentukan file halaman yang akan dimuat
$page_file = __DIR__ . '/../templates/pages/' . $page . '.php';

// Keamanan dasar: Pastikan file halaman ada sebelum memuatnya
if (!file_exists($page_file)) {
    // Jika tidak ada, alihkan ke halaman index
    $page_file = __DIR__ . '/../templates/pages/index.php';
}

// --- Mulai Render Halaman ---

// 1. Muat Header
// Variabel $db, $message, $error_message, $debug_query akan tersedia di header
require_once __DIR__ . '/../templates/layout/header.php';

// 2. Muat Konten Halaman yang Dipilih
// Variabel yang sama juga akan tersedia di file halaman
require_once $page_file;

// 3. Muat Footer
require_once __DIR__ . '/../templates/layout/footer.php';
?>