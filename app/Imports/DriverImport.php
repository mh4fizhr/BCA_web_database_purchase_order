<?php

namespace App\Imports;

use App\Driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DriverImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Driver([
           'nik' => $row[1],
           'nip' => $row[2],
           'NamaDriver' => $row[3],
           'vendor_id' => $row[4]
        ]);
    }

    public function rules(): array
        {
            return [
                 '*.1' => ['nik' => 'required','unique:drivers,nik'],
                 '*.2' => ['nip' => 'required','unique:drivers,nip'],
                 '*.3' => ['NamaDriver' => 'required'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'nik cannot be null.',
            '1.unique' => 'nik has already been taken.',
            '2.required' => 'nip cannot be null.',
            '2.unique' => 'nip has already been taken.',
            '3.required' => 'Nama driver cannot be null.',
        ];
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function startRow(): int
    {
        return 6;
    }
}
