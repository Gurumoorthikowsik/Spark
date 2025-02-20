<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Serializeattendance  extends Authenticatable{

    protected $table = 'serialize_attendance';
}


?>