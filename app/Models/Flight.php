<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model {
    use HasFactory;

    // plural snake naming
    protected $table = "my_flights";

    public $incrementing = false;

    // protected $keyType = "string";

    // about time
    // public $timestamps = false;
    // protected $dateFormat = 'U';

    // define column default value
    protected $attributes = [
        "key" => "val",
    ];

}
