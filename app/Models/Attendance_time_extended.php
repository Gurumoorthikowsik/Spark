<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Attendance_time_extended  extends Authenticatable{

    protected $table = 'attendance_time_extended';
}


?>