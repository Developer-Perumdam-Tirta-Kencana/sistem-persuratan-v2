# Fitur Toggle Registrasi

## Deskripsi
Fitur ini memungkinkan administrator untuk mengaktifkan atau menonaktifkan menu registrasi publik pada aplikasi e-Surat Tirta Kencana.

## Cara Menggunakan

### Untuk Administrator:
1. Login sebagai administrator (role: manager)
2. Buka menu **User Management** dari dashboard
3. Di bagian atas halaman, Anda akan melihat panel **Status Registrasi Publik**
4. Klik toggle switch untuk mengaktifkan atau menonaktifkan registrasi
5. Status akan berubah secara real-time:
   - **Aktif** (hijau): Pengguna baru dapat mendaftar
   - **Nonaktif** (merah): Menu registrasi disembunyikan

### Dampak Saat Registrasi Dinonaktifkan:
- Link "Daftar sekarang" di halaman login akan hilang
- Tombol "Register" di landing page akan hilang
- Tombol "Mulai Sekarang" dan "Daftar Sekarang" di landing page akan hilang
- Akses langsung ke `/register` akan redirect ke login dengan pesan error

## Teknologi yang Digunakan

### Database:
- Tabel: `system_settings`
- Kolom: `key`, `value`, `description`
- Key: `registration_enabled` (nilai: '1' = aktif, '0' = nonaktif)

### Model:
- `App\Models\SystemSetting`
- Method: `isRegistrationEnabled()` - cek status registrasi
- Method: `get($key, $default)` - ambil setting dengan cache
- Method: `set($key, $value)` - set nilai setting

### Controller:
- `App\Http\Controllers\Admin\UserManagementController`
  - `index()` - menampilkan halaman user management dengan status registrasi
  - `toggleRegistration()` - toggle status registrasi via AJAX

- `App\Http\Controllers\Auth\RegisteredUserController`
  - `create()` - cek status registrasi sebelum menampilkan form
  - `store()` - cek status registrasi sebelum proses pendaftaran

### Routes:
```php
Route::post('/admin/user-management/toggle-registration', 
    [UserManagementController::class, 'toggleRegistration'])
    ->name('admin.user-management.toggle-registration');
```

### Views:
- `resources/views/admin/user-management.blade.php` - UI toggle
- `resources/views/auth/login.blade.php` - kondisional link registrasi
- `resources/views/landing.blade.php` - kondisional tombol registrasi

## Keamanan
- Hanya role **manager** (admin) yang dapat mengakses fitur toggle
- Middleware `role:manager` melindungi route toggle
- CSRF token digunakan untuk semua request AJAX
- Cache otomatis dibersihkan saat setting diubah

## Default Setting
- Registrasi **AKTIF** secara default saat migration dijalankan
- Data default tersimpan di migration: `2026_01_19_030724_create_system_settings_table.php`
