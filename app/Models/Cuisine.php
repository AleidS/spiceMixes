<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    public function mixes()
    {
        return $this->hasMany(Mixes::class, 'cuisine_id', 'id');
    }

    protected $fillable = [
        'name',
        'continent',
        'color'
    ];
}