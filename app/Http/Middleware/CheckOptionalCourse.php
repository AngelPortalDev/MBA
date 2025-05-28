<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\StudentCourseModel;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};

class CheckOptionalCourse
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
        $courseId = base64_decode($request->route('course_id'));  // Retrieve course_id from the route parameter
        
        $studentCourseMaster = StudentCourseModel::select('preference_status', 'preference_id')
        ->where('course_id', $courseId)
        ->where('user_id', Auth::user()->id)
        ->where('course_expired_on', '>', now())
        ->first();

        if(!empty($studentCourseMaster) ){
            if ($studentCourseMaster->preference_id == "" && $studentCourseMaster->preference_status == '0') {
                return redirect()->route('student-my-learning')->with('optional_course_error', 'Select your optional ects to access course.')->with('optional_master_courseid', $courseId);
            }
        }
        return $next($request);
    }
}
