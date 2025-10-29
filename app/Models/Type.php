<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // 🔗 Many-to-Many ke Ship
    public function ships()
    {
        return $this->belongsToMany(Ship::class, 'ship_type', 'typeid', 'shipid')
                ->using(ShipType::class);
    }
}
