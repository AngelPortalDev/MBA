<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftExam extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    public $table = 'draft_exam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id'
    ];
}
