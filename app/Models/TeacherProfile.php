<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect};

class TeacherProfile extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'lecturers_master';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lactrure_name',
        'mobile',
        'email',
        'designation',
        'discription',
        'image',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

   
}