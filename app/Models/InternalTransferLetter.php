<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalTransferLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_sumber',
        'no_rek_sumber',
        'bank_tujuan',
        'no_rek_tujuan',
        'nominal',
        'status',
        'approved_by',
        'approved_at',
        'approval_notes',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
