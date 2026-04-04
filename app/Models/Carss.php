<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carss extends Model
{
    protected $table = 'carsses'; // your table name

    protected $fillable = ['name', 'brand', 'image'];
}