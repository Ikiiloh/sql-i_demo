# 🔐 Demo SQL Injection Lengkap

Aplikasi web edukatif untuk memahami berbagai jenis serangan SQL Injection dan cara pencegahannya.

## 📋 Deskripsi

Proyek ini adalah prototipe pembelajaran interaktif yang mendemonstrasikan berbagai teknik SQL Injection beserta implementasi keamanannya. Aplikasi ini dibuat untuk tujuan **edukasi** dalam memahami celah keamanan dan cara mengatasinya.

## ⚠️ Disclaimer

**PERINGATAN:** Aplikasi ini sengaja dibuat dengan celah keamanan untuk keperluan pembelajaran. **JANGAN** gunakan kode vulnerable ini di aplikasi production. Hanya gunakan di lingkungan lokal/development untuk belajar.

## ✨ Fitur Demo

### 🔴 Skenario Vulnerable (Rentan)

1. **In-Band SQL Injection (Login Bypass)**
   - Error-based SQL Injection
   - Logic-based Authentication Bypass
   - Payload: `admin' OR '1'='1' -- `

2. **In-Band SQL Injection (UNION-based)**
   - Mengekstrak data dari tabel lain
   - Payload: `Buku' UNION SELECT username, password FROM users -- `

3. **Blind SQL Injection**
   - Boolean-based: `1' AND 1=1 -- ` vs `1' AND 1=2 -- `
   - Time-based: `1' AND (SELECT 1 FROM (SELECT(SLEEP(5)))a) -- `

4. **INSERT Injection (Sign-up)**
   - Privilege Escalation saat registrasi
   - Payload: `hacker', 'fake-hash-123', 'admin'); -- `

### 🟢 Implementasi Aman

1. **Login Aman**
   - Prepared Statements (Parameterized Queries)
   - Password Hashing dengan `password_hash()`
   - Password Verification dengan `password_verify()`

2. **Registrasi Aman**
   - Prepared Statements
   - Secure Password Hashing
   - Validasi Input

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 7.4+
- **Database:** MySQL/MariaDB
- **Server:** XAMPP / Laragon / LAMP Stack
- **Frontend:** HTML5, CSS3 (Vanilla)

## 📦 Struktur Proyek

```
sql-i-demo/
├── actions/                    # File pemrosesan form
│   ├── do_blind_sqli.php
│   ├── do_login_secure.php
│   ├── do_login_vulnerable.php
│   ├── do_logout.php
│   ├── do_register_secure.php
│   └── do_register_vulnerable.php
├── public/                     # Folder publik (Document Root)
│   ├── css/
│   │   └── style.css
│   └── index.php              # Router utama
├── src/                       # Konfigurasi aplikasi
│   ├── bootstrap.php          # Inisialisasi session & database
│   ├── config.php             # Konfigurasi database
│   └── db.php                 # Koneksi PDO
├── templates/                 # Template HTML/PHP
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   └── pages/
│       ├── index.php
│       ├── login_vulnerable.php
│       ├── login_secure.php
│       ├── search_vulnerable.php
│       ├── blind_sqli.php
│       ├── register_vulnerable.php
│       ├── register_secure.php
│       └── dashboard.php
└── setup_baru.sql             # Script setup database
```

## 🚀 Cara Instalasi

### 1. Persiapan Environment

Pastikan Anda sudah menginstall:
- XAMPP / Laragon / LAMP Stack
- PHP 7.4 atau lebih tinggi
- MySQL/MariaDB

### 2. Setup Database

1. Buka **phpMyAdmin** (biasanya di `http://localhost/phpmyadmin`)
2. Buat database baru bernama `demo_db`
3. Import file `setup_baru.sql`:
   - Klik tab **Import**
   - Pilih file `setup_baru.sql`
   - Klik **Go**

### 3. Konfigurasi Koneksi Database

Buka file `src/config.php` dan sesuaikan jika perlu:

```php
$db_host = 'localhost';
$db_name = 'demo_db';
$db_user = 'root';
$db_pass = ''; // Kosongkan untuk XAMPP default
```

### 4. Jalankan Aplikasi

1. Letakkan folder `sql-i-demo` di dalam folder `htdocs` (XAMPP) atau `www` (Laragon)
2. Start Apache dan MySQL dari control panel
3. Buka browser dan akses: `http://localhost/sql-i-demo/public/`

## 📖 Cara Menggunakan

### Testing Vulnerability

#### 1. **Login Bypass (In-Band)**
- Buka halaman "In-Band (Login)"
- Username: `admin' OR '1'='1' -- ` (dengan spasi setelah --)
- Password: (isi apa saja)
- Hasil: Berhasil login sebagai admin pertama di database

#### 2. **UNION-based Attack**
- Buka halaman "In-Band (UNION)"
- Input: `Buku' UNION SELECT username, password FROM users -- `
- Hasil: Menampilkan username dan hash password dari tabel users

#### 3. **Blind SQL Injection**
- Buka halaman "Blind (Time/Bool)"
- Boolean True: `1' AND 1=1 -- ` (produk ditemukan)
- Boolean False: `1' AND 1=2 -- ` (produk tidak ditemukan)
- Time-based: `1' AND (SELECT 1 FROM (SELECT(SLEEP(5)))a) -- ` (delay 5 detik)

#### 4. **INSERT Injection**
- Buka halaman "Sign-up Rentan"
- Username: `hacker', 'fake-hash-123', 'admin'); -- `
- Password: (isi apa saja)
- Hasil: Akun dibuat dengan role 'admin'

### Testing Secure Implementation

1. Coba payload yang sama di halaman **"Login Aman"** dan **"Sign-up Aman"**
2. Serangan akan gagal karena:
   - Menggunakan Prepared Statements
   - Input di-escape dengan aman
   - Password di-hash dengan benar

## 🎯 Tujuan Pembelajaran

Setelah menggunakan aplikasi ini, Anda diharapkan memahami:

1. ✅ Cara kerja berbagai jenis SQL Injection
2. ✅ Dampak dari SQL Injection terhadap keamanan aplikasi
3. ✅ Perbedaan antara kode vulnerable dan kode yang aman
4. ✅ Implementasi Prepared Statements dengan PDO
5. ✅ Best practices dalam pengelolaan password
6. ✅ Pentingnya validasi dan sanitasi input

## 🔒 Prinsip Keamanan yang Diajarkan

### ❌ Yang TIDAK Boleh Dilakukan

```php
// VULNERABLE - Jangan pernah lakukan ini!
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $db->query($sql);
```

### ✅ Yang HARUS Dilakukan

```php
// SECURE - Selalu gunakan Prepared Statements
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
```

## 📊 Data Default

### Tabel `users`
| Username | Password | Role  |
|----------|----------|-------|
| admin    | admin123 | admin |
| budi     | budi456  | user  |

### Tabel `products`
- Laptop Gaming, Mouse Wireless, Monitor 4K (Elektronik)
- Buku Pemrograman, Novel Misteri (Buku)

## 🐛 Troubleshooting

### Error: "Koneksi database gagal"
- Pastikan MySQL sudah running
- Cek konfigurasi di `src/config.php`
- Pastikan database `demo_db` sudah dibuat

### Error: "Call to undefined function password_verify()"
- Upgrade PHP ke versi 7.4 atau lebih tinggi

### Halaman tidak menampilkan styling
- Pastikan mengakses melalui `public/index.php`
- Cek path file CSS di `public/css/style.css`

## 📚 Referensi & Materi Lanjutan

- [OWASP SQL Injection](https://owasp.org/www-community/attacks/SQL_Injection)
- [PHP PDO Prepared Statements](https://www.php.net/manual/en/pdo.prepared-statements.php)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)

## 👨‍💻 Kontributor

Proyek ini dibuat untuk keperluan edukasi dan pembelajaran keamanan aplikasi web.

## 📄 Lisensi

Proyek ini bebas digunakan untuk keperluan pembelajaran. Gunakan dengan bijak dan bertanggung jawab.

---

**Catatan Penting:** Selalu praktikkan ethical hacking dan gunakan pengetahuan ini hanya untuk tujuan yang baik! 🛡️