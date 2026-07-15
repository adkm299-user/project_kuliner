# Proyek Akhir - Pemrograman Web Lanjut (Kelompok A11.4410)

Repository ini dibuat untuk memenuhi pengumpulan Final Project UAS Mata Kuliah Pemrograman Web Lanjut.
dengan anggota kelompok
ady kusuma - A11.2024.15823
rido pangestu - A11.2024.15813

## 🛠️ Cara Instalasi & Konfigurasi

## Persyaratan

Pastikan perangkat sudah terinstal:

- PHP 8.1 atau lebih baru
- Composer
- MySQL/MariaDB
- Git (opsional)

## Langkah Instalasi

1. Clone repository

```bash
git clone https://github.com/adkm299-user/project_kuliner.git
```

2. Masuk ke folder project

```bash
cd nama-project
```

3. Install dependency

```bash
composer install
```

4. Salin file konfigurasi

```bash
cp .env.example .env
```

_(Jika di Windows, cukup copy lalu ubah nama `.env.example` menjadi `.env`.)_

## Konfigurasi Database

1. Buat database baru di MySQL dengan nama:

```
db_kuliner
```

2. Buka file `.env`, lalu ubah bagian berikut sesuai konfigurasi MySQL:

```env
database.default.hostname = localhost
database.default.database = db_kuliner
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

## Menjalankan Migration dan Seeder

Buat tabel dan data awal dengan perintah:

```bash
php spark migrate --seed
```

## Menjalankan Aplikasi

Jalankan server CodeIgniter:

```bash
php spark serve
```

Aplikasi dapat diakses melalui:

```
http://localhost:8080
```

1. **Clone Repository**
   ```bash
   git clone [https://github.com/adkm299-user/project_kuliner.git](https://github.com/adkm299-user/project_kuliner.git)
   cd project_kuliner.git
   ```
