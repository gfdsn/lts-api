<?php

namespace App\Infrastructure\Persistence\Product\Models;

use App\Infrastructure\Persistence\Product\Factories\ProductModelFactory;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use App\Infrastructure\Persistence\Product\Subdomains\Availability\Models\AvailabilityModel;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductModel extends Model
{

    use HasFactory;

    protected $table = 'products';
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $hidden = ['pivot'];

    protected $fillable = [
        "id",
        "title",
        "description",
        "attributes",
        "measures",
        "classification",
        "quotation",
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
        "accessories" => "array",
        "quotation" => "array"
    ];

    protected static function newFactory(): ProductModelFactory
    {
        return ProductModelFactory::new();
    }

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
