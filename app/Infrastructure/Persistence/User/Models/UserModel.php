<?php

namespace App\Infrastructure\Persistence\User\Models;

use App\Infrastructure\Persistence\User\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
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

    protected static function newFactory(): UserModelFactory
    {
        return UserModelFactory::new();
    }

}
