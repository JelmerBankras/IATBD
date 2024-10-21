<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // Fields that are mass assignable
    protected $fillable = ['name', 'species', 'age', 'user_id', 'image']; // User ID is not mass assignable, set later

    public function user()
    {
        return $this->belongsTo(User::class);  // A pet belongs to one user
    }
}
