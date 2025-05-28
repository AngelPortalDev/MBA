<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect};

class Testimonals extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'testimonals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'last_name',
        'designation',
        'feedback',
        'image',
        'created_at',
        'updated_at'
    ];

   
}