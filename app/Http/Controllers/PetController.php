<?php

namespace App\Http\Controllers;

use App\Models\PetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'hourly_rate' => 'nullable|numeric|min:0',
        ]);

        $userId = Auth::id();

        Pet::create([
            'name' => $request->name,
            'species' => $request->species,
            'age' => $request->age,
            'image' => $request->file('image')->store('images', 'public'),
            'user_id' => $userId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'hourly_rate' => $request->hourly_rate,
        ]);

        return redirect()->route('add-pet')->with('success', 'Pet added successfully!');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);

        // Check if the logged-in user is the owner of the pet
        if (Auth::id() !== $pet->user_id) {
            abort(403);  // Deny access
        }

        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        if (Auth::id() !== $pet->user_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'hourly_rate' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pet->update([
            'name' => $request->name,
            'species' => $request->species,
            'age' => $request->age,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'hourly_rate' => $request->hourly_rate,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $pet->update(['image' => $imagePath]);
        }

        return redirect()->route('profile')->with('success', 'Pet updated successfully!');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);

        // Check if the logged-in user is the owner of the pet
        if (Auth::id() !== $pet->user_id) {
            abort(403);  // Deny access
        }

        $pet->delete();

        return redirect()->route('profile')->with('success', 'Pet deleted successfully!');
    }

    public function requestSitting($petId)
    {
        $pet = Pet::findOrFail($petId);

        if (Auth::id() === $pet->user_id) {
            return redirect()->back()->with('error', 'Je kunt geen aanvraag indienen voor je eigen huisdier.');
        }

        PetRequest::create([
            'pet_id' => $pet->id,
            'sitter_id' => Auth::id(),
            'owner_id' => $pet->user_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Aanvraag succesvol verzonden!');
    }

}
