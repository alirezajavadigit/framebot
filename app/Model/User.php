<?php

namespace App\Model;

use System\Database\ORM\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'password'];
    protected $hidden = ['password'];
    protected $casts = [];
    
}
