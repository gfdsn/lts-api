<?php

namespace App\Infrastructure\Persistence\Product\Models;

use App\Infrastructure\Persistence\Product\Subdomains\Availability\Models\AvailabilityModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductModel extends Model
{

    protected $table = 'products';
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        "id",
        "title",
        "description",
        "attributes",
        "measures",
        "classification",
        "price",
        "images",
        "documentation",
        "availability",
        "accessories",
        "slug"
    ];

    protected $casts = [
        "attributes" => "array",
        "measures" => "array",
        "classification" => "array",
        "images" => "array",
        "documentation" => "array",
        "availability" => "array",
        "accessories" => "array"
    ];

    public function availability(): BelongsTo
    {
        return $this->belongsTo(AvailabilityModel::class, 'availability.availability_id');
    }

}
