<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Addproduct extends Authenticatable{
   
    protected $table = 'add_product';

    protected $fillable =
    [
        'serial_no',
        'status',
        'brand',
        'accessories'
       
    ];
}


?>