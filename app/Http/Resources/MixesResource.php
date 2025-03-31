<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
        return  [
            'id' => $this->id,
            'name' => $this->name,
            'description'=>$this->description,
            'ingredients'=>json_decode($this->ingredients, true),
            'user_id' => $this->user_id,
            'cuisine_id' => $this->cuisine_id,
            'cuisine' => new CuisineResource($this->whenLoaded('cuisine')),
            'editable' => $this->user_id === $currentUserId && $this->user_id!==null,
            // $this->cuisine->name : null, // Include the cuisine name
            'avatar' => $this?->getFirstMediaUrl('avatars'),
        ];
    }
}