<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeasureController extends Controller
{
    /**
     * Display a listing of the measures.
     */
    public function index()
    {
        $measures = Measure::all();
        return Inertia::render('Measures/Index', ['measures' => $measures]);
    }

    /**
     * Store a newly created measure in storage.
     */
    public function store(Request $request)
    {
        $measure = Measure::create($request->all());
        return redirect()->route('measures.index');
    }

    /**
     * Display the specified measure.
     */
    public function show($id)
    {
        $measure = Measure::find($id);
        return Inertia::render('Measures/Show', ['measure' => $measure]);
    }

    /**
     * Update the specified measure in storage.
     */
    public function update(Request $request, $id)
    {
        $measure = Measure::find($id);
        $measure->update($request->all());
        return redirect()->route('measures.index');
    }

    /**
     * Remove the specified measure from storage.
     */
    public function destroy($id)
    {
        $measure = Measure::find($id);
        $measure->delete();
        return redirect()->route('measures.index');
    }
}