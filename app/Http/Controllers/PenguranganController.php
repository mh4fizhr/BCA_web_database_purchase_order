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
use App\backup_pengurangan;
use App\pks;
use App\addendum;
use App\approve;
use PDF;
use App\tampungan_pengurangan;
use App\tampungan_pengurangan_driver;


class PenguranganController extends Controller
{
    //
    public function pengurangan_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        $tp_pengurangans = tampungan_pengurangan::all();
        return view('PO/pengurangan',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','history_drivers','tp_pengurangans'));
    }

    public function pengurangan_po_damira()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $tp_pengurangans = tampungan_pengurangan_driver::all();
        return view('PO/pengurangan_damira',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','tp_pengurangans'));
    }

    public function form_pengurangan_po($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $po = tpo::find($id);
        $nopos = Nopo::all();
        $poss = tpo::where('id',$id)->get();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        return view('PO/form_pengurangan',compact('po','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','poss','pkss','addendums'));
    }

    public function form_pengurangan_po_damira($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $po = tpo::find($id);
        $nopos = Nopo::all();
        $poss = tpo::where('id',$id)->get();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        $count_po = 1;
        return view('PO/form_pengurangan_damira',compact('po','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','poss','pkss','addendums','count_po'));
        
    }

    // public function form_pengurangan_multiple_po(Request $request)
    // {
    //     $po_single = tpo::find($request->pengurangan[0]);
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
    //     if ($request->get('pengurangan') != '') {
    //         $poss = tpo::whereIn('id',$request->get('pengurangan'))->get();
    //         for ($i=0; $i < $poss->count(); $i++) { 
    //           if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
    //              $pos = tpo::all();
    //              return redirect('/backend/po/pengurangan')->with('warning','Pilih vendor yang sama');
    //           }
    //         }
    //         return view('PO/form_pengurangan',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
    //     }else{
    //         $pos = tpo::all();
    //         return redirect('/backend/po/pengurangan')->with('warning','Tidak ada item yang dipilih');
    //         // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
    //     }
    // }

    public function form_pengurangan_multiple_po_button(Request $request)
    {
        $pengurangan = tampungan_pengurangan::all()->pluck('po_id')->toarray();
        $po_single = tpo::find($pengurangan[0]);
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
        if (tampungan_pengurangan::all()->count() != 0) {
            $poss = tpo::whereIn('id',tampungan_pengurangan::all()->pluck('po_id')->toarray())->get();
            for ($i=0; $i < tampungan_pengurangan::all()->count(); $i++) { 
              if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
                 $pos = tpo::all();
                 return redirect('/backend/po/pengurangan')->with('warning','Pilih vendor yang sama');
              }
            }
            return view('PO/form_pengurangan',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
        }else{
            $pos = tpo::all();
            return redirect('/backend/po/pengurangan')->with('warning','Tidak ada item yang dipilih');
            // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
        }
    }

    // public function form_pengurangan_damira_multiple_po(Request $request)
    // {
    //     $po_single = tpo::find($request->pengurangan[0]);
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
    //     if ($request->get('pengurangan') != '') {
    //         $poss = tpo::whereIn('id',$request->get('pengurangan'))->get();
    //         $count_po = tpo::whereIn('id',$request->get('pengurangan'))->count();
    //         for ($i=0; $i < $poss->count(); $i++) { 
    //           if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
    //              $pos = tpo::all();
    //              return redirect('/backend/po/pengurangan')->with('warning','Tolong pilih vendor yang sama');
    //           }
    //         }
    //         return view('PO/form_pengurangan_damira',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','count_po','pkss','addendums'));
    //     }else{
    //         $pos = tpo::all();
    //         return redirect('/backend/po/pengurangan_damira')->with('warning','Tidak ada item yang dipilih');
    //         // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
    //     }
    // }


    public function form_pengurangan_driver_multiple_po_button(Request $request)
    {

        $pengurangan_driver = tampungan_pengurangan_driver::all()->pluck('po_id')->toarray();
        $po_single = tpo::find($pengurangan_driver[0]);
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
        if (tampungan_pengurangan_driver::all()->count() != 0) {
            $poss = tpo::whereIn('id',tampungan_pengurangan_driver::all()->pluck('po_id')->toarray())->get();
            $count_po = tpo::whereIn('id',tampungan_pengurangan_driver::all()->pluck('po_id')->toarray())->count();
            for ($i=0; $i < tampungan_pengurangan_driver::all()->count(); $i++) { 
              if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
                 $pos = tpo::all();
                 return redirect('/backend/po/pengurangan')->with('warning','Tolong pilih vendor yang sama');
              }
            }
            return view('PO/form_pengurangan_damira',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','count_po','pkss','addendums'));
        }else{
            $pos = tpo::all();
            return redirect('/backend/po/pengurangan_damira')->with('warning','Tidak ada item yang dipilih');
            // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
        }
    }


    public function form_update_pengurangan_multiple_po($id,$single_id)
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
        $table_template_pengurangan = table_template_pengurangan::find($single_id);
        $po_id = tpo::find($table_template_pengurangan->po_id);
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        if($template_pengurangan->sewa == 'Pengemudi Kendaraan Operasional')
        {
            return view('PO/form_update_pengurangan_damira',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_pengurangan','table_template_pengurangan','table_template_pengurangans','po_id','pkss','addendums'));
        }
        else
        {
            return view('PO/form_update_pengurangan_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_pengurangan','table_template_pengurangan','table_template_pengurangans','po_id','pkss','addendums'));
        }
    }


    public function po_edit_pengurangan(Request $request, $id)
    {
        $template_pengurangan = new template_pengurangan();
        $template_pengurangan->no_surat = $request->get('no_surat');
        $template_pengurangan->tgl_surat = $request->get('tgl_surat');
        $template_pengurangan->nama_vendor = $request->get('nama_vendor');
        $template_pengurangan->pic_vendor = $request->get('pic_vendor');
        $template_pengurangan->jabatan_vendor = $request->get('jabatan_vendor');
        $template_pengurangan->alamat_vendor = $request->get('alamat_vendor');
        
        if($request->get('sewa_template') == 'Mobil+Driver'){
          $po_sewa = 'Mobil dan Pengemudi' ;
        }
        else if($request->get('sewa') == 'Mobil'){
           $po_sewa = 'Mobil' ;
        }
        else if($request->get('sewa') == 'Driver'){
           $po_sewa = 'Pengemudi' ;
        }
        $template_pengurangan->sewa = $po_sewa;

        $template_pengurangan->jml_mobil = $request->get('jml_mobil');
        $template_pengurangan->jml_driver = $request->get('jml_driver');

        $template_pengurangan->pks = $request->get('pks');
        $template_pengurangan->no_pks = $request->get('no_pks');
        $template_pengurangan->tgl_pks = $request->get('tgl_pks');

        $template_pengurangan->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_pengurangan->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_pengurangan->nama_pb1 = $request->get('nama_pb1');
        $template_pengurangan->nama_pb2 = $request->get('nama_pb2');
        $template_pengurangan->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_pengurangan->jabatan_pb2 = $request->get('jabatan_pb2');

        $template_pengurangan->save();

        $po = tpo::find($id);
        $drivers = Driver::where('Po_id','=',$id)->get();
        $history = historydriver::where('Po_id',$id)->WhereNull('tgl_selesai')->first();
        $timeline = new timeline;

        if ($po->Driver_id != '') {
            $drivers2 = DB::table('drivers')->where('Po_id', $id)->value('id'); 
            $report_driver = report_driver::where('driver_id',$drivers2)->WhereNull('tgl_selesai')->first();
        }

        $pengurangan = new Pengurangan();
        $request->validate([
            'nopo_lama' => 'nullable',
            'nopo_pengurangan' => 'nullable',
            'sewa' => 'nullable',
            'sewa_lama' => 'nullable',
            'tgl_cutoff' => 'nullable',
            'sewa_sementara' => 'nullable'
        ]);


        if ($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil+Driver') {
            if($request->sewa == 'Mobil'){
                $po->Sewa_sementara = 'Driver';
               
            }elseif ($request->sewa == 'Driver') {
                $po->Sewa_Sementara = 'Mobil';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;              
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';

                    $driver->save();
                }
            }else{
                $po->Sewa_sementara = 'null';
                // $po->Hargasewamobil_pengurangan = '0';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }
        }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil'){
            if($request->sewa == 'Mobil'){
                $po->Sewa_sementara = 'null';
                // $po->Hargasewamobil_pengurangan = '0';
            }else{
                $po->Sewa_sementara = 'null';
                // $po->Hargasewamobil_pengurangan = '0';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }
        }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Driver'){
            if($request->sewa == 'Driver'){
                $po->Sewa_sementara = 'null';
                // $po->Hargasewamobil_pengurangan = '0';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }else{
                $po->Sewa_sementara = 'null';
                // $po->Hargasewamobil_pengurangan = '0';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }
        }else{
            if ($po->Sewa_sementara == 'Mobil+Driver' && $request->sewa == 'Mobil+Driver') {
                $po->Sewa_sementara = 'null';
                // $po->Hargasewadriver_relokasi = '0';
                // $po->Hargasewamobil_pengurangan = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }elseif($po->Sewa_sementara == 'Mobil+Driver' && $request->sewa == 'Driver'){
                $po->Sewa_sementara = 'Mobil';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }elseif($po->Sewa_sementara == 'Mobil+Driver' && $request->sewa == 'Mobil'){
                $po->Sewa_sementara = 'Driver';
                // $po->Hargasewamobil_pengurangan = '0';
            }elseif($po->Sewa_sementara == 'Driver' && $request->sewa == 'Driver'){
                $po->Sewa_sementara = 'null';
                // $po->Hargasewadriver_relokasi = '0';
                $po->Driver_id = '';
                $po->MulaiSewa2 = null;
                $po->SelesaiSewa2 = null;
                if (isset($history)) {
                    $history->tgl_selesai = $request->tgl_cutoff;
                }
                if (isset($report_driver)) {
                    $report_driver->tgl_selesai = $request->tgl_cutoff;
                }
                foreach($drivers as $driver) {
                    $driver->Po_id = '';
                    $driver->save();
                }
            }elseif($po->Sewa_sementara == 'Mobil' && $request->sewa == 'Mobil'){
                $po->Sewa_sementara = 'null';
            }
        }

        $po->NoPo = $request->nopo_lama;
        $po->Tgl_cutoff = $request->tgl_cutoff;
        $po->Pengurangan = $request->sewa;
        $po->Sewa = $request->sewa_lama;
        $po->Nopo_pengurangan = $request->get('no_surat');
        $po->save();

        $pengurangan->po_id = $id;
        $pengurangan->Nopo_pengurangan = $request->get('no_surat');
        $pengurangan->pengurangan = $request->sewa;
        $pengurangan->tgl_cutoff = $request->tgl_cutoff;
        $pengurangan->save();

        $timeline->po_id = $id;
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
        $timeline->judul = 'Pengurangan - '.$user_status;
        $timeline->ket1 = 'nopo : '.$request->get('no_surat');
        $timeline->ket2 = 'pengurangan : '.$request->sewa;
        $timeline->ket3 = 'tgl cutoff : '.$request->tgl_cutoff;
        $timeline->user_id = auth::user()->name;
        $timeline->save();


        if (isset($history)) {
            $history->save();
        }

        $mobil = Mobil::find($request->get('mobil_id'));
        $table_template_pengurangan = new table_template_pengurangan(); 
        $table_template_pengurangan->template_id = $template_pengurangan->id;
        $table_template_pengurangan->po_id = $po->id;
        $table_template_pengurangan->merek = $mobil->id;
        $table_template_pengurangan->nopol = $request->get('nopol');
        $table_template_pengurangan->nama_cabang = $request->get('nama_cabang');
        $table_template_pengurangan->kode_cabang = $request->get('kode_cabang');
        $table_template_pengurangan->tgl_efektif = $request->get('tgl_cutoff');
        $table_template_pengurangan->keterangan = $request->sewa;
        $table_template_pengurangan->save();

        $approve = new approve();
        $approve->po_id = $po->id;
        $approve->template_id = $template_pengurangan->id;
        $approve->kategori = 'pengurangan';
        $approve->approve = 'waiting';
        $approve->save();

        // return redirect('/backend/po/pengurangan');
        return redirect('/backend/po/show/'.$id);
        // return $request;
    }



    public function po_edit_pengurangan_multiple(Request $request, $id)
    {
        $request->validate([
            'po_id.*' => 'nullable',
            'nopo_lama.*' => 'nullable',
            'nopo_pengurangan.*' => 'nullable',
            'sewa.*' => 'nullable',
            'sewa_lama.*' => 'nullable',
            'tgl_cutoff.*' => 'nullable',
            'sewa_sementara.*' => 'nullable',
            'mobil_id.*' => 'nullable',
            'nama_cabang.*' => 'nullable',
            'kode_cabang.*' => 'nullable',
            'nopol.*' => 'nullable'
        ]);

        $po_id = $request->po_id;
        $nopo_lama = $request->nopo_lama;
        $nopo_pengurangan = $request->nopo_pengurangan;
        $sewa = $request->sewa;
        $sewa_lama = $request->sewa_lama;
        $tgl_cutoff = $request->tgl_cutoff;
        $sewa_sementara = $request->sewa_sementara;
        $mobil_id = $request->mobil_id;
        $nama_cabang = $request->nama_cabang;
        $kode_cabang = $request->kode_cabang;
        $nopol = $request->nopol;

        $template_pengurangan = new template_pengurangan();
        $template_pengurangan->no_surat = $request->get('no_surat');
        $template_pengurangan->tgl_surat = $request->get('tgl_surat');
        $template_pengurangan->nama_vendor = $request->get('nama_vendor');
        $template_pengurangan->pic_vendor = $request->get('pic_vendor');
        $template_pengurangan->jabatan_vendor = $request->get('jabatan_vendor');
        $template_pengurangan->alamat_vendor = $request->get('alamat_vendor');
        
        
        // if($request->get('sewa_template') == 'Mobil+Driver'){
        //   $po_sewa = 'Mobil dan Pengemudi' ;
        // }
        // else if($request->get('sewa') == 'Mobil'){
        //    $po_sewa = 'Mobil' ;
        // }
        // else if($request->get('sewa') == 'Driver'){
        //    $po_sewa = 'Pengemudi' ;
        // }
        $template_pengurangan->sewa = $request->get('sewa_template');

        $template_pengurangan->jml_mobil = $request->get('count_mobil');
        $template_pengurangan->jml_driver = $request->get('count_driver');
        $template_pengurangan->pks = $request->get('pks');
        $template_pengurangan->no_pks = $request->get('no_pks');
        $template_pengurangan->tgl_pks = $request->get('tgl_pks');
        $template_pengurangan->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_pengurangan->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_pengurangan->nama_pb1 = $request->get('nama_pb1');
        $template_pengurangan->nama_pb2 = $request->get('nama_pb2');
        $template_pengurangan->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_pengurangan->jabatan_pb2 = $request->get('jabatan_pb2');
        $template_pengurangan->save();

        
        $jumlah = 0;
        for($count = 0; $count < count($tgl_cutoff); $count++)
        {
            $pengurangan = new Pengurangan();
            $backup_pengurangan = new backup_pengurangan();
            $po = tpo::find($po_id[$count]);
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
            $backup_pengurangan->Sewa = $po->Sewa;
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


            $po->NoPo = $nopo_lama[$count];
            $po->Tgl_cutoff = $tgl_cutoff[$count];
            $po->Pengurangan = $sewa[$count];
            $po->Sewa = $sewa_lama[$count];
            $po->Nopo_pengurangan = $request->get('no_surat');
            $po->save();

            $pengurangan->po_id = $po_id[$count];
            $pengurangan->Nopo_pengurangan = $request->get('no_surat');
            $pengurangan->pengurangan = $sewa[$count];
            $pengurangan->tgl_cutoff = $tgl_cutoff[$count];
            $pengurangan->save();


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
            $timeline->judul = 'Pengurangan - '.$user_status;
            $timeline->ket1 = 'nopo : '.$request->get('no_surat');
            $timeline->ket2 = 'pengurangan : '.$sewa[$count];
            $timeline->ket3 = 'tgl cutoff : '.$tgl_cutoff[$count];
            $timeline->user_id = auth::user()->name;
            $timeline->save();

            if (isset($history)) {
                $history->save();
            }

            $table_template_pengurangan = new table_template_pengurangan(); 
            $table_template_pengurangan->template_id = $template_pengurangan->id;
            $table_template_pengurangan->po_id = $po->id;

            if ($po->Sewa == 'Driver') {
            }else{
               $mobil = Mobil::find($mobil_id[$count]);
               $table_template_pengurangan->merek = $mobil->id;
            }
            
            $table_template_pengurangan->nopol = $nopol[$count];
            $table_template_pengurangan->nama_cabang = $nama_cabang[$count];
            $table_template_pengurangan->kode_cabang = $kode_cabang[$count];
            $table_template_pengurangan->tgl_efektif = $tgl_cutoff[$count];
            $table_template_pengurangan->keterangan = $sewa[$count];
            $table_template_pengurangan->save();

            $backup_pengurangan->template_id = $template_pengurangan->id;
            $backup_pengurangan->table_template_id = $table_template_pengurangan->id;
            $backup_pengurangan->save();

            $approve = new approve();
            $approve->po_id = $po->id;
            $approve->template_id = $template_pengurangan->id;
            $approve->kategori = 'pengurangan';
            $approve->approve = 'waiting';
            $approve->save();

            $jumlah++;
        }

        
          return redirect('/backend/po/table/3');
        

        
        // return $request;
    }





    public function form_update_pengurangan_po_proses(Request $request)
    {

        

        $template_pengurangan = template_pengurangan::find($request->get('template_pengurangan_id'));

        $template_pengurangan->no_surat = $request->get('no_surat');
        $template_pengurangan->tgl_surat = $request->get('tgl_surat');

        $template_pengurangan->pks = $request->get('pks');
        $template_pengurangan->no_pks = $request->get('no_pks');
        $template_pengurangan->tgl_pks = $request->get('tgl_pks');

        $template_pengurangan->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_pengurangan->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_pengurangan->nama_pb1 = $request->get('nama_pb1');
        $template_pengurangan->nama_pb2 = $request->get('nama_pb2');
        $template_pengurangan->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_pengurangan->jabatan_pb2 = $request->get('jabatan_pb2');

        $template_pengurangan->save();

        $request->validate([
            'po_id.*' => 'nullable',
            'nopo_lama.*' => 'nullable',
            'nopo_pengurangan.*' => 'nullable',
            'sewa.*' => 'nullable',
            'sewa_lama.*' => 'nullable',
            'tgl_cutoff.*' => 'nullable',
            'sewa_sementara.*' => 'nullable',
            'mobil_id.*' => 'nullable',
            'nama_cabang.*' => 'nullable',
            'kode_cabang.*' => 'nullable',
            'nopol.*' => 'nullable'
        ]);

        $po_id = $request->po_id;
        $nopo_lama = $request->nopo_lama;
        $nopo_pengurangan = $request->nopo_pengurangan;
        $sewa = $request->sewa;
        $sewa_lama = $request->sewa_lama;
        $tgl_cutoff = $request->tgl_cutoff;
        $sewa_sementara = $request->sewa_sementara;
        $mobil_id = $request->mobil_id;
        $nama_cabang = $request->nama_cabang;
        $kode_cabang = $request->kode_cabang;
        $nopol = $request->nopol;

        $jumlah = 0;
        for($count = 0; $count < count($tgl_cutoff); $count++)
        {

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~ RESTORE DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~~
            $pos = $po = tpo::find($po_id[$count]);
            $backup_pengurangan = backup_pengurangan::where('po_id',$po_id[$count])->latest()->first();


            $pos->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
            $pos->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
            $pos->Pengurangan = $backup_pengurangan->Pengurangan;
            $pos->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
            $pos->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff;
            $pos->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~ RESTORE DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $po = tpo::find($po_id[$count]);
            $timeline = timeline::where('Po_id',$po_id[$count])->where('judul','Pengurangan - BPD')->orWhere('judul','Pengurangan - BOP')->latest()->first();         
            if ($po->Driver_id != '') {
                $drivers2 = DB::table('drivers')->where('Po_id', $po_id[$count])->value('id'); 
                $report_driver = report_driver::where('driver_id',$drivers2)->latest()->first();
            }
            $history = historydriver::where('Po_id',$po_id[$count])->latest()->first();

            $pengurangan = pengurangan::where('Po_id',$po_id[$count])->whereNotNull('pengurangan')->latest()->first();



            if ($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil+Driver') {
                if($sewa[$count] == 'Mobil'){
                    $po->Sewa_sementara = 'Driver';
                }elseif ($sewa[$count] == 'Driver') {
                    $po->Sewa_Sementara = 'Mobil';
                                
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }else{
                    $po->Sewa_sementara = 'null';
                    
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }
            }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Mobil'){
                if($sewa[$count] == 'Mobil'){
                    $po->Sewa_sementara = 'null';
                    // $po->Hargasewamobil_pengurangan = '0';
                }else{
                    $po->Sewa_sementara = 'null';
                    
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }
            }elseif($po->Tgl_cutoff == '' && $po->Sewa_sementara == 'Driver'){
                if($sewa[$count] == 'Driver'){
                    $po->Sewa_sementara = 'null';
                    
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }else{
                    $po->Sewa_sementara = 'null';
                    
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }
            }else{
                if ($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Mobil+Driver') {
                    $po->Sewa_sementara = 'null';
                    
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }elseif($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Driver'){
                    $po->Sewa_sementara = 'Mobil';
                    // $po->Hargasewadriver_relokasi = '0';
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }elseif($po->Sewa_sementara == 'Mobil+Driver' && $sewa[$count] == 'Mobil'){
                    $po->Sewa_sementara = 'Driver';
                    
                }elseif($po->Sewa_sementara == 'Driver' && $sewa[$count] == 'Driver'){
                    $po->Sewa_sementara = 'null';
                    
                    if (isset($history)) {
                        $history->tgl_selesai = $tgl_cutoff[$count];
                    }
                    if (isset($report_driver)) {
                        $report_driver->tgl_selesai = $tgl_cutoff[$count];
                    }

                }elseif($po->Sewa_sementara == 'Mobil' && $sewa[$count] == 'Mobil'){
                    $po->Sewa_sementara = 'null';
                }
            }

            $po->NoPo = $nopo_lama[$count];
            $po->Tgl_cutoff = $tgl_cutoff[$count];
            if($backup_pengurangan->Driver_id != '' && $backup_pengurangan->Tgl_cutoff_driver == ''){
                $po->Tgl_cutoff_driver = $tgl_cutoff[$count];
            }
            $po->Pengurangan = $sewa[$count];
            $po->Nopo_pengurangan = $request->get('no_surat');
            $po->save();

            // $pengurangan->Nopo_pengurangan = $request->nopo_pengurangan;
            $pengurangan->pengurangan = $sewa[$count];
            $pengurangan->tgl_cutoff = $tgl_cutoff[$count];
            $pengurangan->save();

            // $timeline->ket1 = 'nopo : '.$request->nopo_pengurangan;
            $timeline->ket2 = 'pengurangan : '.$sewa[$count];
            $timeline->ket3 = 'tgl cutoff : '.$tgl_cutoff[$count];
            $timeline->save();



            $table_template_pengurangan = table_template_pengurangan::where('template_id',$request->get('template_pengurangan_id'))->where('po_id',$po_id[$count])->first();
            $table_template_pengurangan->tgl_efektif = $tgl_cutoff[$count];
            $table_template_pengurangan->keterangan = $sewa[$count];
            $table_template_pengurangan->save();

            // $report_driver->save();

            if (isset($history)) {
                $history->save();
            }

        }

        // return redirect('/backend/po/pengurangan');
        return redirect('/backend/po/table/3');
    }





    public function form_delete_pengurangan_multiple_po($id,$template_id,$table_template_id)
    {
        $table_template_pengurangan = table_template_pengurangan::where('template_id',$template_id)->get();
        $table_template_pengurangan_single = table_template_pengurangan::where('template_id',$template_id)->first();
        $table_template_pengurangan_count = table_template_pengurangan::where('template_id',$template_id)->count();

        if($table_template_pengurangan_count == 1){

          $backup_pengurangan = backup_pengurangan::where('po_id',$id)->where('template_id',$template_id)->where('table_template_id',$table_template_id)->first();

          $po = tpo::find($id);

          if ($backup_pengurangan->Driver_id != '') {
              $history_driver = historydriver::where('Po_id',$id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
              $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
              $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('pengurangan')->latest()->first(); 
              
             $timeline = timeline::where('Po_id',$id)->where('judul','Delete driver - BPD')->orWhere('judul','Delete driver - BOP')->latest()->first(); 
             $timeline->delete();


              $timeline = timeline::where('Po_id',$id)->where('judul','Pengurangan - BPD')->orWhere('judul','Pengurangan - BOP')->latest()->first();
  

              $po->Sewa = $backup_pengurangan->Sewa;
              $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
              $po->NoPo = $backup_pengurangan->NoPo;
              $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
              $po->Driver_id = $backup_pengurangan->Driver_id;
              $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
              $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
              $po->Pengurangan = null;
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

               $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('pengurangan')->latest()->first(); 
               $timeline = timeline::where('Po_id',$id)->where('judul','Pengurangan - BPD')->orWhere('judul','Pengurangan - BOP')->latest()->first();       
               

               $po->Sewa = $backup_pengurangan->Sewa;
               $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
               $po->NoPo = $backup_pengurangan->NoPo;
               $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
               $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
               $po->Pengurangan = null;
               $po->save();

               // $relokasi->delete();


               $timeline->delete();
               $pengurangan->delete();
               
          }


          $backup_pengurangan->delete();


        }else{





          foreach ($table_template_pengurangan as $table_template_pengurangans) {
            if ($table_template_pengurangans->template_id == $template_id) {
              
              $backup_pengurangan = backup_pengurangan::where('po_id',$table_template_pengurangans->po_id)->where('template_id',$template_id)->where('table_template_id',$table_template_pengurangans->id)->first();
              
              $po = tpo::find($table_template_pengurangans->po_id);

              if ($backup_pengurangan->Driver_id != '') {
                  $history_driver = historydriver::where('Po_id',$table_template_pengurangans->po_id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
                  $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
                  $pengurangan = pengurangan::where('Po_id',$table_template_pengurangans->po_id)->whereNotNull('pengurangan')->latest()->first(); 
                  $timeline = timeline::where('Po_id',$table_template_pengurangans->po_id)->where('judul','Pengurangan - BPD')->orWhere('judul','Pengurangan - BOP')->latest()->first();           
                  

                  $po->Sewa = $backup_pengurangan->Sewa;
                  $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                  $po->NoPo = $backup_pengurangan->NoPo;
                  $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
                  $po->Driver_id = $backup_pengurangan->Driver_id;
                  $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                  $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
                  $po->Pengurangan = null;
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

                   $pengurangan = pengurangan::where('Po_id',$table_template_pengurangans->po_id)->whereNotNull('pengurangan')->latest()->first(); 
                   $timeline = timeline::where('Po_id',$table_template_pengurangans->po_id)->where('judul','Pengurangan - BPD')->orWhere('judul','Pengurangan - BOP')->latest()->first();           
                   

                   $po->Sewa = $backup_pengurangan->Sewa;
                   $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                   $po->NoPo = $backup_pengurangan->NoPo;
                   $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
                   $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                   $po->Pengurangan = null;
                   $po->save();

                   // $relokasi->delete();

                   $timeline->delete();
                   $pengurangan->delete();
                   
              }

              $backup_pengurangan->delete();

            }
          }

        }

       

       $table_template_pengurangan_delete = table_template_pengurangan::where('template_id',$template_id)->delete();
       $template_pengurangan = template_pengurangan::find($template_id)->delete();
       
       approve::where('template_id',$template_id)->where('kategori','pengurangan')->delete();

       return redirect('/backend/po/table/3')->with('success', 'Cutoff berhasil di batalkan');
       // return $backup_pengurangan;
    }

    public function form_pengurangan_refresh()
    {
        return redirect('/backend/po/pengurangan')->with('warning', 'refresh page not support in this page');
    }

    public function approve_pengurangan($id,$single_id)
    {
        $template_pengurangan = template_pengurangan::find($id);
        $template_pengurangan->status = '1';
        $template_pengurangan->save();

        approve::where('template_id',$id)->where('kategori','pengurangan')->delete();
        return redirect('/backend/po/table/3')->with('success','PO pengurangan berhasil di approve');
    }

    public function tampungan_pengurangan($id)
    {
      $tp_pengurangan = new tampungan_pengurangan();

      $tp_pengurangan->po_id = $id;
      $tp_pengurangan->save();

      return redirect('/backend/po/pengurangan');
    }

    public function delete_tampungan_pengurangan($id)
    {
      $tp_pengurangan = tampungan_pengurangan::find($id);

      $tp_pengurangan->delete();

      return redirect('/backend/po/pengurangan');
    }

    public function tampungan_pengurangan_driver($id)
    {
      $tp_pengurangan = new tampungan_pengurangan_driver();

      $tp_pengurangan->po_id = $id;
      $tp_pengurangan->save();

      return redirect('/backend/po/pengurangan_damira');
    }

    public function delete_tampungan_pengurangan_driver($id)
    {
      $tp_pengurangan = tampungan_pengurangan_driver::find($id);

      $tp_pengurangan->delete();

      return redirect('/backend/po/pengurangan_damira');
    }

















    public function form_pembatalan_pengurangan($id,$template_id,$table_template_id)
    {
        $table_template_pengurangan = table_template_pengurangan::where('template_id',$template_id)->get();
        $table_template_pengurangan_single = table_template_pengurangan::where('template_id',$template_id)->first();
        $table_template_pengurangan_count = table_template_pengurangan::where('template_id',$template_id)->count();

        if($table_template_pengurangan_count == 1){

          $backup_pengurangan = backup_pengurangan::where('po_id',$id)->where('template_id',$template_id)->where('table_template_id',$table_template_id)->first();

          $po = tpo::find($id);

          if ($backup_pengurangan->Driver_id != '') {
              $history_driver = historydriver::where('Po_id',$id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
              $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
              $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('pengurangan')->latest()->first(); 
              

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
              $timeline->judul = 'Pembatalan cutoff - '.$user_status;
              // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
              $timeline->ket1 = 'nopo : '.$table_template_pengurangan->template->no_surat;
              $timeline->ket2 = 'pengurangan : '.$table_template_pengurangan->keterangan;
              $timeline->user_id = auth::user()->name;
  

              $po->Sewa = $backup_pengurangan->Sewa;
              $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
              $po->NoPo = $backup_pengurangan->NoPo;
              $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
              $po->Driver_id = $backup_pengurangan->Driver_id;
              $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
              $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
              $po->Pengurangan = null;
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

               $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('pengurangan')->latest()->first();     
               

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
               $timeline->judul = 'Pembatalan cutoff - '.$user_status;
               // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
               $timeline->ket1 = 'nopo : '.$table_template_pengurangan->template->no_surat;
               $timeline->ket2 = 'pengurangan : '.$table_template_pengurangan->keterangan;
               $timeline->user_id = auth::user()->name;


               $po->Sewa = $backup_pengurangan->Sewa;
               $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
               $po->NoPo = $backup_pengurangan->NoPo;
               $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
               $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
               $po->Pengurangan = null;
               $po->save();

               // $relokasi->delete();


               $timeline->save();
               $pengurangan->delete();
               
          }


          $backup_pengurangan->delete();


        }else{





          foreach ($table_template_pengurangan as $table_template_pengurangans) {
            if ($table_template_pengurangans->template_id == $template_id) {
              
              $backup_pengurangan = backup_pengurangan::where('po_id',$table_template_pengurangans->po_id)->where('template_id',$template_id)->where('table_template_id',$table_template_pengurangans->id)->first();
              
              $po = tpo::find($table_template_pengurangans->po_id);

              if ($backup_pengurangan->Driver_id != '') {
                  $history_driver = historydriver::where('Po_id',$table_template_pengurangans->po_id)->where('Driver_id',$backup_pengurangan->Driver_id)->latest()->first(); 
                  $driver = driver::where('id',$backup_pengurangan->Driver_id)->first();
                  $pengurangan = pengurangan::where('Po_id',$table_template_pengurangans->po_id)->whereNotNull('pengurangan')->latest()->first(); 
                  

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
                  $timeline->judul = 'Pembatalan cutoff - '.$user_status;
                  // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
                  $timeline->ket1 = 'nopo : '.$table_template_pengurangan->template->no_surat;
                  $timeline->ket2 = 'pengurangan : '.$table_template_pengurangan->keterangan;
                  $timeline->user_id = auth::user()->name;          
                  

                  $po->Sewa = $backup_pengurangan->Sewa;
                  $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                  $po->NoPo = $backup_pengurangan->NoPo;
                  $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
                  $po->Driver_id = $backup_pengurangan->Driver_id;
                  $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                  $po->Tgl_cutoff_driver = $backup_pengurangan->Tgl_cutoff_driver;
                  $po->Pengurangan = null;
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

                   $pengurangan = pengurangan::where('Po_id',$table_template_pengurangans->po_id)->whereNotNull('pengurangan')->latest()->first(); 
                          
                   

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
                   $timeline->judul = 'Pembatalan cutoff - '.$user_status;
                   // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
                   $timeline->ket1 = 'nopo : '.$table_template_pengurangans->template->no_surat;
                   $timeline->ket2 = 'pengurangan : '.$table_template_pengurangans->keterangan;
                   $timeline->user_id = auth::user()->name;


                   $po->Sewa = $backup_pengurangan->Sewa;
                   $po->Sewa_sementara = $backup_pengurangan->Sewa_sementara;
                   $po->NoPo = $backup_pengurangan->NoPo;
                   $po->Nopo_pengurangan = $backup_pengurangan->Nopo_pengurangan;
                   $po->Tgl_cutoff = $backup_pengurangan->Tgl_cutoff;
                   $po->Pengurangan = null;
                   $po->save();

                   // $relokasi->delete();

                   $timeline->save();
                   $pengurangan->delete();
                   
              }

              $backup_pengurangan->delete();

            }
          }

        }

       

       $table_template_pengurangan_delete = table_template_pengurangan::where('template_id',$template_id)->delete();
       $template_pengurangan = template_pengurangan::find($template_id)->delete();
       
       approve::where('template_id',$template_id)->where('kategori','pengurangan')->delete();

       return redirect('/backend/po/table/3')->with('success', 'Cutoff berhasil di batalkan');
       // return $backup_pengurangan;
    }
}
