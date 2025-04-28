# 📚 Tutorial Pemulihan Database dan Update URL API di Hosting Baru

Dokumen ini menjelaskan langkah-langkah untuk:
- **Mengimpor** file SQL (`export_mysql7_serv00_com.sql`) ke dalam database MySQL di **hosting baru**.
- **Mengubah URL API** pada source code aplikasi agar sesuai dengan domain hosting baru.

---

## 📋 Prasyarat

- Akses ke **cPanel** atau **phpMyAdmin** di hosting baru.
- File `export_mysql7_serv00_com.sql` tersedia.
- Database MySQL telah dibuat di hosting.
- Akses ke source code aplikasi untuk melakukan update URL.

> **Catatan:** Pastikan nama database, username, password, dan domain baru sudah dikonfigurasi dengan benar.

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

### 1. Cari File BuildVars.java
- Buka source code aplikasi menggunakan Android Studio atau editor kode lainnya.
- Arahkan ke file berikut:
  ```
  nama paket aplikasi contoh yang aplikasi user:
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
Cek bahwa semua endpoint sudah mengacu ke `BASE_URL_API`, contoh:

```java
public static final String URL_LOGIN = BASE_URL_API + "auth/login.php";
public static final String URL_REGISTER = BASE_URL_API + "auth/register.php";
public static final String PRODUCT_LIST = BASE_URL_API + "product/products.php";
```

---

## 📑 Troubleshooting

| Masalah | Solusi |
| :--- | :--- |
| Error "Max Upload Size Exceeded" saat import SQL | Tingkatkan limit upload file pada `php.ini`, atau gunakan metode upload manual via File Manager. |
| Error "Access Denied for User" | Pastikan username, password, dan hak akses database sudah benar. |
| Charset atau Collation Error | Pastikan collation database sesuai dengan file SQL (`utf8mb4`, `latin1`, dll). |
| Aplikasi tidak bisa konek ke API | Pastikan URL API sudah diperbarui ke domain baru, database sudah aktif, dan file PHP sudah berada di direktori `api/` di hosting. |

---

## 📎 Referensi

- [phpMyAdmin Official Documentation](https://docs.phpmyadmin.net/en/latest/)
- [MySQL Import and Export Documentation](https://dev.mysql.com/doc/refman/8.0/en/mysqlimport.html)
- [Android Networking Best Practices](https://developer.android.com/training/volley)
- [cPanel Database Management Guide](https://docs.cpanel.net/cpanel/databases/)

---

> 📌 **Penting:** Selalu lakukan **backup** database dan source code sebelum melakukan migrasi atau perubahan besar pada aplikasi.
