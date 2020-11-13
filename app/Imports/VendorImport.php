<?php

namespace App\Imports;

use App\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class VendorImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vendor([
            'KodeVendor' => $row[1],
            'NamaVendor' => $row[2],
            'PICvendor' => $row[3],
            'Nohpvendor' => $row[4],
            'Pejabatvendor' => $row[5],
            'Jabatanvendor' => $row[6],
            'Alamatvendor' => $row[7]
        ]);
    }

    public function rules(): array
        {
            return [
                 '*.1' => ['KodeVendor' => 'required','unique:vendors,KodeVendor'],
                 '*.2' => ['NamaVendor' => 'required','unique:vendors,NamaVendor'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'Kode vendor cannot be null.',
            '1.unique' => 'Kode vendor has already been taken.',
            '2.required' => 'Nama vendor cannot be null.',
            '2.unique' => 'Nama vendor has already been taken.',
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
