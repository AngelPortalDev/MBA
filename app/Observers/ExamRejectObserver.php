<?php

namespace App\Observers;

use App\Models\ExamRemarkMaster;

class ExamRejectObserver
{
    /**
     * Handle the ExamRemarkMaster "created" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function created(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }

    /**
     * Handle the ExamRemarkMaster "updated" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function updated(ExamRemarkMaster $examRemarkMaster)
    {
        if ($examRemarkMaster->isDirty('approved_status') && $examRemarkMaster->approved_status == 2) {
            $subEmentor = $examRemarkMaster->remark_updated_by;
            \Log::info($subEmentor);
        }
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
