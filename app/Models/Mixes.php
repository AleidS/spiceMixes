<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// tutorial: https://www.youtube.com/watch?v=iTiC-fpj3gs&ab_channel=TapanSharma

class Mixes extends Model implements HasMedia
{
    use HasFactory;
      use InteractsWithMedia;

    protected $fillable = [
        'name',
        'ingredients',
        'description',
        'user_id',
        'cuisine_id',
       
    ];
   
    // Define the relationship with the Cuisine model
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, 'cuisine_id');
    }
}