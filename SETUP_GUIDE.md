# Sistem Surat PHP 8 - Setup Guide

## Overview
Sistem Persuratan dengan Laravel 8, Breeze Authentication, dan Role-Based Access Control (Admin, Staff, User).

## Features
- ✅ Laravel Breeze Authentication (Login/Register)
- ✅ Role-Based Access Control (RBAC)
  - Admin: Full access
  - Staff: Limited access
  - User: Basic access
- ✅ Landing Page
- ✅ Role-specific Dashboards
- ✅ Middleware untuk proteksi route berdasarkan role

## Requirements
- PHP 7.3+
- Composer
- MySQL/MariaDB
- Node.js & NPM

## Installation Steps

### 1. Configure Environment
Copy `.env.example` ke `.env` jika belum ada:
```bash
cp .env.example .env
```

Update database configuration di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_surat
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Create Database
Buat database baru:
```sql
CREATE DATABASE sistem_surat;
```

### 3. Run Migrations
Jalankan migration untuk membuat tabel:
```bash
php artisan migrate
```

### 4. Seed Database
Jalankan seeder untuk membuat roles default:
```bash
php artisan db:seed
```

### 5. Install NPM Dependencies
```bash
npm install
```

### 6. Build Assets
```bash
npm run dev
```

### 7. Run Application
```bash
php artisan serve
```

Akses aplikasi di: http://localhost:8000

## Default Roles

| ID | Role Name | Description |
|----|-----------|-------------|
| 1  | admin     | Administrator with full access |
| 2  | staff     | Staff member with limited access |
| 3  | user      | Regular user |

## Creating Admin User

```bash
php artisan tinker
```

```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = Hash::make('password');
$user->role_id = 1;
$user->save();
```

## Route Structure

- `/` - Landing Page
- `/login` - Login
- `/register` - Register
- `/admin/dashboard` - Admin Dashboard
- `/staff/dashboard` - Staff Dashboard
- `/user/dashboard` - User Dashboard
