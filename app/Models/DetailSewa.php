<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSewa extends Model
{
    use HasFactory;

    protected $fillable = [
        'sewaid',
        'shipid',
        'jumlah',
        'subtotal',
    ];

    // 🔗 Relasi ke Sewa
    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'sewaid');
    }

    // 🔗 Relasi ke Ship
    public function ship()
    {
        return $this->belongsTo(Ship::class, 'shipid');
    }
}
