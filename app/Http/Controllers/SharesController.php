<?php

namespace App\Http\Controllers;
use App\Models\Shares;
use App\Models\Mixes;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ShareResource;
use App\Http\Resources\MixesResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pipeline\Pipeline;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:500',
            'mix_id' => 'required|integer',
        ]);
        $request->validate([
            'email' => 'required|string|max:255',
        ]);
        $email = $request->email;

        $targetUser = User::where('email', '=', $email)->first();

        // Checking if user isn't trying to share a mix that he doesnt own.
        // Shouldnt be possible, but perhaps when editing the request data with postman it could be.
        $targetMix = Mixes::find($request->mix_id);
        $targetMixOwner = $targetMix->user_id;
        $currentUserId = Auth::id();
        if ($targetMixOwner != $currentUserId) {
            return response()->json(
                'Sorry, it seems like you are trying to share a mix that is not yours, this is not possible',
                400
            );
        }

        $share = $validatedData;
        if ($targetUser != null) {
            $target_id = $targetUser->id;
            $shareData = array_merge($validatedData, [
                'target_user' => $target_id,
            ]);
            Shares::create($shareData);
        }
        return back()->with([
            'message' => 'Mix shared if email was found',
            // Indicate that the mix is now favorited
        ]);
    }
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

    //Accept the share
    public function accept(Request $request, $id)
    {
        // Retrieve the share by ID
        $share = Shares::findOrFail($id);
        $share->update([
            'accepted' => true,
            'responded' => true, // this will update cost for the current supplier
        ]);
        // Retrieve the mix associated with the share
        $mix = Mixes::findOrFail($share->mix_id);

        $mix->user_id = $share->target_user;
        $mix->id = null;
        $mixData = $mix->toArray();

        $mixData['ingredients'] = $mix->ingredients; // Include ingredients if needed
        $mixData['user_id'] = Auth::id();
        // Create a new Request object with the mix data
        $mixRequest = Request::create('/mixes', 'POST', $mixData);
        $mixRequest->setUserResolver(function () {
            return Auth::user();
        });

        // Apply middleware to the request
        return app('App\Http\Controllers\MixesController')->store($mixRequest);
    }
    // Decline the share
    public function decline()
    {
        $share = Shares::findOrFail($id);
        $share->update([
            'accepted' => false,
            'responded' => true, // this will update cost for the current supplier
        ]);
    }
    // Create a new share, if email of target user is found

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
