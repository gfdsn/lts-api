<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "measures" => $this->measures,
            'category' => new CategoryResource($this->category),
            'subcategory' => new CategoryResource($this->subCategory),
            "quotation" => $this->quotation,
            "images" => $this->images,
            "documentation" => $this->documentation,
            'availability' => new AvailabilityResource($this->availability),
            "stock" => $this->stock,
            "accessories" => AccessoryResource::collection($this->accessories),
        ];
    }
}
