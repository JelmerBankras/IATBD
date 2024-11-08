<?php

namespace App\Http\Controllers;

use App\Models\PetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller {
    public function update(Request $request, $id){
        $petRequest = PetRequest::findOrFail($id);

        if (Auth::id() !== $petRequest->owner_id) {
            abort(403);
        }

        // Werk de status bij
        $petRequest->status = $request->status;
        $petRequest->save();

        if ($request->status === 'accepted') {
            $sitterId = $petRequest->sitter_id;  // Haal het sitter_id op
            return redirect()->route('profile', ['sitter_id' => $sitterId])->with('success', 'Aanvraag is geaccepteerd!');
        }

        return redirect()->back()->with('success', 'Aanvraag is geweigerd!');
    }
}
