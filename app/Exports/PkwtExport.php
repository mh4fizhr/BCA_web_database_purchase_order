<?php

namespace App\Exports;

use App\pkwt;
use App\driver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class PkwtExport implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return pkwt::where('active',null)->orwhere('active','')->get()->sortByDesc('driver_id');
    }

    public function headings(): array
    {

        return ['DRIVE_ID','NIP','Nama driver','Vendor','Tgl masuk','pkwt1','pkwt1','pkwt2','pkwt2','Jeda (Bulan)','Periode Jeda','Periode','Keterangan','created_at','updated_at',
        ];

    }

    public function map($report_pkwt): array
    {


    	if ($report_pkwt->TanggalMasuk == '') {
          $TanggalMasuk = '';
        }else{
          $TanggalMasuk =  date('d/m/Y', strtotime($report_pkwt->TanggalMasuk));
        }

        if ($report_pkwt->pkwt1_start == '') {
          $pkwt1_start = '';
        }else{
          $pkwt1_start =  date('d/m/Y', strtotime($report_pkwt->pkwt1_start));
        }

        if ($report_pkwt->pkwt1_end == '') {
          $pkwt1_end = '';
        }else{
          $pkwt1_end =  date('d/m/Y', strtotime($report_pkwt->pkwt1_end));
        }

        if ($report_pkwt->pkwt2_start == '') {
          $pkwt2_start = '';
        }else{
          $pkwt2_start =  date('d/m/Y', strtotime($report_pkwt->pkwt2_start));
        }

        if ($report_pkwt->pkwt2_end == '') {
          $pkwt2_end = '';
        }else{
          $pkwt2_end =  date('d/m/Y', strtotime($report_pkwt->pkwt2_end));
        }



        if ($report_pkwt->PeriodeJeda_start == '') {
          $PeriodeJeda_start = '';
        }else{
          $PeriodeJeda_start =  date('d/m/Y', strtotime($report_pkwt->PeriodeJeda_start));
        }

        if ($report_pkwt->PeriodeJeda_end == '') {
          $PeriodeJeda_end = '';
        }else{
          $PeriodeJeda_end =  date('d/m/Y', strtotime($report_pkwt->PeriodeJeda_end));
        }

        $created_at =  date('d-M-Y', strtotime($report_pkwt->created_at));
        $updated_at =  date('d-M-Y', strtotime($report_pkwt->updated_at));



        return [
            $report_pkwt->driver_id,
            $report_pkwt->driver->nip,
            $report_pkwt->driver->NamaDriver,
            $report_pkwt->driver->vendor_id,

            $TanggalMasuk,
            $pkwt1_start,
            $pkwt1_end,
            $pkwt2_start,
            $pkwt2_end,

            $report_pkwt->DurasiJeda,
            $PeriodeJeda_start,
            $PeriodeJeda_end,
            $report_pkwt->Keterangan,
            
            $created_at,
            $updated_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
        	'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        	'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        	'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        	'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
       {
           return [
               AfterSheet::class => function(AfterSheet $event) {
               	// Merge Cells
                   $event->sheet->getDelegate()->freezePane('A2');
                   // Set the cell content centered
                   $event->sheet->getDelegate()->getStyle('A1:O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   $event->sheet->getDelegate()->getStyle('H1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('K1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   $event->sheet->getDelegate()->getStyle('F1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   // $event->sheet->getDelegate()->getStyle('R1:T1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:O1')->getFont()->setBold(true);
                   // $event->sheet->getDelegate()->getStyle('U1:W1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
                   $event->sheet->mergeCells('F1:G1');
                   $event->sheet->mergeCells('H1:I1');
                   $event->sheet->mergeCells('K1:L1');

                   $event->sheet->getRowDimension('1')->setRowHeight(20);


                   
               },
           ];
       }
}
