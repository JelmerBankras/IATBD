<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\PetRequest; // Zorg ervoor dat je het juiste model importeert

class ReviewController extends Controller
{
    public function store(Request $request, $sitterId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Controleer of de aanvrager bevoegd is om een review te plaatsen
        $acceptedRequest = PetRequest::where('owner_id', Auth::id())
                                      ->where('sitter_id', $sitterId)
                                      ->where('status', 'accepted')
                                      ->first();

        // Als er geen geaccepteerde aanvraag wordt gevonden, kan de eigenaar geen review plaatsen
        if (!$acceptedRequest) {
            return redirect()->back()->with('error', 'You are not authorized to review this sitter.');
        }

        // Maak de review aan
        Review::create([
            'request_id' => $acceptedRequest->id,
            'owner_id' => Auth::id(),
            'sitter_id' => $sitterId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect naar het profiel met een succesmelding
        return redirect()->route('profile')->with('success', 'Review added successfully!');
    }
}
