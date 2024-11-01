<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\StudentMail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class StudentController extends Controller
{
    public function importForm()
    {
        return view('students.import');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimport.');
    }

    public function blastEmailForm()
    {
        return view('students.blast_email');
    }

    public function sendEmails(Request $request)
    {
        // Validasi input
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Ambil semua data mahasiswa dari database
        $students = Student::all();

        foreach ($students as $student) {
            // Kirim email
            Mail::to($student->email)->queue(new StudentMail($student, $request->message));

            // Simpan log email
            DB::table('email_logs')->insert([
                'email' => $student->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan salinan email ke folder "Sent" menggunakan IMAP
            $this->saveToSentMailbox($student->email, $request->subject, $request->message);
        }

        return redirect()->back()->with('success', 'Blast email sedang dikirim.');
    }

    // Method untuk menyimpan salinan email ke folder "Sent"
    private function saveToSentMailbox($toEmail, $subject, $message)
    {
        $imapHost = '{mail.aulia.recodex.id:993/imap/ssl}'; // Sesuaikan dengan konfigurasi cPanel
        $username = env('MAIL_USERNAME'); // Sesuaikan dengan username cPanel
        $password = env('MAIL_PASSWORD'); // Sesuaikan dengan password cPanel

        // Buka koneksi IMAP
        $mailbox = \imap_open($imapHost . 'INBOX.Sent', $username, $password);

        if ($mailbox) {
            $headers = "From: " . config('mail.from.address') . "\r\n";
            $headers .= "To: {$toEmail}\r\n";
            $headers .= "Subject: {$subject}\r\n";
            $headers .= "Date: " . date('r') . "\r\n";

            // Format pesan lengkap dengan header
            $emailMessage = $headers . "\r\n" . $message;

            // Simpan email ke folder "Sent"
            imap_append($mailbox, $imapHost . 'INBOX.Sent', $emailMessage);

            // Tutup koneksi IMAP
            imap_close($mailbox);
        } else {
            // Jika gagal, log error atau kirimkan notifikasi
            Log::error('Gagal menyimpan email ke folder Sent melalui IMAP.');
        }
    }
}
