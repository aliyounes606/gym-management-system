<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
public function toArray($request)
{
    return [
        'id'          => $this->id,
        'name'        => $this->name,
        'description' => $this->description,
        'calories'    => $this->calories,
        'image_url'   => $this->image ? asset('storage/' . $this->image->path) : null,
        'created_at'  => $this->created_at->format('Y-m-d'),
    ];
}
}
