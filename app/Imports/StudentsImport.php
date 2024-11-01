<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    public function model(array $row)
    {
        return new Student([
            'email' => $row[0],
            'name' => $row[1],
            'gender' => $row[2],
            'phone' => $row[3],
            'university' => $row[4],
            'major' => $row[5],
            'gpa' => $row[6],
            'year_of_graduation' => $row[7],
            'domicile' => $row[8],
            'date_of_birth' => $row[9],
        ]);
    }
}

