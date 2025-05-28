<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect};

class EmentorSubementorRelation extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'ementor_submentor_relations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sub_ementor_id', 'id');
    }

    // public function getSubEmentorList($where = [], $select = [])
    // {
    //     $subEmentorData = [];
    //     if (Auth::check()) {
    //         $query = EmentorSubementorRelation::select('sub_ementor_id')->with(['user' => function ($query) {
    //             $query->select('id', 'name', 'last_name', 'photo');
    //          }]);
             

    //         if (isset($where) && count($where) > 0 && is_array($where)) {
    //             $subEmentorData = $query->where($where)->orderBy('id','desc')->get();
    //         } else {
    //             $subEmentorData = $query->orderBy('id','desc')->get();
    //         }
    //         return $subEmentorData;
    //     }
    // }
    
    public function getSubEmentorList($where = [], $select = [])
    {
        $subEmentorData = [];

        if (Auth::check()) {
            $query = EmentorSubementorRelation::select('sub_ementor_id')
                ->with(['user' => function ($query) {
                    $query->select('id', 'name', 'last_name', 'photo')
                        ->where('is_deleted', 'No'); // Filter only active users
                }])
                ->whereHas('user', function ($query) {
                    $query->where('is_deleted', 'No'); // Ensure relation exists and user is not deleted
                });

            if (!empty($where) && is_array($where)) {
                $subEmentorData = $query->where($where)->orderBy('id', 'desc')->get();
            } else {
                $subEmentorData = $query->orderBy('id', 'desc')->get();
            }

            return $subEmentorData;
        }
    }

}