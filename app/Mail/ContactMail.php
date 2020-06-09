<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;
    protected $feedback;

    /**
     * Create a new message instance.
     *
     * @param $contact
     * @param $feedback
     */
    public function __construct($contact, $feedback = null)
    {
        $this->contact = $contact;
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'contact' => $this->contact,
            'feedback' => $this->feedback,
        ];

        return $this->view('mail.contact')->with($data);
    }
}
