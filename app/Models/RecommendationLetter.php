<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendationLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pt',
        'jenis_kegiatan',
        'nama_perumahan',
        'jumlah_unit',
        'lokasi',
        'status',
        'approved_by',
        'approved_at',
        'approval_notes',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
