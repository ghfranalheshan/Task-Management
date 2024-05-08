<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable implements ShouldQueue
{
      private $title;
        private $message;
    
        /**
         * Create a new message instance.
         */
        public function __construct($title,$body)
        {
            $this->title = $title;
            $this->body= $body;
        }
    
        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
    {
        return $this->subject($this->title)
                    ->view('emails.reminder') 
                    ->with([
                        'title' => $this->title,
                        'body' => $this->body,
                    ]);
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
