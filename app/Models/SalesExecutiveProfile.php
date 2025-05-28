<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect,DB};
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesExecutiveProfile extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    public $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id'
    ];

    public function getSalesExecutiveProfile($where = [], $select = [])
    {
        $salesExecutiveData = [];
        if (Auth::check()) {
            $query = SalesExecutiveProfile::query();
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $salesExecutiveData = $query->where($where)->orderBy('id','desc')->get();
            } else {
                $salesExecutiveData = $query->orderBy('id','desc')->get();
            }
            return $salesExecutiveData;
        }
    }
}
