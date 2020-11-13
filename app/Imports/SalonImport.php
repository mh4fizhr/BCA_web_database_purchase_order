<?php

namespace App\Imports;

use App\salon;
use App\tpo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SalonImport implements ToModel, WithStartRow
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
          $salon1 = null;
        }else{
            if(strtotime($row[21])){
                $salon1 =  date('m/d/Y', strtotime($row[21]));
            }else{
                $salon1 = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('m/d/Y');
            } 
        }

        if ($row[22] == '') {
          $salon2 = null;
        }else{
            if(strtotime($row[22])){
                $salon2 =  date('m/d/Y', strtotime($row[22]));
            }else{
                $salon2 = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[22])->format('m/d/Y');
            } 
        }

        return new salon([
            //
            'periode' => $row[20],
            'po_id' => $po->id,
            'mobil_id' => $po->Mobil_id,
            'cabang_id' => $po->Cabang_id,
            'vendor_id' => $po->Vendor_Driver,
            'driver_id' => $po->Driver_id,
            'Salon1' => $salon1,
            'Salon2' => $salon2,
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
