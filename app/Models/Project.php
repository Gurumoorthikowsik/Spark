<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';


    protected $fillable = [
        'user_id',
        'roll_name',
        'username',
        'project',
        'desc',
        'type',
        'status',
        'git_url',
        'project_file',
        'team_count',
        'projectId',
        'created_at',


    ];

}
