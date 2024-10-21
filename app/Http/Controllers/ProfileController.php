<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch pets and houses associated with the authenticated user
        $pets = $user->pets;    // Assuming there is a 'pets' relationship in User model
        $houseImages = $user->houses; // Assuming there is a 'houses' relationship in User model

        // Pass the data to the view
        return view('profile', compact('user', 'pets', 'houseImages'));
    }
}
