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
        // 'mobil_id', // Removing mobil_id as we use DetailPesanan now
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    // Deprecated or can comprise logic to get the 'first' car for backward compatibility if needed
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id'); // Keep for safety until fully migrated
    }
}
