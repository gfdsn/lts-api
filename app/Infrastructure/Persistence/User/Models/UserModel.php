<?php

namespace App\Infrastructure\Persistence\User\Models;

use App\Domain\User\Enums\UserProfileType;
use App\Infrastructure\Persistence\Product\Models\ProductModel;
use App\Infrastructure\Persistence\User\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'users';
    protected $keyType = 'uuid';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    public function firstName(): Attribute
    {
        return Attribute::make(
            get: fn () => ucfirst($this->name),
        );
    }

    public function profileType(): BelongsTo
    {
        return $this->belongsTo(ProfileTypeModel::class);
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->profileType?->name === UserProfileType::ADMIN->value
        );
    }

    protected static function newFactory(): UserModelFactory
    {
        return UserModelFactory::new();
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            "exp" => time() + 1800, // token lasts 30 minutes
            "is_admin" => $this->profile_type_id == 3,
        ];
    }

    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(ProductModel::class, "wishlists", "user_id", "product_id")->withTimestamps();
    }

}
