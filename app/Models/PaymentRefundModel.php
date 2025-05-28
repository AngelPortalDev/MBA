<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};
use App\Models\PaymentModule;

class PaymentRefundModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'payment_refund';
    protected $guarded  = [];


    public function RefundData()
    {
        return $this->belongsTo(PaymentModule::class, 'payment_id', 'id');
    }

}