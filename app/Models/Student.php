<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'gender',
        'phone',
        'university',
        'major',
        'gpa',
        'year_of_graduation',
        'domicile',
        'date_of_birth',
    ];
}
