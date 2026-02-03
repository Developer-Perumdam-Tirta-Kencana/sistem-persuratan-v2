<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskOrderLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'dasar_surat',
        'hari',
        'tanggal_surat',
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
        'tanggal_surat' => 'date',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getJumlahPetugasAttribute()
    {
        $list = $this->list_petugas;
        if (is_array($list)) return count($list);
        if (is_string($list)) {
            $decoded = json_decode($list, true);
            return is_array($decoded) ? count($decoded) : 0;
        }
        return 0;
    }
}
