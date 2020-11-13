<?php

namespace App\Imports;

use App\jkk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow; 
use Maatwebsite\Excel\Concerns\WithValidation;

class JkkImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new jkk([
            'jkk' => $row[1],
        ]);
    }

    public function rules(): array
        {
            return [
                 '*.1' => ['jkk' => 'unique:jkks,jkk'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.unique' => 'Jkk has already been taken.',
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
