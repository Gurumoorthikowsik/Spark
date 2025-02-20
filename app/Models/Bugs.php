<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bugs extends Model
{
    use HasFactory;

    protected $table = 'bugs';

    protected $fillable = [
        'bugs_name', 'bugs_desc', 'module_name', 'Status', 'image', 'created_at', 'updated_at'
    ];


}
