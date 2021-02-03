<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query;

class Pastel extends Model{
    protected $table = "pasteles";

    protected $fillable = [
        'sabor',
        'tamano',
        'precio'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}