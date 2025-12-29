# OurTucTuc 🚐💨 — Shuttle Management REST API

Sistem backend (REST API) untuk mengelola operasional **shuttle/TucTuc kampus**: rute, halte, jadwal sopir, kendaraan, dan keluhan penumpang.  
Dibuat untuk **Tugas Besar Web Application Development (Kelompok 4)**.

> Fokus utama: API yang rapi, role-based access, dan validasi jam/jadwal yang aman saat update partial request.

---

## 🌟 Highlights
- **Auth** pakai **Laravel Sanctum** (Bearer Token)
- **Role-based access**: `admin` & `penumpang`
- CRUD data operasional: **Halte, Rute, Kendaraan, Sopir, Jadwal Sopir, Rute–Halte**
- **Keluhan** dengan aturan akses:
  - penumpang: buat & kelola keluhan sendiri
  - admin: update status keluhan
- Upload foto sopir (multipart/form-data) + storage link

---

## 🧰 Tech Stack
- Laravel 12
- PHP 8.2+
- MySQL/MariaDB
- Sanctum (Token-based Auth)

---

## 🗂️ Modul & Entity
**Entity utama:**
- `users` (role: admin/penumpang)
- `halte`
- `rute`
- `rute_halte` (mapping rute ke halte + jam)
- `kendaraan`
- `sopir` (foto)
- `jadwal_sopir` (jam_mulai & jam_selesai)
- `keluhan`

---

## 🔐 Auth Flow (Ringkas)
1. **Register / Login**
2. Dapat **token**
3. Kirim header berikut di request selanjutnya:

```http
Authorization: Bearer <token>
Accept: application/json
