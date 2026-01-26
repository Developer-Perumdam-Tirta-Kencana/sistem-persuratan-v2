<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_tujuan',
        'nomor_surat',
        'tanggal_surat',
        'bulan_gaji',
        'total_nominal',
        'nomor_rekening_sumber',
        'status',
        'approved_by',
        'approved_at',
        'approval_notes',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'total_nominal' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
