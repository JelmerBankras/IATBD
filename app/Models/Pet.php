<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'species', 'age', 'user_id', 'image', 'start_date', 'end_date', 'hourly_rate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
