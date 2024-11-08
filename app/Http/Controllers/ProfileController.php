<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(){
        $user = Auth::user();

        $pets = $user->pets;
        $houseImages = $user->houses;

        $ownerRequests = $user->ownerRequests;


        // Pass the data to the view
        return view('profile', compact('user', 'pets', 'houseImages', 'ownerRequests'));
    }
}
