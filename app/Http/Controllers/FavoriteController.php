<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mix_id' => 'required|integer|exists:mixes,id',
        ]);
        $user = Auth::user();
        $user->favoriteMixes()->syncWithoutDetaching($validatedData['mix_id']);
        return back()->with([
            'message' => 'Added to favorites successfully',
            'favorite' => true, // Indicate that the mix is now favorited
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'mix_id' => 'required|integer|exists:mixes,id',
        ]);
        $user = Auth::user();
        $user->favoriteMixes()->detach($validatedData['mix_id']);
        return back()->with([
            'message' => 'Removed from favorites successfully',
            'favorite' => false, // Indicate that the mix is no longer favorited
        ]);
    }
}
