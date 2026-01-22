<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipPermissionLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'instansi_pendidikan',
        'nomor_surat_permohonan',
        'list_mahasiswa',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'list_mahasiswa' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
