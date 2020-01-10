<?php

namespace App;
use App\User;
use App\Role;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'test.role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_id',
    ];
}
