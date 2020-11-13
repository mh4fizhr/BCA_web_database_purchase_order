<?php

namespace App\Imports;

use App\mcu;
use App\tpo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;


class McuImport implements ToModel, WithStartRow
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
          $mcu = null;
        }else{
            if(strtotime($row[21])){
                $mcu =  date('m/d/Y', strtotime($row[21]));
            }else{
                $mcu = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('m/d/Y');
            } 
        }

        if ($row[22] == '') {
          $seragam = null;
        }else{
            if(strtotime($row[22])){
                $seragam =  date('m/d/Y', strtotime($row[22]));
            }else{
                $seragam = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[22])->format('m/d/Y');
            } 
        }

        if($mcu != null && $seragam != null){
            $status = '1';
        }else{
            $status = '0';
        }

        return new mcu([
            'periode' => $row[20],
            'po_id' => $po->id,
            'mobil_id' => $po->Mobil_id,
            'cabang_id' => $po->Cabang_id,
            'vendor_id' => $po->Vendor_Driver,
            'driver_id' => $po->Driver_id,
            'mcu' => $mcu,
            'seragam' => $seragam,
            'status' => $status,
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
