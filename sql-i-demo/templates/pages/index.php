<h2>Selamat Datang!</h2>
<p>Gunakan navigasi di atas untuk mencoba berbagai skenario SQL Injection yang telah dibahas di PPT Anda.</p>

<h3 style="margin-top: 2rem;">Daftar Produk (Tabel `products`):</h3>
<table>
    <tr><th>ID</th><th>Nama</th><th>Kategori</th></tr>
    <?php
    // $db tersedia dari bootstrap.php yang dimuat oleh index.php
    $stmt = $db->query("SELECT id, name, category FROM products");
    while ($row = $stmt->fetch()) {
        echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['category']) . "</td></tr>";
    }
    ?>
</table>

<h3 style="margin-top: 2rem;">Daftar Pengguna (Tabel `users`):</h3>
<table>
    <tr><th>ID</th><th>Username</th><th>Password (Hash)</th><th>Role</th></tr>
     <?php
    $stmt = $db->query("SELECT id, username, password, role FROM users");
    while ($row = $stmt->fetch()) {
        echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['username']) . "</td><td style='word-break:break-all;'>" . htmlspecialchars($row['password']) . "</td><td>" . htmlspecialchars($row['role']) . "</td></tr>";
    }
    ?>
</table>