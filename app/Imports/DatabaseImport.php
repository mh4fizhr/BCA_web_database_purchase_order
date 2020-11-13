<?php

namespace App\Imports;

use App\tpo;
use App\cabang;
use App\Vendor;
use App\Mobil;
use App\Driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Auth;

class DatabaseImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new tpo([
        //    'Sewa' => $row[1],
        //    'CP' => $row[2],
        //    'Cabang_id' => $row[3],
        //    'Ump_id' => $row[4],
        //    'Mobil_id' => $row[5],
        //    'Type' => $row[6],
        //    'Nopol' => $row[7],
        //    'Vendor_Mobil' => $row[8],
        //    'Vendor_Driver' => $row[9],
        //    'Driver_id' => $row[10],
        //    'UserPengguna' => $row[11],
        //    'NoPo' => $row[12],
        //    'MulaiSewa' => $row[13],
        //    'Tgl_bastk' => $row[14],
        //    'Tgl_bastd' => $row[15],
        //    'Tgl_relokasi' => $row[16],
        //    'Efisien_relokasi' => $row[17],
        //    'Cabang_relokasi' => $row[18],
        //    'Tgl_cutoff' => $row[19],
        //    'SelesaiSewa' => $row[20],
        //    'HargaSewaMobil' => $row[21],
        //    'HargaSewaDriver2019' => $row[22],
        //    'HargaSewaMobilDriver' => $row[23],
        //    'status' => $row[24],
        // ]);  

        if ($row[4] == '') {
          $mobils = null;
        }else{
          $mobil = Mobil::where('KodeMobil',$row[4])->first(); 
          $mobils = $mobil->id;
        }

        $cabang = Cabang::where('KodeCabang',$row[7])->first(); 
        $vendor = Vendor::where('KodeVendor',$row[6])->first(); 

        if ($row[8] == '') {
          $drivers = null;
        }else{
          $driver = Driver::where('nik',$row[8])->first();
          if (Driver::where('nik',$row[8])->exists()) {
              $drivers = $driver->id;
          }else{
              $drivers = null;
          } 
        }

        if ($row[11] == '') {
          $Tgl_bastk = null;
        }else{
          $Tgl_bastk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('m/d/Y');
        }

        if ($row[12] == '') {
          $Tgl_bastd = null;
        }else{
          $Tgl_bastd = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('m/d/Y');
        }

        if ($row[13] == '') {
          $Tgl_cutoff = null;
        }else{
          $Tgl_cutoff = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('Y-m-d');
        }

        if ($row[2] == 'Mobil+Driver' || $row[2] == 'Mobil' || $row[2] == 'Driver') {
          return new tpo([
             'NoPo' => $row[1],
             'Nopo_permanent' => $row[1],
             'Sewa' => $row[2],
             'Sewa_sementara' => $row[2],
             'Sewa_permanent' => $row[2],
             'CP' => $row[3],
             'Mobil_id' => $mobils,
             'Driver_id' => $drivers,
             'Nopol' => $row[5],
             'Vendor_Driver' => $vendor->id,
             'Vendor_Mobil' => $vendor->id,
             'Cabang_id' => $cabang->id,  
             'Cabang_permanent' => $cabang->id,  
             'UserPengguna' => $row[9],
             'MulaiSewa' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d'),    
             'Tgl_bastk' => $Tgl_bastk,     
             'Tgl_bastd' => $Tgl_bastd,   
             'Tgl_cutoff' => $Tgl_cutoff,                
             'SelesaiSewa' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14])->format('Y-m-d'),             
             'HargaSewaMobil' => $row[15],
             'Hargasewamobil_pengurangan' => $row[15],
             'HargaSewaDriver2019' => $row[16],
             'Hargasewadriver_relokasi' => $row[16],
             'HargaSewaMobilDriver' => null,
             'bbm' => $row[18],
             'jenis_bbm' => $row[19],
             'NoRegister' => $row[20],
             'status' => '7',
             'user_id' => auth::user()->id,
          ]);
        }
        
        

    }

    public function rules(): array
        {
            return [
                 '*.1' => ['NoPo' => 'required'],
                 '*.2' => ['Sewa' => 'required'],
                 '*.7' => ['Cabang_id' => 'required'],
            ];
        }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'No.PO cannot be null.',
            '2.required' => 'Sewa cannot be null.',
            '7.required' => 'Cabang cannot be null.',
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
        return 12;
    }
}
