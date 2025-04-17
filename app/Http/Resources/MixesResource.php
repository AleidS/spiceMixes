<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Mixes;
use App\Http\Resources\IngredientResource;

class MixesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentUserId = Auth::id();
        $mix = Mixes::find($this->id);
        // dd($mix->allIngredients);
        // $ingredients2 = Mixes::find(1)->ingredients;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,

            'ingredients' => IngredientResource::collection($this->ingredients),
            'img_source' => $this->img_source,
            'user_id' => $this->user_id,
            'cuisine_id' => $this->cuisine_id,
            'share_mix' => $this->share_mix,
            'share_is_original' => $this->share_is_original,
            'share_name' => $this->share_name,
            'share_accepted' => $this->share_accepted,
            'share_decline_reason' => $this->share_decline_reason,
            'cuisine' => new CuisineResource($this->whenLoaded('cuisine')),
            'favorite' => $this->isFavoritedByCurrentUser(),
            'editable' => $this->user_id === $currentUserId && $this->user_id !== null,
            'is_own' => $this->user_id === $currentUserId && $this->user_id !== null,
            // $this->cuisine->name : null, // Include the cuisine name
            'avatar' => $this?->getFirstMediaUrl('avatars'),
            'source_url' => $this->source_url,
            'source_name' => $this->source_name,
            'show_alternatives' => $this->show_alternatives,
        ];
    }
}
