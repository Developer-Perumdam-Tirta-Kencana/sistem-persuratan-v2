# Template Surat - Sistem Surat v2

## 📋 Daftar Template Surat yang Tersedia

### 1. Surat Payroll (Gaji)
**Route:** `/payroll-letters`
**Model:** PayrollLetter
**Controller:** PayrollLetterController

**Field Database:**
- `bank_tujuan` (Enum: Jatim, BRI)
- `nomor_surat` (String)
- `tanggal_surat` (Date)
- `bulan_gaji` (String)
- `total_nominal` (Decimal)
- `nomor_rekening_sumber` (String)

**Form Input:**
- Nomor Surat
- Tanggal Surat
- Periode/Bulan Gaji
- Tujuan Bank (Dropdown: Jatim/BRI)
- Nomor Rekening Sumber
- Total Gaji (dengan auto terbilang)

---

### 2. Surat Pemberitahuan Pekerjaan
**Route:** `/job-notification-letters`
**Model:** JobNotificationLetter
**Controller:** JobNotificationLetterController

**Field Database:**
- `instansi_tujuan` (String)
- `lokasi_pekerjaan` (Text)
- `hari_tanggal_pelaksanaan` (String)
- `waktu_mulai` (Time)
- `waktu_selesai` (Time)
- `jenis_pekerjaan` (String)

**Form Input:**
- Instansi Tujuan
- Jenis Pekerjaan
- Lokasi (Textarea)
- Tanggal Pelaksanaan
- Waktu Mulai - Selesai

---

### 3. Surat Informasi Ketersediaan Air (Developer)
**Route:** `/water-availability-letters`
**Model:** WaterAvailabilityLetter
**Controller:** WaterAvailabilityLetterController

**Field Database:**
- `status_ketersediaan` (Boolean)
- `nama_pengembang` (String)
- `nama_proyek` (String)
- `alamat_proyek` (Text)
- `nomor_surat_masuk` (String)
- `tanggal_surat_masuk` (Date)

**Form Input:**
- Status (Radio: Dapat/Belum Dapat Melayani)
- Nama Pengembang/PT
- Nama Perumahan
- Alamat Lokasi (Textarea)
- Dasar Surat Masuk (Nomor & Tanggal)

---

### 4. Surat Rekomendasi
**Route:** `/recommendation-letters`
**Model:** RecommendationLetter
**Controller:** RecommendationLetterController

**Field Database:**
- `nama_pt` (String)
- `jenis_kegiatan` (String)
- `nama_perumahan` (String)
- `jumlah_unit` (Integer)
- `lokasi` (Text)

**Form Input:**
- Nama PT Pengembang
- Jenis Kegiatan
- Nama Perumahan
- Jumlah Unit
- Lokasi (Textarea)

---

### 5. Surat Perintah Tugas (SPT)
**Route:** `/task-order-letters`
**Model:** TaskOrderLetter
**Controller:** TaskOrderLetterController

**Field Database:**
- `dasar_surat` (Text)
- `list_petugas` (JSON Array)
- `hari_tanggal_tugas` (String)
- `waktu_tugas` (String)
- `tempat_tugas` (String)
- `keperluan_tugas` (Text)
- `pakaian` (String, Optional)

**Form Input:**
- Dasar Surat (Textarea)
- Daftar Petugas (Repeater/Multi-select)
- Tanggal Tugas (Date Range)
- Waktu
- Tempat
- Keperluan (Textarea)
- Dresscode/Pakaian (Optional)

---

### 6. Surat Kuasa Pelimpahan
**Route:** `/delegation-letters`
**Model:** DelegationLetter
**Controller:** DelegationLetterController

**Field Database:**
- `pemberi_kuasa_1_id` (FK to users - Direktur)
- `pemberi_kuasa_2_id` (FK to users - Kabag Keu)
- `penerima_kuasa_id` (FK to users - Staf)
- `tujuan_transaksi` (Text)

**Form Input:**
- Pemberi Kuasa 1 (Dropdown: Pilih Direktur)
- Pemberi Kuasa 2 (Dropdown: Pilih Kabag)
- Penerima Kuasa (Dropdown: Pilih Staf)
- Untuk Keperluan (Textarea)

---

### 7. Surat Pelimpahan Rekening (Internal Transfer)
**Route:** `/internal-transfer-letters`
**Model:** InternalTransferLetter
**Controller:** InternalTransferLetterController

**Field Database:**
- `bank_sumber` (String)
- `no_rek_sumber` (String)
- `bank_tujuan` (String)
- `no_rek_tujuan` (String)
- `nominal` (Decimal)

**Form Input:**
- Bank Asal
- No. Rekening Asal
- Nominal (Rp)
- Bank Tujuan
- No. Rekening Tujuan

---

### 8. Surat Izin Magang/PKL
**Route:** `/internship-permission-letters`
**Model:** InternshipPermissionLetter
**Controller:** InternshipPermissionLetterController

**Field Database:**
- `instansi_pendidikan` (String)
- `nomor_surat_permohonan` (String)
- `list_mahasiswa` (JSON Array: nama, nim, prodi)
- `tanggal_mulai` (Date)
- `tanggal_selesai` (Date)

**Form Input:**
- Asal Kampus/Sekolah
- Dasar/No Surat Permohonan
- Daftar Mahasiswa (Repeater: Nama, NIM, Prodi)
- Durasi Magang (Date Range: Mulai - Selesai)

---

## 🚀 Cara Menggunakan

### 1. Migrasi Database
```bash
php artisan migrate
```

### 2. Akses Template
Setiap template dapat diakses melalui route yang telah didefinisikan:
- `/payroll-letters` - Surat Payroll
- `/job-notification-letters` - Pemberitahuan Pekerjaan
- `/water-availability-letters` - Ketersediaan Air
- `/recommendation-letters` - Rekomendasi
- `/task-order-letters` - Perintah Tugas
- `/delegation-letters` - Kuasa Pelimpahan
- `/internal-transfer-letters` - Pelimpahan Rekening
- `/internship-permission-letters` - Izin Magang/PKL

### 3. Fitur CRUD
Setiap template memiliki fitur lengkap:
- ✅ **List/Index** - Melihat daftar surat
- ✅ **Create** - Membuat surat baru
- ✅ **Show** - Melihat detail surat
- ✅ **Edit** - Mengedit surat
- ✅ **Delete** - Menghapus surat

---

## 📁 Struktur File

### Controllers
```
app/Http/Controllers/
├── PayrollLetterController.php
├── JobNotificationLetterController.php
├── WaterAvailabilityLetterController.php
├── RecommendationLetterController.php
├── TaskOrderLetterController.php
├── DelegationLetterController.php
├── InternalTransferLetterController.php
└── InternshipPermissionLetterController.php
```

### Models
```
app/Models/
├── PayrollLetter.php
├── JobNotificationLetter.php
├── WaterAvailabilityLetter.php
├── RecommendationLetter.php
├── TaskOrderLetter.php
├── DelegationLetter.php
├── InternalTransferLetter.php
└── InternshipPermissionLetter.php
```

### Migrations
```
database/migrations/
├── 2026_01_22_000001_create_payroll_letters_table.php
├── 2026_01_22_000002_create_job_notification_letters_table.php
├── 2026_01_22_000003_create_water_availability_letters_table.php
├── 2026_01_22_000004_create_recommendation_letters_table.php
├── 2026_01_22_000005_create_task_order_letters_table.php
├── 2026_01_22_000006_create_delegation_letters_table.php
├── 2026_01_22_000007_create_internal_transfer_letters_table.php
└── 2026_01_22_000008_create_internship_permission_letters_table.php
```

### Views (Contoh untuk Payroll)
```
resources/views/payroll-letters/
├── index.blade.php   (List)
├── create.blade.php  (Form Tambah)
├── edit.blade.php    (Form Edit)
└── show.blade.php    (Detail)
```

---

## 🔧 Next Steps

1. **Generate views untuk template lainnya** (7 template sisanya)
2. **Tambahkan validasi custom** menggunakan Form Request
3. **Implementasi export PDF** untuk setiap template
4. **Tambahkan fitur pencarian & filter** di halaman index
5. **Buat dashboard overview** menampilkan statistik semua template
6. **Integrasi dengan template Word** untuk generate dokumen

---

## 💡 Catatan Penting

- Semua route sudah dilindungi middleware `auth`
- Validasi input sudah diterapkan di controller
- Field JSON (list_petugas, list_mahasiswa) otomatis di-cast oleh model
- Relasi foreignKey (delegation_letters) sudah di-setup dengan restrict on delete
- Pagination sudah aktif (15 items per page)

---

**Status:** ✅ Database & Controllers Ready | ⏳ Views In Progress
