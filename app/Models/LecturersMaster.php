<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturersMaster extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'lecturers_master';
    protected $guarded  = [];
    protected $visible = ['lactrure_name', 'discription', 'image', 'is_deleted'];
}