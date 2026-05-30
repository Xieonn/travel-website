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

    public function up(): void
{
    Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->string('location');
        $table->string('image')->nullable();
        $table->string('category');
        $table->timestamps();
    });
}
}
