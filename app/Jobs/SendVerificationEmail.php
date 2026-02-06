<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Submission;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submissions;

    /**
     * Create a new job instance.
     */
    public function __construct(Submission $submissions)
    {
        $this->submissions = $submissions;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->submissions->email)->send(new VerificationMail($this->submissions));

        $this->submissions->update([
            'verification_sent_at' => now(),
        ]);
    }
}
