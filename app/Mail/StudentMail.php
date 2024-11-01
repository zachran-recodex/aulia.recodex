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

    public function __construct($student, $subject, $message)
    {
        $this->student = $student;
        $this->subjectText = $subject;
        $this->messageText = $message;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
                    ->from('admin@aulia.recodex.id', 'Admin')
                    ->view('emails.student')
                    ->with([
                        'messageText' => $this->messageText,
                    ]);
    }
}

