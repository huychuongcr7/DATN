<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendContactMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact;
    protected $feedback;

    /**
     * Create a new job instance.
     *
     * @param $contact
     * @param null $feedback
     */
    public function __construct($contact, $feedback = null)
    {
        $this->contact = $contact;
        $this->feedback = $feedback;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ContactMail($this->contact, $this->feedback);
        Mail::to($this->contact->email)->send($email);
    }
}
