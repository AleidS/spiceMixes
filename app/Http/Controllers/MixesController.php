<?php

namespace App\Http\Controllers;


use App\Models\Mixes;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\CuisineResource;
use App\Http\Resources\MeasureResource;
use App\Http\Resources\MixesResource;
use App\Models\Cuisine; 
use App\Models\Measure; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// https://spatie.be/docs/laravel-query-builder/v6/introduction
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\RateLimiter;
use Spatie\QueryBuilder\AllowedFilter;

class MixesController extends Controller
{
    /**
     * Display a listing of the mixes.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            // If the user is authenticated, show their mixes
            return $this->allMixes($request);
        } else {
            // If the user is not authenticated, show public mixes
            return $this->publicMixes($request);
        }
    }


    public function allMixes(Request $request)
    {
        
        $userId = Auth::id();

         $mixesQuery =
            QueryBuilder::for(Mixes::class)
            ->allowedFilters([
                AllowedFilter::partial('name'), // Allows partial matching for the 'name' field
            ])
            ->with('cuisine') 
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
        
        $mixes = $mixesQuery->paginate($request->pageSize ?? 9);

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
    public function publicMixes(Request $request)
    {
        
       

         $mixesQuery = Mixes::with('cuisine')
            ->where(function ($query) {
                $query->whereNull('user_id');
            });

        if ($request->has('cuisine_id') && $request->cuisine_id) {
            $mixesQuery->where('cuisine_id', $request->cuisine_id);
        }

        if ($request->selectAll) {
            return MixesResource::collection(
                $mixesQuery->get()
            );
        }

        $mixes = $mixesQuery->paginate($request->pageSize ?? 9);

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


    public function create()
        {
          
            $cuisines = CuisineResource::collection(Cuisine::all());
            $measures = MeasureResource::collection(Measure::all());

            return Inertia::render('Mixes/Add', [
                'measures' => $measures,
                'cuisines' => $cuisines,
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
            // 'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make avatar nullable and validate file type
        ]);
         $request->validate([
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file type and size
        ]);
       
        $totalCreatedMixes = $request->user()->mixes->count();
        // Limit the number of images a user can upload to one per minute
        if (RateLimiter::tooManyAttempts('medialibrary-uploads:' . $request->user()->id, $perMinute = 1)) {
            return response()->json("You are uploading a lot of images, please try again later", 400);
        }
         if (RateLimiter::tooManyAttempts('medialibrary-uploads:' . $request->user()->id, $perDay = 30)) {
            return response()->json("You can edit/upload max 30 images a day, please try again tomorrow", 400);
        }
 
        if ($totalCreatedMixes< 30) {
            $mix = Mixes::create($validatedData);

            if ($request->hasFile('avatar')) {
                $mix->addMedia($request->file('avatar'))->toMediaCollection('avatars');
            }
              return redirect()->route('home')
            ->with('message', 'Mix created successfully');
        } else {
        return response()->json("You cant add more then 30 mixes", 400);
        }
        //Debugging
        // $avatarUrl = $mix->getFirstMediaUrl('avatars');
        // dd($avatarUrl);  // This will dump the URL of the avatar to check if it's stored correctly

      

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
            return redirect()->route('home')->with('error', 'Mix not found.');
        }

        $cuisines = CuisineResource::collection(Cuisine::all());
        $measures = MeasureResource::collection(Measure::all());

            // Transform the pagination result using MixesResource
        
        $mixResource = new MixesResource($mix);

        return Inertia::render('Mixes/Show', 
        ['mix' => $mixResource, 'measures'=>$measures]);
    }
    /**
     * Display the specified mix.
     */
    public function edit($id)
    {
        $mix = Mixes::with('cuisine')->find($id);
        if (!$mix) {
            return redirect()->route('home')->with('error', 'Mix not found.');
        }

        $cuisines = CuisineResource::collection(Cuisine::all());
        $measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource
       
        $mixResource = new MixesResource($mix);

         return Inertia::render('Mixes/Add', 

            ['mix' => $mixResource,
            'measures'=>$measures, 
            'cuisines' => $cuisines,]
        );
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
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make avatar nullable and validate file type

        ]);

        if ($request->hasFile('avatar')) {
            $mix->addMedia($request->file('avatar'))->toMediaCollection('avatars');
        }

        
       $mix = Mixes::with('cuisine')->find($id);
        $mix->update($validatedData);
        $mixResource = new MixesResource($mix);

        $cuisines = CuisineResource::collection(Cuisine::all());
        $measures = MeasureResource::collection(Measure::all());


        $this->show($id);
        
         return Inertia::render('Mixes/Show', 

            ['mix' => $mixResource,
            'measures'=>$measures, 
            'cuisines' => $cuisines,]
        );
    }

    /**
     * Remove the specified mix from storage.
     */
    public function destroy($id)
    {
        $mix = Mixes::find($id);
        $mix->delete();
        return redirect()->route('home');
    }
}