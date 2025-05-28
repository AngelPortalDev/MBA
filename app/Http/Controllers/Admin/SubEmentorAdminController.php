<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use App\Models\User;
use App\Models\EmentorProfile;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAdmin;
use App\Imports\ImportAdmin;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use File;

class SubEmentorAdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getSubEmentorData($cat)
    {
        if (Auth::check()) {
            $ementorData = [];
            $where = [];
            $ementorDashboardData = [];
            if (isset($cat) && !empty($cat) && $cat != 'all'){

                if ($cat == 'Active') {
                    $where = ['ementor_profile_master.status' => '0'];
                }
                if($cat == 'Inactive'){
                    $where = ['ementor_profile_master.status' => '1'];
                }
                if ($cat == 'delete') {
                    $where = ['is_deleted' => 'Yes'];
                }
                if(base64_decode($cat) > 0){
                    $where = ['ementor_profile_master.ementor_id' => base64_decode($cat)];
                }
            }
            if(base64_decode($cat) > 0 && $cat != 'all'){
                $subEmentorData = $this->EmentorProfile->getSubEmentorProfile($where);
                $ementor = getData('ementor_submentor_relations', ['ementor_id', 'sub_ementor_id'], ['sub_ementor_id' => base64_decode($cat)]);
                $ementorId = 0;
                
                if (!empty($ementor) && isset($ementor[0]->ementor_id)) {
                    $ementorId = $ementor[0]->ementor_id;
                }
                
                $subEmentorId = isset($ementor[0]->sub_ementor_id) ? $ementor[0]->sub_ementor_id : 0;
                if (!Auth::check() && empty($subEmentorId) && $subEmentorId == 0) {
                    return redirect('/login');
                }
                
                $approvedAmounts = DB::table('exam_remark_master')
                    ->where('remark_updated_by', $subEmentorId)
                    ->where('is_cheking_completed', '2')
                    ->where('approved_status', '1')
                    ->sum('amount') ?? 0;

                $checkedExams = DB::table('exam_remark_master')
                    ->where('remark_updated_by', $subEmentorId)
                    ->where('is_cheking_completed', '2')
                    ->whereNull('approved_by')
                    ->select('exam_type', 'exam_id')
                    ->get();

                $pendingAmounts = $checkedExams->sum(function ($checkedExam) {
                    return DB::table('exam_amounts')
                        ->where('exam_type', $checkedExam->exam_type)
                        ->where('exam_id', $checkedExam->exam_id)
                        ->sum('amount');
                });

                $totalAmounts = $approvedAmounts + $pendingAmounts;

                $data = [
                    'totalAmounts' => $totalAmounts,
                    'approvedAmounts' => $approvedAmounts,
                    'pendingAmounts' => $pendingAmounts,
                ];
                
                return view('admin.sub-e-mentors.sub-e-mentors-edit', compact('subEmentorData', 'ementorId', 'data'));
            }else{
                $ementorData = $this->EmentorProfile->getSubEmentorProfile($where);
                return response()->json($ementorData);
            }

        }
        return redirect('/login');
    }
}
