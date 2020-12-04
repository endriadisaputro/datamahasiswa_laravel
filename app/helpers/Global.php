<?php  
use App\Student;
use App\Teacher;

function ranking5Besar()
{
	$students=Student::all();
    $students->map(function($s){
        $s->rataRataNilai=$s->rataRataNilai();
        return $s;
    });
    $students=$students->sortByDesc('rataRataNilai')->take(3);
    return $students;
}

function totalStudents()
{
	return Student::count();
}

function totalTeachers()
{
	return Teacher::count();
}

