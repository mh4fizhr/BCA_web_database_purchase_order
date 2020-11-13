<?php

namespace App\Exports;

use App\report_mcu;
use App\mcu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class mcu_export implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return report_mcu::all();
      return mcu::all()->sortByDesc('po_id');
    }

    public function headings(): array
    {
 
        return ['ID','Nopo','Jeni sewa','CP/D','Nopol','Kode Cabang','Nama Cabang','Inisial','Cabang Utama','Status Cabang','KWL','Kota','Kode Mobil','Merek Mobil','Tahun','Type','Vendor','NIK','NIP','Nama Driver','periode','MCU','Seragam','created_at','updated_at',
        ];

    }

    public function map($report_mcu): array
    {
        // ___________________________________Driver_______________________________________

        if ($report_mcu->po->Driver_id == '') {
          $namadriver = '';
          $nik = '';
          $nip = '';
        }else{
          $namadriver = $report_mcu->driver->NamaDriver;
          $nik = $report_mcu->driver->nik;
          $nip = $report_mcu->driver->nip;
        }


        // ___________________________________Mobil_______________________________________

        if ($report_mcu->po->Mobil_id == '') {
          $kodemobil = '';
          $merekmobil = '';
          $type = '';
          $tahun = '';
        }else{
          $kodemobil = $report_mcu->mobil->KodeMobil;
          $merekmobil = $report_mcu->mobil->MerekMobil;
          $type = $report_mcu->mobil->Type;
          $tahun = $report_mcu->mobil->Tahun;
        }

        if ($report_mcu->mcu == '') {
          $mcu = '';
        }else{
          $mcu =  date('d/m/Y', strtotime($report_mcu->mcu));
        }

        if ($report_mcu->Seragam == '') {
          $seragam = '';
        }else{
          $seragam =  date('d/m/Y', strtotime($report_mcu->Seragam));
        }

        $created_at =  date('d-M-Y', strtotime($report_mcu->created_at));
        $updated_at =  date('d-M-Y', strtotime($report_mcu->updated_at));




        return [
        	$report_mcu->po->id,
        	
            $report_mcu->po->NoPo,
            $report_mcu->po->Sewa,
            $report_mcu->po->CP,
            $report_mcu->po->Nopol,

            $report_mcu->po->cabang->KodeCabang,
            $report_mcu->po->cabang->NamaCabang,
            $report_mcu->po->cabang->InisialCabang,
            $report_mcu->po->cabang->CabangUtama,
            $report_mcu->po->cabang->StatusCabang,
            $report_mcu->po->cabang->KWL,
            $report_mcu->po->cabang->Kota,

            $kodemobil,
            $merekmobil,
            $tahun,
            $type,

            $report_mcu->po->vendor->KodeVendor,

            $nik,
            $nip,
            $namadriver,

            $report_mcu->periode,
            $mcu,
            $seragam,
            $created_at,
            $updated_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'X' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Y' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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

                   $event->sheet->getDelegate()->getStyle('U1:W1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   $event->sheet->getDelegate()->getStyle('F1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('M1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   $event->sheet->getDelegate()->getStyle('R1:T1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:Z1')->getFont()->setBold(true);

                   $event->sheet->getDelegate()->getStyle('U1:W1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

                   $event->sheet->getRowDimension('1')->setRowHeight(20);
                   
               },
           ];
       }
}
