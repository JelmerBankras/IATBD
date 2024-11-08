<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Voeg request_id toe aan de fillable array
    protected $fillable = [
        'request_id',
        'owner_id',
        'sitter_id',
        'rating',
        'comment',
    ];
}
