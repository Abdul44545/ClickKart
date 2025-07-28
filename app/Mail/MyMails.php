<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyMails  extends Mailable
{
    use Queueable, SerializesModels;
    public $msg;
  
    /**
     * Create a new message instance.
     */
    public function __construct($msg)
    {
        //
        $this->msg = $msg;
     
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
           
        );
    }


    public function content(): Content
    {
     return new Content(
    view: 'principlesendM',
    with: [
        'msg' => $this->msg,
     
    ]
);
    }

    public function attachments(): array
    {
        return [];
    }
}
