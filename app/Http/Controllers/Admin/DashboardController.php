<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Cache};
use Carbon\Carbon;
use App\Events\AdminDashboardUpdated;
use Log;

class DashboardController extends Controller
{
    public function getDashboardData()
    {
        $totalSales = DB::table('payments')->where(['is_deleted' => 'No', 'status' => '0'])->sum('total_amount');
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $currentMonthSales = DB::table('payments')
            ->where('is_deleted', 'No')
            ->where('status', '0')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('total_amount');

        $previousMonthSales = DB::table('payments')
            ->where('is_deleted', 'No')
            ->where('status', '0')
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->sum('total_amount');

        $percentageChange = $previousMonthSales > 0
            ? round((($currentMonthSales - $previousMonthSales) / $previousMonthSales) * 100, 2)
            : ($currentMonthSales > 0 ? 100 : 0);

        $studentCounts = DB::table('users')
            ->selectRaw('
                COUNT(*) as totalStudentsCount,
                SUM(CASE WHEN is_verified = "Verified" THEN 1 ELSE 0 END) as totalEnrolledStudentsCount
            ')
            ->where([
                'is_deleted' => 'No',
                'is_active' => 'Active',
                'block_status' => '0',
                'role' => 'user',
            ])
            ->first();
            
        
        $totalEnrolledStudentsCount =  is_enrolled();

        $totalStudentsCount = $studentCounts->totalStudentsCount;

        $unverifiedStudentCount = DB::table('orders')
            ->join('student_doc_verification', 'student_doc_verification.student_id', '=', 'orders.user_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where([
                'student_doc_verification.identity_is_approved' => 'Approved',
                'student_doc_verification.edu_is_approved' => 'Approved',
                'orders.status' => '0'
            ])
            ->whereNotNull('student_doc_verification.resume_file')
            ->where('student_doc_verification.english_score', '>=', '10')
            ->distinct('orders.user_id')
            ->count();  

        $verifiedStudentsCount = DB::table('users')
            ->where([
                'is_verified' => 'verified',
                'is_active' => 'Active',
                'is_deleted' => 'No'
            ])
            ->count();

        $latestCourse = DB::table('course_master')
            ->join('users', 'users.id', '=', 'course_master.ementor_id')
            ->select(
                'course_master.id as course_id', 
                'course_title', 
                DB::raw("CONCAT(users.name, ' ', users.last_name) as ementor_name"), 
                'course_thumbnail_file', 
                'users.photo', 
                'published_on'
            )
            ->orderBy('published_on', 'desc')
            ->first();
        
        if ($latestCourse) {
            $publishedOnDate = Carbon::parse($latestCourse->published_on);
            $now = Carbon::now();

            $latestCourse->published_on_text = $publishedOnDate->diffForHumans($now, [
                'parts' => 1,
                'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
            ]);
        }

        $latestEnrolledStudent = DB::table('users')
            ->orderBy('verified_on', 'desc')
            ->first();
            

        $ementorData = DB::table('users')
            ->join('course_master', 'users.id', '=', 'course_master.ementor_id')
            ->join('course_master as courseMaster', 'users.id', '=', 'course_master.ementor_id')
            ->leftJoin('orders', function ($join) {
                $join->on('course_master.id', '=', 'orders.course_id')
                    ->where('orders.status', '=', '0');
            })
            ->leftJoin('users as studentUser', 'studentUser.id', '=', 'orders.user_id')
            ->select(
                'users.id',
                DB::raw("CONCAT(users.name, ' ', users.last_name) as name"),
                'users.photo',
                DB::raw('(SELECT COUNT(DISTINCT cm.id) FROM course_master cm WHERE cm.ementor_id = users.id) as assigned_course_count'), 
                DB::raw('COUNT(DISTINCT orders.id) as total_enrollment_count'),
            )
            ->where('users.role', 'instructor')
            ->where('studentUser.is_verified', 'Verified')
            ->groupBy('users.id', 'users.name', 'users.last_name', 'users.photo')
            ->orderByDesc('assigned_course_count')
            ->first();

        $data = [
            'totalSales' => $totalSales,
            'percentageChange' => $percentageChange,
            'totalStudentsCount' => $totalStudentsCount,
            'totalEnrolledStudentsCount' => $totalEnrolledStudentsCount,
            'verifiedStudentsCount' => $verifiedStudentsCount,
            'latestCourse' => $latestCourse,
            'latestEnrolledStudent' => $latestEnrolledStudent,
            'ementorData' => $ementorData,
        ];
        // dd($data);

        $dataHasChanged = $this->checkIfDataHasChanged($data);

        if ($dataHasChanged) {
            Log::info('websocket run');
            broadcast(new AdminDashboardUpdated($data));
        }

        return response()->json($data);
    }

    protected function checkIfDataHasChanged($newData)
    {
        $previousData = Cache::get('dashboard_data');
        if ($previousData != $newData) {
            Cache::put('dashboard_data', $newData, now()->addMinutes(5));
            return true;
        }

        return false;
    }
}
