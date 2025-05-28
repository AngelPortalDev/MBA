<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class SendPaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for payments failed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today('Europe/Malta')->format('Y-m-d');
        $paymentData = DB::table('payments')->leftJoin('orders', 'orders.payment_id', '=', 'payments.id')->select('payments.created_at','orders.course_id','payments.user_id','orders.course_price')->whereDate('payments.created_at',$today)->where('payments.status','1')->get();
        foreach($paymentData as $key => $value){

            $createdAt = Carbon::parse($value->created_at);
            // $twoHoursLater = $createdAt->copy()->addHours(2);
            $twoHoursLater = $createdAt->copy()->addHours(1)->format('Y-m-d H:i');
            \Log::info('Created At: ' . $createdAt);
            \Log::info('15 Mins Later: ' . $twoHoursLater);
            
            $now = Carbon::now('Europe/Malta')->format('Y-m-d H:i');
            \Log::info('Now: ' . $now);


            if ($now == $twoHoursLater) {
            \Log::info("Every Hours cron job testing.");

                $status = '<span class="badge text-bg-danger">Failed</span>';                  
                $student = DB::table('users')->where('id', $value->user_id)->first();
                $course = DB::table('course_master')->where('id', $value->course_id)->first();
                // if ((request()->getHost() === 'www.eascencia.mt')) {
                    $email = 'claire@ascenciamalta.mt';
                    $ccEmail = 'info@eascencia.mt';
                // }else{
                //     $email = 'chetan@angel-portal.com';
                //     $ccEmail = 'ankita@angel-portal.com';
                // }
                mail_send(
                    62,
                    [
                        '#user#',
                        '#amount#',
                        '#course_name#',
                        '#status#',
                        '#subjectemail#',
                        '#emailpng_url#'
                    ],
                    [
                        $student->name . ' ' . $student->last_name,
                        $value->course_price,
                        $course->course_title,
                        $status,
                        'Failed',
                        'https://www.eascencia.mt/frontend/images/email/paymentfailed.png'
                    ],
                    $email, $ccEmail
                );
            }
        }
    }
}
