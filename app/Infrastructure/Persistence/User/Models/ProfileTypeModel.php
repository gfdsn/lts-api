<?php

namespace App\Infrastructure\Persistence\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfileTypeModel extends Model
{
    protected $table = 'profile_types';
    protected $fillable = ["name"];
    public $timestamps = false;

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class);
    }
}
