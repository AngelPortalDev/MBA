<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\StudentCourseModel;

class SelectOptionalAward extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optional:ects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

            $thresholdDate = Carbon::now();
            $UserSelectEctsReminder = StudentCourseModel::select('users.name','users.last_name','users.email')->Join('users','users.id','student_course_master.user_id')->where('course_expired_on','>',$thresholdDate)->where('student_course_master.is_deleted','No')->where('preference_status','0')->whereNull('preference_id')->distinct()->get();

            foreach($UserSelectEctsReminder as $OptionalEcts){

                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($OptionalEcts->email));
                $myLearningLink = url('/student/student-my-learning');
                mail_send(
                    51,
                    [
                        '#Name#',
                        '#Link#',
                        '#unsubscribeRoute#',
                    ],
                    [
                        $OptionalEcts->name." ".$OptionalEcts->last_name,
                        $myLearningLink,
                        $unsubscribeRoute    
                    ],
                    $OptionalEcts->email
                );
            }
        
    }
}
