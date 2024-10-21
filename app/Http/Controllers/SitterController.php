<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\House;

class SitterController extends Controller
{
    public function uploadHouseImages(Request $request)
    {
        // Validatie
        $request->validate([
            'house_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Voor elk geüpload beeld
        foreach ($request->file('house_images') as $image) {
            $imagePath = $image->store('houses', 'public'); // Opslaan in 'storage/app/public/houses'

            // Sla de afbeelding op in de houses tabel en koppel deze aan de huidige gebruiker
            House::create([
                'user_id' => Auth::id(),  // De ingelogde gebruiker
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->back()->with('success', 'House images uploaded successfully!');
    }
}
