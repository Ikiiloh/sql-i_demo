<h2>Demo In-Band (Login Bypass)</h2>
<p>Mendapatkan akses dengan membobol logika <code>WHERE</code>.</p>
<div class="payload-info">
    <p><b>Payload (Logic):</b> <code>admin' OR '1'='1' -- </code> (dengan spasi di akhir)</p>
    <p><b>Payload (Error):</b> <code>'</code> (untuk memicu error)</p>
</div>
<form action="../actions/do_login_vulnerable.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-danger">Login Rentan</button>
</form>