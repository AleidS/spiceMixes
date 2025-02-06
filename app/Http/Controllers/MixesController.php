<?php

namespace App\Http\Controllers;

use App\Models\Mixes;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MixesController extends Controller
{
    /**
     * Display a listing of the mixes.
     */
    public function index()
    {
        
        $userId = Auth::id();

        $mixes = Mixes::where('user_id', $userId)
            ->orWhereNull('user_id')
            ->get();
        
        return Inertia::render('Mixes/Index', ['mixes' => $mixes]);
    }


    /**
     * Store a newly created mix in storage.
     */
    public function store(Request $request)
    // {
    // // Temporarily disable validation and CSRF protection for testing
    //     $data = $request->all();

    //     Mixes::create($data);

    //     return redirect()->route('mixes.index');
    // }
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|json',
            'description' => 'required|string|max:255',
            'user_id' => 'nullable|integer',
            'cuisine' => 'required|integer',
            'photo_url' => 'required|string|max:255',
        ]);

        Mixes::create($validatedData);

        // return to_route('mixes.index');
    }

    /**
     * Display the specified mix.
     */
    public function show($id)
    {
        $mix = Mixes::find($id);
        return Inertia::render('Mixes/Show', ['mix' => $mix]);
    }

    /**
     * Update the specified mix in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|json',
            'description' => 'required|string|max:255',
            'user_id' => 'nullable|integer',
            'cuisine' => 'required|integer',
            'photo_url' => 'required|string|max:255',
        ]);

        $mix = Mixes::find($id);
        $mix->update($validatedData);
        return redirect()->route('mixes.index');
    }

    /**
     * Remove the specified mix from storage.
     */
    public function destroy($id)
    {
        $mix = Mixes::find($id);
        $mix->delete();
        return redirect()->route('mixes.index');
    }
}