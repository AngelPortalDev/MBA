<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Carbon\Carbon;

class CourseCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUrl = url()->current();

        $isEnrolled = getData('student_course_master', ['id', 'course_expired_on', 'exam_remark', 'exam_attempt_remain', 'payment_id'], ['user_id' => Auth::user()->id, 'course_id' => base64_decode($request->course_id)], '1', 'id', 'desc');

        if (empty($isEnrolled) || !isset($isEnrolled[0])) {
            return redirect()->route('index')->withErrors('You are not enrolled in this course.');
        }

        $enrollmentData = $isEnrolled[0];
        $courseExpiredOn = Carbon::parse($enrollmentData->course_expired_on);

        
        $examAttemptRemain = DB::table('student_course_master')
            ->where('user_id', Auth::user()->id)
            ->where('course_id', base64_decode($request->course_id))
            ->orderBy('id', 'desc')
            ->value('exam_attempt_remain');


        if (str_contains($currentUrl, 'student/exam/')) {
            if ($courseExpiredOn < now()) {
                if ($examAttemptRemain == 1) {
                    $gracePeriodEnd = $courseExpiredOn->copy()->addDays(15);
                    
                    if ($gracePeriodEnd < now()) {
                        return redirect()->route('index')->with('error', 'Your exam attempt period has expired.');
                    }else{
                        return $next($request);
                    }
                } else {
                    return redirect()->route('index')->with('error', 'Your course has expired.');
                }
            }
        }

        // if (str_contains($currentUrl, 'student/exam/')) {
        //     if ($courseExpiredOn >= now()) {
        //         $courseExpiredOn->addDays(15);
        //         DB::table('student_course_master')
        //             ->where('user_id', Auth::user()->id)
        //             ->where('course_id', base64_decode($request->course_id))
        //             ->update(['course_expired_on' => $courseExpiredOn]);
        //     }
        // }

        if ($courseExpiredOn < now() || $enrollmentData->exam_remark == '1' || $enrollmentData->exam_attempt_remain == 0) {
            return redirect()->route('index')->withErrors('You are not enrolled in this course.');
        }

        return $next($request);
    }
}


