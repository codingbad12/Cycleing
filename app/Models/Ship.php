<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_day',
        'capacity',
        'image',
        'description',
        'length',
        'year_built',
        'max_speed',
        'amenities',
        'stock',
    ];

    // 🔗 Relasi ke detail sewa
    public function detailSewas()
    {
        return $this->hasMany(DetailSewa::class, 'shipid');
    }

    // 🔗 Many-to-Many ke Type
    public function types()
    {
        return $this->belongsToMany(Type::class, 'ship_type', 'shipid', 'typeid')
                ->using(ShipType::class);
    }

    // Relation to Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
