<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Category\Models;

use App\Infrastructure\Persistence\Product\Models\ProductModel;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Factories\CategoryModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CategoryModel extends Model
{

    use HasFactory;

    protected $table = 'categories';
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        "id",
        "name",
        "slug",
        "icon"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductModel::class, "classification.category_id", "id");
    }

    protected static function newFactory(): CategoryModelFactory
    {
        return CategoryModelFactory::new();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

}
