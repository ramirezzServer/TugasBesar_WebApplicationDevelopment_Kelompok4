# OurTucTuc 🚐💨 — Shuttle Management System (Web + REST API)

Project **OurTucTuc** adalah sistem manajemen shuttle/TucTuc kampus yang menyediakan:
- **Web App (Blade + Session Auth)** untuk Admin & Penumpang
- **REST API (Laravel Sanctum - Bearer Token)** untuk kebutuhan endpoint mobile / integrasi

Dibuat untuk **Tugas Besar Web Application Development (Kelompok 4)**.

---

## ✨ Fitur

### Web App (Blade)
**Role: admin**
- Dashboard Admin
- Kelola data: **Sopir**, **Kendaraan**, **Halte**, **Rute**, **Rute–Halte**, **Jadwal Sopir**
- Kelola keluhan: admin **hanya bisa ubah status keluhan** (bukan isi)

**Role: penumpang**
- Dashboard User
- Lihat daftar rute
- CRUD keluhan pribadi (tanpa bisa ubah status)
- Edit profil

### REST API (Sanctum)
- Register & Login menghasilkan **Bearer Token**
- Role-based access:
  - **admin**: CRUD operasional + lihat user
  - **penumpang**: buat/hapus keluhan milik sendiri
- Validasi jam jadwal sopir aman (termasuk **partial update**: update jam_mulai atau jam_selesai salah satu)

---

## 🧱 Tech Stack
- Laravel **12**
- PHP **8.2+**
- MySQL / MariaDB
- Laravel Sanctum
- Vite + TailwindCSS

---

## 📁 Struktur Project
Repo ini menyimpan aplikasi Laravel di folder:

- `OurTucTuc/` → Laravel App (web + api)

> Semua command dijalankan dari folder `OurTucTuc`.

---

## ✅ Requirements
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL / MariaDB

---

## 🚀 Quick Start (Local)

### 1) Masuk ke folder project
```bash
cd OurTucTuc
