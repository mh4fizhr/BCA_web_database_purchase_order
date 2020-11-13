<?php

namespace App\Imports;

use App\harga_ump;
use App\tahun;
use App\kota;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class HargaumpImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if (tahun::where('Tahun', $row[2])->exists()) {
            $tahuns = $row[2];
        }else{
            $tahuns = null;
        }

        return new harga_ump([
            'Kota_id' => $row[1],
            'Tahun_id' => $row[2],
            'Jkk_id' => $row[3],
            'Vendor_id' => $row[4],
            'Harga_include' => $row[5],             
            'Harga_eksclude' => $row[6],
            'created_by' => auth::user()->name
        ]);
    }

    public function rules(): array
        {
            return [
                 '*.1' => ['Kota_id' => 'required'],
                 '*.2' => ['Tahun_id' => 'required'],
                 '*.3' => ['Jkk_id' => 'required'],
                 '*.4' => ['Vendor_id' => 'required'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'Kota cannot be null.',    
            '2.required' => 'Tahun cannot be null.',  
            '3.required' => 'Jkk cannot be null.', 
            '4.required' => 'Vendor cannot be null.',    
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
