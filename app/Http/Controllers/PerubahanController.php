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
use App\bbm;
use App\pks;
use App\addendum;
use App\backup_pengurangan;
use App\approve;
use PDF;
use App\tampungan_perubahan;

class PerubahanController extends Controller
{
    //
    public function perubahan_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::whereNotNull('perubahan')->get();
        $tp_perubahans = tampungan_perubahan::all();
        return view('PO/perubahan',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','tp_perubahans'));
    }

    public function form_perubahan_po($id)
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
        // $poss = tpo::find($request->get('relokasi'));
        $poss = tpo::where('id',$id)->get();
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        return view('PO/form_perubahan',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
    }
        
    // public function form_perubahan_multiple_po(Request $request)
    // {
    //     $po_single = tpo::find($request->perubahan[0]);
    //     $cabangs = Cabang::all();
    //     $mobils = Mobil::all();
    //     $umps = ump::all();
    //     $vendors = Vendor::all();
    //     $drivers = Driver::all();
    //     $nopos = Nopo::all();
    //     $jabatans = jabatan::all();
    //     $unitkerjas = unitkerja::all();
    //     $pejabats = pejabat::all()->sortBy('nama');
    //     $pkss = pks::all()->sortBy('no_pks');
    //     $addendums = addendum::all()->sortBy('id');
    //     // $poss = tpo::find($request->get('relokasi'));
    //     if ($request->get('perubahan') != '') {
    //         $poss = tpo::whereIn('id',$request->get('perubahan'))->get();
    //         for ($i=0; $i < $poss->count(); $i++) { 
    //           if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
    //              $pos = tpo::all();
    //              return redirect('/backend/po/perubahan')->with('warning','Tolong pilih vendor yang sama');
    //           }
    //         }
    //         return view('PO/form_perubahan',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
    //     }else{
    //         $pos = tpo::all();
    //         return redirect('/backend/po/perubahan')->with('warning','Tidak ada item yang dipilih');
    //         // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
    //     }
    // }


    public function form_perubahan_multiple_po_button(Request $request)
    {
        $perubahan = tampungan_perubahan::all()->pluck('po_id')->toarray();
        $po_single = tpo::find($perubahan[0]);
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $nopos = Nopo::all();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        // $poss = tpo::find($request->get('relokasi'));
        if (tampungan_perubahan::all()->count() != 0) {
            $poss = tpo::whereIn('id',tampungan_perubahan::all()->pluck('po_id')->toarray())->get();
            for ($i=0; $i < tampungan_perubahan::all()->count(); $i++) { 
              if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
                 $pos = tpo::all();
                 return redirect('/backend/po/perubahan')->with('warning','Tolong pilih vendor yang sama');
              }
            }
            return view('PO/form_perubahan',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
        }else{
            $pos = tpo::all();
            return redirect('/backend/po/perubahan')->with('warning','Tidak ada item yang dipilih');
            // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
        }
    }

    

    public function form_update_perubahan_multiple_po($id,$single_id)
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
        $table_template_perubahan = table_template_perubahan::find($single_id);
        $po_id = tpo::find($table_template_perubahan->po_id);
        $poss = tpo::all();
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        return view('PO/form_update_perubahan_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_perubahan','table_template_perubahan','table_template_perubahans','po_id','pkss','addendums'));
    }


    public function po_edit_perubahan_multiple(Request $request, $id)

    {
        
        $template_perubahan = new template_perubahan();

        $template_perubahan->no_surat = $request->get('no_surat');
        $template_perubahan->tgl_surat = $request->get('tgl_surat');
        $template_perubahan->nama_vendor = $request->get('nama_vendor');
        $template_perubahan->pic_vendor = $request->get('pic_vendor');
        $template_perubahan->jabatan_vendor = $request->get('jabatan_vendor');
        $template_perubahan->alamat_vendor = $request->get('alamat_vendor');
        $template_perubahan->sewa = 'Perubahan Data Pairing';
        $template_perubahan->jml_mobil = $request->get('jml_mobil');
        $template_perubahan->jml_driver = $request->get('jml_driver');

        $template_perubahan->pks = $request->get('pks');
        $template_perubahan->no_pks = $request->get('no_pks');
        $template_perubahan->tgl_pks = $request->get('tgl_pks');

        $template_perubahan->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_perubahan->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_perubahan->nama_pb1 = $request->get('nama_pb1');
        $template_perubahan->nama_pb2 = $request->get('nama_pb2');
        $template_perubahan->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_perubahan->jabatan_pb2 = $request->get('jabatan_pb2');

        $template_perubahan->save();

        $request->validate([
            'po_id.*' => 'nullable',
            'nopo_lama.*' => 'nullable',
            'nopo_relokasi.*' => 'nullable',
            'cabang_relokasi.*' => 'required',
            'tgl_efektif.*' => 'required',
            'nopol.*' => 'nullable',
            'status_cabang_lama.*' => 'nullable',
            'nama_cabang_lama.*' => 'nullable',
            'kode_cabang_lama.*' => 'nullable',
            'mobil_id.*' => 'nullable',
            'sewa.*' => 'nullable',
            'sewa_lama.*' => 'nullable',
            'cabang_id.*' => 'nullable',
            'sewa_pengurangan.*' => 'nullable'
        ]);


        $Po_id = $request->po_id;
        $po_id = $request->po_id;
        $Sewa = $request->sewa;
        $sewa = $request->sewa_pengurangan;
        $Sewa_lama = $request->sewa_lama;
        $NoPo = $request->nopo_lama;
        $Cabang_relokasi = $request->cabang_relokasi;
        $Tgl_efektif = $request->tgl_efektif;
        $tgl_cutoff = $request->tgl_efektif;
        $Cabang_id = $request->cabang_lama;
        $Nopo_relokasi = $request->nopo_relokasi;
        $Mobil_id = $request->mobil_id;
        $Cabang_id = $request->cabang_id;

        $nopol = $request->nopol;
        $status_cabang_lama = $request->status_cabang_lama;
        $nama_cabang_lama = $request->nama_cabang_lama;
        $kode_cabang_lama = $request->kode_cabang_lama;

        $jumlah = 0;
        for($count = 0; $count < count($Po_id); $count++)
        {
            if ($sewa[$count] != 'Mobil+Driver') {
              
                   $po = tpo::find($Po_id[$count]);     
                   $timeline = new timeline();      
                   $pengurangan = new pengurangan();       
                   $table_template_perubahan = new table_template_perubahan();

                   // _____________PENGURANGAN____________

                   $backup_pengurangan = new backup_pengurangan();
                   $drivers = Driver::where('Po_id','=',$po_id[$count])->get();
                   $history = historydriver::where('Po_id',$po_id[$count])->WhereNull('tgl_selesai')->first();

                   // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                   if ($po->Driver_id != '') {
                       $drivers2 = DB::table('drivers')->where('Po_id', $po_id[$count])->value('id'); 
                       $report_driver = report_driver::where('driver_id',$drivers2)->WhereNull('tgl_selesai')->first();
                       $driver = Driver::find($drivers2);

                       $timeline = new timeline;
                       $timeline->po_id = $po_id[$count];
                       date_default_timezone_set('Asia/Jakarta');
                       $currentDateTime2 = date('Y-m-d H:i:s');
                       $timeline->tanggal = $currentDateTime2;
                       if (auth::user()->status == 'operasional') {
                           $user_status = 'BOP';
                       }elseif(auth::user()->status == 'pengada'){
                           $user_status = 'BPD';
                       }elseif(auth::user()->status == 'blk'){
                           $user_status = 'BLK';
                       }elseif(auth::user()->status == 'admin'){
                           $user_status = 'ADMIN';
                       }
                       $timeline->judul = 'Delete driver - '.$user_status;
                       $timeline->ket1 = 'driver : '.$driver->NamaDriver;
                       $timeline->ket3 = 'tgl selesai : '.$tgl_cutoff[$count];
                       $timeline->user_id = auth::user()->name;

                       $timeline->save();
                   }

                   // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                   $backup_pengurangan->po_id = $po->id;
                   $backup_pengurangan->Sewa_sementara = $po->Sewa_sementara;
                   $backup_pengurangan->NoPo = $po->NoPo;
                   $backup_pengurangan->Nopo_pengurangan = $request->get('no_surat');
                   $backup_pengurangan->Pengurangan = $po->Pengurangan;
                   $backup_pengurangan->Tgl_cutoff = $po->Tgl_cutoff;
                   $backup_pengurangan->Tgl_cutoff_driver = $po->Tgl_cutoff_driver;
                   $backup_pengurangan->Hargasewamobil = $po->HargaSewaMobil;
                   $backup_pengurangan->Hargasewadriver = $po->HargaSewaDriver2019;
                   $backup_pengurangan->Driver_id = $po->Driver_id;


                   if ($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil+Driver') {
                       if($sewa[$count] == 'Mobil'){
                           $po->Sewa_sementara = 'Driver';
                       }elseif ($sewa[$count] == 'Driver') {
                           $po->Sewa_Sementara = 'Mobil';
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;              
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';

                               $driver->save();
                           }
                       }else{
                           $po->Sewa_sementara = 'null';
                           // $po->Hargasewamobil_pengurangan = '0';
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }
                   }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil'){
                       if($sewa[$count] == 'Mobil'){
                           $po->Sewa_sementara = 'null';
                           // $po->Hargasewamobil_pengurangan = '0';
                       }else{
                           $po->Sewa_sementara = 'null';
                           // $po->Hargasewamobil_pengurangan = '0';
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }
                   }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Driver'){
                       if($sewa[$count] == 'Driver'){
                           $po->Sewa_sementara = 'null';
                           // $po->Hargasewamobil_pengurangan = '0';
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }else{
                           $po->Sewa_sementara = 'null';
                           // $po->Hargasewamobil_pengurangan = '0';
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }
                   }else{
                       if ($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Mobil+Driver') {
                           $po->Sewa_sementara = 'null';
                           // $po->Hargasewadriver_relokasi = '0';
                           // $po->Hargasewamobil_pengurangan = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }elseif($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Driver'){
                           $po->Sewa_sementara = 'Mobil';
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }elseif($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Mobil'){
                           $po->Sewa_sementara = 'Driver';
                           // $po->Hargasewamobil_pengurangan = '0';
                       }elseif($po->Sewa_sementara == 'Driver' && $sewa[$count] == 'Driver'){
                           $po->Sewa_sementara = 'null';
                           
                           // $po->Hargasewadriver_relokasi = '0';
                           if($po->Driver_id != '' && $po->Tgl_cutoff_driver == ''){
                               $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
                           }
                           $po->Driver_id = '';
                           
                           $po->MulaiSewa2 = null;
                           $po->SelesaiSewa2 = null;
                           if (isset($history)) {
                               $history->tgl_selesai = $tgl_cutoff[$count];
                           }
                           if (isset($report_driver)) {
                               $report_driver->tgl_selesai = $tgl_cutoff[$count];
                           }
                           foreach($drivers as $driver) {
                               $driver->Po_id = '';
                               $driver->save();
                           }
                       }elseif($po->Sewa_sementara == 'Mobil' && $sewa[$count] == 'Mobil'){
                           $po->Sewa_sementara = 'null';
                       }
                   }



                   $po->NoPo = $NoPo[$count];
                   $po->Tgl_cutoff = $Tgl_efektif[$count];
                   $po->Pengurangan = $sewa[$count];
                   $po->Sewa = $Sewa_lama[$count];
                   $po->Nopo_perubahan = $request->get('no_surat');

                   $po->data_pairing_baru = $Sewa[$count];
                   $po->tgl_efektif_perubahan = $Tgl_efektif[$count];

                   $po->save();

                   $pengurangan->po_id = $Po_id[$count];
                   $pengurangan->Nopo_pengurangan = $request->get('no_surat');
                   $pengurangan->perubahan = $Sewa[$count];
                   $pengurangan->tgl_efektif = $Tgl_efektif[$count];
                   $pengurangan->save();

                   $cabang = Cabang::find($Cabang_relokasi[$count]);

                   $timeline = new timeline(); 
                   $timeline->po_id = $Po_id[$count];
                   date_default_timezone_set('Asia/Jakarta');
                   $currentDateTime2 = date('Y-m-d H:i:s');
                   $timeline->tanggal = $currentDateTime2;
                   if (auth::user()->status == 'operasional') {
                       $user_status = 'BOP';
                   }elseif(auth::user()->status == 'pengada'){
                       $user_status = 'BPD';
                   }elseif(auth::user()->status == 'blk'){
                       $user_status = 'BLK';
                   }elseif(auth::user()->status == 'admin'){
                       $user_status = 'ADMIN';
                   }
                   $timeline->judul = 'Perubahan pairing - '.$user_status;
                   $timeline->ket1 = 'nopo : '.$request->get('no_surat');
                   $timeline->ket2 = 'Perubahan pairing : '.$Sewa[$count];
                   $timeline->ket3 = 'tgl efektif : '.$Tgl_efektif[$count];
                   $timeline->user_id = auth::user()->name;
                   
                   $timeline->save();

                   $mobil = Mobil::find($Mobil_id[$count]); 
                   $cabang = Cabang::find($Cabang_id[$count]);
                   $table_template_perubahan->template_id = $template_perubahan->id;
                   $table_template_perubahan->po_id = $po->id;
                   $table_template_perubahan->nama_cabang = $cabang->NamaCabang;
                   $table_template_perubahan->kode_cabang = $cabang->KodeCabang;
                   $table_template_perubahan->merek = $mobil->id;
                   $table_template_perubahan->nopol = $nopol[$count];
                   $table_template_perubahan->data_pairing_lama = $Sewa_lama[$count];
                   $table_template_perubahan->data_pairing_baru = $Sewa[$count];
                   $table_template_perubahan->tgl_efektif = $Tgl_efektif[$count];

                   $table_template_perubahan->save();

                   $backup_pengurangan->template_id = $template_perubahan->id;
                   $backup_pengurangan->table_template_id = $table_template_perubahan->id;
                   $backup_pengurangan->save();

                   $approve = new approve();
                   $approve->po_id = $po->id;
                   $approve->template_id = $template_perubahan->id;
                   $approve->kategori = 'perubahan';
                   $approve->approve = 'waiting';
                   $approve->save();

                   $jumlah++;

                   if (isset($history)) {
                       $history->save();
                   }

            }else{
              
               $po = tpo::find($Po_id[$count]);  
               $timeline = new timeline();      
               $pengurangan = new pengurangan();   
               $backup_pengurangan = new backup_pengurangan();
               $table_template_perubahan = new table_template_perubahan();

                // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               $backup_pengurangan->po_id = $po->id;
               $backup_pengurangan->Sewa_sementara = $po->Sewa_sementara;
               $backup_pengurangan->NoPo = $po->NoPo;
               $backup_pengurangan->Nopo_pengurangan = $request->get('no_surat');
               $backup_pengurangan->Tgl_cutoff = $po->Tgl_cutoff;
               $backup_pengurangan->Hargasewamobil = $po->HargaSewaMobil;
               $backup_pengurangan->Hargasewadriver = $po->HargaSewaDriver2019;


               // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
               $ump = harga_ump::where('Kota_id',$po->cabang->Kota)->Where('Vendor_id',$po->vendor->KodeVendor)->Where('activated','1')->first();

               $po->Sewa = "Mobil+Driver";
               $po->Sewa_sementara = "Mobil+Driver";
               $po->HargaSewaDriver2019 = $ump->Harga_include;
               // $po->Pengurangan = $sewa[$count];
               $po->Nopo_perubahan = $request->get('no_surat');
               $po->data_pairing_baru = $Sewa[$count];
               $po->tgl_efektif_perubahan = $Tgl_efektif[$count];


               // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               $pengurangan->po_id = $Po_id[$count];
               $pengurangan->Nopo_pengurangan = $request->get('no_surat');
               $pengurangan->perubahan = $Sewa[$count];
               $pengurangan->tgl_efektif = $Tgl_efektif[$count];
              

               // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               $timeline = new timeline(); 
               $timeline->po_id = $Po_id[$count];
               date_default_timezone_set('Asia/Jakarta');
               $currentDateTime2 = date('Y-m-d H:i:s');
               $timeline->tanggal = $currentDateTime2;
               if (auth::user()->status == 'operasional') {
                   $user_status = 'BOP';
               }elseif(auth::user()->status == 'pengada'){
                   $user_status = 'BPD';
               }elseif(auth::user()->status == 'blk'){
                   $user_status = 'BLK';
               }elseif(auth::user()->status == 'admin'){
                   $user_status = 'ADMIN';
               }
               $timeline->judul = 'Perubahan pairing - '.$user_status;
               $timeline->ket1 = 'nopo : '.$request->get('no_surat');
               $timeline->ket2 = 'Perubahan pairing : '.$Sewa[$count];
               $timeline->ket3 = 'tgl efektif : '.$Tgl_efektif[$count];
               $timeline->user_id = auth::user()->name;

               // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               $mobil = Mobil::find($Mobil_id[$count]); 
               $cabang = Cabang::find($Cabang_id[$count]);
               $table_template_perubahan->template_id = $template_perubahan->id;
               $table_template_perubahan->po_id = $po->id;
               $table_template_perubahan->nama_cabang = $cabang->NamaCabang;
               $table_template_perubahan->kode_cabang = $cabang->KodeCabang;
               $table_template_perubahan->merek = $mobil->id;
               $table_template_perubahan->nopol = $nopol[$count];
               $table_template_perubahan->data_pairing_lama = $Sewa_lama[$count];
               $table_template_perubahan->data_pairing_baru = $Sewa[$count];
               $table_template_perubahan->tgl_efektif = $Tgl_efektif[$count];
               $table_template_perubahan->save();

               // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
               $backup_pengurangan->template_id = $template_perubahan->id;
               $backup_pengurangan->table_template_id = $table_template_perubahan->id;
               // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               $approve = new approve();
               $approve->po_id = $po->id;
               $approve->template_id = $template_perubahan->id;
               $approve->kategori = 'perubahan';
               $approve->approve = 'waiting2';
               
               $approve->save();
               
               $backup_pengurangan->save();
               $pengurangan->save();
               $timeline->save();
               $po->save();
            }
                   
        }
        
        // if ($jumlah == 1) {
        //   return redirect('/backend/po/show/'.$Po_id[0]);
        // }else{
          return redirect('/backend/po/table/4');
        // }

    }

    public function form_update_perubahan_po_proses(Request $request)

    {

        $template_perubahan = template_perubahan::find($request->get('template_perubahan_id'));

        $template_perubahan->no_surat = $request->get('no_surat');
        $template_perubahan->tgl_surat = $request->get('tgl_surat');

        $template_perubahan->pks = $request->get('pks');
        $template_perubahan->no_pks = $request->get('no_pks');
        $template_perubahan->tgl_pks = $request->get('tgl_pks');

        $template_perubahan->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_perubahan->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_perubahan->nama_pb1 = $request->get('nama_pb1');
        $template_perubahan->nama_pb2 = $request->get('nama_pb2');
        $template_perubahan->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_perubahan->jabatan_pb2 = $request->get('jabatan_pb2');

        $template_perubahan->save();
       
        $request->validate([
            'po_id.*' => 'nullable',
            'nopo_lama.*' => 'nullable',
            'nopo_relokasi.*' => 'nullable',
            'cabang_relokasi.*' => 'nullable',
            'tgl_efektif.*' => 'required',
            'nopol.*' => 'nullable',
            'status_cabang_lama.*' => 'nullable',
            'nama_cabang_lama.*' => 'nullable',
            'kode_cabang_lama.*' => 'nullable',
            'mobil_id.*' => 'nullable',
            'sewa.*' => 'nullable',
            'sewa_lama.*' => 'nullable',
            'cabang_id.*' => 'nullable',
            'sewa_pengurangan.*' => 'nullable'
        ]);


        $Po_id = $request->po_id;
        $po_id = $request->po_id;
        $Sewa = $request->sewa;
        $sewa = $request->sewa_pengurangan;
        $Sewa_lama = $request->sewa_lama;
        $NoPo = $request->nopo_lama;
        $Cabang_relokasi = $request->cabang_relokasi;
        $Tgl_efektif = $request->tgl_efektif;
        $tgl_cutoff = $request->tgl_efektif;
        $Cabang_id = $request->cabang_lama;
        $Nopo_relokasi = $request->nopo_relokasi;
        $Mobil_id = $request->mobil_id;
        $Cabang_id = $request->cabang_id;

        $nopol = $request->nopol;
        $status_cabang_lama = $request->status_cabang_lama;
        $nama_cabang_lama = $request->nama_cabang_lama;
        $kode_cabang_lama = $request->kode_cabang_lama;

        $jumlah = 0;
        for($count = 0; $count < count($Tgl_efektif); $count++)
        {

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~ RESTORE DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~~
            $pos = $po = tpo::find($po_id[$count]);
            $backup_pengurangan = backup_pengurangan::where('po_id',$po_id[$count])->latest()->first();


            // $pos->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
            // $pos->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
            // $pos->Pengurangan = $backup_pengurangan->Pengurangan;
            $pos->tgl_efektif_perubahan = $backup_pengurangan->Tgl_cutoff;
            $pos->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
            $pos->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff;
            $pos->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~ RESTORE DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $po = tpo::find($po_id[$count]);
            $timeline = timeline::where('Po_id',$po_id[$count])->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first();         
            if ($po->Driver_id != '') {
                $drivers2 = DB::table('drivers')->where('Po_id', $po_id[$count])->value('id'); 
                $report_driver = report_driver::where('driver_id',$drivers2)->latest()->first();
            }
            $history = historydriver::where('Po_id',$po_id[$count])->latest()->first();

            $pengurangan = pengurangan::where('Po_id',$po_id[$count])->whereNotNull('perubahan')->latest()->first();



            // if ($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil+Driver') {
            //     if($sewa[$count] == 'Mobil'){
            //         $po->Sewa_sementara = 'Driver';
            //     }elseif ($sewa[$count] == 'Driver') {
            //         $po->Sewa_Sementara = 'Mobil';
            //         // $po->Hargasewadriver_relokasi = '0';              
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }else{
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }
            // }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil'){
            //     if($sewa[$count] == 'Mobil'){
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //     }else{
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }
            // }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Driver'){
            //     if($sewa[$count] == 'Driver'){
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }else{
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }
            // }else{
            //     if ($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Mobil+Driver') {
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }elseif($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Driver'){
            //         $po->Sewa_sementara = 'Mobil';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }elseif($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Mobil'){
            //         $po->Sewa_sementara = 'Driver';
            //         // $po->Hargasewamobil_pengurangan = '0';
            //     }elseif($po->Sewa_sementara == 'Driver' && $sewa[$count] == 'Driver'){
            //         $po->Sewa_sementara = 'null';
            //         // $po->Hargasewadriver_relokasi = '0';
            //         if (isset($history)) {
            //             $history->tgl_selesai = $tgl_cutoff[$count];
            //         }
            //         if (isset($report_driver)) {
            //             $report_driver->tgl_selesai = $tgl_cutoff[$count];
            //         }

            //     }elseif($po->Sewa_sementara == 'Mobil' && $sewa[$count] == 'Mobil'){
            //         $po->Sewa_sementara = 'null';
            //     }
            // }

            $po->NoPo = $NoPo[$count];
            if ($po->Sewa_sementara == 'Mobil+Driver') {
              $po->Tgl_cutoff = null;
            }else{
              $po->Tgl_cutoff = $Tgl_efektif[$count];
            }
            if($backup_pengurangan->Driver_id != '' && $backup_pengurangan->Tgl_cutoff_driver == ''){
                $po->Tgl_cutoff_driver = $Tgl_efektif[$count];
            }
            // $po->Pengurangan = $sewa[$count];
            $po->Nopo_perubahan = $request->get('no_surat');
            // $po->Sewa = $Sewa_lama[$count];
            // $po->data_pairing_baru = $Sewa[$count];
            $po->tgl_efektif_perubahan = $Tgl_efektif[$count];
            $po->save();

            // $pengurangan->Nopo_pengurangan = $request->nopo_pengurangan;
            $pengurangan->perubahan = $Sewa[$count];
            $pengurangan->tgl_efektif = $Tgl_efektif[$count];
            $pengurangan->save();

            $timeline->ket1 = 'nopo : '.$request->get('no_surat');
            $timeline->ket2 = 'Perubahan pairing : '.$Sewa[$count];
            $timeline->ket3 = 'tgl efektif : '.$Tgl_efektif[$count];
            $timeline->save();


            $table_template_perubahan = table_template_perubahan::where('template_id',$request->get('template_perubahan_id'))->where('po_id',$po_id[$count])->first();
            // $table_template_perubahan->data_pairing_baru = $Sewa[$count];
            $table_template_perubahan->tgl_efektif = $Tgl_efektif[$count];

            $table_template_perubahan->save();

            // $report_driver->save();

            if (isset($history)) {
                $history->save();
            }

        }



                   // $po = tpo::find($request->po_id);     
                   // $timeline = timeline::where('Po_id',$request->po_id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first();
                   // $pengurangan = pengurangan::where('Po_id',$request->po_id)->whereNotNull('perubahan')->latest()->first(); 
                   // $table_template_perubahan = table_template_perubahan::where('template_id',$request->get('template_perubahan_id'))->where('po_id',$request->po_id)->first();

                   // $po->data_pairing_baru = $request->sewa;
                   // $po->tgl_efektif_perubahan = $request->tgl_efektif;
                   // $po->save();

                   // $pengurangan->po_id = $request->po_id;
                   // $pengurangan->perubahan = $request->sewa;
                   // $pengurangan->tgl_efektif = $request->tgl_efektif;
                   // $pengurangan->save();

                   // // $timeline->po_id = $request->po_id;
                   // // date_default_timezone_set('Asia/Jakarta');
                   // // $currentDateTime2 = date('Y-m-d H:i:s');
                   // // $timeline->tanggal = $currentDateTime2;
                   // // $timeline->judul = 'Perubahan pairing - '.auth::user()->name;
                   // $timeline->ket1 = 'Perubahan pairing : '.$request->sewa;
                   // $timeline->ket2 = 'tgl efektif : '.$request->tgl_efektif;
                   // $timeline->save();

                   // // $mobil = Mobil::find($request->mobil_id); 
                   // // $cabang = Cabang::find($request->cabang_id);
                   // // $table_template_perubahan->template_id = $template_perubahan->id;
                   // // $table_template_perubahan->po_id = $po->id;
                   // // $table_template_perubahan->nama_cabang = $cabang->NamaCabang;
                   // // $table_template_perubahan->kode_cabang = $cabang->KodeCabang;
                   // // $table_template_perubahan->merek = $mobil->id;
                   // // $table_template_perubahan->nopol = $request->nopol;
                   // // $table_template_perubahan->data_pairing_lama = $Sewa_lama[$count];
                   // $table_template_perubahan->data_pairing_baru = $request->sewa;
                   // $table_template_perubahan->tgl_efektif = $request->tgl_efektif;

                   // $table_template_perubahan->save();
        
        return redirect('/backend/po/table/4');
        // return $request;
    }

    public function form_delete_perubahan_multiple_po($id,$template_id,$table_template_id)

    {

      $table_template_perubahan = table_template_perubahan::where('template_id',$template_id)->get();
      $table_template_perubahan_single = table_template_perubahan::where('template_id',$template_id)->first();
      $table_template_perubahan_count = table_template_perubahan::where('template_id',$template_id)->count();

      if($table_template_perubahan_count == 1){

        $backup_pengurangan = backup_pengurangan::where('po_id',$id)->where('template_id',$template_id)->where('table_template_id',$table_template_id)->first();

        $po = tpo::find($id);

        if ($backup_pengurangan->Driver_id != '') {

            $history_driver = historydriver::where('Po_id',$id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
            $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
            $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('perubahan')->latest()->first(); 
            $timeline = timeline::where('Po_id',$id)->where('judul','Delete driver - BPD')->orWhere('judul','Delete driver - BOP')->latest()->first(); 
            $timeline->delete();

            $timeline = timeline::where('Po_id',$id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first(); 

            if ($po->Sewa_sementara == 'Mobil+Driver') {
              $po->Sewa = 'Mobil';
              $po->HargaSewaDriver2019 = '0';
            }
            $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
            $po->NoPo = $backup_pengurangan->NoPo;
            $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
            $po->Driver_id = $backup_pengurangan->Driver_id;
            $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
            $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
            $po->Pengurangan = null;
            $po->data_pairing_baru = null;
            $po->tgl_efektif_perubahan = null;
            $po->Nopo_perubahan = null;
            $po->save();

            $driver_id = driver::find($backup_pengurangan->Driver_id);

            $timeline->delete();
            $pengurangan->delete();

            // ~~~~~~~~~~~~~ PROBLEM ~~~~~~~~~~~~~~~~~

            $history_driver->tgl_selesai = null;
            $history_driver->save();

            $driver->Po_id = $backup_pengurangan->po_id;
            $driver->save();

          }else{

            $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('perubahan')->latest()->first(); 
            $timeline = timeline::where('Po_id',$id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first();       

            if ($po->Sewa_sementara == 'Mobil+Driver') {
              $po->Sewa = 'Mobil';
              $po->HargaSewaDriver2019 = '0';
            }
            $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
            $po->NoPo = $backup_pengurangan->NoPo;
            $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
            $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
            $po->Pengurangan = null;
            $po->data_pairing_baru = null;
            $po->tgl_efektif_perubahan = null;
            $po->Nopo_perubahan = null;
            $po->save();

            // $relokasi->delete();

            $timeline->delete();
            $pengurangan->delete();

          }

          $backup_pengurangan->delete();

      }else{

          foreach ($table_template_perubahan as $table_template_perubahans) {
            if ($table_template_perubahans->template_id == $template_id) {
              
              $backup_pengurangan = backup_pengurangan::where('po_id',$table_template_perubahans->po_id)->where('template_id',$template_id)->where('table_template_id',$table_template_perubahans->id)->first();
              
              $po = tpo::find($table_template_perubahans->po_id);

              if ($backup_pengurangan->Driver_id != '') {
                  $history_driver = historydriver::where('Po_id',$table_template_perubahans->po_id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
                  $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
                  $pengurangan = pengurangan::where('Po_id',$table_template_perubahans->po_id)->whereNotNull('perubahan')->latest()->first(); 

                  $timeline = timeline::where('Po_id',$id)->where('judul','Delete driver - BPD')->orWhere('judul','Delete driver - BOP')->latest()->first(); 
                  $timeline->delete();

                  $timeline = timeline::where('Po_id',$table_template_perubahans->po_id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first();           
                  
                  if ($po->Sewa_sementara == 'Mobil+Driver') {
                    $po->Sewa = 'Mobil';
                    $po->HargaSewaDriver2019 = '0';
                  }
                  $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                  $po->NoPo = $backup_pengurangan->NoPo;
                  $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
                  $po->Driver_id = $backup_pengurangan->Driver_id;
                  $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                  $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
                  $po->Pengurangan = null;
                  $po->data_pairing_baru = null;
                  $po->tgl_efektif_perubahan = null;
                  $po->Nopo_perubahan = null;
                  $po->save();

                  $driver_id = driver::find($backup_pengurangan->Driver_id);

                  $timeline->delete();
                  $pengurangan->delete();
                  

                  // ~~~~~~~~~~~~~ PROBLEM ~~~~~~~~~~~~~~~~~

                  $history_driver->tgl_selesai = null;
                  $history_driver->save();

                  $driver->Po_id = $backup_pengurangan->po_id;
                  $driver->save();

              }else{

                   $pengurangan = pengurangan::where('Po_id',$table_template_perubahans->po_id)->whereNotNull('perubahan')->latest()->first(); 
                   $timeline = timeline::where('Po_id',$table_template_perubahans->po_id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first();              
                  
                   if ($po->Sewa_sementara == 'Mobil+Driver') {
                     $po->Sewa = 'Mobil';
                     $po->HargaSewaDriver2019 = '0';
                   }
                   $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                   $po->NoPo = $backup_pengurangan->NoPo;
                   $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
                   $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                   $po->Pengurangan = null;
                   $po->data_pairing_baru = null;
                   $po->tgl_efektif_perubahan = null;
                   $po->Nopo_perubahan = null;
                   $po->save();

                   // $relokasi->delete()


                   $timeline->delete();
                   $pengurangan->delete();
                   
              }

              $backup_pengurangan->delete();

            }
          }

      }
       
                   // $po = tpo::find($id);     
                   // $timeline = timeline::where('Po_id',$id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first(); 
                   // $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('perubahan')->latest()->first();   
                   // $table_template_perubahan = table_template_perubahan::where('id',$table_template_id)->first();

                   // $po->data_pairing_baru = null;
                   // $po->tgl_efektif_perubahan = null;
                   // $po->save();

                   // $pengurangan->delete();

                   // $timeline->delete();

                   // $table_template_perubahan->delete();

      $table_template_perubahan_delete = table_template_perubahan::where('template_id',$template_id)->delete();
      $template_perubahan = template_perubahan::find($template_id)->delete();
      
       approve::where('template_id',$template_id)->where('kategori','perubahan')->delete();
      return redirect('/backend/po/table/4')->with('success', 'Perubahan berhasil di batalkan');
        // return $request;
    }

    public function form_perubahan_refresh()
    {
        return redirect('/backend/po/perubahan')->with('warning', 'refresh page not support in this page');
    }

    public function approve_perubahan($id,$single_id)
    {
        $template_perubahan = template_perubahan::find($id);
        $template_perubahan->status = '1';
        $template_perubahan->save();

        approve::where('template_id',$id)->where('kategori','perubahan')->delete();
        return redirect('/backend/po/table/4')->with('success','PO perubahan berhasil di approve');
    }

    public function tampungan_perubahan($id)
    {
      $tp_perubahan = new tampungan_perubahan();

      $tp_perubahan->po_id = $id;
      $tp_perubahan->save();

      return redirect('/backend/po/perubahan');
    }

    public function delete_tampungan_perubahan($id)
    {
      $tp_perubahan = tampungan_perubahan::find($id);

      $tp_perubahan->delete();

      return redirect('/backend/po/perubahan');
    }






















    public function form_pembatalan_perubahan($id,$template_id,$table_template_id)

    {

      $table_template_perubahan = table_template_perubahan::where('template_id',$template_id)->get();
      $table_template_perubahan_single = table_template_perubahan::where('template_id',$template_id)->first();
      $table_template_perubahan_count = table_template_perubahan::where('template_id',$template_id)->count();

      if($table_template_perubahan_count == 1){

        $backup_pengurangan = backup_pengurangan::where('po_id',$id)->where('template_id',$template_id)->where('table_template_id',$table_template_id)->first();

        $po = tpo::find($id);

        if ($backup_pengurangan->Driver_id != '') {

            $history_driver = historydriver::where('Po_id',$id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
            $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
            $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('perubahan')->latest()->first(); 
            

            $timeline = new timeline();
            $timeline->po_id = $po->id;
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime2 = date('Y-m-d H:i:s');
            $timeline->tanggal = $currentDateTime2;
            if (auth::user()->status == 'operasional') {
                $user_status = 'BOP';
            }elseif(auth::user()->status == 'pengada'){
                $user_status = 'BPD';
            }elseif(auth::user()->status == 'blk'){
                $user_status = 'BLK';
            }elseif(auth::user()->status == 'admin'){
                $user_status = 'ADMIN';
            }
            $timeline->judul = 'Pembatalan perubahan - '.$user_status;
            // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
            $timeline->ket1 = 'nopo : '.$table_template_perubahan->template->no_surat;
            $timeline->ket2 = 'perubahan pairing : '.$table_template_perubahan->data_pairing_baru;
            $timeline->user_id = auth::user()->name;

            
            if ($po->Sewa_sementara == 'Mobil+Driver') {
              $po->Sewa = 'Mobil';
              $po->HargaSewaDriver2019 = '0';
            }
            $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
            $po->NoPo = $backup_pengurangan->NoPo;
            $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
            $po->Driver_id = $backup_pengurangan->Driver_id;
            $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
            $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
            $po->Pengurangan = null;
            $po->data_pairing_baru = null;
            $po->tgl_efektif_perubahan = null;
            $po->Nopo_perubahan = null;
            $po->save();

            $driver_id = driver::find($backup_pengurangan->Driver_id);

            $timeline->save();
            $pengurangan->delete();

            // ~~~~~~~~~~~~~ PROBLEM ~~~~~~~~~~~~~~~~~

            $history_driver->tgl_selesai = null;
            $history_driver->save();

            $driver->Po_id = $backup_pengurangan->po_id;
            $driver->save();

          }else{

            $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('perubahan')->latest()->first(); 
            $timeline = timeline::where('Po_id',$id)->where('judul','Perubahan pairing - BPD')->orWhere('judul','Perubahan pairing - BOP')->latest()->first();       

            $timeline = new timeline();
            $timeline->po_id = $po->id;
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime2 = date('Y-m-d H:i:s');
            $timeline->tanggal = $currentDateTime2;
            if (auth::user()->status == 'operasional') {
                $user_status = 'BOP';
            }elseif(auth::user()->status == 'pengada'){
                $user_status = 'BPD';
            }elseif(auth::user()->status == 'blk'){
                $user_status = 'BLK';
            }elseif(auth::user()->status == 'admin'){
                $user_status = 'ADMIN';
            }
            $timeline->judul = 'Pembatalan perubahan - '.$user_status;
            // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
            $timeline->ket1 = 'nopo : '.$table_template_perubahan->template->no_surat;
            $timeline->ket2 = 'perubahan pairing : '.$table_template_perubahan->data_pairing_baru;
            $timeline->user_id = auth::user()->name;

            if ($po->Sewa_sementara == 'Mobil+Driver') {
              $po->Sewa = 'Mobil';
              $po->HargaSewaDriver2019 = '0';
            }
            $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
            $po->NoPo = $backup_pengurangan->NoPo;
            $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
            $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
            $po->Pengurangan = null;
            $po->data_pairing_baru = null;
            $po->tgl_efektif_perubahan = null;
            $po->Nopo_perubahan = null;
            $po->save();

            // $relokasi->delete();

            $timeline->save();
            $pengurangan->delete();

          }

          $backup_pengurangan->delete();

      }else{

          foreach ($table_template_perubahan as $table_template_perubahans) {
            if ($table_template_perubahans->template_id == $template_id) {
              
              $backup_pengurangan = backup_pengurangan::where('po_id',$table_template_perubahans->po_id)->where('template_id',$template_id)->where('table_template_id',$table_template_perubahans->id)->first();
              
              $po = tpo::find($table_template_perubahans->po_id);

              if ($backup_pengurangan->Driver_id != '') {
                  $history_driver = historydriver::where('Po_id',$table_template_perubahans->po_id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
                  $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
                  $pengurangan = pengurangan::where('Po_id',$table_template_perubahans->po_id)->whereNotNull('perubahan')->latest()->first(); 

                  

                  $timeline = new timeline();
                  $timeline->po_id = $po->id;
                  date_default_timezone_set('Asia/Jakarta');
                  $currentDateTime2 = date('Y-m-d H:i:s');
                  $timeline->tanggal = $currentDateTime2;
                  if (auth::user()->status == 'operasional') {
                      $user_status = 'BOP';
                  }elseif(auth::user()->status == 'pengada'){
                      $user_status = 'BPD';
                  }elseif(auth::user()->status == 'blk'){
                      $user_status = 'BLK';
                  }elseif(auth::user()->status == 'admin'){
                      $user_status = 'ADMIN';
                  }
                  $timeline->judul = 'Pembatalan perubahan - '.$user_status;
                  // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
                  $timeline->ket1 = 'nopo : '.$table_template_perubahans->template->no_surat;
                  $timeline->ket2 = 'perubahan pairing : '.$table_template_perubahans->data_pairing_baru;
                  $timeline->user_id = auth::user()->name;

                  
                  if ($po->Sewa_sementara == 'Mobil+Driver') {
                    $po->Sewa = 'Mobil';
                    $po->HargaSewaDriver2019 = '0';
                  }
                  $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                  $po->NoPo = $backup_pengurangan->NoPo;
                  $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
                  $po->Driver_id = $backup_pengurangan->Driver_id;
                  $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                  $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
                  $po->Pengurangan = null;
                  $po->data_pairing_baru = null;
                  $po->tgl_efektif_perubahan = null;
                  $po->Nopo_perubahan = null;
                  $po->save();

                  $driver_id = driver::find($backup_pengurangan->Driver_id);

                  $timeline->save();
                  $pengurangan->delete();
                  

                  // ~~~~~~~~~~~~~ PROBLEM ~~~~~~~~~~~~~~~~~

                  $history_driver->tgl_selesai = null;
                  $history_driver->save();

                  $driver->Po_id = $backup_pengurangan->po_id;
                  $driver->save();

              }else{

                   $pengurangan = pengurangan::where('Po_id',$table_template_perubahans->po_id)->whereNotNull('perubahan')->latest()->first(); 
                   $timeline = new timeline();
                   $timeline->po_id = $po->id;
                   date_default_timezone_set('Asia/Jakarta');
                   $currentDateTime2 = date('Y-m-d H:i:s');
                   $timeline->tanggal = $currentDateTime2;
                   if (auth::user()->status == 'operasional') {
                       $user_status = 'BOP';
                   }elseif(auth::user()->status == 'pengada'){
                       $user_status = 'BPD';
                   }elseif(auth::user()->status == 'blk'){
                       $user_status = 'BLK';
                   }elseif(auth::user()->status == 'admin'){
                       $user_status = 'ADMIN';
                   }
                   $timeline->judul = 'Pembatalan perubahan - '.$user_status;
                   // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
                   $timeline->ket1 = 'nopo : '.$table_template_perubahans->template->no_surat;
                   $timeline->ket2 = 'perubahan pairing : '.$table_template_perubahans->data_pairing_baru;
                   $timeline->user_id = auth::user()->name;          
                  
                   if ($po->Sewa_sementara == 'Mobil+Driver') {
                     $po->Sewa = 'Mobil';
                     $po->HargaSewaDriver2019 = '0';
                   }
                   $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                   $po->NoPo = $backup_pengurangan->NoPo;
                   $po->Nopo_perubahan = $backup_pengurangan->Nopo_pengurangan;
                   $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                   $po->Pengurangan = null;
                   $po->data_pairing_baru = null;
                   $po->tgl_efektif_perubahan = null;
                   $po->Nopo_perubahan = null;
                   $po->save();

                   


                   $timeline->save();
                   $pengurangan->delete();
                   
              }

              $backup_pengurangan->delete();

            }
          }

      }
       

      $table_template_perubahan_delete = table_template_perubahan::where('template_id',$template_id)->delete();
      $template_perubahan = template_perubahan::find($template_id)->delete();
      
       approve::where('template_id',$template_id)->where('kategori','perubahan')->delete();
      return redirect('/backend/po/table/4')->with('success', 'Perubahan berhasil di batalkan');
        // return $request;
    }
}

