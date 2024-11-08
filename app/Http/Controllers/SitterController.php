<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\House;

class SitterController extends Controller
{
    public function uploadHouseImages(Request $request)
    {

        $request->validate([
            'house_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('house_images') as $image) {
            $imagePath = $image->store('houses', 'public');

            House::create([
                'user_id' => Auth::id(),  // De ingelogde gebruiker
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->back()->with('success', 'House images uploaded successfully!');
    }
}
