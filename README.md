# OurTucTuc 🚐💨  
REST API untuk sistem **manajemen shuttle/TucTuc kampus**: rute, halte, jadwal sopir, kendaraan, dan keluhan penumpang.  
Dibangun sebagai **Tugas Besar Web Application Development (Kelompok 4)**.

![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel&logoColor=white)
![Sanctum](https://img.shields.io/badge/Auth-Sanctum-0F172A)
![API](https://img.shields.io/badge/Type-REST%20API-22c55e)

---

## ✨ Fitur Utama
### 🔐 Authentication & Role
- Register & Login menggunakan **Laravel Sanctum (Bearer Token)**
- Role-based access:
  - **admin**: kelola data operasional
  - **penumpang**: bikin & kelola keluhan sendiri

### 🗺️ Operasional Shuttle
- **Halte**: CRUD halte
- **Rute**: CRUD rute
- **Rute–Halte**: mapping rute ke halte + **jam_berangkat**
- **Kendaraan**: CRUD kendaraan + status (aktif/nonaktif)
- **Sopir**: CRUD sopir + upload foto (multipart/form-data)
- **Jadwal Sopir**: CRUD jadwal dengan validasi jam (jam_selesai > jam_mulai)

### 🗣️ Keluhan Penumpang
- Penumpang bisa:
  - buat keluhan
  - lihat daftar keluhan sendiri
  - update isi keluhan (tanpa ubah status)
  - hapus keluhan sendiri
- Admin bisa:
  - update **status** keluhan (tanpa ubah isi)

---

## 🧱 Tech Stack
- **Laravel 12**
- **PHP 8.2+**
- **Laravel Sanctum**
- **MySQL / MariaDB**
- **Vite + Tailwind (dev deps)**

---

## 🚀 Quick Start (Local)
> Contoh base URL kalau pakai artisan serve: `http://127.0.0.1:8000`

### 1) Install dependency
```bash
composer install
npm install
