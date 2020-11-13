<?php

namespace App\Exports;

use App\report_salon;
use App\salon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class salon_export implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return report_salon::all();
      return salon::where('active',null)->orwhere('active','')->get()->sortByDesc('po_id');
    }

    public function headings(): array
    {

        return ['ID','Nopo','Jeni sewa','CP/D','Nopol','Kode Cabang','Nama Cabang','Inisial','Cabang Utama','Status Cabang','KWL','Kota','Kode Mobil','Merek Mobil','Tahun','Type','Vendor','NIK','NIP','Nama Driver','periode','Salon 1','salon 2','created_at','updated_at',
        ];

    }

    public function map($report_salon): array
    {

        // ___________________________________Driver_______________________________________

        if ($report_salon->po->Driver_id == '') {
          $namadriver = '';
          $nik = '';
          $nip = '';
        }else{
          $namadriver = $report_salon->driver->NamaDriver;
          $nik = $report_salon->driver->nik;
          $nip = $report_salon->driver->nip;
        }


        // ___________________________________Mobil_______________________________________

        if ($report_salon->po->Mobil_id == '') {
          $kodemobil = '';
          $merekmobil = '';
          $type = '';
          $tahun = '';
        }else{
          $kodemobil = $report_salon->mobil->KodeMobil;
          $merekmobil = $report_salon->mobil->MerekMobil;
          $type = $report_salon->mobil->Type;
          $tahun = $report_salon->mobil->Tahun;
        }

        if ($report_salon->Salon1 == '') {
          $salon1 = '';
        }else{
          $salon1 =  date('d/m/Y', strtotime($report_salon->Salon1));
        }

        if ($report_salon->Salon2 == '') {
          $salon2 = '';
        }else{
          $salon2 =  date('d/m/Y', strtotime($report_salon->Salon2));
        }

        $created_at =  date('d-M-Y', strtotime($report_salon->created_at));
        $updated_at =  date('d-M-Y', strtotime($report_salon->updated_at));

        return [
          $report_salon->po->id,

            $report_salon->po->NoPo,
            $report_salon->po->Sewa_sementara,
            $report_salon->po->CP,
            $report_salon->po->Nopol,

            $report_salon->cabang->KodeCabang,
            $report_salon->cabang->NamaCabang,
            $report_salon->cabang->InisialCabang,
            $report_salon->cabang->CabangUtama,
            $report_salon->cabang->StatusCabang,
            $report_salon->cabang->KWL,
            $report_salon->cabang->Kota,

            $kodemobil,
            $merekmobil,
            $tahun,
            $type,

            $report_salon->vendor->KodeVendor,

            $nik,
            $nip,
            $namadriver,

            $report_salon->periode,
            $salon1,
            $salon2,
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
