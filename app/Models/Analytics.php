<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $table = 'analytics_table'; // Adjust this according to your actual table name

    protected $fillable = [
        'gross_profit',
        'tax',
        'operational_cost',
        'nett_profit',
        // Add other fields as needed
    ];

    // Other model properties and methods...
}
