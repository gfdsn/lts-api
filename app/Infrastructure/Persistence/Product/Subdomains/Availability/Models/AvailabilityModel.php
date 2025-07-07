<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Availability\Models;

use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AvailabilityModel extends Model
{
    protected $table = 'availabilities';

    protected $fillable = [
        "id",
        "name"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductModel::class);
    }
}
