<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};
use App\Models\PaymentModule;

class OrderModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'orders';
    protected $guarded  = [];


    public function OrderData()
    {
        return $this->belongsTo(PaymentModule::class, 'payment_id', 'id');
    }

    public function OrderLearning()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id', 'user_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    


    
}