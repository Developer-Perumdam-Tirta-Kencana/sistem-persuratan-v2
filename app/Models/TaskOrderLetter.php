<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskOrderLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'dasar_surat',
        'list_petugas',
        'hari_tanggal_tugas',
        'waktu_tugas',
        'tempat_tugas',
        'keperluan_tugas',
        'pakaian',
    ];

    protected $casts = [
        'list_petugas' => 'array',
    ];
}
