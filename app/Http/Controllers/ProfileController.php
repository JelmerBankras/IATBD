<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PetRequest;
use App\Models\Review;

class ProfileController extends Controller
{
    public function show(){
        $user = Auth::user();

        $pets = $user->pets;
        $houseImages = $user->houses;

        $ownerRequests = $user->ownerRequests;

        $lastPetRequest = PetRequest::where('owner_id', $user->id)
            ->latest('updated_at') // Haalt het laatste geüpdatete record
            ->first(); // Haalt het eerste record (de laatste geüpdatete aanvraag)


        $sitterId = $lastPetRequest ? $lastPetRequest->sitter_id : '0';

        if ($user->role === 'sitter') {
            $reviews = Review::where('sitter_id', $user->id)->get();
        } else {
            $reviews = null; // Of een andere logica voor andere rollen
        }

        // Pass the data to the view
        return view('profile', compact('user', 'pets', 'houseImages', 'ownerRequests', 'sitterId', 'reviews'));
    }
}
