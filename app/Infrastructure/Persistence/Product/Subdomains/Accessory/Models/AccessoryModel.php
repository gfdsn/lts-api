<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models;

use Illuminate\Database\Eloquent\Model;

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

}
