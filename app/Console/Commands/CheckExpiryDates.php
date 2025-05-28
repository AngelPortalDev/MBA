<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class CheckExpiryDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupons:statusupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coupons Status Update';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $today = Carbon::today();

        // Update the status of expired entries
        $StatusUpdate = DB::table('coupons')->where('coupon_validity', '<', $today)
            ->where('status', "Active")
            ->update(['status' => "Inactive",'updated_at'=>$today]);
        \Log::info($StatusUpdate);
        \Log::info("Every Minute cron job testing.");

        // $this->info('Expired entries have been marked as inactive.');
        // return 0;
    }
}
