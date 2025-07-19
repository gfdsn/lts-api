<?php

namespace App\Infrastructure\Persistence\Product\Eloquent;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Product\Mappers\ProductMapper;
use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAll(): Collection
    {
        return ProductModel::all();
    }
    public function save(Product $product): void
    {
        $model = ProductMapper::toModel($product);

        $model->slug = Str::slug($model->title);

        $model->save();
    }

    public function update(ProductModel $productModel, Product $updatedProduct): void
    {
        $productModel->update($updatedProduct->jsonSerialize());
    }

    public function find(string $id): ProductModel
    {
        return ProductModel::find($id);
    }

    public function findBySlug(string $slug): ProductModel
    {
        return ProductModel::where('slug', $slug)->first();
    }

    public function destroy(string $id): bool
    {
        $product = $this->find($id);

        return $product->delete();
    }

    public function random(int $count): Collection
    {
        return ProductModel::with(["availability"])->inRandomOrder()->limit($count)->get();
    }

}
