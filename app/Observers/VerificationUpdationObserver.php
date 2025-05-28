<?php

namespace App\Observers;

use App\Models\StudentDocument;
use App\Models\User;

class VerificationUpdationObserver
{
    /**
     * Handle the StudentDocument "created" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function created(StudentDocument $studentDocument)
    {
        //
    }

    /**
     * Handle the StudentDocument "updated" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function updated(StudentDocument $studentDocument)
    {

        $studentDocument->verificationStutsUpdate($studentDocument);
    }

    protected function verificationStutsUpdate($studentDocument)
    {
        $verification = $studentDocument->identity_is_approved === "Approved" && $studentDocument->edu_is_approved === "Approved" ? "Verified" : "Unverified";
        $studentDocument->update(['identity_is_approved' => 'Pending']);
    }




    /**
     * Handle the StudentDocument "deleted" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function deleted(StudentDocument $studentDocument)
    {
        //
    }

    /**
     * Handle the StudentDocument "restored" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function restored(StudentDocument $studentDocument)
    {
        //
    }

    /**
     * Handle the StudentDocument "force deleted" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function forceDeleted(StudentDocument $studentDocument)
    {
        //
    }
}