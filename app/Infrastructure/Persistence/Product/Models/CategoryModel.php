<?php

namespace App\Infrastructure\Persistence\Product\Models;

use App\Infrastructure\Persistence\Product\Factories\CategoryModelFactory;
use App\Infrastructure\Persistence\User\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryModel extends Model
{

    use HasFactory;

    protected $table = 'categories';
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        "id",
        "name",
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductModel::class);
    }

    protected static function newFactory(): CategoryModelFactory
    {
        return CategoryModelFactory::new();
    }

}
