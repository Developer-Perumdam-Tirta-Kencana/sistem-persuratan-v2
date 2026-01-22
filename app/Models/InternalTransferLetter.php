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
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
    ];
}
