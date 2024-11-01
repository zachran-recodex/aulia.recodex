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

        foreach ($students as $student) {
            Mail::to($student->email)->send(new StudentMail($student, $request->subject, $request->message));
        }

        return redirect()->back()->with('success', 'Blast email telah dikirim ke semua mahasiswa.');
    }
}
