# 📚 Tutorial Pemulihan Database, Update URL API, dan Edit `db_connect.php` di Hosting Baru

Dokumen ini menjelaskan langkah-langkah untuk:
- **Mengimpor** file SQL (`export_mysql7_serv00_com.sql`) ke dalam database MySQL di **hosting baru**.
- **Mengubah URL API** pada source code aplikasi.
- **Mengedit konfigurasi database** pada file `db_connect.php`.

---

## 📋 Prasyarat

- Akses ke **cPanel** atau **phpMyAdmin** di hosting baru.
- File `export_mysql7_serv00_com.sql` tersedia.
- Database MySQL telah dibuat di hosting baru.
- Akses ke source code aplikasi untuk update konfigurasi.
- Data koneksi database baru: hostname, username, password, nama database.

> **Catatan:** Pastikan semua informasi hosting dan database sudah sesuai.

---

## 🛠️ Langkah-langkah Pemulihan Database

### 1. Masuk ke cPanel
- Buka browser, lalu akses halaman **cPanel** hosting Anda.
- Login menggunakan **username** dan **password** yang diberikan.

### 2. Buat Database Baru
- Di bagian **Databases**, klik **MySQL® Databases**.
- Buat **database baru** (contoh: `nama_database_baru`).
- Buat juga **user database** dan **berikan semua hak akses** ke database tersebut.

### 3. Akses phpMyAdmin
- Dari beranda cPanel, klik **phpMyAdmin** pada bagian **Databases**.
- Pilih database baru yang telah dibuat.

### 4. Import File SQL
- Klik menu **Import** di phpMyAdmin.
- Pada bagian **File to Import**, klik **Choose File** dan pilih file `export_mysql7_serv00_com.sql`.
- Pastikan pengaturan:
  - Format: **SQL**
  - Collation: **utf8mb4_general_ci** (atau sesuai kebutuhan)
- Klik tombol **Go** untuk memulai proses import.

> **Catatan Penting:**  
> Jika file lebih dari **50MB**, gunakan metode upload melalui **File Manager** dan restore via command line, atau minta bantuan support hosting.

### 5. Verifikasi Hasil Import
- Pastikan tabel-tabel dan data sudah masuk ke dalam database.
- Lakukan pengecekan pada aplikasi untuk memastikan koneksi database berhasil.

---

## 🛠️ Langkah-langkah Mengubah URL API di Aplikasi

Jika domain hosting Anda berubah, perlu memperbarui URL API di aplikasi Anda.

### 1. Cari File `BuildVars.java`
- Buka source code aplikasi menggunakan Android Studio atau editor kode lainnya.
- Arahkan ke file berikut:
  ```
  /org/brownies/ummah/utils/BuildVars.java
  ```

### 2. Edit Konstanta URL
Temukan bagian kode berikut:

```java
public static class Api {
    public static final String BASE_URL_API = "https://keylachan.serv00.net/api/";
}
```

Ubah `BASE_URL_API` menjadi domain baru Anda, contoh:

```java
public static class Api {
    public static final String BASE_URL_API = "https://domainbaruanda.com/api/";
}
```

### 3. Simpan dan Build Ulang
- Simpan perubahan yang telah dilakukan.
- Build ulang aplikasi untuk menerapkan perubahan URL API baru.

### 4. Pastikan Endpoint Terkait Menggunakan URL Baru
Semua endpoint harus mengacu ke `BASE_URL_API`, contoh:

```java
public static final String URL_LOGIN = BASE_URL_API + "auth/login.php";
public static final String URL_REGISTER = BASE_URL_API + "auth/register.php";
public static final String PRODUCT_LIST = BASE_URL_API + "product/products.php";
```

---

## 🛠️ Langkah-langkah Mengedit `db_connect.php`

Agar aplikasi terhubung dengan database baru, Anda harus memperbarui file `db_connect.php`.

### 1. Cari File `db_connect.php`
- File ini biasanya ada di folder `api/` pada struktur hosting Anda.
- Contoh path:  
  ```
  /public_html/db_connect.php
  ```
  dan di 
  ```
  /public_html/api/db_connect.php
  ```


### 2. Edit Konfigurasi Database

Contoh isi `db_connect.php` lama:

```php
<?php
$host = "mysql7.serv00.com";
$username = "m5329_admin";
$password = "MmBdW[hW60'VeM0eJdQDc3q+*JwH26";
$database = "m5329_admin";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

Update informasi berikut sesuai data baru:

- `$host`: hostname server database baru (contoh: `localhost` atau IP server hosting).
- `$username`: username database baru.
- `$password`: password database baru.
- `$database`: nama database baru.

Contoh setelah diubah:

```php
<?php
$host = "localhost";
$username = "dbuser_baru";
$password = "password_baru";
$database = "nama_database_baru";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 3. Simpan Perubahan
- Setelah diedit, simpan file `db_connect.php`.
- Upload kembali ke server jika Anda mengeditnya secara lokal.

### 4. Uji Koneksi
- Coba akses endpoint API Anda (seperti `/api/auth/login.php`) untuk memastikan koneksi ke database berhasil.

> **Tips:** Untuk keamanan, jangan pernah hardcode password database dalam file publik jika memungkinkan, gunakan environment variable bila didukung.

---

## 📑 Troubleshooting

| Masalah | Solusi |
| :--- | :--- |
| Error "Max Upload Size Exceeded" saat import SQL | Tingkatkan limit upload file pada `php.ini`, atau gunakan metode upload manual via File Manager. |
| Error "Access Denied for User" | Pastikan username, password, dan hak akses database sudah benar. |
| Charset atau Collation Error | Pastikan collation database sesuai dengan file SQL (`utf8mb4`, `latin1`, dll). |
| Aplikasi tidak bisa konek ke API | Pastikan URL API sudah diperbarui ke domain baru, database sudah aktif, dan file PHP sudah benar dikonfigurasi. |
| Error "Connection failed" di `db_connect.php` | Periksa kembali hostname, username, password, dan nama database di konfigurasi. |

---

## 📎 Referensi

- [phpMyAdmin Official Documentation](https://docs.phpmyadmin.net/en/latest/)
- [MySQL Import and Export Documentation](https://dev.mysql.com/doc/refman/8.0/en/mysqlimport.html)
- [Secure PHP Database Connection](https://www.php.net/manual/en/mysqli.construct.php)
- [Android Networking Best Practices](https://developer.android.com/training/volley)
- [cPanel Database Management Guide](https://docs.cpanel.net/cpanel/databases/)

---

> 📌 **Penting:** Selalu lakukan **backup** database dan source code sebelum melakukan migrasi atau perubahan besar pada aplikasi.
