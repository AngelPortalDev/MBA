<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};


class WishlistModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'wishlist';
    protected $guarded  = [];


   
    public function WishlistData()
    {
        return $this->hasMany(StudentProfile::class, 'student_id','student_id');
        
    }

    


    
}