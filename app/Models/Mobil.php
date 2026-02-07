<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mobil',
        'harga',
        'stok',
        'deskripsi',
        'merek_id',
        'tipe_id',
    ];

    public function merek()
    {
        return $this->belongsTo(Merek::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipeMobil::class);
    }

    public function inventory()
    {
        return $this->hasOne(InventoryMobil::class);
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'mobil_promo');
    }
}
