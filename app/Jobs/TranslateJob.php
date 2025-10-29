<?php

namespace App\Jobs;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class TranslateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Job $jobModel)
    {
        $this->jobModel = $jobModel;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Translate job will send a new email');
        Mail::to($this->jobModel->employer->user->email)->send(new JobPosted($this->jobModel));
    }
}
