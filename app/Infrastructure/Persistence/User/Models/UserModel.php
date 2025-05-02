<?php

namespace App\Infrastructure\Persistence\User\Models;

use Illuminate\Database\Eloquent\Model;

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

}
