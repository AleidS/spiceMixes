<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Resources\IngredientResource;

// tutorial: https://www.youtube.com/watch?v=iTiC-fpj3gs&ab_channel=TapanSharma

class Mixes extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'cuisine_id',
        'source_url',
        'source_name',
        'show_alternatives',
        'img_source',
    ];

    // Define the relationship with the Cuisine model
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, 'cuisine_id');
    }
    public function allIngredients()
    {
        return $this->hasMany(Ingredient::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'mix_user', 'mix_id', 'user_id');
    }
    public function isFavoritedByCurrentUser()
    {
        $currentUserId = Auth::id();
        return $this->favoritedBy()->where('user_id', $currentUserId)->exists();
    }
}
