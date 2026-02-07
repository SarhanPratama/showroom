<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_stok',
        'status_ready',
        'mobil_id',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
