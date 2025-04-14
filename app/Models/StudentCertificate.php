<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCertificate extends Model
{

    protected $table = 'student_certificate';


    protected $fillable = [
        'user_id',
        'certifacte_number',
        'Cname',
        'CDate',
        'coursename',
        'file',
        'created_at',
        'updated_at'
    ];


}
