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
        'status',
        'approved_by',
        'approved_at',
        'approval_notes',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime:H:i:s',
        'waktu_selesai' => 'datetime:H:i:s',
        'approved_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
