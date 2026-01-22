<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobNotificationLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'instansi_tujuan',
        'lokasi_pekerjaan',
        'hari_tanggal_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_pekerjaan',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime:H:i:s',
        'waktu_selesai' => 'datetime:H:i:s',
    ];
}
