<h2>Demo Sign-up Rentan (INSERT Injection)</h2>
<p>Mencoba mendaftar sebagai <code>admin</code> dengan menyuntikkan query <code>INSERT</code>.</p>
<div class="payload-info">
    <p><b>Payload di Username:</b> <code>hacker', 'fake-hash-123', 'admin'); -- </code> (dengan spasi di akhir)</p>
    <p><b>Password:</b> (isi apa saja)</p>
    <p><b>Hasil:</b> Query akan diubah untuk memasukkan *role* <code>admin</code>, mengabaikan *role* <code>user</code> yang seharusnya.</p>
</div>
<form action="../actions/do_register_vulnerable.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-danger">Daftar (Rentan)</button>
</form>