<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DelegationLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemberi_kuasa_1_id',
        'pemberi_kuasa_2_id',
        'penerima_kuasa_id',
        'tujuan_transaksi',
    ];

    public function pemberiKuasaPertama()
    {
        return $this->belongsTo(User::class, 'pemberi_kuasa_1_id');
    }

    public function pemberiKuasaKedua()
    {
        return $this->belongsTo(User::class, 'pemberi_kuasa_2_id');
    }

    public function penerimaKuasa()
    {
        return $this->belongsTo(User::class, 'penerima_kuasa_id');
    }
}
