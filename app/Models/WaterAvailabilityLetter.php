<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterAvailabilityLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_ketersediaan',
        'nama_pengembang',
        'nama_proyek',
        'alamat_proyek',
        'nomor_surat_masuk',
        'tanggal_surat_masuk',
    ];

    protected $casts = [
        'status_ketersediaan' => 'boolean',
        'tanggal_surat_masuk' => 'date',
    ];
}
