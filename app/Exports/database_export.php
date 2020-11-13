<?php

namespace App\Exports;

use App\report_database;
use App\tpo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class database_export implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return report_database::all();
        return tpo::where('status','1')->get()->sortByDesc('id');
    }

    public function headings(): array
    {

        return ['ID','Nopo','Jenis Sewa','CP/D','Kode Cabang','Nama Cabang','Inisial','Status','Cabut','Kanwil','Kota','Merek','Type','Tahun','Nopol','Vendor','Nama Driver','NIK','NIP','Mulai Sewa','Tgl bastk','Tgl bastd','Tgl relokasi','Tgl cutoff','Selesai sewa','H.S.Mobil','H.S.Driver','H.S.Mobil + Driver','No register','UserPengguna','created at','created by'
        ];

    }

    
    public function map($report_database): array
    {
        // ___________________________________Driver_______________________________________

        if ($report_database->Driver_id == '') {
          $namadriver = '';
          $nik = '';
          $nip = '';
        }else{
          $namadriver = $report_database->driver->NamaDriver;
          $nik = $report_database->driver->nik;
          $nip = $report_database->driver->nip;
        }

        // ___________________________________Mobil_______________________________________

        if ($report_database->Mobil_id == '') {
          $merekmobil = '';
          $type = '';
          $tahun = '';
        }else{
          $merekmobil = $report_database->mobil->MerekMobil;
          $type = $report_database->mobil->Type;
          $tahun = $report_database->mobil->Tahun;
        }

        // ___________________________________Tanggal_______________________________________

        $tgl_mulai = date('d-M-Y', strtotime($report_database->MulaiSewa));

        if ($report_database->Tgl_bastk == '') {
          $tgl_bastk = '';
        }else{
          $tgl_bastk =  date('d-M-Y', strtotime($report_database->Tgl_bastk));
        }

        if ($report_database->Tgl_bastd == '') {
          $tgl_bastd = '';
        }else{
          $tgl_bastd =  date('d-M-Y', strtotime($report_database->Tgl_bastd));
        }
        
        if ($report_database->Tgl_relokasi == '') {
          $tgl_relokasi = '';
        }else{
          $tgl_relokasi =  date('d-M-Y', strtotime($report_database->Tgl_relokasi));
        }
        
        if ($report_database->Tgl_cutoff == '') {
          $tgl_cutoff = '';
        }else{
          $tgl_cutoff =  date('d-M-Y', strtotime($report_database->Tgl_cutoff));
        }

        if ($report_database->SelesaiSewa == '') {
          $selesaisewa = '';
        }else{
          $selesaisewa =  date('d-M-Y', strtotime($report_database->SelesaiSewa));
        }

        if ($report_database->created_at == '') {
          $created_at = '';
        }else{
          $created_at =  date('d-M-Y', strtotime($report_database->created_at));
        }


         // _______________________________________________________________________________

        $hargatotalsewa = $report_database->HargaSewaMobil + $report_database->HargaSewaDriver2019;

        return [
          $report_database->id,
          $report_database->NoPo,
          $report_database->Sewa_sementara,
          $report_database->CP,
          $report_database->cabang->KodeCabang,
          $report_database->cabang->NamaCabang,
          $report_database->cabang->InisialCabang,
          $report_database->cabang->StatusCabang,
          $report_database->cabang->CabangUtama,
          $report_database->cabang->KWL,
          $report_database->cabang->Kota,
          $merekmobil,
          $type,
          $tahun,
          $report_database->Nopol,
          $report_database->vendor->KodeVendor,
          $namadriver,
          $nik,
          $nip,
          $tgl_mulai,
          $tgl_bastk,
          $tgl_bastd,
          $tgl_relokasi,
          $tgl_cutoff,
          $selesaisewa,
          $report_database->HargaSewaMobil,
          $report_database->HargaSewaDriver2019,
          $hargatotalsewa,
          $report_database->NoRegister,
          $report_database->UserPengguna,
          $created_at,
          $report_database->user->name




         //  $report_database->po_id,
        	// $report_database->Nopo,
        	// $report_database->Sewa,
        	// $report_database->CP,
        	// $report_database->KodeCabang,
        	// $report_database->NamaCabang,
        	// $report_database->InisialCabang,
        	// $report_database->StatusCabang,
        	// $report_database->CabangUtama,
        	// $report_database->KWL,
        	// $report_database->Kota,
        	// $report_database->MerekMobil,
        	// $report_database->Type,
        	// $report_database->Tahun,
        	// $report_database->Nopol,
        	// $report_database->NamaVendor,
        	// $report_database->NamaDriver,
        	// $report_database->nik,
        	// $report_database->nip,
        	// $report_database->MulaiSewa,
        	// $report_database->Tgl_bastk,
        	// $report_database->Tgl_bastd,
        	// $report_database->Tgl_relokasi,
        	// $report_database->Tgl_cutoff,
        	// $report_database->Hargasewamobil,
        	// $report_database->Hargasewadriver,
        	// $report_database->Hargasewamobildriver,
        	// $report_database->No_register,
         //  $report_database->UserPengguna,
        	// Date::dateTimeToExcel($report_database->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'T' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'AE' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
       {
           return [
               AfterSheet::class => function(AfterSheet $event) {
               	// Merge Cells
                   $event->sheet->getDelegate()->freezePane('A2');

                   $event->sheet->getDelegate()->getStyle('F1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');

                   $event->sheet->getDelegate()->getStyle('L1:N1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('51FF0D');

                   $event->sheet->getDelegate()->getStyle('Q1:S1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('99FFFF');

   
                   $event->sheet->getDelegate()->getStyle('A1:AF1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   // $event->sheet->getDelegate()->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   // $event->sheet->getDelegate()->getStyle('V1:W1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   // $event->sheet->getDelegate()->getStyle('G1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   // $event->sheet->getDelegate()->getStyle('N1:Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   // $event->sheet->getDelegate()->getStyle('S1:U1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:AF1')->getFont()->setBold(true);
                   // $event->sheet->getDelegate()->getStyle('B1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
                   // $event->sheet->getDelegate()->getStyle('V1:W1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

                   $event->sheet->getRowDimension('1')->setRowHeight(20);
                   
               },
           ];
       }
}
