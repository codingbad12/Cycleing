<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ShipType extends Pivot
{
    protected $table = 'ship_type';
    public $timestamps = false;
    protected $fillable = ['shipid', 'typeid'];
}
