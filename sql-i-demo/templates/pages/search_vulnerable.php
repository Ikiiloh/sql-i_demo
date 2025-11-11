<h2>Demo In-Band (UNION-based)</h2>
<div class="payload-info">
    <p><b>Payload:</b> <code>Buku' UNION SELECT username, password FROM users -- </code></p>
    <p><b>Catatan:</b> Jumlah kolom (2) harus sama. <code>name</code> -> <code>username</code>, <code>description</code> -> <code>password</code>.</p>
</div>
<form action="index.php?page=search_vulnerable" method="POST">
    <div class="form-group">
        <label for="category">Cari Produk Berdasarkan Kategori</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($_POST['category'] ?? 'Elektronik'); ?>">
    </div>
    <button type="submit" class="btn btn-danger">Cari</button>
</form>

<?php
// Logika untuk menampilkan hasil pencarian
if (isset($_POST['category'])) {
    $category = $_POST['category'];
    
    // --- INI ADALAH BAGIAN YANG RENTAN ---
    $sql = "SELECT name, description FROM products WHERE category = '$category'";
    
    // Simpan di session agar router bisa menampilkannya
    $_SESSION['debug_query'] = $sql; 

    echo "<h3>Hasil Pencarian:</h3>";
    echo "<table>";
    echo "<tr><th>Nama Produk/User</th><th>Deskripsi/Hash Password</th></tr>";
    try {
        // $db tersedia dari router
        $result = $db->query($sql);
        while ($row = $result->fetch(PDO::FETCH_NUM)) { // Ambil sebagai numerik
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row[0]) . "</td>";
            echo "<td>" . htmlspecialchars($row[1]) . "</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='2' style='color:red;'>Error SQL: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
    echo "</table>";
}
?>