<?php

namespace App\Exports;

use App\report_pkwt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class pkwt_export implements FromCollection,ShouldAutoSize,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return report_pkwt::select('id','NamaDriver','nik','nip','NamaVendor','TanggalMasuk','pkwt1_start','pkwt1_end','pkwt2_start','pkwt2_end','DurasiJeda','PeriodeJeda_start','PeriodeJeda_end','Keterangan','Status','active')->where('active',null)->orwhere('active','')->get();
    }

    public function headings(): array
    {

        return ['id','Nama Driver','nik','nip','Vendor','Tgl Masuk','pkwt1(start)','pkwt1(end)','pkwt2(start)','pkwt2(end)','DurasiJeda','PeriodeJeda(start)','PeriodeJeda(end)','Keterangan','Status','active',
        ];

    }

    public function registerEvents(): array
       {
           return [
               AfterSheet::class => function(AfterSheet $event) {
               	// Merge Cells
                   $event->sheet->getDelegate()->freezePane('A2');
                   
                   $event->sheet->getDelegate()->getStyle('A1:Q1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   // $event->sheet->getDelegate()->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   // $event->sheet->getDelegate()->getStyle('V1:W1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   // $event->sheet->getDelegate()->getStyle('G1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   // $event->sheet->getDelegate()->getStyle('N1:Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   // $event->sheet->getDelegate()->getStyle('S1:U1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:Q1')->getFont()->setBold(true);
                   // $event->sheet->getDelegate()->getStyle('B1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
                   // $event->sheet->getDelegate()->getStyle('V1:W1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

                   $event->sheet->getRowDimension('1')->setRowHeight(20);
                   
               },
           ];
       }
}
