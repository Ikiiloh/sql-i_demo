<?php
// Cek login sudah ditangani oleh router (public/index.php)
// Kita bisa langsung ambil data dari session
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<h2>Dashboard</h2>
<p>Selamat datang, <strong><?php echo htmlspecialchars($username); ?></strong>! (Role: <strong><?php echo htmlspecialchars($role); ?></strong>)</p>

<?php if ($role === 'admin'): ?>
    <div class="message" style="background: #fffbe6; border-color: #ffe58f;">
        <h3>Panel Kontrol Admin</h3>
        <p><b>Demo Sukses:</b> Anda berhasil login sebagai Admin!</p>
    </div>
<?php else: ?>
    <div class="message">
        <h3>Dashboard Pengguna</h3>
        <p>Ini adalah halaman profil standar.</p>
    </div>
<?php endif; ?>