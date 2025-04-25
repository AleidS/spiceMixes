<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'measure_id',
        'mixes_id',
        'show_alternatives',
        'optional',
    ];

    public function getTransformedNameAttribute()
    {
        // Remove 'ground', 'dried', and 'powder' from the name
        return trim(preg_replace('/\b(ground|dried|powder)\b/i', '', $this->name));
    }

    public function alternatives()
    {
        return $this->hasOne(Alternatives::class, 'name', 'transformed_name');
    }
}
