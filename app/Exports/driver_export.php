<?php

namespace App\Exports;

use App\report_driver;
use App\historydriver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class driver_export implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return report_driver::all();
        return historydriver::all()->sortByDesc('Po_id');
    }

    public function headings(): array
    {

        return ['id','Nama Driver','NIK','NIP','Nopo','Jeni sewa','CP/D','Nopol','Kode Cabang','Nama Cabang','Inisial','Cabang Utama','Status Cabang','KWL','Kota','Kode Mobil','Merek Mobil','Tahun','Type','Vendor','Tgl mulai','Tgl selesai','created_at','updated_at',
        ];

    }



    public function map($report_driver): array
    {
        // ___________________________________Mobil_______________________________________

        if ($report_driver->po->Mobil_id == '') {
          $kodemobil = '';
          $merekmobil = '';
          $type = '';
          $tahun = '';
        }else{
          $kodemobil = $report_driver->po->mobil->KodeMobil;
          $merekmobil = $report_driver->po->mobil->MerekMobil;
          $type = $report_driver->po->mobil->Type;
          $tahun = $report_driver->po->mobil->Tahun;
        }

        if ($report_driver->tgl_mulai == '') {
          $tgl_mulai = '';
        }else{
          $tgl_mulai =  date('d-M-Y', strtotime($report_driver->tgl_mulai));
        }

        if ($report_driver->tgl_selesai == '') {
          $tgl_selesai = '';
        }else{
          $tgl_selesai =  date('d-M-Y', strtotime($report_driver->tgl_selesai));
        }

        $created_at =  date('d-M-Y', strtotime($report_driver->created_at));
        $updated_at =  date('d-M-Y', strtotime($report_driver->updated_at));


        return [
        	$report_driver->id,
        	$report_driver->driver->NamaDriver,
        	$report_driver->driver->nik,
            $report_driver->driver->nip,
            $report_driver->po->Nopo,
            $report_driver->po->Sewa,
            $report_driver->po->CP,
            $report_driver->po->Nopol,
            $report_driver->po->cabang->KodeCabang,
            $report_driver->po->cabang->NamaCabang,
            $report_driver->po->cabang->InisialCabang,
            $report_driver->po->cabang->CabangUtama,
            $report_driver->po->cabang->StatusCabang,
            $report_driver->po->cabang->KWL,
            $report_driver->po->cabang->Kota,
            $kodemobil,
            $merekmobil,
            $tahun,
            $type,
            $report_driver->po->vendor->KodeVendor,
            $tgl_mulai,
            $tgl_selesai,
            $created_at,
            $updated_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'X' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
       {
           return [
               AfterSheet::class => function(AfterSheet $event) {
               	// Merge Cells
                   $event->sheet->getDelegate()->freezePane('A2');
                   // Set the cell content centered
                   $event->sheet->getDelegate()->getStyle('A1:Y1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   $event->sheet->getDelegate()->getStyle('B1:D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   $event->sheet->getDelegate()->getStyle('U1:V1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   $event->sheet->getDelegate()->getStyle('I1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('P1:S1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   // $event->sheet->getDelegate()->getStyle('S1:U1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:Z1')->getFont()->setBold(true);
                   $event->sheet->getDelegate()->getStyle('B1:D1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
                   $event->sheet->getDelegate()->getStyle('U1:V1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

                   $event->sheet->getRowDimension('1')->setRowHeight(20);
                   
               },
           ];
       }
}
