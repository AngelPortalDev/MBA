<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Carbon\Carbon;

class PaymentModule extends Model
{

    use HasFactory;
    public $timestamps = false;
    public $table = 'payments';
    protected $guarded  = [];
    public function __construct()
    {
        parent::__construct();

     
    }

    public function UserData()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function OrderData()
    {
        return $this->hasMany(OrderModel::class, 'payment_id','id');
        
    }
    public function RefundData()
    {
        return $this->hasMany(PaymentRefundModel::class, 'payment_id','id');
        
    }


    public function getPaymentDetails($where = [], $cat )
    {   
    
        if (Auth::check()) {
            $where = $where;
            $query = $this->with('OrderData')->with('UserData')->with('RefundData')->where('is_deleted', 'No')->WhereNotNull('status')->orderByDesc('id');
            $PaymentData = [];
            $today = Carbon::today();
            // if($cat == 'Hold'){ 
                
            //     $query = $query->where('status','0')->whereDate('hold_date', '>', $today);

            // }else if($cat == 'Paid'){
                
            //     $query = $query->where('status','0')->whereDate('hold_date', '<=', $today);
            // }
            if($cat == 'Paid'){
                
                $query = $query->where('status','0');
            }

            $PaymentData = $query->where($where)->get()->toArray();

            return $PaymentData;
        }
        return redirect('/login');
    }
    
    public function getPaymentReportData($cat, $where = [])
    {
    
        if (Auth::check()) {
            $where = $where;
            $query = $this->with('OrderData')->with('UserData')->with('RefundData')->where('is_deleted', 'No')->WhereNotNull('status')->orderByDesc('id');
            $PaymentData = [];
            $today = Carbon::today();
            if($cat == 'Hold'){ 
                
                $query = $query->where('status','0')->whereDate('hold_date', '>', $today);

            }else if($cat == 'Paid'){
                
                $query = $query->where('status','0')->whereDate('hold_date', '<=', $today);
            }
           

            if (!empty($where) && is_array($where)) {
                $query = $query->where($where);
            }
    
            $PaymentData = $query->get()->toArray();

            return $PaymentData;
        }
        return redirect('/login');
    }


}
