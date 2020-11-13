<?php

namespace App\Exports;

use App\tpo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PoExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tpo::all();
    }

    public function headings(): array

    {

        return ['id','Sewa','CP','Cabang_id','Ump_id','Mobil_id','Type','Nopol','Vendor_Mobil','Vendor_Driver','Driver_id','UserPengguna','NoPo','MulaiSewa','MulaiSewa2','Tgl_bastk','Tgl_bastd','Tgl_relokasi','Nopo_relokasi','Efisien_relokasi','Cabang_relokasi','Hargasewadriver_relokasi','Pengurangan','Sewa_sementara','Nopo_pengurangan','Hargasewamobil_pengurangan','Tgl_cutoff','SelesaiSewa','SelesaiSewa2','HargaSewaMobil','HargaSewaDriver2019','HargaSewaMobilDriver','status','NoRegister','Po_multiple_start','Po_multiple_end','Nopo_permanent','Cabang_permanent','Sewa_permanent','created_at','updated_at'
        ]; 

    }
}
