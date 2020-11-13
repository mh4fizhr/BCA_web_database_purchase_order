<?php

namespace App\Exports;

use App\report_service;
use App\service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class service_export implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return report_service::select('id','periode','Nopo','Sewa','CP','Nopol','KodeCabang','NamaCabang','InisialCabang','CabangUtama','StatusCabang','KWL','Kota','KodeMobil','MerekMobil','Tahun','Type','NamaVendor','nik','nip','NamaDriver','TglService','km','Keterangan','created_at','updated_at')->get();
        return service::where('active',null)->orwhere('active','')->get()->sortByDesc('po_id');
    }

    public function headings(): array
    {

        return ['ID','Nopo','Jeni sewa','CP/D','Nopol','Kode Cabang','Nama Cabang','Inisial','Cabang Utama','Status Cabang','KWL','Kota','Kode Mobil','Merek Mobil','Tahun','Type','Vendor','NIK','NIP','Nama Driver','periode','Tgl Service','km (Rp)','Keterangan','created_at','updated_at',
        ];

    }
    /**
    * @var report_service $report_service
    */

    public function map($report_service): array
    {

      // ___________________________________Driver_______________________________________

        if ($report_service->po->Driver_id == '') {
          $namadriver = '';
          $nik = '';
          $nip = '';
        }else{
          $namadriver = $report_service->driver->NamaDriver;
          $nik = $report_service->driver->nik;
          $nip = $report_service->driver->nip;
        }


        // ___________________________________Mobil_______________________________________

        if ($report_service->po->Mobil_id == '') {
          $kodemobil = '';
          $merekmobil = '';
          $type = '';
          $tahun = '';
        }else{
          $kodemobil = $report_service->mobil->KodeMobil;
          $merekmobil = $report_service->mobil->MerekMobil;
          $type = $report_service->mobil->Type;
          $tahun = $report_service->mobil->Tahun;
        }

        if ($report_service->TglService == '') {
          $tgl_service = '';
        }else{
          $tgl_service =  date('d/m/Y', strtotime($report_service->TglService));
        }

        $created_at =  date('d-M-Y', strtotime($report_service->created_at));
        $updated_at =  date('d-M-Y', strtotime($report_service->updated_at));

        return [
        	$report_service->po->id,
        	

            $report_service->po->NoPo,
            $report_service->po->Sewa_sementara,
            $report_service->po->CP,
            $report_service->po->Nopol,

            $report_service->cabang->KodeCabang,
            $report_service->cabang->NamaCabang,
            $report_service->cabang->InisialCabang,
            $report_service->cabang->CabangUtama,
            $report_service->cabang->StatusCabang,
            $report_service->cabang->KWL,
            $report_service->cabang->Kota,

            $kodemobil,
            $merekmobil,
            $tahun,
            $type,

            $report_service->vendor->KodeVendor,

            $nik,
            $nip,
            $namadriver,

            $report_service->periode,
            $tgl_service,
            $report_service->km,
            $report_service->Keterangan,
            $created_at,
            $updated_at,
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Y' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Z' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
       {
           return [
               AfterSheet::class => function(AfterSheet $event) {
               	// Merge Cells
                   // $event->sheet->getDelegate()->setMergeCells(['A1:O1', 'A2:C2', 'D2:O2']);
                   // freeze the pane
                   $event->sheet->getDelegate()->freezePane('A2');
                   // Set the cell content centered
                   $event->sheet->getDelegate()->getStyle('A1:Z1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   $event->sheet->getDelegate()->getStyle('U1:X1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   $event->sheet->getDelegate()->getStyle('F1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('M1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   $event->sheet->getDelegate()->getStyle('R1:T1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:Z1')->getFont()->setBold(true);
                   $event->sheet->getDelegate()->getStyle('U1:X1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

                   $event->sheet->getRowDimension('1')->setRowHeight(20);
                   
                   // $event->sheet->getDelegate()->getStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
// setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN ) );
                   // Define the column width
                   // Other style requirements (set border, background color, etc.) handle the macro given in the extension, you can also customize the macro to achieve, see the official website for details
                   
               },
           ];
       }

}
