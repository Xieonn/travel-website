<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Destination extends Model
{

    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
        'category',
    ];
}
