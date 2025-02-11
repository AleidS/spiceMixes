<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CuisineController extends Controller
{
    /**
     * Display a listing of the cuisines.
     */
    public function index()
    {
        $cuisines = Cuisine::all();
        return Inertia::render('Cuisines/Index', [
            'cuisines' => $cuisines,
        ]);
    }

    /**
     * Show the form for creating a new cuisine.
     */
    public function create()
    {
        return Inertia::render('Cuisines/Create');
    }

    /**
     * Store a newly created cuisine in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
        ]);

        Cuisine::create($request->all());

        return redirect()->route('cuisines.index')->with('success', 'Cuisine created successfully.');
    }

    /**
     * Display the specified cuisine.
     */
    public function show(Cuisine $cuisine)
    {
        return Inertia::render('Cuisines/Show', [
            'cuisine' => $cuisine,
        ]);
    }

    /**
     * Show the form for editing the specified cuisine.
     */
    public function edit(Cuisine $cuisine)
    {
        return Inertia::render('Cuisines/Edit', [
            'cuisine' => $cuisine,
        ]);
    }

    /**
     * Update the specified cuisine in storage.
     */
    public function update(Request $request, Cuisine $cuisine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
        ]);

        $cuisine->update($request->all());

        return redirect()->route('cuisines.index')->with('success', 'Cuisine updated successfully.');
    }

    /**
     * Remove the specified cuisine from storage.
     */
    public function destroy(Cuisine $cuisine)
    {
        $cuisine->delete();

        return redirect()->route('cuisines.index')->with('success', 'Cuisine deleted successfully.');
    }
}