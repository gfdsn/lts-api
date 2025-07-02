<?php

namespace App\Infrastructure\Persistence\Product\Models;

use Illuminate\Database\Eloquent\Model;

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
        "costs",
        "images",
        "documentation",
        "stock",
        "accessories"
    ];
    protected $casts = [
        "attributes" => "array",
        "measures" => "array",
        "classification" => "array",
        "costs" => "array",
        "images" => "array",
        "documentation" => "array",
        "accessories" => "array"
    ];

}
