<?php

namespace App\Imports;

use App\tpo;
use App\cabang;
use App\Vendor;
use App\Mobil;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Auth;

class PoImport implements ToModel, WithStartRow
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

        $mobil = Mobil::where('KodeMobil',$row[4])->first();
        $cabang = Cabang::where('KodeCabang',$row[6])->first(); 
        $vendor = Vendor::where('KodeVendor',$row[5])->first(); 

        return new tpo([
          'NoPo' => $row[1],
          'Nopo_permanent' => $row[1],
           'Sewa' => $row[2],
           'Sewa_sementara' => $row[2],
           'Sewa_permanent' => $row[2],
           'CP' => $row[3],
           'Mobil_id' => $mobil->id,
           'Vendor_Driver' => $vendor->id,
           'Vendor_Mobil' => $vendor->id,
           'Cabang_id' => $cabang->id,  
           'Cabang_permanent' => $cabang->id,  
           'MulaiSewa' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7])->format('Y-m-d'),       
           'SelesaiSewa' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('Y-m-d'),             
           'HargaSewaMobil' => $row[9],
           'Hargasewamobil_pengurangan' => $row[9],
           'HargaSewaDriver2019' => $row[10],
           'Hargasewadriver_relokasi' => $row[10],
           'HargaSewaMobilDriver' => null,
           'bbm' => $row[12],
           'jenis_bbm' => $row[13],
           'status' => '5',
           'user_id' => auth::user()->id,

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
        return 12;
    }
}

