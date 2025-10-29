<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
     use HasFactory;

    protected $fillable = [
        'userid',
        'start_sewa',
        'end_sewa',
        'total_price',
        'status',
    ];

    protected $casts = [
        'start_sewa' => 'date',
        'end_sewa' => 'date',
    ];

    // 🔗 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // 🔗 Relasi ke DetailSewa
    public function detailSewas()
    {
        return $this->hasMany(DetailSewa::class, 'sewaid');
    }
}
