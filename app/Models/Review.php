<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
     protected $fillable = [
        'userid',
        'shipid',
        'rating',
        'comment',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke produk
    public function ship()
    {
        return $this->belongsTo(ship::class);
    }
}
