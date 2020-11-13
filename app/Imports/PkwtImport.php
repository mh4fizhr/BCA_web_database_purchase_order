<?php

namespace App\Imports;

use App\pkwt;
use App\driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PkwtImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $driver = driver::where('id',$row[0])->first();

        if ($row[4] == '') {
          $TanggalMasuk = null;
        }else{
            if(strtotime($row[4])){
                $TanggalMasuk =  date('m/d/Y', strtotime($row[4]));
            }else{
                $TanggalMasuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('m/d/Y');
            } 
        }

        if ($row[5] == '') {
          $pkwt1_start = null;
        }else{
            if(strtotime($row[5])){
                $pkwt1_start =  date('m/d/Y', strtotime($row[5]));
            }else{
                $pkwt1_start = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->format('m/d/Y');
            } 
        }

        if ($row[6] == '') {
          $pkwt1_end = null;
        }else{
            if(strtotime($row[6])){
                $pkwt1_end =  date('m/d/Y', strtotime($row[6]));
            }else{
                $pkwt1_end = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6])->format('m/d/Y');
            } 
        }

        if ($row[7] == '') {
          $pkwt2_start = null;
        }else{
            if(strtotime($row[7])){
                $pkwt2_start =  date('m/d/Y', strtotime($row[7]));
            }else{
                $pkwt2_start = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7])->format('m/d/Y');
            } 
        }

        if ($row[8] == '') {
          $pkwt2_end = null;
        }else{
            if(strtotime($row[8])){
                $pkwt2_end =  date('m/d/Y', strtotime($row[8]));
            }else{
                $pkwt2_end = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('m/d/Y');
            } 
        }

        if ($row[10] == '') {
          $PeriodeJeda_start = null;
        }else{
            if(strtotime($row[10])){
                $PeriodeJeda_start =  date('m/d/Y', strtotime($row[10]));
            }else{
                $PeriodeJeda_start = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('m/d/Y');
            } 
        }

        if ($row[11] == '') {
          $PeriodeJeda_end = null;
        }else{
            if(strtotime($row[11])){
                $PeriodeJeda_end =  date('m/d/Y', strtotime($row[11]));
            }else{
                $PeriodeJeda_end = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('m/d/Y');
            } 
        }



        return new pkwt([
            //
            'driver_id' => $driver->id,
            'TanggalMasuk' => $TanggalMasuk,
            'pkwt1_start' => $pkwt1_start,
            'pkwt1_end' => $pkwt1_end,
            'pkwt2_start' => $pkwt2_start,
            'pkwt2_end' => $pkwt2_end,
            'DurasaJeda' => $row[10],
            'PeriodeJeda_start' => $PeriodeJeda_start,
            'PeriodeJeda_end' => $PeriodeJeda_end,
            'Keterangan' => $row[13],
            
        ]);
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
