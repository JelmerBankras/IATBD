<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    // Store the new pet in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userId = Auth::id(); // This will return the authenticated user's ID or null

        // Create and store a new pet in the database
        Pet::create([
            'name' => $request->name,
            'species' => $request->species,
            'age' => $request->age,
            'image' => $request->file('image')->store('images', 'public'),
            'user_id' => $userId// Assuming the user is authenticated
        ]);

        // Redirect or return a response
        return redirect()->route('add-pet')->with('success', 'Pet added successfully!');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);

        // Check of de ingelogde gebruiker eigenaar is van het huisdier
        if (Auth::id() !== $pet->user_id) {
            abort(403);  // Toegang weigeren
        }

        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        // Check of de ingelogde gebruiker eigenaar is van het huisdier
        if (Auth::id() !== $pet->user_id) {
            abort(403);  // Toegang weigeren
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            // Je kunt ook de image velden toevoegen als je de afbeelding wilt bewerken
        ]);

        $pet->update($request->only('name', 'type'));

        return redirect()->route('profile')->with('success', 'Pet updated successfully!');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);

        // Check of de ingelogde gebruiker eigenaar is van het huisdier
        if (Auth::id() !== $pet->user_id) {
            abort(403);  // Toegang weigeren
        }

        $pet->delete();

        return redirect()->route('profile')->with('success', 'Pet deleted successfully!');
    }


}
