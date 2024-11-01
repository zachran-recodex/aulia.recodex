<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/students/import', [StudentController::class, 'importForm'])->name('students.importForm');
Route::post('/students/import', [StudentController::class, 'importExcel'])->name('students.import');
Route::get('/', [StudentController::class, 'blastEmailForm'])->name('students.blastEmailForm');
Route::post('/send-emails', [StudentController::class, 'sendEmails'])->name('students.sendEmails');
