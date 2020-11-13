<?php

namespace App\Exports;

use App\Cabang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CabangExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cabang::all();
    }

    public function headings(): array

    {

        return ['id','KodeCabang','NamaCabang','InisialCabang','CabangUtama','StatusCabang','KWL','Kota','Ump_id','active','created_at','updated_at ',
        ];

    }
}
