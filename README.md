# OurTucTuc 🚐💨 — Shuttle Management REST API

Sistem backend (REST API) untuk mengelola operasional **shuttle/TucTuc kampus**: rute, halte, jadwal sopir, kendaraan, dan keluhan penumpang.  
Dibuat untuk **Tugas Besar Web Application Development (Kelompok 4)**.

> Fokus utama: API yang rapi, role-based access, dan validasi jam/jadwal yang aman saat update partial request.

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
