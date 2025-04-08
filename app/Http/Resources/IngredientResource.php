<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     *
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mixes_id' => $this->mixes_id,
            'measure_id' => $this->measure_id,
            'quantity' => $this->quantity,
            'alternatives' => $this->alternatives,
            'show_alternatives' => $this->show_alternatives,
        ];
    }
}
