<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller {
    public function update(Request $request, $id){
        $petRequest = Request::findOrFail($id);
        $petRequest->status = $request->status;
        $petRequest->save();

        // Controleer of de ingelogde gebruiker de eigenaar is
        if (Auth::id() !== $petRequest->owner_id) {
            abort(403);
        }

        // Update de status van de aanvraag
        $petRequest->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Aanvraag is ' . ($request->status === 'accepted' ? 'geaccepteerd' : 'geweigerd') . '!');
    }
}
