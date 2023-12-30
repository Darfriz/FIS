<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'name', 'email', 'from_location', 'to_location', 'date', 'passengers', 'total_price',
    ];
}
