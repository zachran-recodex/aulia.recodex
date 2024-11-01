<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $messageText;

    public function __construct($student, $messageText)
    {
        $this->student = $student;
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this->from('admin@aulia.recodex.id', config('app.name')) // Ganti dengan alamat email Anda
                    ->subject('Informasi Mahasiswa')
                    ->view('emails.student')
                    ->with([
                        'messageText' => $this->messageText,
                    ]);
    }
}
