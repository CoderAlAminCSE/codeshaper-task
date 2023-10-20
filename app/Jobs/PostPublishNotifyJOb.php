<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\PostPublishNotifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PostPublishNotifyJOb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     */

    protected $receiver;
    protected $details;

    public function __construct($receiver, $details)
    {
        $this->receiver = $receiver;
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->receiver)->send(new PostPublishNotifyMail($this->details));
    }
}
