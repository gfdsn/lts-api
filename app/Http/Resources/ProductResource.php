<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
            "slug" => $this->slug,
            "description" => $this->description,
            "attributes" => $this->attributes,
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
