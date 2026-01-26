# Fitur Persetujuan Surat (Approval Letters)

## Deskripsi
Halaman baru untuk mengelola persetujuan semua template surat dengan berbagai filter dan sorting yang canggih.

## Fitur Utama

### 1. **Filter & Sorting**
   - ✅ **Filter per Template Surat**
     - Semua Template (default)
     - Surat Payroll
     - Notifikasi Pekerjaan
     - Ketersediaan Air
     - Surat Rekomendasi
     - Surat Perintah Tugas
     - Surat Penugasan
     - Surat Transfer Internal
     - Surat Izin Magang

   - ✅ **Filter per Status Surat**
     - Menunggu ACC (Pending)
     - Sudah Disetujui (Approved)
     - Ditolak (Rejected)
     - Draft
     - Perlu Revisi (Need Revision)

   - ✅ **Pencarian**
     - Cari berdasarkan nomor surat
     - Cari berdasarkan perihal surat

### 2. **Dashboard Statistik**
   - Menampilkan total surat yang menunggu persetujuan
   - Menampilkan total surat yang sudah disetujui
   - Menampilkan total surat yang ditolak
   - Menampilkan total surat dalam draft
   - Menampilkan total surat yang perlu revisi

### 3. **Tabel Surat**
   Menampilkan informasi:
   - Template surat
   - Nomor surat
   - Perihal surat
   - Tanggal surat
   - Status surat (dengan color coding)
   - Aksi yang tersedia

### 4. **Aksi pada Surat**
   - Untuk surat dengan status "Menunggu ACC":
     - ✅ Tombol Setujui (Approve)
     - ❌ Tombol Tolak (Reject)
   - Untuk surat dengan status "Perlu Revisi":
     - ✏️ Tombol Edit
   - Untuk semua surat:
     - 👁️ Tombol Lihat (View)

### 5. **Status Badges dengan Warna**
   - 🟡 Menunggu ACC (Yellow)
   - 🟢 Disetujui (Green)
   - 🔴 Ditolak (Red)
   - ⚪ Draft (Gray)
   - 🟠 Perlu Revisi (Orange)

## File yang Dibuat

### Backend
- `app/Http/Controllers/ApprovalLetterController.php` - Controller utama untuk mengelola approval letters

### Frontend
- `resources/views/approval-letters/index.blade.php` - Tampilan halaman persetujuan surat

### Routes
- `GET /approval-letters` → `approval-letters.index` (menampilkan daftar surat untuk disetujui)

## Routes yang Didaftarkan
```php
// Approval Letters Route
Route::get('/approval-letters', [ApprovalLetterController::class, 'index'])->name('approval-letters.index');
```

## Akses Menu
### Admin Dashboard
- Menu tersedia di sidebar navigasi admin
- Lokasi: Setelah "Template Surat" section
- Label: "Persetujuan Surat"

### Staff Dashboard
- Quick action button di dashboard staff
- Judul: "Persetujuan Surat"

## Database Support
Controller mendukung semua template surat yang ada:
1. PayrollLetter
2. JobNotificationLetter
3. WaterAvailabilityLetter
4. RecommendationLetter
5. TaskOrderLetter
6. DelegationLetter
7. InternalTransferLetter
8. InternshipPermissionLetter

## Cara Menggunakan

### Mengakses Halaman
1. Login ke dashboard
2. Klik menu "Persetujuan Surat" di sidebar (admin) atau quick action (staff)
3. Atau akses langsung di: `/approval-letters`

### Memfilter Surat
1. Pilih template surat dari dropdown "Template Surat"
2. Pilih status surat dari dropdown "Status Surat"
3. Masukkan nomor/perihal surat di form pencarian (opsional)
4. Klik tombol "Filter"

### Reset Filter
- Klik tombol "Reset" untuk mengembalikan ke tampilan default

### Melakukan Aksi pada Surat
- Klik "Lihat" untuk melihat detail surat
- Klik "Setujui" untuk menyetujui surat (akan diminta konfirmasi)
- Klik "Tolak" untuk menolak surat (akan diminta alasan penolakan)
- Klik "Edit" untuk mengedit surat yang perlu revisi

## Catatan
- Semua surat ditampilkan secara urut dari yang terbaru
- Pagination otomatis setiap 15 surat per halaman
- Responsive design untuk mobile dan desktop
- Filter dapat dikombinasikan untuk pencarian yang lebih spesifik

## Phase Selanjutnya
- Implementasi fungsi approve/reject/edit yang belum selesai
- Penambahan validasi dan authorization
- Integrasi dengan email notification
- Export surat yang sudah disetujui
