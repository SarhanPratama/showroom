<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'badge_text',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'is_active',
        'order'
    ];
}
