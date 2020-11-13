<?php

namespace App\Imports;

use App\kota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KotaImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new kota([
            'Kota' => $row[1]
        ]);
    }

    public function rules(): array
        {
            return [
                 '*.1' => ['kota' => 'unique:kotas,kota'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.unique' => 'Kota has already been taken.',
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
