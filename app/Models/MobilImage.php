<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilImage extends Model
{
    use HasFactory;

    protected $fillable = ['mobil_id', 'image'];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
