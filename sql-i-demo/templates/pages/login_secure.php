<h2>Demo Login AMAN (Prepared Statements + Hash Verify)</h2>
<p>Coba gunakan payload <code>admin' OR '1'='1' -- </code> di sini. Serangan akan gagal.</p>
<p>Login normal (misal <code>budi</code> / <code>budi456</code>) akan berhasil karena kode ini menggunakan <code>password_verify()</code>.</p>
<form action="../actions/do_login_secure.php" method="POST">
    <div class="form-group"><label for="username">Username</label><input type="text" id="username" name="username" required></div>
    <div class="form-group"><label for="password">Password</label><input type="password" id="password" name="password" required></div>
    <button type="submit" class="btn btn-safe">Login Aman</button>
</form>