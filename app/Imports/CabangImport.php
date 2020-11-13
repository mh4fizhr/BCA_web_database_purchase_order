<?php

namespace App\Imports;

use App\Cabang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CabangImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cabang([
         'KodeCabang' => $row[1],
         'NamaCabang' => $row[2],
         'InisialCabang' => $row[3],
         'CabangUtama' => $row[4],
         'StatusCabang' => $row[5],             
         'KWL' => $row[6],
         'Kota' => $row[7]
        ]);
    }

    public function rules(): array
        {
            return [
                 '*.1' => ['KodeCabang' => 'required','unique:cabangs,KodeCabang'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'Kode cabang cannot be null.',
            '1.unique' => 'Kode cabang has already been taken.',
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
