<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myproject extends Model
{
    use HasFactory;

    protected $table = 'template';

    protected $fillable = [
        'userid',
        'template_name',
        'desc',
        'status',
        'file',
        'created_at',
        'updated_at'
    ];

}
