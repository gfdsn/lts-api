<?php

namespace App\Infrastructure\Persistence\Product\Models;

use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use App\Infrastructure\Persistence\Product\Subdomains\Availability\Models\AvailabilityModel;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        "availability_id",
        "stock",
        "accessories",
        "slug"
    ];

    protected $casts = [
        "attributes" => "array",
        "measures" => "array",
        "classification" => "array",
        "images" => "array",
        "documentation" => "array",
        "accessories" => "array"
    ];

    public function availability(): BelongsTo
    {
        return $this->belongsTo(AvailabilityModel::class, 'availability_id');
    }

    public function getCategoryAttribute()
    {
        return CategoryModel::find(optional($this->classification)['category_id']);
    }

    public function getSubCategoryAttribute()
    {
        return CategoryModel::find(optional($this->classification)['subcategory_id']);
    }

    public function getAccessoriesAttribute()
    {
        $ids = json_decode($this->attributes['accessories'] ?? '[]', true);

        if (!is_array($ids) || empty($ids)) {
            return collect();
        }

        return AccessoryModel::whereIn('id', $ids)->get();
    }


}
