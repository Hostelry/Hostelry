<?php

declare(strict_types=1);

namespace Hostelry\Account\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

final class User extends Authenticatable
{
    protected $fillable = ['username', 'password', 'api_token'];
}
