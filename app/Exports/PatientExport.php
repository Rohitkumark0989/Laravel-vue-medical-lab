<?php

namespace App\Exports;
use App\Models\Patient;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PatientExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return [
            'id',
            'p_name',
            'p_mobile',
            'p_address',
            'p_gender',
            'p_age',
            'p_cnic'
        ];
    }
    public function collection()
    {
        return collect(Patient::testDetails());
    }
}
