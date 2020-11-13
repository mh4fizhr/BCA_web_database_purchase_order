<?php

namespace App\Imports;

use App\Service;
use App\tpo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ServiceImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $po = tpo::where('id',$row[0])->first();

        if ($row[21] == '') {
          $tglservice = null;
        }else{
            if(strtotime($row[21])){
                $tglservice =  date('m/d/Y', strtotime($row[21]));
            }else{
                $tglservice = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('m/d/Y');
            } 
        }

        return new Service([
            'periode' => $row[20],
            'po_id' => $po->id,
            'mobil_id' => $po->Mobil_id,
            'cabang_id' => $po->Cabang_id,
            'vendor_id' => $po->Vendor_Driver,
            'driver_id' => $po->Driver_id,
            'TglService' => $tglservice,
            'km' => $row[22],
            'Keterangan' => $row[23],
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
