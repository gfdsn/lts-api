<?php

namespace App\Infrastructure\Persistence\Product\Eloquent;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Product\Mappers\ProductMapper;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{

    public function save(Product $product): void
    {
        $model = ProductMapper::toModel($product);

        $model->slug = Str::slug($model->title);

        $model->save();
    }

}
