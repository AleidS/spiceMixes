<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Http\Resources\CuisineResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CuisineController extends Controller
{
    /**
     * Display a listing of the cuisines.
     */
    protected $cuisines;

    public function __construct()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $this->cuisines = CuisineResource::collection(
                Cuisine::where('user_id', $userId)
                    ->orWhereNull('user_id')
                    ->withCount('mixes')
                    ->get()
            );
        } else {
            $this->cuisines = CuisineResource::collection(
                Cuisine::whereNull('user_id')->withCount('mixes')->get()
            );
        }
    }

    public function index(Request $request)
    {
        $totalCreatedCuisines = $request->user()->cuisines->count();

        return Inertia::render('Cuisines/Index', [
            'cuisines' => $this->cuisines,
            'totalCreatedCuisines' => $totalCreatedCuisines,
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
        $userId = Auth::id();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'continent' => 'nullable|string|max:255',
            'color' => ['required', 'hex_color'],
            'id' => 'nullable|integer',
        ]);
        $validatedData = array_merge($validatedData, [
            'user_id' => $userId,
        ]);

        $totalCreatedCuisines = $request->user()->cuisines->count();

        if ($request->id != null) {
            $cuisine = Cuisine::find($request->id);
            $cuisine->update($validatedData);
        } elseif ($totalCreatedCuisines < 10) {
            Cuisine::create($validatedData);
        } else {
            return response()->json(
                'sorry, the total number of custom cuisines is 10, please contact me if you really need more!',
                400
            );
        }
        $totalCreatedCuisines = $request->user()->cuisines->count();
        $this->__construct();

        return Inertia::render('Cuisines/Index', [
            'cuisines' => $this->cuisines,
            'totalCreatedCuisines' => $totalCreatedCuisines,
        ]);
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

        return redirect()
            ->route('cuisines.index')
            ->with('success', 'Cuisine updated successfully.');
    }

    /**
     * Remove the specified cuisine from storage.
     */
    public function destroy($id)
    {
        $userId = Auth::id();
        $cuisine = Cuisine::find($id);
        if ($cuisine->user_id == $userId) {
            $cuisine->delete();
        } else {
            dd('please dont delete someone elses mixes!');
        }

        return redirect()->route('cuisines')->with('success', 'Cuisine deleted successfully.');
    }
}
