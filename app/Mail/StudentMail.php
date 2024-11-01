<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $subjectText;
    public $messageText;
    public $sender;

    public function __construct($student, $subject, $message, $sender)
    {
        $this->student = $student;
        $this->subjectText = $subject;
        $this->messageText = $message;
        $this->sender = $sender;
    }

    public function build()
    {
        return $this->from($this->sender['email'], $this->sender['name'])
                    ->subject($this->subjectText)
                    ->view('emails.student')
                    ->with([
                        'messageText' => $this->messageText,
                    ]);
    }
}
