<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function pets(){
        return $this->hasMany(Pet::class);
    }

    public function houses(){
        return $this->hasMany(House::class);
    }

    public function ownerRequests(){
        return $this->hasMany(PetRequest::class, 'owner_id');
    }

    public function receivedReviews(){
        return $this->hasMany(Review::class, 'sitter_id');
    }

    public function writtenReviews(){
        return $this->hasMany(Review::class, 'owner_id');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
