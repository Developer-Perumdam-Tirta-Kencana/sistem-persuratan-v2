<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'tujuan',
        'status',
        'dibuat_oleh',
        'disetujui_oleh',
    ];

    protected $dates = [
        'tanggal_surat',
        'created_at',
        'updated_at',
    ];
}
