<?php

namespace App\Infrastructure\Persistence\User\Models;

use App\Domain\User\Enums\UserProfileType;
use App\Infrastructure\Persistence\User\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

}
