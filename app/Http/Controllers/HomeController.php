<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $pets = Pet::all();

        $speciesList = Pet::select('species')->distinct()->pluck('species');
        $query = Pet::query();

        if ($request->ajax() && $request->has('species') && $request->species) {
            $query->where('species', $request->species);
        }

        $pets = $query->get();

        // Controleer of het een AJAX-request is
        if ($request->ajax()) {
            return response()->json([
                'pets' => $pets
            ]);
        }

        return view('home', compact('pets', 'speciesList'));
    }
}
