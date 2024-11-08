<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRequest extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'sitter_id', 'owner_id', 'status'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function sitter()
    {
        return $this->belongsTo(User::class, 'sitter_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
