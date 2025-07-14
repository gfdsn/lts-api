<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models;

use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessoryModel extends Model
{

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class);
    }

}
