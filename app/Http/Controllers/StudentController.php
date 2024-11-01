<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\StudentMail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $students = Student::all();
        $senders = [
            ['name' => 'Sender 1', 'email' => 'sender1@example.com'],
            ['name' => 'Sender 2', 'email' => 'sender2@example.com'],
            ['name' => 'Sender 3', 'email' => 'sender3@example.com'],
            ['name' => 'Sender 4', 'email' => 'sender4@example.com'],
            ['name' => 'Sender 5', 'email' => 'sender5@example.com'],
            ['name' => 'Sender 6', 'email' => 'sender6@example.com'],
            ['name' => 'Sender 7', 'email' => 'sender7@example.com'],
            ['name' => 'Sender 8', 'email' => 'sender8@example.com'],
            ['name' => 'Sender 9', 'email' => 'sender9@example.com'],
            ['name' => 'Sender 10', 'email' => 'sender10@example.com'],
        ];

        $batchSize = 100; // Tentukan jumlah penerima per batch
        $chunks = $students->chunk($batchSize); // Pecah data menjadi batch

        foreach ($chunks as $chunk) {
            foreach ($chunk as $index => $student) {
                $sender = $senders[$index % count($senders)];
                Mail::to($student->email)->queue(new StudentMail($student, $request->subject, $request->message, $sender));
            }
        }

        return redirect()->back()->with('success', 'Blast email sedang dikirim.');
    }
}
