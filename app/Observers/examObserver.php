<?php

namespace App\Observers;

use App\Models\ExamRemarkMaster;

class examObserver
{
    /**
     * Handle the ExamRemarkMaster "created" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function created(ExamRemarkMaster $examRemarkMaster)
    {
        // mail_send(
        //     30,
        //     [
        //         '#[Portal Link].#',
        //         '#[Contact Email].#',
        //     ],
        //     [
        //         '<a href="http://eascencia.mt/"><strong>https://eascencia.mt </strong></a>',
        //         '<a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt.</a>'
        //     ],
        //     "almakhdoom078692@gmail.com"
        // );
        // \Log::info('Observer is triggered for created event.');
    }

    /**
     * Handle the ExamRemarkMaster "updated" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function updated(ExamRemarkMaster $examRemarkMaster)
    {
    }

    /**
     * Handle the ExamRemarkMaster "deleted" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function deleted(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }

    /**
     * Handle the ExamRemarkMaster "restored" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function restored(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }

    /**
     * Handle the ExamRemarkMaster "force deleted" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function forceDeleted(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }
}
