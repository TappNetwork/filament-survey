<?php

namespace Tapp\FilamentSurvey\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Tapp\FilamentSurvey\Exports\SurveysExport;
use Tapp\FilamentSurvey\Mail\Export;

class SendExportSurveys implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filename = now()->format('Y-m-d_his').'-surveys.xlsx';
        $subject = __('Export ready:').' '.$filename;

        $export = Excel::download(new SurveysExport(), $filename)->getFile();

        Mail::to($this->user->email)->send(new Export($export, $filename, $subject));
    }
}
