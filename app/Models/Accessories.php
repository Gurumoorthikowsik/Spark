<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Accessories extends Authenticatable{
   
    protected $table = 'accessories';

    protected $fillable =
    [
        'accessories_name',
        'status',
       
    ];
}


?>