<?php

use Illuminate\Support\Facades\{DB, Storage, Mail, Exception, Queue,Log};
use App\Jobs\SendActionMails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\User;
use App\Notifications\SendNotification;
use Smalot\PdfParser\Parser;
use Illuminate\Database\Eloquent\Model;
use setasign\Fpdi\Fpdi;


if (!function_exists('getDropDownlist')) {
    function getDropDownlist($table, $select, $limit = '')
    {

        if (!empty($select[1])) {
            $order = $select[1];
        } else {
            $order = $select[0];
        }
        if (isset($table) && !empty($table) && isset($select) && is_array($select)) {

            $query = DB::table($table)->select($select)->where('is_deleted', 'No')->orderBy($order,'ASC');
           
            if (!empty($limit) && isset($limit) && is_numeric($limit)) {
                $query->take($limit);
            }
            $data = $query->get();
            return $data;
        }
    }
}
if (!function_exists('getContentAsAssigned')) {
    function getContentAsAssigned($table, $select, $where)
    {


        if (!empty($select[1])) {
            $order = $select[1];
        } else {
            $order = $select[0];
        }
        if (isset($table) && !empty($table) && isset($select) && is_array($select)) {
            $query = DB::table($table)->select($select);
            if (isset($where) && !empty($where) && count($where) > 0  &&  is_array($where)) {
                $query->where($where);
            }
            $data = $query->get();
            return $data;
        }
    }
}
if (!function_exists('getData')) {
    function getData($table, $select, $where = '', $limit = '', $order_col = '', $order_dirc = 'DESC')
    {
        if (isset($table) && !empty($table) && isset($select) && is_array($select) && isset($where) && is_array($where)) {
            // $query = DB::table($table)->select($select)->where('is_deleted', 'No'); OLD
            $query = DB::table($table)->select($select); //New
            if (isset($where) && !empty($where) && $where != '' &&  is_array($where)) {
                $query->where($where);
            }
            if (isset($limit) && !empty($limit) && is_numeric($limit) && $limit != '') {
                $query->limit($limit);
            }
            if (isset($order_col) && !empty($order_col)) {
                $query->orderBy($order_col, $order_dirc);
            }

            $data = $query->get();
            return $data;
        }
    }
}
if (!function_exists('getPaidCourse')) {
    function getPaidCourse($where)
    {
        $data = [];
        if (isset($where['user_id']) && !empty($where['user_id']) && is_numeric($where['user_id'])) {

            $userId = $where['user_id'] ? $where['user_id'] : 0;

            $adjustedExpiryCondition = "IF(scm.exam_attempt_remain = 1, DATE_ADD(scm.course_expired_on, INTERVAL 15 DAY), scm.course_expired_on)";

            $query = DB::table('course_master as cm')
                ->select(
                    'cm.id as course_id',
                    'cm.course_title',
                    'user.id as userId',
                    'ord.id as orderId',
                    'cm.course_thumbnail_file',
                    'scm.course_expired_on',
                    'scm.exam_remark',
                    'scm.exam_attempt_remain',
                    'cm.category_id',
                    'cm.ects',
                    'scm.course_progress',
                    'scm.id as scmId',
                    'scm.preference_status',
                    'scm.preference_id',
                    DB::raw("$adjustedExpiryCondition as adjusted_expiry")
                )
                ->leftJoin('orders as ord', 'ord.course_id', '=', 'cm.id')
                ->leftJoin('users as user', 'ord.user_id', '=', 'user.id')
                ->leftJoin('student_course_master as scm', function ($join) {
                    $join->on('scm.course_id', '=', 'cm.id')
                        ->on('scm.user_id', '=', 'user.id');
                })
                ->where('ord.user_id', $userId)
                ->where('scm.is_deleted','No');
                if(isset($where['ementor_id'])){
                    $ementorId = $where['ementor_id'] ? $where['ementor_id'] : 0;
                    $query->where('cm.ementor_id', $ementorId);
                }
                if (isset($where['include_adjusted_expiry']) && $where['include_adjusted_expiry'] === true) {
                    $query->whereRaw("$adjustedExpiryCondition > NOW()");
                } else {
                    $query->where('scm.course_expired_on', '>', now());
                }
                
                $query = $query->where('ord.status', '0')->where('cm.category_id','!=','5')
                ->whereNotNull('ord.course_id')
                ->where(function ($query) {
                    $query->where('scm.exam_remark', '!=', '1')
                        ->orWhereNull('scm.exam_remark');
                })
                ->where(function ($query) {
                    $query->where('scm.exam_attempt_remain', '!=', 0)
                        ->orWhere('scm.exam_attempt_remain', '>', 0);
                })
                ->whereIn('ord.id', function ($subquery) use ($userId) {
                    $subquery->select(DB::raw('MAX(ord.id)'))
                        ->from('orders as ord')
                        ->where('ord.user_id', $userId)
                        ->groupBy('ord.course_id', 'ord.user_id');
                });
                
            $data = $query->get()->toArray();
        }
        return $data;
    }
}
if (!function_exists('getAllPaidCourse')) {
    function getAllPaidCourse($where)
    {
        $data = [];
        if (isset($where['user_id']) && !empty($where['user_id']) && is_numeric($where['user_id'])) {

            $userId = $where['user_id'] ? $where['user_id'] : 0;
            
            $adjustedExpiryCondition = "IF(scm.exam_attempt_remain = 1, DATE_ADD(scm.course_expired_on, INTERVAL 15 DAY), scm.course_expired_on)";

            $query = DB::table('course_master as cm')
                ->select(
                    'cm.id as course_id',
                    'cm.course_title',
                    'user.id as userId',
                    'ord.id as orderId',
                    'cm.course_thumbnail_file',
                    'scm.course_expired_on',
                    'scm.exam_remark',
                    'scm.exam_attempt_remain',
                    'cm.category_id',
                    'cm.ects',
                    'scm.course_progress',
                    'scm.id as scmId',
                    'scm.course_start_date',
                    'payments.total_amount as purchase_price',
                    DB::raw("$adjustedExpiryCondition as adjusted_expiry")
                )
                ->leftJoin('orders as ord', 'ord.course_id', '=', 'cm.id')
                ->leftJoin('users as user', 'ord.user_id', '=', 'user.id')
                ->leftJoin('student_course_master as scm', function ($join) {
                    $join->on('scm.course_id', '=', 'cm.id')
                        ->on('scm.user_id', '=', 'user.id');
                })
                ->leftJoin('payments', 'scm.payment_id', '=', 'payments.id')
                ->where('ord.user_id', $userId)
                ->where('user.is_deleted','No')
                ->where('user.is_active','Active')
                // ->where('user.is_verified','Verified')
                ->where('user.block_status','0')
                ->where('scm.is_deleted','No');
                if(isset($where['start_date'])){
                    $startDate = $where['start_date'];
                    $query->where('scm.'.$startDate[0], $startDate[1], $startDate[2]);
                }
                if(isset($where['course_id'])){
                    $startDate = $where['course_id'];
                    $query->whereIn('cm.id', $where['course_id']);
                }
                if(isset($where['student_course_master_id'])){
                    $startDate = $where['student_course_master_id'];
                    $query->whereIn('scm.id', $where['student_course_master_id']);
                }
                if(isset($where['end_date'])){
                    $endDate = $where['end_date'];
                    $query->where('scm.'.$endDate[0], $endDate[1], $endDate[2]);
                }
                if(isset($where['ementor_id'])){
                    $ementorId = $where['ementor_id'] ? $where['ementor_id'] : 0;
                    $query->where('cm.ementor_id', $ementorId);
                }
                // if (isset($where['include_adjusted_expiry']) && $where['include_adjusted_expiry'] === true) {
                //     $query->whereRaw("$adjustedExpiryCondition > NOW()");
                // } 
                // else {
                //     if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
                //         $query->where('scm.course_expired_on', '>', now());
                //     }
                // }
                
                if (isset($where['course_title']) && !empty($where['course_title'])) {
                    $query->where('cm.course_tile', 'like', '%' . $where['course_title'] . '%');
                }

                $query = $query->where('ord.status', '0')
                ->whereNotNull('ord.course_id')
                ->whereIn('ord.id', function ($subquery) use ($userId) {
                    $subquery->select(DB::raw('MAX(ord.id)'))
                        ->from('orders as ord')
                        ->where('ord.user_id', $userId)
                        ->groupBy('ord.course_id', 'ord.user_id');
                });
                
                if (isset($where['limit']) && !empty($where['limit']) && is_numeric($where['limit'])) {
                    $query = $query->orderByDesc('scm.id')->limit(1);
                }else{
                    $query = $query->orderByDesc('scm.id');
                }





            // if (isset($where) && !empty($where) && $where != '' &&  is_array($where)) {
            //     $query->where($where);
            // }
            // if (isset($limit) && !empty($limit) && is_numeric($limit) && $limit != '') {
            //     $query->limit($limit);
            // }
            // if (isset($order_col) && !empty($order_col)) {
            //     $query->orderBy($order_col, $order_dirc);
            // }

            $data = $query->get()->toArray();
        }
        return $data;
    }
}
if (!function_exists('getStudentExpiredCourse')) {
    function getStudentExpiredCourse($where)
    {
        $data = [];
        if (isset($where['user_id']) && !empty($where['user_id']) && is_numeric($where['user_id'])) {

            $userId = $where['user_id'] ? $where['user_id'] : 0;

            $query = DB::table('student_course_master as scm')
                ->select(
                    'cm.id as course_id',
                    'cm.course_title',
                    'user.id as userId',
                    'cm.course_thumbnail_file',
                    'scm.course_expired_on',
                    'cm.category_id',
                    'cm.ects',
                    'scm.course_progress',
                    'scm.exam_remark',
                    'scm.exam_attempt_remain',
                    'scm.id as scmId',
                )
                ->leftJoin('users as user', 'scm.user_id', '=', 'user.id')
                ->leftJoin('course_master as cm', 'cm.id', '=', 'scm.course_id')
                ->where('scm.user_id', $userId)
                ->where('scm.is_deleted', 'No')
                ->where(function ($query) {
                    $query->where('scm.course_expired_on', '<', now()) // First check if course is expired
                        ->orWhere(function ($subQuery) { // If not expired, apply other conditions
                            $subQuery->where('scm.exam_remark', '=', '1')
                                     ->orWhere('scm.exam_attempt_remain', '=', 0);
                        });
                });
                // ->where(function ($query) {
                //     $query->where('scm.exam_remark', '=', '1')
                //         ->orWhere('scm.exam_attempt_remain', '=', 0);
                // });
                if (isset($where['ementor_id'])) {
                    $ementorId = $where['ementor_id'] ? $where['ementor_id'] : 0;
                    $query->where('cm.ementor_id', $ementorId);
                }

            $data = $query->get()->toArray();
        }
        return $data;
    }
}
// if (!function_exists('is_expired')) {
//     function is_expired($where)
//     {
//         $planDetails = '';
//         if (isset($where) && !empty($where) && is_array($where)) {
//             $currentDate = Carbon::now('Europe/Malta');
//             $today = $currentDate->format('Y-m-d');
//             $planDetails = DB::table('student_course_master')->Join('users','users.id','student_course_master.user_id')->where('is_active','Active')->where('course_expired_on', '>=', $today)->where($where)->count();
//         }
//         return $planDetails;
//     }
// }

if (!function_exists('is_expired')) {
    function is_expired($where)
    {
        $planDetails = '';
        if (isset($where) && !empty($where) && is_array($where)) {
            $currentDate = Carbon::now('Europe/Malta');
            $today = $currentDate->format('Y-m-d');
            
            $expiredCourse = DB::table('student_course_master')
                ->where($where)
                ->where('course_expired_on', '<', $today)
                ->where('exam_attempt_remain', 1)
                ->where('exam_remark', '0')
                ->first(); // Fetch only one record
                
            
            // Store result for checking purpose
            $result = [];
            
            if ($expiredCourse) { // Check if a record exists
                $result = [
                    'id' => $expiredCourse->id,
                    'original_expiry' => $expiredCourse->course_expired_on,
                    'new_expiry' => Carbon::parse($expiredCourse->course_expired_on)->addDays(15)->format('Y-m-d'),
                ];
                $today = $result['new_expiry'];
            }

            $planDetails = DB::table('student_course_master')
                ->join('users', 'users.id', '=', 'student_course_master.user_id')
                ->where($where)
                ->where('users.is_active', 'Active');
                if ($expiredCourse) {
                    $planDetails->where('course_expired_on', '<=', $today);
                }else{
                    $planDetails->where('course_expired_on', '>=', $today);
                }
                $planDetails = $planDetails->count();


        }
        return $planDetails;
    }
}

if (!function_exists('jobList')) {
    function jobList($table, $select, $where = '', $limit = '', $order_col = '', $order_dirc = 'DESC')
    {
        if (isset($table) && !empty($table) && isset($select) && is_array($select) && isset($where) && is_array($where)) {
            // $query = DB::table($table)->select($select)->where('is_deleted', 'No'); OLD
            $query = DB::table($table)->select($select); //New
            if (isset($where) && !empty($where) && $where != '' &&  is_array($where)) {
                $query->where($where);
            }
            if (isset($limit) && !empty($limit) && is_numeric($limit) && $limit != '') {
                $query->limit($limit);
            }
            if (isset($order_col) && !empty($order_col)) {
                $query->orderBy($order_col, $order_dirc);
            }
            $query->where('job_expired_on', '>=', Carbon::now('Europe/Malta')->format('Y-m-d'));
            $data = $query->get();
            return $data;
        }
    }
}
if (!function_exists('multiSelectDropdown')) {
    function multiSelectDropdown($table, $select, $keys)
    {
        if (isset($table) && !empty($table) && isset($keys) && is_array($keys)) {

            foreach ($keys as $key) {
                $data[] = DB::table($table)->select($select)->where('id', $key)->get()->toArray();
            }
            return $data;
        }
    }
}
if (!function_exists('getDataArray')) {
    function getDataArray($table, $select, $where)
    {
        if (isset($table) && !empty($table)) {
            $query =  DB::table($table)->select($select);
            if (isset($where) && count($where)  > 0 &&  is_array($where)) {
                $query->where($where);
            }
            $data = $query->get()->toArray();
            return $data;
        }
    }
}
if (!function_exists('userEmailExist')) {
    function userExist($table, $select)
    {

        $data = DB::table($table)->select($select)->where('is_deleted', 'No')->get();
        return $data;
    }
}
if (!function_exists('jobseekerAction')) {
    function jobseekerAction($table, $data, $where = '')
    {
        $exists = DB::table($table)->where($where)->count();

        if ($exists != 0) {
            $data = DB::table($table)->where($where)->update($data);
            return $data;
        } else {
            $data = DB::table($table)->insert($data);
            return $data;
        }
    }
}
if (!function_exists('is_exist')) {
    function is_exist($table, $where)
    {
        $data = 0;
        if (isset($table) && !empty($table) && isset($where) && is_array($where)) {
            $data = DB::table($table)->where($where)->count();
        }
        return $data;
    }
}
if (!function_exists('is_exists')) {
    function is_exists(Model $modelInstance, array $where)
    {
        $data = 0;
        if (isset($modelInstance) && !empty($modelInstance) && isset($modelInstance)) {
            $data = $modelInstance->where($where)->count();
        }
        return $data;
    }
}
if (!function_exists('processData')) {
    function processData($tableInfo, $data = [], $where = [])
    {

        $exists = 0;
        if (count($where) > 0) {
            $exists =  is_exist($tableInfo[0], $where);
        }
        if (isset($tableInfo) && is_array($tableInfo) && count($tableInfo) === 2) {
            $query = DB::table($tableInfo[0]);
            $primarykeyCol = isset($tableInfo[1])  ? $tableInfo[1] : 0;

            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                if (isset($data) && is_array($data) && count($data) > 0) {
                    $getId =  $query->insertGetId($data);
                    if (isset($getId) && is_numeric($getId) && $getId > 0) {
                        return ['status' => TRUE, 'id' => $getId];
                    }
                }
                return FALSE;
            } elseif (isset($exists) && is_numeric($exists) && $exists > 0) {
                if (isset($where) && is_array($where) && count($where) > 0) {
                    $query->where($where);
                }
                $getId = $query->first($primarykeyCol)->$primarykeyCol;
                if (isset($data) && is_array($data) && count($data) > 0) {
                    $response = $query->update($data);
                    if (isset($response) && is_numeric($response)) {
                        return ['status' => TRUE, 'id' => $getId];
                    }
                }
                return FALSE;
            }
            return FALSE;
        }
        return FALSE;
    }
}
if (!function_exists('saveData')) {
    function saveData($modelInstance, $data = [], $where = [])
    {
        $exists = 0;
        if (count($where) > 0) {
            $exists =  is_exists($modelInstance, $where);
        }
        if (isset($modelInstance)) {
            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                if (isset($data) && is_array($data) && count($data) > 0) {
                    $getId =  $modelInstance->create($data);
                    if (isset($getId) && is_numeric($getId->getKey()) && $getId->getKey() > 0) {
                        return ['status' => TRUE, 'id' => $getId->getKey()];
                    }
                }
                return FALSE;
            } elseif (isset($exists) && is_numeric($exists) && $exists > 0 && isset($where) && is_array($where) && count($where) > 0) {
                $getData = $modelInstance->where($where)->first();
                if (isset($data) && is_array($data) && count($data) > 0) {
                    $getData->update($data);
                    if (isset($getData) && is_numeric($getData->getKey()) && $getData->getKey() > 0) {
                        return ['status' => TRUE, 'id' => $getData->getKey()];
                    }
                }
                return FALSE;
            }
            return FALSE;
        }
    }
}

if (!function_exists('jobCount')) {
    function jobCount($table, $where)
    {
        if (isset($table) && !empty($table) && isset($where) && is_array($where)) {
            $data = DB::table($table)->where($where)->where('job_expired_on', '>=', Carbon::now('Europe/Malta')->format('Y-m-d'))->count();
            return $data;
        }
    }
}

if (!function_exists('isImageCorrupt')) {
    function isImageCorrupt($file)
    {
        $filePath = $file->getPathname();  // This returns the temporary path (string)
    
        $fileCorrupt = false;

        $imageInfo = @getimagesize($filePath);  // Suppresses warnings for corrupt images

        if ($imageInfo === false) {
            $mimeType = @mime_content_type($filePath);  // Get the MIME type of the file

            if ($mimeType === 'application/pdf') {
                $filePath = $file->getPathname(); 
                try {
                    $pdf = new Fpdi();
                    $pdf->setSourceFile($filePath);
                    $fileCorrupt = false;
                } catch (\Exception $e) {
                    $fileCorrupt = true;
                }
                // As per ankita's Suggestion (17-02-2025) addition of zip and plain text validation
            } elseif ($mimeType === 'application/zip') {
                // For ZIP files, we simply check if it's a valid ZIP archive
                try {
                    $zip = new \ZipArchive();
                    $res = $zip->open($file->getRealPath());
                    if ($res !== true) {
                        $fileCorrupt = true; // If it can't be opened, it's corrupt
                    }
                    $zip->close();
                } catch (\Exception $e) {
                    $fileCorrupt = true;
                }
        
            } elseif ($mimeType === 'text/plain') {
                // For text files, just check if they are not empty or null
                $fileContent = file_get_contents($file->getRealPath());
                if (empty($fileContent)) {
                    $fileCorrupt = true; // If the file is empty, it's considered corrupt
                }
                // As per ankita's Suggestion (17-02-2025)
            } else {
                // If the MIME type is not PDF, then the file is corrupt
                $fileCorrupt = true;
            }
        }

        return $fileCorrupt;  // Return true if corrupt, false if valid
    }
}

if (!function_exists('UploadFiles')) {
    function UploadFiles($file, $folder, $old_file = '')
    {
        if (isset($file) && !empty($file) && isset($folder) && !empty($folder)) {
      
            $CorruptFile = isImageCorrupt($file);
            if($CorruptFile === false){  // If not corrupt
                $filePath = $file->getRealPath();
                if (function_exists('passthru')) {
                    ob_start();
                    passthru("clamscan $filePath", $returnCode);
                    $scanResult = ob_get_clean();
                    if ($returnCode === 0 && str_contains($scanResult, 'OK')) {
                        return FALSE;
                    } else {
                        $is_uploaded = Storage::disk('local')->putFile($folder, $file);
                    }
                } else {
                    $is_uploaded = Storage::disk('local')->putFile($folder, $file);
                }
                if (isset($is_uploaded) && !empty($is_uploaded)) {
                    if (!empty($old_file) && isset($old_file) && Storage::disk('local')->exists($old_file)) {
                        Storage::disk('local')->delete($old_file);
                    }
                    return ['status' => TRUE, 'url' => $is_uploaded];
                } else {
                    return TRUE;
                }
            } else {
                return FALSE; // Return false if the image is corrupt
            }
        } else {

            return FALSE;
        }
    }
}

if (!function_exists('mail_send')) {
    function mail_send($tmpl_id, $repl_contain, $repl_value, $sendto, $cc = null, $replyTo = null)
    {
        $exists = is_exist('unsubscribe_emails', ['email' => $sendto]);
        if (isset($exists) && is_numeric($exists) && $exists == 0) {
            $templContain = getData('email_templates', ['email_subject', 'email_content'], ['is_deleted' => 'No', 'id' => $tmpl_id]);
            $email_subject = $templContain[0]->email_subject;
            $email_content = $templContain[0]->email_content;
            $data['newSubject'] = str_replace($repl_contain, $repl_value, $email_subject);
            $data['newContain'] = str_replace($repl_contain, $repl_value, $email_content);
            $tes = send(
                $data['newSubject'],
                $data['newContain'],
                $sendto,
                $cc, 
                $replyTo
            );
        }
    }
}
if (!function_exists('send')) {
    function send($subject, $sendingData, $sendto, $cc = null, $replyTo = null)
    {

        try {
            // Queue::push(new SendActionMails($subject, $sendingData, $sendto, $cc, $replyTo));
            SendActionMails::dispatch($subject, $sendingData, $sendto, $cc, $replyTo);
            return TRUE;
        } catch (\Exception $error) {
            return FALSE;
        }
    }
}
if (!function_exists('duration')) {
    function duration($diff_date)
    {

        $date = new Carbon($diff_date, 'Europe/Malta');
        if ($date->diffInYears() != 0) {
            if ($date->diffInYears() > 1) {
                return $date->diffInYears() . " Years";
            } else {
                return $date->diffInYears() . " Year";
            }
        } elseif ($date->diffInMonths() != 0) {
            if ($date->diffInMonths() > 1) {
                return $date->diffInMonths() . " Months";
            } else {
                return $date->diffInMonths() . " Month";
            }
        } elseif ($date->diffInWeeks() != 0) {
            if ($date->diffInWeeks() > 1) {
                return $date->diffInWeeks() . " Weeks";
            } else {
                return $date->diffInWeeks() . " Week";
            }
        } elseif ($date->diffInDays() != 0) {
            if ($date->diffInDays() > 1) {
                return $date->diffInDays() . " Days";
            } else {
                return $date->diffInDays() . " Day";
            }
        } elseif ($date->diffInHours() != 0) {
            if ($date->diffInHours() > 1) {
                return $date->diffInHours() . " Hours";
            } else {
                return $date->diffInHours() . " Hour";
            }
        } elseif ($date->diffInMinutes() != 0) {
            if ($date->diffInMinutes() > 1) {
                return $date->diffInMinutes() . " Minutes";
            } else {
                return $date->diffInMinutes() . " Minute";
            }
        } elseif ($date->diffInMinutes() === 0) {
            return "Just Now";
        }
    }
}

if(!function_exists('block_ipaddress')){
    function block_ipaddress(){
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $table = 'users';
        $where = ['block_status' => '1','last_session_ip' => $ipAddress];
        $exists = DB::table($table)->where($where)->count();
        if (isset($exists) && is_numeric($exists) && $exists > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

function getCountryCodeByIp()
{
    try {
        $response = Http::get("https://api.myip.com");

        if ($response->successful()) {
            $countryName = $response->json('country');

            $countryData = DB::table('country_master')
                            ->where('country_name', $countryName)
                            ->select('country_code', 'country_flag', 'country_name', 'id')
                            ->first();

            return [
                'country_code' => $countryData ? $countryData->country_code : '',
                'country_flag' => $countryData ? $countryData->country_flag : '',
                'country_name' => $countryData ? $countryData->country_name : '',
                'country_id' => $countryData ? $countryData->id : ''
            ];
        }
    } catch (\Exception $e) {
    }

    return [
        'country_code' => '',
        'country_flag' => '',
        'country_name' => '',
        'country_id' => ''
    ];
}

if (!function_exists('is_enrolled')) {
    function is_enrolled($studentId = null, $courseId = null,$where = null)
    {
        $query = DB::table('student_course_master')
            ->join('users', 'users.id', '=', 'student_course_master.user_id')
            ->join('orders', function($join) {
                $join->on('orders.user_id', '=', 'student_course_master.user_id')
                    ->on('orders.course_id', '=', 'student_course_master.course_id')
                    ->where('orders.status', '0');
            })
            ->where('users.is_active', 'Active')
            ->where('users.is_verified', 'Verified')
            ->where('student_course_master.is_deleted', 'No')
            ->where('block_status', '0')
            ->where('orders.status', '0');

        // Apply conditions based on the presence of $studentId and $courseId
        if ($studentId) {
            $query->where('student_course_master.user_id', $studentId);
        }
        if ($courseId) {
            $query->where('student_course_master.course_id', $courseId);
            $query->where('orders.course_id', $courseId);
        }
        if($where){
            $query->where($where);
            return $query->distinct()->count('student_course_master.user_id');
        }
        // Get distinct count based on orders.id to avoid duplicate enrollments
        return $query->distinct('orders.id')->count();
    }
}
if (!function_exists('is_purchased')) {
    function is_purchased($studentId = null, $courseId = null,$where = null)
    {
        $query = DB::table('student_course_master')
            ->join('users', 'users.id', '=', 'student_course_master.user_id')
            ->join('orders', function($join) {
                $join->on('orders.user_id', '=', 'student_course_master.user_id')
                    ->on('orders.course_id', '=', 'student_course_master.course_id')
                    ->where('orders.status', '0');
            })
            ->where('student_course_master.is_deleted', 'No')
            ->where('orders.status', '0');

        // Apply conditions based on the presence of $studentId and $courseId
        if ($studentId) {
            $query->where('student_course_master.user_id', $studentId);
        }
        if ($courseId) {
            $query->where('student_course_master.course_id', $courseId);
            $query->where('orders.course_id', $courseId);
        }
        if($where){
            $query->where($where);
        }
        return $query->distinct()->count('student_course_master.user_id');

        // Get distinct count based on orders.id to avoid duplicate enrollments
        // return $query->distinct('orders.id')->count();
    }
}
if (!function_exists('total_purchased_students')) {
    function total_purchased_students($studentId = null, $courseId = null,$where = null)
    {
        $query = DB::table('student_course_master')
            ->join('users', 'users.id', '=', 'student_course_master.user_id')
            ->join('orders', function($join) {
                $join->on('orders.user_id', '=', 'student_course_master.user_id')
                    ->on('orders.course_id', '=', 'student_course_master.course_id')
                    ->where('orders.status', '0');
            })
            ->where('student_course_master.is_deleted', 'No')
            ->where('orders.status', '0');

        // Apply conditions based on the presence of $studentId and $courseId
        if ($studentId) {
            $query->where('student_course_master.user_id', $studentId);
        }
        if ($courseId) {
            $query->where('student_course_master.course_id', $courseId);
            $query->where('orders.course_id', $courseId);
        }
        if($where){
            $query->where($where);
        }
        // return $query->distinct()->count();

        // Get distinct count based on orders.id to avoid duplicate enrollments
        return $query->distinct('orders.id')->count();
    }
}

if(!function_exists('is_enrolled_upload_doc')){
    function is_enrolled_upload_doc($studentId,$courseId)
    {
        $data = 0;
        $where = [];
        if (isset($courseId) && !empty($courseId)) {
            $where = ['student_course_master.course_id'=>$courseId];
        }
        if(isset($studentId) && !empty($studentId)){
            $where = array_merge($where,['student_course_master.user_id'=>$studentId]);
        }
        $data = DB::table('student_course_master')
        ->join('student_doc_verification', 'student_doc_verification.student_id', '=', 'student_course_master.user_id')
        ->join('users', 'users.id', 'student_course_master.user_id')
        ->where('identity_doc_file', '!=', '')
        ->where('edu_doc_file', '!=', '')
        ->where('english_score','>=','10')
        ->whereNotNull('resume_file')
        ->where('is_active','Active')
        ->where(function ($query) {
            $query->where('identity_trail_attempt', '!=', '0')
                  ->orWhere('identity_is_approved', '=', 'Reject')
                  ->orWhere('identity_is_approved', '=', 'Approved');

        })
        ->where(function ($query) {
            $query->where('edu_trail_attempt', '!=', '0')
                  ->orWhere('edu_is_approved', '=', 'Reject')
                  ->orWhere('edu_is_approved', '=', 'Approved');

        })
        ->where($where)
        ->count();

        return $data;
    }
}

if (!function_exists('deleteRecord')) {
    function deleteRecord($model, $where, $setDeletedBy = false)
    {
        if (empty($model) || empty($where) || !is_array($where)) {
            return ['status' => false, 'message' => 'Invalid parameters provided.'];
        }

        $record = $model::where($where)->first();

        if ($record) {
            if ($setDeletedBy) {
                $record->deleted_by = Auth::id();
                $record->is_deleted = 'Yes';
                $record->save();
            }
            $record->delete();

            return ['status' => true, 'id' => $record->id];
        }

        return false;
    }
}

if (!function_exists('canDeleteExam')) {
    function canDeleteExam($courseId)
    {
        if (empty($courseId)) {
            return ['status' => false, 'message' => 'Invalid course ID.'];
        }

        $currentDate = now();

        $adjustedExpiryCondition = "IF(scm.exam_attempt_remain = 1, DATE_ADD(scm.course_expired_on, INTERVAL 15 DAY), scm.course_expired_on)";

        $enrollmentExists = DB::table('student_course_master as scm')
            ->where('scm.course_id', $courseId)
            ->where(function ($query) {
                $query->where('scm.exam_remark', '!=', '1')
                      ->orWhereNull('scm.exam_remark');
            })
            ->where('scm.exam_attempt_remain', '>', 0)
            ->whereRaw("$adjustedExpiryCondition > ?", [$currentDate])
            ->exists();

        if ($enrollmentExists) {
            return ['status' => false, 'message' => 'Cannot delete exam: students are enrolled and have remaining attempts.'];
        }

        return ['status' => true, 'message' => 'Exam can be deleted.'];
    }
}

if (!function_exists('checkAnalysisResults')) {
    function checkAnalysisResults($analysisId, $apiKey) {
        $client = new Client();
        $url = "https://www.virustotal.com/api/v3/analyses/{$analysisId}";

        $response = $client->get($url, [
            'headers' => [
                'x-apikey' => $apiKey,
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        return $result;

        if (isset($result['data'])) {
            $analysisData = $result['data'];
            if ($analysisData['attributes']['status'] === 'completed') {
                foreach ($analysisData['attributes']['stats'] as $scanner => $result) {
                    echo "$scanner: " . $result['result'] . "\n";
                }
            } else {
                echo "The analysis is still in progress. Please check back later.\n";
            }
        } else {
            if (isset($result['error'])) {
                echo "Error: " . $result['error']['message'] . "\n";
            } else {
                echo "Unexpected response structure:\n";
                print_r($result);
            }
        }
    }
}

if (!function_exists('getExamType')) {
    function getExamType($type)
    {
        switch ($type) {
            case 1:
                return 'Assignment';
            case 2:
                return 'Mock Interview';
            case 3:
                return 'Vlog';
            case 4:
                return 'Peer Review';
            case 5:
                return 'Forum Leadership';
            case 6:
                return 'Reflective Journal';
            case 7:
                return 'Multiple Choice';
            case 8:
                return 'Survey';
            case 9:
                return 'Artificial Intelligence';
            default:
                return '';
        }
    }
}

if (!function_exists('getCourseExamCount')) {
    function getCourseExamCount($course_id)
    {
        if (Auth::check()) {
            $course_id  = isset($course_id) ? base64_decode($course_id) : 0;
            $courseMaster = getData('course_master', ['category_id'], ['id' => $course_id]);

            if ($courseMaster[0]->category_id != 1) {
                $courseIds = DB::table('master_course_management')
                            ->where('award_id', $course_id)
                            ->where('is_deleted', 'No')
                            ->pluck('course_id');

                $examCount = DB::table('exam_management_master')
                            ->whereIn('course_id', $courseIds)
                            ->where(['is_deleted' => 'No'])
                            ->where('exam_type', '!=', 5)
                            ->count();
            } else {
                $examCount = DB::table('exam_management_master')
                            ->where(['course_id' => $course_id, 'is_deleted' => 'No'])
                            ->where('exam_type', '!=', 5)
                            ->count();
            }
            return $examCount;
        }
        return redirect('/login ');
    }
}

if (!function_exists('getStudentCourseMaster')) {
    function getStudentCourseMaster($userId, $courseId)
    {
        if (Auth::check()) {
            $userId  = isset($userId) ? base64_decode($userId) : 0;
            $courseId  = isset($courseId) ? base64_decode($courseId) : 0;
            return DB::table('student_course_master')
                ->select(['id', 'exam_remark'])
                ->where([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'is_deleted' => 'No'
                ])
                ->latest('id')
                ->first();
        }
        return redirect('/login ');
    }
}

if (!function_exists('determineExamResult')) {
    function determineExamResult($examAttemptRemain, $submittedExamsCount, $courseExamCount, $courseId, $userId, $scmId)
    {
        $completedExamCount = DB::table('exam_remark_master')->where([
            // 'course_id' => $courseId,
            // 'user_id' => $userId,
            'student_course_master_id' => $scmId,
            'is_active' => '1',
            'is_cheking_completed' => '2',
        ])
        ->where('exam_type', '!=', 5)
        ->count();


        if ($completedExamCount == $courseExamCount) {

            $studentCourseMaster = DB::table('student_course_master')->select(['id', 'exam_remark'])->where([
                // 'user_id' => $userId,
                // 'course_id' => $courseId,
                'id' => $scmId,
                'is_deleted' => 'No'
            ])
            ->first();

            if ($studentCourseMaster) {
                return evaluateFinalExamStatus($studentCourseMaster->exam_remark);
            }
        }

        if ($examAttemptRemain == 2 && $submittedExamsCount == 0) {
            return ['result' => 'Not Attempt', 'color' => 'warning'];
        }
        if($submittedExamsCount == $courseExamCount){
            return ['result' => 'Checking', 'color' => 'primary'];
        }elseif ($submittedExamsCount < $courseExamCount) {
            
            $studentCourseMaster = DB::table('student_course_master')->select(['id', 'exam_remark'])->where([
                // 'user_id' => $userId,
                // 'course_id' => $courseId,
                'id' => $scmId,
                'is_deleted' => 'No'
            ])
            ->first();
            
            if ($examAttemptRemain == 1 && (!isset($studentCourseMaster->exam_remark) || $studentCourseMaster->exam_remark == 0)) {
                return ['result' => 'Pending', 'color' => 'warning'];

            }
            return fetchExamRemarkStatus($courseId, $userId, $scmId, 'Pending');
        }

        return ['result' => 'Checking', 'color' => 'primary'];
    }
}

if (!function_exists('fetchExamRemarkStatus')) {
    function fetchExamRemarkStatus($courseId, $userId, $scmId, $defaultStatus)
    {
            
        $studentCourseMaster = DB::table('student_course_master')->select(['id', 'exam_remark'])->where([
            // 'user_id' => $userId,
            // 'course_id' => $courseId,
            'id' => $scmId,
            'is_deleted' => 'No'
        ])
        ->first();

        if ($studentCourseMaster) {
            return evaluateFinalExamStatus($studentCourseMaster->exam_remark);
        }

        return ['result' => $defaultStatus, 'color' => 'warning'];
    }
}

if (!function_exists('evaluateFinalExamStatus')) {
    function evaluateFinalExamStatus($examRemark)
    {
        return match ($examRemark) {
            '0' => ['result' => 'Fail', 'color' => 'danger'],
            '1' => ['result' => 'Pass', 'color' => 'success'],
            default => ['result' => 'Pending', 'color' => 'warning'],
        };
    }
}

if (!function_exists('sendNotification')) {
    
    function sendNotification(array $userIds, array $data = [])
    {
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                $notificationData = $data;

                // $user->notify(new SendNotification($notificationData));
                $user->notify((new SendNotification($notificationData))->onQueue('notifications'));
                broadcast(new \App\Events\NotificationSent($user, $notificationData));
            }
        }
    }
}
if (!function_exists('course_data_enrolled')) {
    function course_data_enrolled()
    {
        $query = DB::table('student_course_master')
        ->join('course_master', 'student_course_master.course_id', '=', 'course_master.id')
        ->join('users', 'users.id', '=', 'student_course_master.user_id')
        ->join('orders', function($join) {
            $join->on('orders.user_id', '=', 'student_course_master.user_id')
                ->on('orders.course_id', '=', 'student_course_master.course_id')
                ->where('orders.status', '=', '0');
        })
        ->select(
            'student_course_master.course_id',
            'course_master.course_title',
            DB::raw('COUNT(DISTINCT orders.id) as aggregate'),
           'category_id','course_master.status','course_thumbnail_file','course_master.id','ects','course_old_price','course_final_price'
        )
        ->where('users.is_active', 'Active')
        ->where('users.is_verified', 'Verified')
        ->where('student_course_master.is_deleted', 'No')
        ->where('block_status', '0')
        ->where('orders.status', '0')
        ->groupBy('student_course_master.course_id','course_master.course_title',
        'course_master.category_id',
        'course_master.status',
        'course_master.course_thumbnail_file',
        'course_master.id',
        'course_master.ects',
        'course_master.course_old_price',
        'course_master.course_final_price')
        ->orderByDesc('aggregate')
        ->limit(4)
        ->get();
        return $query;
    }
}

if (!function_exists('getPdfWordCount')) {
    function getPdfWordCount($docFile)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($docFile);
        
        $text = $pdf->getText();
        
        if (empty(trim($text))) {
            return [
                'word_count' => 0,
                'is_text_based' => false
            ];
        }
        
        $wordCount = str_word_count($text);

        return [
            'word_count' => $wordCount,
            'is_text_based' => true
        ];
    }
}


if (!function_exists('getExamTable')) {
    function getExamTable($examType) {
        $tableMap = [
            1 => 'exam_assignments',
            2 => 'exam_mock_interview',
            3 => 'exam_vlog',
            4 => 'exam_peer_review',
            5 => 'exam_discord',
            6 => 'exam_reflective_journals',
            7 => 'exam_mcq',
            8 => 'exam_survey',
            9 => 'exam_artificial_intelligence',
        ];

        return $tableMap[$examType] ?? null;
    }
}
if (!function_exists('getAssignedSubMentor')) {
    function getAssignedSubMentor($scmId)
    {
        $assignedSubEmentor = DB::table('subementor_student_relations')
            ->where(['student_course_master_id' => $scmId])
            ->where('is_deleted', 'No')
            ->first();

        return $assignedSubEmentor ? $assignedSubEmentor->sub_ementor_id : null;
    }
}

if (!function_exists('awardCoursesCountByMasterCourseId')) {
    function awardCoursesCountByMasterCourseId($masterCourseId, $student_course_master_id)
    {
        $courseCount = DB::table('master_course_management')
            ->where(['optional_course_id' => null, 'award_id' => $masterCourseId, 'is_deleted' => 'No'])
            ->count();
            
        $studentCourseMaster = getData('student_course_master', ['preference_id', 'preference_status'], ['id' => $student_course_master_id]);
        if($studentCourseMaster[0]->preference_status == '0'){
            if($studentCourseMaster[0]->preference_id != null){
                $preferenceIds = $studentCourseMaster[0]->preference_id;
                $preferenceIdsArray = explode(',', $preferenceIds);
            }
            $courseCount += count($preferenceIdsArray);
        }

        return $courseCount;
    }
}

if (!function_exists('getCoursePromoCode')) {
    function getCoursePromoCode($courseId)
    {
        $today = Carbon::now(); // Current date and time
        if (Auth::check() && Auth::user()->role =='user'){
            $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $courseId ,'is_deleted'=>'No'], "", 'created_at');
            if (isset($studentCourseMaster) && !empty($studentCourseMaster[0]) &&  $studentCourseMaster[0]->course_expired_on > now() && ( ($studentCourseMaster[0]->exam_attempt_remain == '1' && $studentCourseMaster[0]->exam_remark == '0') ||  $studentCourseMaster[0]->exam_attempt_remain == '2' )
            ) {
                    $coursePromoCode = [];
            }else{
                $exists = DB::table('coupons')->where('course_id',$courseId)->where('status','Active')->count();
                $coursePromoCode = [];
                if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {

                    $coursePromoCode = getData('coupons',['id', 'coupon_name'], ['course_id'=>$courseId,'is_deleted'=>'No','status'=>'Active',['coupon_validity', '>', $today],['institute_id', '=', '']]);
                }

            }
        }else{
            $exists = DB::table('coupons')->where('course_id',$courseId)->where('status','Active')->count();
            $coursePromoCode = [];
            if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {

                $coursePromoCode = getData('coupons',['id', 'coupon_name'], ['course_id'=>$courseId,'is_deleted'=>'No','status'=>'Active',['coupon_validity', '>', $today],['institute_id', '=', '']]);
            }

        }
        return isset($coursePromoCode) && !empty($coursePromoCode[0]) ? $coursePromoCode[0]->coupon_name : '';

    }
}

if (!function_exists('getExamTitle')) {
    function getExamTitle($examType, $examId)
    {
        if($examType == 5){
            return 'Forum Leadership';
        }
        $examTable = getExamTable($examType);
        $column = ($examType == 1) ? 'assignment_tittle' : 'title';
        $examTitle = DB::table($examTable)
            ->where(['id' => $examId, 'is_deleted' => 'No'])
            ->select($column)
            ->first();

        return $examTitle ? ucfirst(html_entity_decode($examTitle->$column)) : null;

    }
}
if(!function_exists('blockedOnboarding')){
    function blockedOnboarding($email){
        $table = 'users';
        $where = ['email'=>$email];
        $UserData = getData('users',['role'],$where,'1','','');

        if (isset($UserData) && !empty($UserData) && count($UserData) > 0) {
            $role = $UserData[0]->role;
            $wherePer = [];
            if($role == 'user'){
                $wherePer = ['student'=>'login','status'=>'0'];
                $checkRole = "Student";
            }
            if($role == 'institute'){
                $wherePer = ['institute'=>'login','status'=>'0'];
                $checkRole = "Institute";
            }
            if($role == 'instructor'){
                $wherePer = ['ementor'=>'login','status'=>'0'];
                $checkRole = "Ementor";

            }
            $isExists = is_exist('permission',$wherePer);
            if (isset($isExists) && is_numeric($isExists) && $isExists === 1) {
                return $checkRole ? $checkRole : FALSE;
            }
        }else{
            return FALSE;
        }
    }

} 

if (!function_exists('getExamAmount')) {
    function getExamAmount($courseId, $examType, $examId)
    {
        
        $examAmount = DB::table('exam_amounts')
            ->where(['course_id' => base64_decode($courseId), 'exam_id' => base64_decode($examId), 'exam_type' => base64_decode($examType), 'is_deleted' => 'No'])
            ->select('amount')
            ->first();

        return $examAmount ? $examAmount->amount : 0;

    }
}

if (!function_exists('generateIconPath')) {
    function generateIconPath($iconType)
    {
        $iconPaths = [
            'success' => asset('frontend/images/icons/Shield Check.gif'),
            'error' => asset('frontend/images/icons/Shield Cross.gif'),
            'warning' => asset('frontend/images/icons/exclamation mark.gif'),
        ];
        return isset($iconPaths[$iconType]) ? $iconPaths[$iconType] : '';
    }
}
 
if(!function_exists('alreadyAwardBuy')){
    function alreadyAwardBuy($studentId, $courseId){
        $MainCourseCheck =  FALSE;
        $MessageCheck = FALSE;
        $masterCourseData = DB::table('master_course_management')
        ->whereIn('course_id', $courseId)
        ->where('is_deleted', 'No')
        ->pluck('award_id');
        foreach($masterCourseData as $dataCheck){
            $studentMasterCheck = getData('student_course_master',['course_expired_on','course_id','course_progress','exam_remark','exam_attempt_remain','preference_id'],['course_id'=>$dataCheck, 'user_id'=>Auth::user()->id,'is_deleted'=>'No'],'','created_at','desc');
            if(isset($studentMasterCheck) && !empty($studentMasterCheck[0]) && $studentMasterCheck[0]->course_expired_on > now() && ($studentMasterCheck[0]->exam_attempt_remain != "0" && $studentMasterCheck[0]->exam_remark == '0'  || $studentMasterCheck[0]->exam_attempt_remain == "2" || $studentMasterCheck[0]->exam_attempt_remain == '1' && $studentMasterCheck[0]->exam_remark == '0' )){
                $MessageCheck = TRUE;
                $MainCourseCheck =  TRUE;
            }
        }
        if($MainCourseCheck == FALSE){
            $studentMasterCheckOptional = getData('student_course_master',['course_expired_on','course_id','course_progress','exam_remark','exam_attempt_remain','preference_id'],[ 'user_id'=>Auth::user()->id,['preference_id', '!=', null],'is_deleted'=>'No'],'','created_at','desc');
            foreach($studentMasterCheckOptional as $optionalCheck){
                $preference_id = $optionalCheck->preference_id;
                $preferenceIdsArray = explode(',', $preference_id);
                $commonValues = array_intersect($courseId, $preferenceIdsArray);
                if (!empty($commonValues)) {
                    $masterCourseDataOptional = DB::table('master_course_management')
                    ->whereIn('optional_course_id', $preferenceIdsArray)
                    ->pluck('award_id');
                    foreach($masterCourseDataOptional as $dataOptionalCheck){
                        $studentMasterCheckMaster = getData('student_course_master',['course_expired_on','course_id','course_progress','exam_remark','exam_attempt_remain','preference_id'],['course_id'=>$dataOptionalCheck, 'user_id'=>Auth::user()->id,'is_deleted'=>'No'],'','created_at','desc');
                        if(isset($studentMasterCheckMaster) && !empty($studentMasterCheckMaster[0]) && $studentMasterCheckMaster[0]->course_expired_on > now() && ($studentMasterCheckMaster[0]->exam_attempt_remain != "0" && $studentMasterCheckMaster[0]->exam_remark == '0'  || $studentMasterCheckMaster[0]->exam_attempt_remain == "2" || $studentMasterCheckMaster[0]->exam_attempt_remain == '1' && $studentMasterCheckMaster[0]->exam_remark == '0' )){
                            $MessageCheck = TRUE;
                        }
                    }
                }
            }
        }
        return $MessageCheck;
    }
}      

if(!function_exists('getCourseStatus')){
    function getCourseStatus($course)
    {

        
        if (
            ($course->exam_remark == 1) || ($course->exam_remark == 0 && $course->exam_attempt_remain == 0) ||
            ($course->exam_remark == 0 && $course->exam_attempt_remain == 1 && Carbon::parse($course->adjusted_expiry)->lt(Carbon::today())) ||
            (is_null($course->exam_remark) && $course->exam_attempt_remain == 2 && Carbon::parse($course->adjusted_expiry)->lt(Carbon::today()))
        ) {
            return [
                'status' => 'Expired',
                'color' => 'danger'
            ];
        }

        // 3. Otherwise, In Progress
        return [
            'status' => 'In Progress',
            'color' => 'primary'
        ];
    }
}
      

if(!function_exists('getCourseSectionId')){
    function getCourseSectionId($section_name)
    {
        $sectionId = DB::table('course_section_masters')
            ->where(['section_name' => $section_name, 'is_deleted' => 'No'])
            ->select('id')
            ->first();

        return $sectionId ? $sectionId->id : 0;
    }
}