<?php

namespace App\Http\Controllers;

use App\Imports\PoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Cabang;
use App\Driver;
use App\Mobil;
use App\Vendor;
use App\tpo;
use App\ump;
use App\pkwt;
use App\Service;
use App\mcu;
use App\User;
use App\Nopo;
use App\Relokasi;
use App\Pengurangan;
use App\harga_ump;
use App\kota;
use App\historydriver;
use App\historymobil;
use App\historynopol;
use App\salon;
use App\report_service;
use App\report_salon;
use App\report_mcu;
use App\report_driver;
use App\report_database;
use App\report_pkwt;
use App\timeline;
use App\Cp;
use App\tahun_mobil;
use App\pejabat;
use App\unitkerja;
use App\jabatan;
use App\template_relokasi;
use App\table_template_relokasi;
use App\template_pengurangan;
use App\table_template_pengurangan;
use App\template_perubahan;
use App\table_template_perubahan;
use PDF;
use App\addendum;
use App\pks;
use Exception;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_relokasi()
    {
             $template_relokasis = template_relokasi::paginate(1000)->sortByDesc('id');
             $vendor_uniques = $template_relokasis->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_relokasis = table_template_relokasi::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             $s = 'active';
             return view('surat/relokasi/index',compact('template_relokasis','table_template_relokasis','s','vendor_uniques','vendors'));
    }  

    public function index_relokasi_status($status)
    {
             $template_relokasis = template_relokasi::paginate(1000)->sortByDesc('id');
             $vendor_uniques = $template_relokasis->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_relokasis = table_template_relokasi::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             $s = $status;
             return view('surat/relokasi/index',compact('template_relokasis','table_template_relokasis','s','vendor_uniques','vendors'));
    }   

    public function view_relokasi($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $nopos = Nopo::all();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $template_relokasi = template_relokasi::find($id);

        $table_template_relokasis = table_template_relokasi::all()->sortByDesc('id');

        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        // $poss = tpo::whereIn('id',$request->get('relokasi'))->get();
        $poss = tpo::all();
        return view('surat/relokasi/view',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_relokasi','table_template_relokasis','pkss','addendums'));
    } 


    public function status_relokasi(Request $request)
    {
        $request->validate([
            'status.*' => 'nullable',
        ]);

        $status = $request->status;

        $return = 0;

        if ($status == '') {
            return redirect('/backend/surat/relokasi')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {

               $Status = template_relokasi::find($status[$count]);
               if ($Status->status != '1') {
                   $Status->status = '1';
                   $Status->save();
                   $return = 1;
               }else{
                    $Status->status = '';
                    $Status->save();
                    $return = 0;
               }
            }

            return redirect('/backend/surat/relokasi');

        }
        
    }
                
    public function download_relokasi($id)
    {
            function terbilang($tanggal){
              $terbilang = '';
              if ($tanggal == '1') {
                $terbilang = 'satu';
              }else if($tanggal == '2') {
                $terbilang = 'dua';
              }else if($tanggal == '3') {
                $terbilang = 'tiga';
              }else if($tanggal == '4') {
                $terbilang = 'empat';
              }else if($tanggal == '5') {
                $terbilang = 'lima';
              }else if($tanggal == '6') {
                $terbilang = 'enam';
              }else if($tanggal == '7') {
                $terbilang = 'tujuh';
              }else if($tanggal == '8') {
                $terbilang = 'delapan';
              }else if($tanggal == '9') {
                $terbilang = 'sembilan';
              }else if($tanggal == '10') {
                $terbilang = 'sepuluh';
              }else if($tanggal == '0') {
                $terbilang = 'nol';
              }

              return $terbilang;
            }

            setlocale(LC_ALL, 'id-ID', 'id_ID');
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');


            $template_relokasi = template_relokasi::find($id);
            $pos = tpo::all();
            $table_template_relokasis = table_template_relokasi::where('template_id',$id)->get();
            $vendors = Vendor::where('NamaVendor',$template_relokasi->nama_vendor)->first();
            $count_mobil = 0;
            $count_driver = 0;
            foreach ($table_template_relokasis as $table_template_relokasi) {
                foreach ($pos as $po) {
                    if ($table_template_relokasi->po_id == $po->id) {
                        if ($po->Sewa_sementara == 'Mobil+Driver') {
                            $count_mobil++;
                            $count_driver++;
                        }else if($po->Sewa_sementara == 'Mobil'){
                            $count_mobil++;
                        }else if($po->Sewa_sementara == 'Driver'){
                            $count_driver++;
                        }
                    }
                }
            }



            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $phpWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0));
            $phpWord->addParagraphStyle('boldpJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0,'bold' =>true));
            $phpWord->addFontStyle('bold',array('bold' =>true));
            $phpWord->addFontStyle('bold_underline',array('bold' =>true,'underline' =>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
                             // //add this style then append it to text below
                             // $section->addText('something', 'textstyle', 'pJustify');
                             // //the text behind this will be justified and will be in a new line, not in a new paragraph
                             // $section->addText('behind', 'textstyle', 'pJustify');

                             $section = $phpWord->addSection();

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             $no_surat = $template_relokasi->no_surat; 
                             // $tgl_surat = 'Jakarta, '.strftime("%d %B %Y", strtotime($template_relokasi->created_at));
                             $tgl_surat = $template_relokasi->tgl_surat;

                             $kepada = "Kepada,";
                             $nama_vendor = $template_relokasi->nama_vendor; 
                             $alamat_vendor = $template_relokasi->alamat_vendor; 
                             
                             $yth = "Up. Yth. ".$vendors->Pejabatvendor." - ".$template_relokasi->jabatan_vendor;

                             $perihal = "Relokasi Sewa ".$template_relokasi->sewa;

                             $dengan_hormat = "Dengan hormat,";

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SYARAT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             $mobil = '';
                             $driver = '';
                             $dan = '';

                             if ($count_mobil != 0) {
                                 $mobil = "sewa mobil sebanyak ".$count_mobil." (".terbilang($count_mobil).") unit";
                             }

                             if ($count_driver != 0) {
                                 $driver = "sewa pengemudi sebanyak ".$count_driver." (".terbilang($count_driver).") orang";
                             }

                             if ($count_driver != 0 && $count_mobil != 0) {
                                 $dan = ' dan ';
                             }

                             
                             $description = "Menunjuk ".$template_relokasi->pks." No. ".$template_relokasi->no_pks." tanggal ".strftime("%d %B %Y", strtotime($template_relokasi->tgl_pks)).", dengan ini kami sampaikan relokasi ".$mobil."".$dan."".$driver.", dengan data sebagai berikut :
                             ";

                             // $description = "Menunjuk ".$template_relokasi->pks." No. ".$template_relokasi->no_pks." tanggal ".strftime("%d %B %Y", strtotime($template_relokasi->tgl_pks)).", dengan ini kami sampaikan relokasi sewa mobil sebanyak ".$count_mobil." (".terbilang($count_mobil).") unit dan pengemudi sebanyak ".$count_driver." (".terbilang($count_driver).") orang, dengan data sebagai berikut :
                             // ";

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SYARAT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             

                             $demikian = "Demikian kami sampaikan, atas perhatian dan kerjasama Bapak kami ucapkan terima kasih.";
                             $hormat_kami = "Hormat kami,";
                             $nama_bank = "PT BANK CENTRAL ASIA, Tbk";

                             $unitkerja = $template_relokasi->unitkerja_pb1." ".$template_relokasi->unitkerja_pb2;


                             $phpWord->addFontStyle($nama_vendor, array('bold' => true));

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             $section->addText("");
                             $section->addText('No. '.$no_surat."\t\t\t\t\t\t".$tgl_surat);
                             $section->addText($kepada,'textstyle','pJustify');
                             $section->addText($nama_vendor,'bold','pJustify');
                             $section->addText($alamat_vendor);
                             $section->addText($yth, ['bold' => true]);
                             $section->addText("Perihal : ".$perihal);
                             $section->addText($dengan_hormat);
                             $section->addText($description,'textstyle','pJustify');
                                 $section->addText("",'textstyle','pJustify');

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999');
                             $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'ffffff');
                             $cellRowContinue = array('vMerge' => 'continue');
                             $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
                             $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
                             $cellVCentered = array('valign' => 'center');

                             $spanTableStyleName = 'Colspan Rowspan';
                             $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
                             $table = $section->addTable($spanTableStyleName);

                             $table->addRow();

                             $cell1 = $table->addCell(500, $cellRowSpan);
                             $textrun1 = $cell1->addTextRun($cellHCentered);
                             $textrun1->addText('No',['bold' => true]);

                             $cell2 = $table->addCell(2000, $cellRowSpan);
                             $textrun2 = $cell2->addTextRun($cellHCentered);
                             $textrun2->addText('Merk/Type/Tahun',['bold' => true]);

                             $cell3 = $table->addCell(2000, $cellRowSpan);
                             $textrun3 = $cell3->addTextRun($cellHCentered);
                             $textrun3->addText('No. Polisi',['bold' => true]);

                             $cell6 = $table->addCell(2000, $cellRowSpan);
                             $textrun6 = $cell6->addTextRun($cellHCentered);
                             $textrun6->addText('Data Pairing',['bold' => true]);

                             $cell4 = $table->addCell(4000, $cellColSpan);
                             $textrun4 = $cell4->addTextRun($cellHCentered);
                             $textrun4->addText('Cabang / RCC Lama',['bold' => true]);

                             $cell5 = $table->addCell(4000, $cellColSpan);
                             $textrun5 = $cell5->addTextRun($cellHCentered);
                             $textrun5->addText('Cabang / RCC Lama',['bold' => true]);

                             $table->addCell(2000, $cellRowSpan)->addText('Tgl. Efektif', ['bold' => true], $cellHCentered);

                             $table->addRow();
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(2000, $cellVCentered)->addText('Nama', ['bold' => true], $cellHCentered);
                             $table->addCell(2000, $cellVCentered)->addText('Kode', ['bold' => true], $cellHCentered);
                             $table->addCell(2000, $cellVCentered)->addText('Nama', ['bold' => true], $cellHCentered);
                             $table->addCell(2000, $cellVCentered)->addText('Kode', ['bold' => true], $cellHCentered);
                             $table->addCell(null, $cellRowContinue);

                             $i = 1;
                             foreach ($table_template_relokasis as $table_template_relokasi) {
                                 $mobil = Mobil::find($table_template_relokasi->merek);
                                 $po_sewa = tpo::find($table_template_relokasi->po_id);
                                 $table->addRow();
                                 $table->addCell(500)->addText("{$i}",$cellVCentered, $cellHCentered);

                                 if ($table_template_relokasi->merek == '') {
                                     $table->addCell(2000)->addText('');
                                 }else{
                                     if ($table_template_relokasi->sewa == 'Mobil+Driver') {
                                         $table->addCell(2000)->addText($mobil->MerekMobil." ".$mobil->Type." + Pengemudi",null,$cellHCentered);
                                     }else{
                                        $table->addCell(2000)->addText($mobil->MerekMobil." ".$mobil->Type,null,$cellHCentered);
                                     }
                                 }


                                 $table->addCell(2000)->addText($table_template_relokasi->nopol,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_relokasi->sewa,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_relokasi->status_cabang_lama." - ".$table_template_relokasi->nama_cabang_lama,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_relokasi->kode_cabang_lama,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_relokasi->status_cabang_baru." - ".$table_template_relokasi->nama_cabang_baru,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_relokasi->kode_cabang_baru,null,$cellHCentered);
                                 $table->addCell(2000)->addText(strftime("%d %B %Y", strtotime($table_template_relokasi->tgl_efektif)),null,$cellHCentered);
                                 $i++;
                             }

   


                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             $section->addText("<w:br/>".$demikian);
                             $section->addText($hormat_kami);
                             $section->addText($nama_bank,'bold','boldpJustify');

                             $table = $section->addTable();
                             $table->addRow();
                             if ($template_relokasi->unitkerja_pb1 == $template_relokasi->unitkerja_pb2) {
                                $table->addCell(3000)->addText($template_relokasi->unitkerja_pb1);
                                $table->addCell(3000)->addText('');
                             }else{
                                $table->addCell(3000)->addText($template_relokasi->unitkerja_pb1);
                                $table->addCell(3000)->addText($template_relokasi->unitkerja_pb2);
                             }
                             
                             
                             $section->addTextBreak(4);

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


                             $table = $section->addTable();
                             
                             $table->addRow();
                             $table->addCell(3000)->addText($template_relokasi->nama_pb1,'bold_underline','boldpJustify');
                             $table->addCell(3000)->addText($template_relokasi->nama_pb2,'bold_underline','boldpJustify');
                             $table->addRow();
                             $table->addCell(3000)->addText($template_relokasi->jabatan_pb1);
                             $table->addCell(3000)->addText($template_relokasi->jabatan_pb2);


                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             $section->addText("\n");
                             $section->addText('CC : - BOP','','boldpJustify');
                             $section->addText("        ".'- BPL');


                             $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

                             try {

                                 $objWriter->save(storage_path('SuratRelokasi.docx'));

                             } catch (Exception $e) {

                             }

                             return response()->download(storage_path('SuratRelokasi.docx'));
    }



    public function index_pengurangan()
    {
             $template_pengurangans = template_pengurangan::paginate(1000)->sortByDesc('id');
             $vendor_uniques = $template_pengurangans->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_pengurangans = table_template_pengurangan::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             $s = 'active';
             return view('surat/pengurangan/index',compact('template_pengurangans','table_template_pengurangans','s','vendor_uniques','vendors'));
    }   

    public function index_pengurangan_status($status)
    {
             $template_pengurangans = template_pengurangan::paginate(1000)->sortByDesc('id');
             $vendor_uniques = $template_pengurangans->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_pengurangans = table_template_pengurangan::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             $s = $status;
             return view('surat/pengurangan/index',compact('template_pengurangans','table_template_pengurangans','s','vendor_uniques','vendors'));
    }   

    public function view_pengurangan($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $nopos = Nopo::all();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $poss = tpo::all();
        $template_pengurangan = template_pengurangan::find($id);
        $table_template_pengurangans = table_template_pengurangan::all()->sortByDesc('id');
        $table_template_pengurangan = table_template_pengurangan::where('template_id',$id)->first();
        $po_id = tpo::find($table_template_pengurangan->po_id);
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        if($template_pengurangan->sewa == 'Pengemudi Kendaraan Operasional')
        {
            return view('surat/pengurangan/view_damira',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_pengurangan','table_template_pengurangan','table_template_pengurangans','po_id','pkss','addendums'));
        }
        else
        {
            return view('surat/pengurangan/view',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_pengurangan','table_template_pengurangan','table_template_pengurangans','po_id','pkss','addendums'));
        }
    }

    public function status_pengurangan(Request $request)
    {
        $request->validate([
            'status.*' => 'nullable',
        ]);

        $status = $request->status;

        $return = 0;

        if ($status == '') {
            return redirect('/backend/surat/pengurangan')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {

               $Status = template_pengurangan::find($status[$count]);
               if ($Status->status != '1') {
                   $Status->status = '1';
                   $Status->save();
                   $return = 1;
               }else{
                    $Status->status = '';
                    $Status->save();
                    $return = 0;
               }
            }

            return redirect('/backend/surat/pengurangan');

        }
        
    }
                
    public function download_pengurangan($id)
    {
            function terbilang($tanggal){
              $terbilang = '';
              if ($tanggal == '1') {
                $terbilang = 'satu';
              }else if($tanggal == '2') {
                $terbilang = 'dua';
              }else if($tanggal == '3') {
                $terbilang = 'tiga';
              }else if($tanggal == '4') {
                $terbilang = 'empat';
              }else if($tanggal == '5') {
                $terbilang = 'lima';
              }else if($tanggal == '6') {
                $terbilang = 'enam';
              }else if($tanggal == '7') {
                $terbilang = 'tujuh';
              }else if($tanggal == '8') {
                $terbilang = 'delapan';
              }else if($tanggal == '9') {
                $terbilang = 'sembilan';
              }else if($tanggal == '10') {
                $terbilang = 'sepuluh';
              }else if($tanggal == '0') {
                $terbilang = 'nol';
              }

              return $terbilang;
            }

            setlocale(LC_ALL, 'id-ID', 'id_ID');
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');


            $template_pengurangan = template_pengurangan::find($id);
            $pos = tpo::all(); 
            $table_template_pengurangans = table_template_pengurangan::where('template_id',$id)->get();
            $vendors = Vendor::where('NamaVendor',$template_pengurangan->nama_vendor)->first();
            $count_mobil = 0;
            $count_driver = 0;

            if ($template_pengurangan->sewa == 'Pengemudi Kendaraan Operasional') {

                if ($template_pengurangan->sewa == 'Mobil dan Pengemudi') {
                    $count_mobil++;
                    $count_driver++;
                }elseif ($template_pengurangan->sewa == 'Mobil') {
                    $count_mobil++;
                }elseif($template_pengurangan->sewa == 'Pengemudi'){
                    $count_driver++;
                }


                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $phpWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0));
                $phpWord->addParagraphStyle('boldpJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0,'bold' =>true));
                $phpWord->addFontStyle('bold',array('bold' =>true));
                $phpWord->addFontStyle('bold_underline',array('bold' =>true,'underline' =>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

                                 $section = $phpWord->addSection();

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 $no_surat = $template_pengurangan->no_surat; 
                                 $tgl_surat = $template_pengurangan->tgl_surat;

                                 $kepada = "Kepada,";
                                 $nama_vendor = $template_pengurangan->nama_vendor; 
                                 $alamat_vendor = $template_pengurangan->alamat_vendor; 
                                 
                                 $yth = "Up. Yth. ".$vendors->Pejabatvendor." - ".$template_pengurangan->jabatan_vendor;

                                 $perihal = "Penghentian Sewa ".$template_pengurangan->sewa;

                                 $dengan_hormat = "Dengan hormat,";

                                 $description = "Menunjuk ".$template_pengurangan->pks." No. ".$template_pengurangan->no_pks." tanggal ".strftime("%d %B %Y", strtotime($template_pengurangan->tgl_pks)).", dengan ini kami sampaikan penghentian sewa pengemudi sebanyak ".$template_pengurangan->jml_driver." (".terbilang($template_pengurangan->jml_driver).") orang, dengan data sebagai berikut :
                                 ";

                                 $demikian = "Demikian kami sampaikan, atas perhatian dan kerjasama Bapak kami ucapkan terima kasih.";
                                 $hormat_kami = "Hormat kami,";
                                 $nama_bank = "PT BANK CENTRAL ASIA, Tbk";

                                 $unitkerja = $template_pengurangan->unitkerja_pb1." ".$template_pengurangan->unitkerja_pb2;

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 $section->addText("");
                                 $section->addText('No. '.$no_surat."\t\t\t\t\t".$tgl_surat);
                                 $section->addText($kepada);
                                 $section->addText($nama_vendor."<w:br/>".$alamat_vendor, ['bold' => true]);
                                 $section->addText($yth, ['bold' => true]);
                                 $section->addText("Perihal : ".$perihal);
                                 $section->addText($dengan_hormat);
                                 $section->addText($description,'textstyle','pJustify');
                                 $section->addText("",'textstyle','pJustify');

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                                 $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999');
                                 $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'ffffff');
                                 $cellRowContinue = array('vMerge' => 'continue');
                                 $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
                                 $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
                                 $cellVCentered = array('valign' => 'center');

                                 $spanTableStyleName = 'Colspan Rowspan';
                                 $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
                                 $table = $section->addTable($spanTableStyleName);

                                 $table->addRow();

                                 $cell1 = $table->addCell(500, $cellRowSpan);
                                 $textrun1 = $cell1->addTextRun($cellHCentered);
                                 $textrun1->addText('No',['bold' => true]);

                                 $cell2 = $table->addCell(2800, $cellRowSpan);
                                 $textrun2 = $cell2->addTextRun($cellHCentered);
                                 $textrun2->addText('Nama Cabang / Unit Kerja',['bold' => true]);

                                 $cell3 = $table->addCell(2800, $cellRowSpan);
                                 $textrun3 = $cell3->addTextRun($cellHCentered);
                                 $textrun3->addText('Kode Cabang / RCC',['bold' => true]);

                                 $cell4 = $table->addCell(2800, $cellRowSpan);
                                 $textrun4 = $cell4->addTextRun($cellHCentered);
                                 $textrun4->addText('Tgl. Efektif',['bold' => true]);

                                 $table->addRow();
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);

                                 $i = 1;
                                 foreach ($table_template_pengurangans as $table_template_pengurangan) {
                                     $mobil = Mobil::find($table_template_pengurangan->merek);

                                     $table->addRow();
                                     $table->addCell(500)->addText("{$i}",null, $cellHCentered);
                                     $table->addCell(2800)->addText($table_template_pengurangan->nama_cabang,null, $cellHCentered);
                                     $table->addCell(2800)->addText($table_template_pengurangan->kode_cabang,null, $cellHCentered);
                                     $table->addCell(2800)->addText(strftime("%d %B %Y", strtotime($table_template_pengurangan->tgl_efektif)),null,$cellHCentered);
                                     $i++;
                                 }

       


                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                                 $section->addText("<w:br/>".$demikian);
                                 $section->addText($hormat_kami);
                                 $section->addText($nama_bank,'bold','boldpJustify');

                                 $table = $section->addTable();
                                 $table->addRow();
                                 if ($template_pengurangan->unitkerja_pb1 == $template_pengurangan->unitkerja_pb2) {
                                     $table->addCell(3000)->addText($template_pengurangan->unitkerja_pb1);
                                     $table->addCell(3000)->addText('');
                                  }else{
                                     $table->addCell(3000)->addText($template_pengurangan->unitkerja_pb1);
                                     $table->addCell(3000)->addText($template_pengurangan->unitkerja_pb2);
                                  }
                                 
                                 $section->addTextBreak(4);

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


                                 $table = $section->addTable();
                                 
                                 $table->addRow();
                                 $table->addCell(3000)->addText($template_pengurangan->nama_pb1,'bold_underline','boldpJustify');
                                 $table->addCell(3000)->addText($template_pengurangan->nama_pb2,'bold_underline','boldpJustify');
                                 $table->addRow();
                                 $table->addCell(3000)->addText($template_pengurangan->jabatan_pb1);
                                 $table->addCell(3000)->addText($template_pengurangan->jabatan_pb2);


                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 $section->addText("\n");
                                 $section->addText('CC : - BOP','','boldpJustify');
                                 $section->addText("        ".'- BPL');
                                 

                                 $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

                                 try {

                                     $objWriter->save(storage_path('SuratCutoff.docx'));

                                 } catch (Exception $e) {

                                 }

                                 return response()->download(storage_path('SuratCutoff.docx'));
               
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`

            }else{

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   

                if ($template_pengurangan->sewa == 'Mobil dan Pengemudi') {
                    $count_mobil++;
                    $count_driver++;
                }elseif ($template_pengurangan->sewa == 'Mobil') {
                    $count_mobil++;
                }elseif($template_pengurangan->sewa == 'Pengemudi'){
                    $count_driver++;
                }


                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $phpWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0));
                $phpWord->addParagraphStyle('boldpJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0,'bold' =>true));
                $phpWord->addFontStyle('bold',array('bold' =>true));
                $phpWord->addFontStyle('bold_underline',array('bold' =>true,'underline' =>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

                                 $section = $phpWord->addSection();

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 $no_surat = $template_pengurangan->no_surat; 
                                 $tgl_surat = $template_pengurangan->tgl_surat;

                                 $kepada = "Kepada,";
                                 $nama_vendor = $template_pengurangan->nama_vendor; 
                                 $alamat_vendor = $template_pengurangan->alamat_vendor; 
                                 
                                 $yth = "Up. Yth. ".$vendors->Pejabatvendor." - ".$template_pengurangan->jabatan_vendor;

                                 $perihal = "Penghentian Sewa ".$template_pengurangan->sewa;

                                 $dengan_hormat = "Dengan hormat,";

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SYARAT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                                 $mobil = '';
                                 $driver = '';
                                 $dan = '';

                                 if ($template_pengurangan->jml_mobil != 0) {
                                     $mobil = "sewa mobil sebanyak ".$template_pengurangan->jml_mobil." (".terbilang($template_pengurangan->jml_mobil).") unit";
                                 }

                                 if ($template_pengurangan->jml_driver != 0) {
                                     $driver = "sewa pengemudi sebanyak ".$template_pengurangan->jml_driver." (".terbilang($template_pengurangan->jml_driver).") orang";
                                 }

                                 if ($template_pengurangan->jml_driver != 0 && $template_pengurangan->jml_mobil!= 0) {
                                     $dan = ' dan ';
                                 }


                                 $description = "Menunjuk ".$template_pengurangan->pks." No. ".$template_pengurangan->no_pks." tanggal ".strftime("%d %B %Y", strtotime($template_pengurangan->tgl_pks)).", dengan ini kami sampaikan penghentian ".$mobil."".$dan."".$driver.", dengan data sebagai berikut :
                                 ";

                                 $demikian = "Demikian kami sampaikan, atas perhatian dan kerjasama Bapak kami ucapkan terima kasih.";
                                 $hormat_kami = "Hormat kami,";
                                 $nama_bank = "PT BANK CENTRAL ASIA, Tbk";

                                 $unitkerja = $template_pengurangan->unitkerja_pb1." ".$template_pengurangan->unitkerja_pb2;

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 $section->addText("");
                                 $section->addText('No. '.$no_surat."\t\t\t\t\t".$tgl_surat);
                                 $section->addText($kepada);
                                 $section->addText($nama_vendor."<w:br/>".$alamat_vendor, ['bold' => true]);
                                 $section->addText($yth, ['bold' => true]);
                                 $section->addText("Perihal : ".$perihal);
                                 $section->addText($dengan_hormat);
                                 $section->addText($description,'textstyle','pJustify');
                                 $section->addText("",'textstyle','pJustify');

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                                 $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999');
                                 $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'ffffff');
                                 $cellRowContinue = array('vMerge' => 'continue');
                                 $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
                                 $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
                                 $cellVCentered = array('valign' => 'center');

                                 $spanTableStyleName = 'Colspan Rowspan';
                                 $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
                                 $table = $section->addTable($spanTableStyleName);

                                 $table->addRow();

                                 $cell1 = $table->addCell(500, $cellRowSpan);
                                 $textrun1 = $cell1->addTextRun($cellHCentered);
                                 $textrun1->addText('No',['bold' => true]);

                                 $cell2 = $table->addCell(2000, $cellRowSpan);
                                 $textrun2 = $cell2->addTextRun($cellHCentered);
                                 $textrun2->addText('Nama Cabang',['bold' => true]);

                                 $cell3 = $table->addCell(2000, $cellRowSpan);
                                 $textrun3 = $cell3->addTextRun($cellHCentered);
                                 $textrun3->addText('Kode Cab. / RCC',['bold' => true]);

                                 $cell4 = $table->addCell(2000, $cellRowSpan);
                                 $textrun4 = $cell4->addTextRun($cellHCentered);
                                 $textrun4->addText('Merk/Type/Tahun',['bold' => true]);

                                 $cell5 = $table->addCell(2000, $cellRowSpan);
                                 $textrun5 = $cell5->addTextRun($cellHCentered);
                                 $textrun5->addText('No. Polisi',['bold' => true]);

                                 $cell6 = $table->addCell(2000, $cellRowSpan);
                                 $textrun6 = $cell6->addTextRun($cellHCentered);
                                 $textrun6->addText('Tgl. Efektif',['bold' => true]);

                                 $cell7 = $table->addCell(2000, $cellRowSpan);
                                 $textrun7 = $cell7->addTextRun($cellHCentered);
                                 $textrun7->addText('Keterangan',['bold' => true]);

                                 $table->addRow();
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);
                                 $table->addCell(null, $cellRowContinue);

                                 $i = 1;
                                 foreach ($table_template_pengurangans as $table_template_pengurangan) {
                                     $mobil = Mobil::find($table_template_pengurangan->merek);

                                     $table->addRow();
                                     $table->addCell(500)->addText("{$i}",null, $cellHCentered);
                                     $table->addCell(1000)->addText($table_template_pengurangan->nama_cabang,null, $cellHCentered);
                                     $table->addCell(1000)->addText($table_template_pengurangan->kode_cabang,null, $cellHCentered);

                                     if ($table_template_pengurangan->merek == '') {

                                         $table->addCell(2000)->addText('');

                                     }else{

                                        

                                        $table->addCell(2000)->addText($mobil->MerekMobil." ".$mobil->Type." ".$mobil->Tahun,null,$cellHCentered);
                                     }


                                     $table->addCell(2000)->addText($table_template_pengurangan->nopol,null,$cellHCentered);
                                     $table->addCell(2000)->addText(strftime("%d %B %Y", strtotime($table_template_pengurangan->tgl_efektif)),null,$cellHCentered);
                                     $table->addCell(2000)->addText($table_template_pengurangan->keterangan,null,$cellHCentered);
                                     $i++;
                                 }

       


                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                                 $section->addText("<w:br/>".$demikian);
                                 $section->addText($hormat_kami);
                                 $section->addText($nama_bank,'bold','boldpJustify');


                                 $table = $section->addTable();
                                 $table->addRow();
                                 if ($template_pengurangan->unitkerja_pb1 == $template_pengurangan->unitkerja_pb2) {
                                     $table->addCell(3000)->addText($template_pengurangan->unitkerja_pb1);
                                     $table->addCell(3000)->addText('');
                                  }else{
                                     $table->addCell(3000)->addText($template_pengurangan->unitkerja_pb1);
                                     $table->addCell(3000)->addText($template_pengurangan->unitkerja_pb2);
                                  }
                                 
                                 $section->addTextBreak(4);

                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


                                 $table = $section->addTable();
                                 
                                 $table->addRow();
                                 $table->addCell(3000)->addText($template_pengurangan->nama_pb1,'bold_underline','boldpJustify');
                                 $table->addCell(3000)->addText($template_pengurangan->nama_pb2,'bold_underline','boldpJustify');
                                 $table->addRow();
                                 $table->addCell(3000)->addText($template_pengurangan->jabatan_pb1);
                                 $table->addCell(3000)->addText($template_pengurangan->jabatan_pb2);


                                 // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 $section->addText("\n");
                                 $section->addText('CC : - BOP','','boldpJustify');
                                 $section->addText("        ".'- BPL');

                                 $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

                                 try {

                                     $objWriter->save(storage_path('SuratCutoff.docx'));

                                 } catch (Exception $e) {

                                 }

                                 return response()->download(storage_path('SuratCutoff.docx'));
            }
    }

    public function index_perubahan()
    {
             $template_perubahans = template_perubahan::paginate(1000)->sortByDesc('id');
             $vendor_uniques = $template_perubahans->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_perubahans = table_template_perubahan::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             $s = 'active';
             return view('surat/perubahan/index',compact('template_perubahans','table_template_perubahans','s','vendor_uniques','vendors'));
    }   

    public function index_perubahan_status($status)
    {
             $template_perubahans = template_perubahan::paginate(1000)->sortByDesc('id');
             $vendor_uniques = $template_perubahans->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_perubahans = table_template_perubahan::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             $s = $status;
             return view('surat/perubahan/index',compact('template_perubahans','table_template_perubahans','s','vendor_uniques','vendors'));
    }   

    public function view_perubahan($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $nopos = Nopo::all();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $template_perubahan = template_perubahan::find($id);
        $table_template_perubahans = table_template_perubahan::all()->sortByDesc('id');
        // $table_template_perubahan = table_template_perubahan::find($single_id);
        // $po_id = tpo::find($table_template_perubahan->po_id);
        $poss = tpo::all();
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        return view('surat/perubahan/view',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_perubahan','table_template_perubahans','pkss','addendums'));
    }

    public function status_perubahan(Request $request)
    {
        $request->validate([
            'status.*' => 'nullable',
        ]);

        $status = $request->status;

        $return = 0;

        if ($status == '') {
            return redirect('/backend/surat/perubahan')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {

               $Status = template_perubahan::find($status[$count]);
               if ($Status->status != '1') {
                   $Status->status = '1';
                   $Status->save();
                   $return = 1;
               }else{
                    $Status->status = '';
                    $Status->save();
                    $return = 0;
               }
            }

            return redirect('/backend/surat/perubahan');

        }
        
    }
                
    public function download_perubahan($id)
    {
            function terbilang($tanggal){
              $terbilang = '';
              if ($tanggal == '1') {
                $terbilang = 'satu';
              }else if($tanggal == '2') {
                $terbilang = 'dua';
              }else if($tanggal == '3') {
                $terbilang = 'tiga';
              }else if($tanggal == '4') {
                $terbilang = 'empat';
              }else if($tanggal == '5') {
                $terbilang = 'lima';
              }else if($tanggal == '6') {
                $terbilang = 'enam';
              }else if($tanggal == '7') {
                $terbilang = 'tujuh';
              }else if($tanggal == '8') {
                $terbilang = 'delapan';
              }else if($tanggal == '9') {
                $terbilang = 'sembilan';
              }else if($tanggal == '10') {
                $terbilang = 'sepuluh';
              }else if($tanggal == '0') {
                $terbilang = 'nol';
              }

              return $terbilang;
            }

            setlocale(LC_ALL, 'id-ID', 'id_ID');
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');


            $template_perubahan = template_perubahan::find($id);
            $pos = tpo::all();
            $table_template_perubahans = table_template_perubahan::where('template_id',$id)->get();
            $vendors = Vendor::where('NamaVendor',$template_perubahan->nama_vendor)->first();
            $count_mobil = 0;
            $count_driver = 0;
            foreach ($table_template_perubahans as $table_template_perubahan) {
                foreach ($pos as $po) {
                    if ($table_template_perubahan->po_id == $po->id) {
                        if ($po->Sewa_sementara == 'Mobil+Driver') {
                            $count_mobil++;
                            $count_driver++;
                        }else if($po->Sewa_sementara == 'Mobil'){
                            $count_mobil++;
                        }else if($po->Sewa_sementara == 'Driver'){
                            $count_driver++;
                        }
                    }
                }
            }



            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $phpWord->addParagraphStyle('pJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0));
            $phpWord->addParagraphStyle('boldpJustify', array('align' => 'both', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0,'bold' =>true));
            $phpWord->addFontStyle('bold',array('bold' =>true));
            $phpWord->addFontStyle('justbold',array('bold' =>true));
            $phpWord->addFontStyle('bold_underline',array('bold' =>true,'underline' =>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
                             // //add this style then append it to text below
                             // $section->addText('something', 'textstyle', 'pJustify');
                             // //the text behind this will be justified and will be in a new line, not in a new paragraph
                             // $section->addText('behind', 'textstyle', 'pJustify');

                             $section = $phpWord->addSection();

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             $no_surat = $template_perubahan->no_surat; 
                             $tgl_surat = 'Jakarta, '.strftime("%d %B %Y", strtotime($template_perubahan->created_at));

                             $kepada = "Kepada,";
                             $nama_vendor = $template_perubahan->nama_vendor; 
                             $alamat_vendor = $template_perubahan->alamat_vendor; 
                             
                             $yth = "Up. Yth. ".$vendors->Pejabatvendor." - ".$template_perubahan->jabatan_vendor;

                             $perihal = "Perubahan Data Pairing";
                             $dengan_hormat = "Dengan hormat,";

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SYARAT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             $mobil = '';
                             $driver = '';
                             $dan = '';

                             // if ($count_mobil != 0) {
                             //     $mobil = "sewa mobil sebanyak ".$count_mobil." (".terbilang($count_mobil).") unit";
                             // }

                             // if ($count_driver != 0) {
                             //     $driver = "sewa pengemudi sebanyak ".$count_driver." (".terbilang($count_driver).") orang";
                             // }

                             // if ($count_driver != 0 && $count_mobil != 0) {
                             //     $dan = ' dan ';
                             // }
                             
                             // $description = "Menunjuk ".$template_perubahan->pks." No. ".$template_perubahan->no_pks." tanggal ".strftime("%d %B %Y", strtotime($template_perubahan->tgl_pks)).", dengan ini kami sampaikan perubahan ".$mobil."".$dan."".$driver.", dengan data sebagai berikut :
                             // ";

                             $description = "Menunjuk ".$template_perubahan->pks." No. ".$template_perubahan->no_pks." tanggal ".strftime("%d %B %Y", strtotime($template_perubahan->tgl_pks)).", dengan ini kami sampaikan perubahan data pairing sebanyak ".count($table_template_perubahans)." ".terbilang(count($table_template_perubahans))." unit, dengan data sebagai berikut : ";

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SYARAT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             

                             $demikian = "Demikian kami sampaikan, atas perhatian dan kerjasama Bapak kami ucapkan terima kasih.";
                             $hormat_kami = "Hormat kami,";
                             $nama_bank = "PT BANK CENTRAL ASIA, Tbk";

                             $unitkerja = $template_perubahan->unitkerja_pb1." ".$template_perubahan->unitkerja_pb2;


                             $phpWord->addFontStyle($nama_vendor, array('bold' => true));

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             $section->addText("");
                             $section->addText('No. '.$no_surat."\t\t\t\t\t\t".$tgl_surat);
                             $section->addText($kepada,'textstyle','pJustify');
                             $section->addText($nama_vendor,'bold','pJustify');
                             $section->addText($alamat_vendor,'justbold');
                             $section->addText($yth, ['bold' => true]);
                             $section->addText("Perihal : ".$perihal);
                             $section->addText($dengan_hormat);
                             $section->addText($description,'textstyle','pJustify');
                                 $section->addText("",'textstyle','pJustify');

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999');
                             $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'ffffff');
                             $cellRowContinue = array('vMerge' => 'continue');
                             $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
                             $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
                             $cellVCentered = array('valign' => 'center');

                             $spanTableStyleName = 'Colspan Rowspan';
                             $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
                             $table = $section->addTable($spanTableStyleName);

                             $table->addRow();

                             $cell1 = $table->addCell(500, $cellRowSpan);
                             $textrun1 = $cell1->addTextRun($cellHCentered);
                             $textrun1->addText('No',['bold' => true]);

                             $cell2 = $table->addCell(500, $cellRowSpan);
                             $textrun2 = $cell2->addTextRun($cellHCentered);
                             $textrun2->addText('Nama Cabang',['bold' => true]);

                             $cell3 = $table->addCell(2000, $cellRowSpan);
                             $textrun3 = $cell3->addTextRun($cellHCentered);
                             $textrun3->addText('Kode Cab. / RCC',['bold' => true]);

                             $cell4 = $table->addCell(2000, $cellRowSpan);
                             $textrun4 = $cell4->addTextRun($cellHCentered);
                             $textrun4->addText('Merek/Type/ Tahun',['bold' => true]);

                             $cell5 = $table->addCell(4000, $cellRowSpan);
                             $textrun5 = $cell5->addTextRun($cellHCentered);
                             $textrun5->addText('No. Polisi',['bold' => true]);

                             $cell6 = $table->addCell(4000, $cellRowSpan);
                             $textrun6 = $cell6->addTextRun($cellHCentered);
                             $textrun6->addText('Data Pairing Lama',['bold' => true]);

                             $cell7 = $table->addCell(4000, $cellRowSpan);
                             $textrun7 = $cell7->addTextRun($cellHCentered);
                             $textrun7->addText('Data Pairing Baru',['bold' => true]);

                             $cell8 = $table->addCell(4000, $cellRowSpan);
                             $textrun8 = $cell8->addTextRun($cellHCentered);
                             $textrun8->addText('Tgl. Efektif',['bold' => true]);

                             $table->addRow();
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);
                             $table->addCell(null, $cellRowContinue);

                             $i = 1;
                             foreach ($table_template_perubahans as $table_template_perubahan) {
                                 $mobil = Mobil::find($table_template_perubahan->merek);

                                 $table->addRow();
                                 $table->addCell(500)->addText("{$i}",$cellVCentered, $cellHCentered);
                                 $table->addCell(2000)->addText($table_template_perubahan->nama_cabang,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_perubahan->kode_cabang,null,$cellHCentered);
                                     
                                 $table->addCell(2000)->addText($mobil->MerekMobil." ".$mobil->Type,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_perubahan->nopol,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_perubahan->data_pairing_lama,null,$cellHCentered);
                                 $table->addCell(2000)->addText($table_template_perubahan->data_pairing_baru,null,$cellHCentered);
                                 $table->addCell(2000)->addText(strftime("%d %B %Y", strtotime($table_template_perubahan->tgl_efektif)),null,$cellHCentered);
                                 $i++;
                             }

   


                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                             $section->addText("<w:br/>".$demikian);
                             $section->addText($hormat_kami);
                             $section->addText($nama_bank,'bold','boldpJustify');

                             $table = $section->addTable();
                             $table->addRow();
                             if ($template_perubahan->unitkerja_pb1 == $template_perubahan->unitkerja_pb2) {
                                $table->addCell(3000)->addText($template_perubahan->unitkerja_pb1);
                                $table->addCell(3000)->addText('');
                             }else{
                                $table->addCell(3000)->addText($template_perubahan->unitkerja_pb1);
                                $table->addCell(3000)->addText($template_perubahan->unitkerja_pb2);
                             }
                             
                             $section->addTextBreak(4);

                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


                             $table = $section->addTable();
                             
                             $table->addRow();
                             $table->addCell(3000)->addText($template_perubahan->nama_pb1,'bold_underline','boldpJustify');
                             $table->addCell(3000)->addText($template_perubahan->nama_pb2,'bold_underline','boldpJustify');
                             $table->addRow();
                             $table->addCell(3000)->addText($template_perubahan->jabatan_pb1);
                             $table->addCell(3000)->addText($template_perubahan->jabatan_pb2);


                             // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             $section->addText("\n");
                             $section->addText('CC : - BOP','','boldpJustify');
                             $section->addText("        ".'- BPL');

                             $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

                             try {

                                 $objWriter->save(storage_path('SuratPerubahanDataPairing.docx'));

                             } catch (Exception $e) {

                             }

                             return response()->download(storage_path('SuratPerubahanDataPairing.docx'));
    }
}
