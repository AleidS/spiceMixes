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
use App\Models\Ingredient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// https://spatie.be/docs/laravel-query-builder/v6/introduction
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\RateLimiter;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MixesController extends Controller
{
    /**
     * Display a listing of the mixes.
     */

    protected $cuisines;
    protected $measures;

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
        $this->measures = MeasureResource::collection(Measure::all());
    }

    public function index(Request $request)
    {
        // dd($this->cuisines);
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

        $mixesQuery = QueryBuilder::for(Mixes::class)
            ->allowedFilters([
                AllowedFilter::partial('name'), // Allows partial matching for the 'name' field
            ])
            ->with(['favoritedBy', 'cuisine'])
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)->orWhereNull('user_id');
            });

        if ($request->has('cuisine_id') && $request->cuisine_id) {
            $mixesQuery->where('cuisine_id', $request->cuisine_id);
        }

        if ($request->has('is_own') && $request->is_own === 'true') {
            $mixesQuery->where('user_id', Auth::id());
        }
        if ($request->has('show_favorites') && $request->show_favorites === 'true') {
            $mixesQuery->whereHas('favoritedBy', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        }

        if ($request->selectAll) {
            return MixesResource::collection($mixesQuery->get());
        }

        $mixes = $mixesQuery->paginate($request->pageSize ?? 9);

        // $this->cuisines = CuisineResource::collection(Cuisine::withCount('mixes')->get());
        // $this->measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource
        $mixes = MixesResource::collection($mixes);

        return Inertia::render('Mixes/Index', [
            'mixes' => $mixes,
            'cuisines' => $this->cuisines,
            'measures' => $this->measures,
            'selectedCuisineId' => $request->cuisine_id,
            'pageNumber' => $request->page_number,
            'search' => data_get($request, 'filters.search', false),
            'is_own' => $request->is_own,
            'show_favorites' => $request->show_favorites,
        ]);
    }
    public function publicMixes(Request $request)
    {
        $mixesQuery = QueryBuilder::for(Mixes::class)
            ->allowedFilters([
                AllowedFilter::partial('name'), // Allows partial matching for the 'name' field
            ])
            ->with(['favoritedBy', 'cuisine'])
            ->whereNull('user_id');

        if ($request->has('cuisine_id') && $request->cuisine_id) {
            $mixesQuery->where('cuisine_id', $request->cuisine_id);
        }

        if ($request->selectAll) {
            return MixesResource::collection($mixesQuery->get());
        }

        $mixes = $mixesQuery->paginate($request->pageSize ?? 9);

        // $this->cuisines = CuisineResource::collection(Cuisine::withCount('mixes')->get());
        // $this->measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource
        $mixes = MixesResource::collection($mixes);

        return Inertia::render('Mixes/Index', [
            'mixes' => $mixes,
            'cuisines' => $this->cuisines,
            'measures' => $this->measures,
            'selectedCuisineId' => $request->cuisine_id,
            'pageNumber' => $request->page_number,
            'search' => data_get($request, 'filters.search', false),
            'is_own' => $request->is_own,
        ]);
    }

    public function create()
    {
        // $this->cuisines = CuisineResource::collection(Cuisine::all());
        $this->measures = MeasureResource::collection(Measure::all());

        return Inertia::render('Mixes/Add', [
            'measures' => $this->measures,
            'cuisines' => $this->cuisines,
        ]);
    }

    /**
     * Store a newly created mix in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // {
        // // Temporarily disable validation and CSRF protection for testing
        //     $data = $request->all();

        //     Mixes::create($data);

        //     return redirect()->route('mixes.index');
        // }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'img_source' => 'nullable|string|max:300',
            'source_url' => 'nullable|string|max:255',
            'source_name' => 'nullable|string|max:255',
            'user_id' => 'nullable|integer',
            'cuisine_id' => 'required|integer',
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048', // Validate file type and size
        ]);
        $validatedIngredients = $request->validate([
            'ingredients' => 'nullable|json',
        ]);
        // dd($validatedData);
        $totalCreatedMixes = $request->user()->mixes->count();
        // Limit the number of images a user can upload to one per minute
        if (
            RateLimiter::tooManyAttempts(
                'medialibrary-uploads:' . $request->user()->id,
                $perMinute = 1
            )
        ) {
            return response()->json(
                'You are uploading a lot of images, please try again later',
                400
            );
        }
        if (
            RateLimiter::tooManyAttempts(
                'medialibrary-uploads:' . $request->user()->id,
                $perDay = 10
            )
        ) {
            return response()->json(
                'Sorry, at the moment you can edit/upload max 10 images a day, please try again tomorrow or upload without an image',
                400
            );
        }

        if ($totalCreatedMixes < 30) {
            $mix = Mixes::create($validatedData);
            $ingredients = json_decode($request->ingredients, true);
            if ($ingredients) {
                foreach ($ingredients as $ingredient) {
                    $ingredient['mixes_id'] = $mix->id;
                    // dd(gettype($ingredient), gettype($request));
                    if (is_null($ingredient['name'])) {
                    } else {
                        $object = new \stdClass();
                        foreach ($ingredient as $key => $value) {
                            $object->$key = $value;
                        }
                        $validatedIngredient = Validator::make($ingredient, [
                            'name' => 'required|string|max:255',
                            'quantity' => 'required|integer',
                            'measure_id' => 'required|integer',
                            'show_alternatives' => 'boolean',
                            'mixes_id' => 'required|integer',
                        ])->validate();
                        $ingredientCreated = Ingredient::create($validatedIngredient);
                    }
                }
            }

            if ($request->hasFile('avatar')) {
                $mix->addMedia($request->file('avatar'))->toMediaCollection('avatars');
            }
            return redirect()->route('home')->with('message', 'Mix created successfully');
        } else {
            return response()->json("Sorry, at the moment you can't add more than 30 mixes", 400);
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
        if (Auth::check()) {
            // Authenticated users can view their own mixes or public mixes
            $mix = Mixes::with(['favoritedBy', 'cuisine'])
                ->where(function ($query) {
                    $query->where('user_id', Auth::id())->orWhereNull('user_id');
                })
                ->find($id);
        } else {
            // Unauthenticated users can only view public mixes
            $mix = Mixes::with(['cuisine'])
                ->whereNull('user_id')
                ->find($id);
        }
        if (!$mix) {
            return redirect()->route('home')->with('error', 'Mix not found.');
        }

        // $this->cuisines = CuisineResource::collection(Cuisine::all());
        // $this->measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource

        $mixResource = new MixesResource($mix);

        return Inertia::render('Mixes/Show', [
            'mix' => $mixResource,
            'measures' => $this->measures,
        ]);
    }
    /**
     * Display the specified mix.
     */
    public function duplicate($id)
    {
        $mix = Mixes::with(['favoritedBy', 'cuisine'])->find($id);
        if (!$mix) {
            return redirect()->route('home')->with('error', 'Mix not found.');
        }
        if ($mix->user_id != null) {
            dd('woops, that does not seem to be a public mix');
            return redirect()->route('home')->with('error', 'That is not yours, sorry.');
        }

        // $this->cuisines = CuisineResource::collection(Cuisine::all());
        // $this->measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource

        $newMix = $mix->replicate();
        $newMix->name = 'Your ' . $mix->name;
        $newMix->created_at = Carbon::now();
        $newMix->user_id = Auth::id();
        $newMix->save();

        $mixResource = new MixesResource($newMix);

        return Inertia::render(
            'Mixes/Add',

            ['mix' => $mixResource, 'measures' => $this->measures, 'cuisines' => $this->cuisines]
        );
    }

    public function edit($id)
    {
        $mix = Mixes::with(['favoritedBy', 'cuisine'])->find($id);
        if (!$mix) {
            return redirect()->route('home')->with('error', 'Mix not found.');
        }

        // $this->cuisines = CuisineResource::collection(Cuisine::all());
        // $this->measures = MeasureResource::collection(Measure::all());

        // Transform the pagination result using MixesResource

        $mixResource = new MixesResource($mix);

        return Inertia::render(
            'Mixes/Add',

            ['mix' => $mixResource, 'measures' => $this->measures, 'cuisines' => $this->cuisines]
        );
    }

    /**
     * Update the specified mix in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'source_url' => 'nullable|string|max:255',
            'source_name' => 'nullable|string|max:255',
            'img_source' => 'nullable|string|max:300',
            'user_id' => 'nullable|integer',
            'cuisine_id' => 'required|integer',
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048', // Make avatar nullable and validate file type
        ]);
        // dd($validatedData);
        $validatedIngredients = $request->validate([
            'ingredients' => 'required|json',
        ]);

        $mix = Mixes::with(['favoritedBy', 'cuisine'])->find($id);

        // https://spatie.be/docs/laravel-medialibrary/v11/basic-usage/retrieving-media
        if ($request->hasFile('avatar')) {
            $media = $mix->getFirstMedia('avatars');
            if ($media) {
                $media->delete();
            }
            $mix->addMedia($request->file('avatar'))->toMediaCollection('avatars');
        }

        $mix->update($validatedData);

        $ingredients = json_decode($request->ingredients, true);
        foreach ($ingredients as $ingredient) {
            $ingredient['mixes_id'] = $mix->id;
            // dd(gettype($ingredient), gettype($request));
            if (is_null($ingredient['name'])) {
            } else {
                $object = new \stdClass();
                foreach ($ingredient as $key => $value) {
                    $object->$key = $value;
                }
                $validatedIngredient = Validator::make($ingredient, [
                    'id' => 'sometimes|exists:ingredients,id',
                    'name' => 'required|string|max:255',
                    'quantity' => 'required|integer',
                    'measure_id' => 'required|integer',
                    'show_alternatives' => 'boolean',
                    'optional' => 'nullable|boolean',
                    'mixes_id' => 'required|integer',
                ])->validate();
                if (isset($validatedIngredient['id'])) {
                    // Update the existing ingredient using its ID
                    Ingredient::find($validatedIngredient['id'])->update($validatedIngredient);
                } else {
                    // Create a new ingredient
                    Ingredient::create($validatedIngredient);
                }
                // dont duplicate the existing ingredients
                // $ingredientCreated = IngredientIngredient::updateOrCreate(
                //     [
                //         'name' => $validatedIngredient['name'],
                //         'mixes_id' => $validatedIngredient['mixes_id'],
                //     ],
                //     $validatedIngredient
                // );
            }
        }

        // Otherwise you dont see the edits when intertia returns the page
        $mix = Mixes::with(['favoritedBy', 'cuisine'])->find($id);
        $mixResource = new MixesResource($mix);

        $this->show($id);

        return Inertia::render(
            'Mixes/Show',

            ['mix' => $mixResource, 'measures' => $this->measures, 'cuisines' => $this->cuisines]
        );
    }

    /**
     * Remove the specified mix from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $mix = Mixes::find($id);
        // If someone deletes a mix with an image, delete the image.
        $media = $mix->getFirstMedia('avatars');
        if ($media) {
            $media->delete();
        }
        $mix->delete();
        return redirect()->route('home');
    }
}
