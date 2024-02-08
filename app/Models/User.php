<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
