<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password'];
    public function mixes()
    {
        return $this->hasMany('App\Models\Mixes', 'user_id', 'id');
    }
    public function cuisines()
    {
        return $this->hasMany('App\Models\Cuisine', 'user_id', 'id');
    }
    public function favoriteMixes()
    {
        return $this->belongsToMany('App\Models\Mixes', 'mix_user', 'user_id', 'mix_id');
    }
    public function shares()
    {
        return $this->hasMany('App\Models\Shares', 'target_user', 'id')->whereNull('responded');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
