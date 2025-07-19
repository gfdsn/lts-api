<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models;

use App\Infrastructure\Persistence\Product\Models\ProductModel;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Factories\AccessoryModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessoryModel extends Model
{

    use HasFactory;

    protected $table = 'accessories';
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        "id",
        "name",
        "details",
        "price",
        "stock",
    ];

    protected static function newFactory(): AccessoryModelFactory
    {
        return AccessoryModelFactory::new();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class);
    }

}
