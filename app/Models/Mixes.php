<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Mixes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'description',
        'user_id',
        'cuisine',
        'photo_url'
    ];
}