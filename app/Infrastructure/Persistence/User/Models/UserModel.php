<?php

namespace App\Infrastructure\Persistence\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
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
}
