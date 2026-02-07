<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pesan',
        'status_pesanan',
        'total_harga',
        'customer_id',
        'mobil_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
