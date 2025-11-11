<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo SQL Injection Lengkap</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <h1>Prototipe Demo SQL-i Lengkap</h1>

        <nav>
            <a href="index.php?page=index">Home</a> |
            <a href="index.php?page=login_vulnerable" style="color:#dc3545;">In-Band (Login)</a> |
            <a href="index.php?page=search_vulnerable" style="color:#dc3545;">In-Band (UNION)</a> |
            <a href="index.php?page=blind_sqli" style="color:#dc3545;">Blind (Time/Bool)</a> |
            <a href="index.php?page=register_vulnerable" style="color:#dc3545;">Sign-up Rentan</a> |
            <a href="index.php?page=register_secure" style="color:#28a745;">Sign-up Aman</a> |
            <?php if (isset($_SESSION['username'])): ?>
                <a href="index.php?page=dashboard"><b>Dashboard</b></a> |
                <a href="../actions/do_logout.php" style="color: #dc3545;">Logout</a>
            <?php else: ?>
                <a href="index.php?page=login_secure" style="color:#28a745;">Login Aman</a>
            <?php endif; ?>
        </nav>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if ($debug_query): ?>
            <h3>Query yang Dieksekusi:</h3>
            <div class="query-box"><?php echo htmlspecialchars($debug_query); ?></div>
        <?php endif; ?>

        ```

#### 2. File `templates/layout/footer.php`

Sekarang, buka file ini. **HAPUS SEMUA ISINYA.** (Termasuk yang `<html><div>...` dari screenshot Anda sebelumnya). Ganti **hanya** dengan kode di bawah ini.

```php
        </div> </body>
</html>