<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{

    protected float $cartTotal = 0;

    public function withTotal(float $total): static
    {
        $this->cartTotal = $total;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "products" => CartProductResource::collection($this),
            'total' => $this->cartTotal,
        ];
    }

}
