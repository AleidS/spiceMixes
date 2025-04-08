<?php

namespace App\Http\Controllers;
use App\Models\Shares;
use Illuminate\Http\Request;
use App\Http\Resources\ShareResource;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        Auth::check();
        $userId = Auth::id();
        $sharesQuery = QueryBuilder::for(Shares::class)->where(function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });

        $shares = SharesResource::collection($sharesQuery->get());
        $cuisines = CuisineResource::collection(Cuisine::withCount('mixes')->get());
        $measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource
        $mixes = MixesResource::collection($mixes);

        return Inertia::render('Mixes/Index', [
            'mixes' => $mixes,
            'cuisines' => $cuisines,
            'measures' => $measures,
            'selectedCuisineId' => $request->cuisine_id,
            'pageNumber' => $request->page_number,
            'search' => data_get($request, 'filters.search', false),
            'is_own' => $request->is_own,
            'show_favorites' => $request->show_favorites,
        ]);
    }

    public function accept(Request $request, $id)
    {
        $share = ShareResource::collection()->firstWhere('id', $id);
        dd($share);
    }
    public function decline() {}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shares $shares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shares $shares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shares $shares)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shares $shares)
    {
        //
    }
}
