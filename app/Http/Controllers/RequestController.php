<?php

namespace App\Http\Controllers;

use App\Models\PetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller {
    public function update(Request $request, $id){
        // Haal de aanvraag op met het opgegeven ID
        $petRequest = PetRequest::findOrFail($id);

        // Controleer of de ingelogde gebruiker de eigenaar is van het huisdier
        if (Auth::id() !== $petRequest->owner_id) {
            abort(403);  // Als de gebruiker niet de eigenaar is, geef dan een 403 Forbidden fout
        }

        // Werk de status bij
        $petRequest->status = $request->status;
        $petRequest->save();  // Sla de gewijzigde status op

        // Als de aanvraag geaccepteerd wordt, stuur het sitter_id naar de profielpagina
        if ($request->status === 'accepted') {
            $sitterId = $petRequest->sitter_id;  // Haal het sitter_id op
            return redirect()->route('profile', ['sitter_id' => $sitterId])->with('success', 'Aanvraag is geaccepteerd!');
        }

        // Als de aanvraag wordt geweigerd, stuur terug naar de vorige pagina
        return redirect()->back()->with('success', 'Aanvraag is geweigerd!');
    }
}
