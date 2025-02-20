<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User_add_inventory  extends Authenticatable{

    protected $table = 'users_add_inventory';
}


?>