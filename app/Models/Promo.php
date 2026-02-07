<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_promo',
        'diskon',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function mobils()
    {
        return $this->belongsToMany(Mobil::class, 'mobil_promo');
    }
}
