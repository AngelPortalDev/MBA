<?php

namespace App\Providers;

use App\Models\StudentDocument;
use Illuminate\Support\ServiceProvider;
use App\Observers\VerificationUpdationObserver;
use App\Models\ExamRemarkMaster;
use App\Models\CertificateIssue;
use App\Observers\examObserver;
use App\Observers\StudentDocumentObserver;
use App\Observers\ExamRejectObserver;
use App\Observers\CertificateIssueObserver;
use App\Observers\ExamRemarkMasterObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // StudentDocument::observe(VerificationUpdationObserver::class);
        // ExamRemarkMaster::observe(examObserver::class);
        StudentDocument::observe(StudentDocumentObserver::class);
        // ExamRemarkMaster::observe(ExamRejectObserver::class);
        CertificateIssue::observe(CertificateIssueObserver::class);
        ExamRemarkMaster::observe(ExamRemarkMasterObserver::class);

    }
}