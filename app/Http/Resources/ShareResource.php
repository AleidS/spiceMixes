<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Mixes;
use App\Http\Resources\IngredientResource;

class ShareResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentUserId = Auth::id();
        $mix = Mixes::find($this->mix_id);
        $mix_name = $mix->name;
        // dd($mix->allIngredients);
        // $ingredients2 = Mixes::find(1)->ingredients;
        return [
            'id' => $this->id,
            'mix_id' => $this->mix_id,
            'mix_name' => $mix_name,
            'responded' => $this->responded,
            'accepted' => $this->accepted,
            'target_user' => $this->target_user,
            'message' => $this->message,
            'name' => $this->name,
        ];
    }
}
