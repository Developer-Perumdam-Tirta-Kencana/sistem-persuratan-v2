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
        'status',
        'approved_by',
        'approved_at',
        'approval_notes',
    ];

    protected $casts = [
        'list_petugas' => 'array',
        'approved_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
