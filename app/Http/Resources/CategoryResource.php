<?php

namespace App\Http\Resources;

use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CategoryResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "icon" => $this->icon,
            "productCount" => $this->getProductCount()
        ];
    }

    protected function getProductCount(): int
    {
        return ProductModel::where('classification->category_id', $this->id)->count();
    }
}
