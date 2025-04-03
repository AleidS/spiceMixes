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
        return redirect()->route('home')->with('message', 'Added to favorites successfully');
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
        return redirect()->route('home')->with('message', 'Removed from favorites successfully');
    }
}
