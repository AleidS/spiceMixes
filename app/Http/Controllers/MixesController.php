<?php

namespace App\Http\Controllers;


use App\Models\Mixes;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\CuisineResource;
use App\Http\Resources\MeasureResource;
use App\Http\Resources\MixesResource;
use App\models\Cuisine;
use App\models\Measure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MixesController extends Controller
{
    /**
     * Display a listing of the mixes.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $mixesQuery = Mixes::with('cuisine')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->orWhereNull('user_id');
            });

        if ($request->has('cuisine_id') && $request->cuisine_id) {
            $mixesQuery->where('cuisine_id', $request->cuisine_id);
        }

        if ($request->selectAll) {
            return MixesResource::collection(
                $mixesQuery->get()
            );
        }

        $mixes = $mixesQuery->paginate($request->pageSize ?? 10);

        $cuisines = CuisineResource::collection(Cuisine::all());
        $measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource
        $mixes = MixesResource::collection($mixes);

        return Inertia::render('Mixes/Index', [
            'mixes' => $mixes,
            'cuisines' => $cuisines,
            'measures'=> $measures,
            'selectedCuisineId' => $request->cuisine_id,
        ]);
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
            'cuisine_id' => 'required|integer',
        ]);

        $mix = Mixes::create($validatedData);

        $mix
            ->addMedia($request->avatar[0])
            ->toMediaCollection('avatars');

        //Debugging
        // $avatarUrl = $mix->getFirstMediaUrl('avatars');
        // dd($avatarUrl);  // This will dump the URL of the avatar to check if it's stored correctly

        return redirect()->route('mixes.index')
        ->with('message', 'Mix created successfully');

        // return redirect()->route('mixes.index')
        //     ->with('message', 'Mix created successfully');
    
    }

    /**
     * Display the specified mix.
     */
    public function show($id)
    {
        $mix = Mixes::with('cuisine')->find($id);
       if (!$mix) {
        return redirect()->route('mixes.index')->with('error', 'Mix not found.');
    }

    $cuisines = CuisineResource::collection(Cuisine::all());
    $measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource
       
    $mixResource = new MixesResource($mix);

    return Inertia::render('Mixes/Show', 
    ['mix' => $mixResource, 'measures'=>$measures]);
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
            'cuisine_id' => 'required|integer',
            'avatar'=>'required',
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