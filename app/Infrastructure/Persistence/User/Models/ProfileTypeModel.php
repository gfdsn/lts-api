<?php

namespace App\Infrastructure\Persistence\User\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileTypeModel extends Model
{

    protected $table = 'profile_types';
    protected $fillable = ["name"];
    public $timestamps = false;
}
