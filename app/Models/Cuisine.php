<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cuisine extends Model
{
    use HasFactory;

    public function mixes()
    {
        return $this->hasMany(Mixes::class, 'cuisine_id', 'id')->where(function ($query) {
            $query
                ->where('user_id', Auth::id()) // Only show mixes belonging to the authenticated user
                ->orWhereNull('user_id'); // Or mixes that are public (no user_id)
        });
    }

    protected $fillable = ['name', 'continent', 'color', 'user_id'];
}
