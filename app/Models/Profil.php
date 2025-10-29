<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use hasFactory;

    protected $fillable = [
        'userid',
        'nama',
        'alamat',
        'no_telp',
        'bio',
        'tanggal_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
