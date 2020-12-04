<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::all();
    }

    public function map($student): array
    {
    	return[
    		$student->nama_lengkap(),
    		$student->jenis_kelamin,
    		$student->agama,
    		$student->rataRataNilai()
    	];
    }

    public function headings(): array
    {
    	return[
    		'NAMA',
    		'JENIS KELAMIN',
    		'AGAMA',
    		'NILAI RATA-RATA'
    	];
    }
}
