<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};


class PaymentModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'payments';
    protected $guarded  = [];


   

    


    
}