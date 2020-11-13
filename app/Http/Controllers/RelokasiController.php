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
use App\approve;
use App\tampungan_relokasi;
use PDF;

class RelokasiController extends Controller
{
    //
    public function relokasi_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $jabatans = jabatan::all();
        $table_template_relokasis = table_template_relokasi::all();
        $template_relokasis = template_relokasi::all();

        $tp_relokasis = tampungan_relokasi::all();


        return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','table_template_relokasis','template_relokasis','tp_relokasis'));
    }

    public function form_relokasi_po($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::find($id);
        $nopos = Nopo::all();
        $jabatans = jabatan::all();
        $unitkerjas = unitkerja::all();
        $pejabats = pejabat::all()->sortBy('nama');
        $poss = tpo::where('id',$id)->get();
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        return view('PO/form_relokasi_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
    }

    // public function form_relokasi_multiple_po(Request $request)
    // {
    //     // return $request->relokasi
    //     $po_single = tpo::find($request->relokasi[0]);
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
    //     if ($request->get('relokasi') != '') {
    //         $poss = tpo::whereIn('id',$request->get('relokasi'))->get();
    //         for ($i=0; $i < $poss->count(); $i++) { 
    //           if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
    //              $pos = tpo::all();
    //              return redirect('/backend/po/relokasi')->with('warning','Tolong pilih vendor yang sama');
    //           }
    //         }
    //         return view('PO/form_relokasi_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
    //     }else{
    //         $pos = tpo::all();
    //         return redirect('/backend/po/relokasi')->with('warning','Tidak ada item yang dipilih');
    //     }
        
    // }

    public function form_relokasi_multiple_po_button()
    {
        $relokasi = tampungan_relokasi::all()->pluck('po_id')->toarray();
        // return tampungan_relokasi::all()->pluck('id')->toarray();
        $po_single = tpo::find($relokasi[0]);
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
        if (tampungan_relokasi::all()->count() != 0) {
            $poss = tpo::whereIn('id',tampungan_relokasi::all()->pluck('po_id')->toarray())->get();
            for ($i=0; $i < tampungan_relokasi::all()->count(); $i++) { 
              if ($poss[$i]->Vendor_Driver != $po_single->Vendor_Driver) {
                 $pos = tpo::all();
                 return redirect('/backend/po/relokasi')->with('warning','Pilih vendor yang sama');
              }
            }
            return view('PO/form_relokasi_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
            // if ($poss->Vendor_Driver == $po_single->Vendor_Driver) {
            //   return view('PO/form_relokasi_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','pkss','addendums'));
            // }else{
            //   $pos = tpo::all();
            //   return redirect('/backend/po/relokasi')->with('warning','Vendor Berbeda');
            // }
        }else{
            $pos = tpo::all();
            return redirect('/backend/po/relokasi')->with('warning','Tidak ada item yang dipilih');
            // return view('PO/relokasi',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'))->with('Warning','Pilih salah satu');
        }
    }

    public function form_update_relokasi_multiple_po($id,$single_id)
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
        $table_template_relokasi = table_template_relokasi::find($single_id);
        $table_template_relokasis = table_template_relokasi::all()->sortByDesc('id');
        $po_id = tpo::find($table_template_relokasi->po_id);
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('id');
        // $poss = tpo::whereIn('id',$request->get('relokasi'))->get();
        $poss = tpo::all();
        return view('PO/form_update_relokasi_multiple',compact('poss','cabangs','umps','vendors','drivers','mobils','nopos','jabatans','unitkerjas','pejabats','template_relokasi','table_template_relokasi','table_template_relokasis','po_id','pkss','addendums'));
    }

    

    public function po_edit_relokasi_multiple(Request $request, $id)

    {

        $template_relokasi = new template_relokasi();

        $template_relokasi->no_surat = $request->get('no_surat');
        $template_relokasi->tgl_surat = $request->get('tgl_surat');
        $template_relokasi->nama_vendor = $request->get('nama_vendor');
        $template_relokasi->pic_vendor = $request->get('pic_vendor');
        $template_relokasi->jabatan_vendor = $request->get('jabatan_vendor');
        $template_relokasi->alamat_vendor = $request->get('alamat_vendor');
        $template_relokasi->sewa = $request->get('sewa');
        $template_relokasi->jml_mobil = $request->get('jml_mobil');
        $template_relokasi->jml_driver = $request->get('jml_driver');

        $template_relokasi->pks = $request->get('pks');
        $template_relokasi->no_pks = $request->get('no_pks');
        $template_relokasi->tgl_pks = $request->get('tgl_pks');

        $template_relokasi->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_relokasi->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_relokasi->nama_pb1 = $request->get('nama_pb1');
        $template_relokasi->nama_pb2 = $request->get('nama_pb2');
        $template_relokasi->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_relokasi->jabatan_pb2 = $request->get('jabatan_pb2');

        $template_relokasi->save();

        $request->validate([
            'po_id.*' => 'nullable',
            'nopo_lama.*' => 'nullable',
            'nopo_relokasi.*' => 'nullable',
            'cabang_relokasi.*' => 'required',
            'tgl_efektif_relokasi.*' => 'required',
            'cabang_lama.*' => 'nullable',
            'hargasewadriver.*' => 'nullable',
            'hargasewadriver_relokasi.*' => 'nullable',
            'nopol.*' => 'nullable',
            'status_cabang_lama.*' => 'nullable',
            'nama_cabang_lama.*' => 'nullable',
            'kode_cabang_lama.*' => 'nullable',
            'mobil_id.*' => 'nullable'
        ]);


        $Po_id = $request->po_id;
        $NoPo = $request->nopo_lama;
        $Cabang_relokasi = $request->cabang_relokasi;
        $Efisien_relokasi = $request->tgl_efektif_relokasi;
        $Cabang_id = $request->cabang_lama;
        $Nopo_relokasi = $request->nopo_relokasi;
        $HargaSewaDriver2019 = $request->hargasewadriver;
        $Hargasewadriver_relokasi = $request->hargasewadriver_relokasi;
        $Cabang_lama = $request->cabang_lama;
        $Efisien_relokasi = $request->tgl_efektif_relokasi;
        $Mobil_id = $request->mobil_id;

        $nopol = $request->nopol;
        $status_cabang_lama = $request->status_cabang_lama;
        $nama_cabang_lama = $request->nama_cabang_lama;
        $kode_cabang_lama = $request->kode_cabang_lama;

        $jumlah = 0;
        for($count = 0; $count < count($Cabang_relokasi); $count++)
        {
                   $po = tpo::find($Po_id[$count]);
                   $relokasi = new Relokasi();      
                   $timeline = new timeline();
                   $approve = new approve();             
                   $table_template_relokasi = new table_template_relokasi();
                   

                   $po->NoPo = $NoPo[$count];
                   $po->Cabang_relokasi = $Cabang_relokasi[$count];
                   $po->Efisien_relokasi = $Efisien_relokasi[$count];
                   $po->Cabang_id = $Cabang_id[$count];
                   // $po->Nopo_relokasi = $Nopo_relokasi[$count];
                   $po->Nopo_relokasi = $request->get('no_surat');
                   $po->Po_multiple_start = '';
                   $po->Po_multiple_end = '';
                   $po->HargaSewaDriver2019 = $HargaSewaDriver2019[$count];
                   $po->Hargasewadriver_relokasi = $Hargasewadriver_relokasi[$count];

                   $relokasi->Po_id = $Po_id[$count];
                   $relokasi->Cabang_id_lama = $Cabang_lama[$count];
                   $relokasi->Cabang_id = $Cabang_relokasi[$count];
                   $relokasi->Efisien_relokasi = $Efisien_relokasi[$count];
                   // $relokasi->Nopo_relokasi = $Nopo_relokasi[$count];
                   $relokasi->Nopo_relokasi = $request->get('no_surat');
                   $po->save();

                   $relokasi->save();

                   $cabang = Cabang::find($Cabang_relokasi[$count]);



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
                   $timeline->judul = 'Relokasi - '.$user_status;
                   // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
                   $timeline->ket1 = 'nopo : '.$request->get('no_surat');
                   $timeline->ket2 = 'relokasi : '.$cabang->KodeCabang.' - '.$cabang->NamaCabang.' - '.$cabang->Kota;
                   $timeline->ket3 = 'tgl efektif : '.$Efisien_relokasi[$count];
                   $timeline->user_id = auth::user()->name;

                   $timeline->save();

                   

                   $table_template_relokasi->template_id = $template_relokasi->id;
                   $table_template_relokasi->po_id = $po->id;

                   if ($po->Sewa_sementara == 'Driver') {
                     
                   }else{
                      $mobil = Mobil::find($Mobil_id[$count]); 
                      $table_template_relokasi->merek = $mobil->id;
                   }
                   
                   $table_template_relokasi->nopol = $nopol[$count];
                   $table_template_relokasi->sewa = $po->Sewa_sementara;
                   $table_template_relokasi->status_cabang_lama = $status_cabang_lama[$count];
                   $table_template_relokasi->nama_cabang_lama = $nama_cabang_lama[$count];
                   $table_template_relokasi->kode_cabang_lama = $kode_cabang_lama[$count];
                   $table_template_relokasi->status_cabang_baru = $cabang->StatusCabang;
                   $table_template_relokasi->nama_cabang_baru = $cabang->NamaCabang;
                   $table_template_relokasi->kode_cabang_baru = $cabang->KodeCabang;
                   $table_template_relokasi->tgl_efektif = $Efisien_relokasi[$count];

                   $table_template_relokasi->save();
                   $jumlah++;

                   $approve->po_id = $po->id;
                   $approve->template_id = $template_relokasi->id;
                   $approve->kategori = 'relokasi';
                   $approve->approve = 'waiting';
                   $approve->save();
        }

        // if ($jumlah == 1) {
        //   return redirect('/backend/po/show/'.$Po_id[0]);
        // }else{
          return redirect('/backend/po/table/2');
        
        
    }

    public function form_update_relokasi_po_proses(Request $request)
    {
        $template_relokasi = template_relokasi::find($request->get('template_relokasi_id'));

        $template_relokasi->no_surat = $request->get('no_surat');
        $template_relokasi->tgl_surat = $request->get('tgl_surat');

        $template_relokasi->pks = $request->get('pks');
        $template_relokasi->no_pks = $request->get('no_pks');
        $template_relokasi->tgl_pks = $request->get('tgl_pks');

        $template_relokasi->unitkerja_pb1 = $request->get('unitkerja_pb1');
        $template_relokasi->unitkerja_pb2 = $request->get('unitkerja_pb2');
        $template_relokasi->nama_pb1 = $request->get('nama_pb1');
        $template_relokasi->nama_pb2 = $request->get('nama_pb2');
        $template_relokasi->jabatan_pb1 = $request->get('jabatan_pb1');
        $template_relokasi->jabatan_pb2 = $request->get('jabatan_pb2');

        $template_relokasi->save();

        $request->validate([
            'po_id.*' => 'nullable',
            'nopo_lama.*' => 'nullable',
            'nopo_relokasi.*' => 'nullable',
            'cabang_relokasi.*' => 'required',
            'tgl_efektif_relokasi.*' => 'required',
            'cabang_lama.*' => 'nullable',
            'hargasewadriver.*' => 'nullable',
            'hargasewadriver_relokasi.*' => 'nullable',
            'nopol.*' => 'nullable',
            'status_cabang_lama.*' => 'nullable',
            'nama_cabang_lama.*' => 'nullable',
            'kode_cabang_lama.*' => 'nullable',
            'mobil_id.*' => 'nullable'
        ]);

        $Po_id = $request->po_id;
        $NoPo = $request->nopo_lama;
        $Cabang_relokasi = $request->cabang_relokasi;
        $Efisien_relokasi = $request->tgl_efektif_relokasi;
        $Cabang_id = $request->cabang_lama;
        $Nopo_relokasi = $request->nopo_relokasi;
        $HargaSewaDriver2019 = $request->hargasewadriver;
        $Hargasewadriver_relokasi = $request->hargasewadriver_relokasi;
        $Cabang_lama = $request->cabang_lama;
        $Efisien_relokasi = $request->tgl_efektif_relokasi;
        $Mobil_id = $request->mobil_id;

        $nopol = $request->nopol;
        $status_cabang_lama = $request->status_cabang_lama;
        $nama_cabang_lama = $request->nama_cabang_lama;
        $kode_cabang_lama = $request->kode_cabang_lama;

        for($count = 0; $count < count($Cabang_relokasi); $count++)
        {
        $po = tpo::find($Po_id[$count]);
                   $relokasi = Relokasi::where('Po_id',$Po_id[$count])->latest()->first();
                   $timeline = timeline::where('Po_id',$Po_id[$count])->where('judul','Relokasi - BPD')->orWhere('judul','Relokasi - BOP')->latest()->first();               
                   $table_template_relokasi = table_template_relokasi::where('template_id',$request->get('template_relokasi_id'))->where('po_id',$Po_id[$count])->first();
                   

                   // $po->NoPo = $NoPo[$count];
                   $po->Cabang_relokasi = $Cabang_relokasi[$count];
                   $po->Efisien_relokasi = $Efisien_relokasi[$count];
                   $po->Nopo_relokasi = $request->get('no_surat');
                   $po->Po_multiple_start = '';
                   $po->Po_multiple_end = '';
                   // $po->HargaSewaDriver2019 = $request->hargasewadriver;
                   $po->Hargasewadriver_relokasi = $Hargasewadriver_relokasi[$count];
                   $po->save();

                   $relokasi->Po_id = $Po_id[$count];
                   // $relokasi->Cabang_id_lama = $request->cabang_lama;
                   $relokasi->Cabang_id = $Cabang_relokasi[$count];
                   $relokasi->Efisien_relokasi = $Efisien_relokasi[$count];
                   // $relokasi->Nopo_relokasi = $request->nopo_relokasi;
                   $relokasi->save();

                   $cabang = Cabang::find($Cabang_relokasi[$count]);
  

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
                   $timeline->judul = 'Relokasi - '.$user_status;
                   // $timeline->ket1 = 'nopo : '.$request->nopo_relokasi;
                   $timeline->ket2 = 'relokasi : '.$cabang->KodeCabang.' - '.$cabang->NamaCabang.' - '.$cabang->Kota;
                   $timeline->ket3 = 'tgl efektif : '.$Efisien_relokasi[$count];
                   $timeline->user_id = auth::user()->name;
                   
                   $timeline->save();

                   // if ($po->Sewa_sementara == 'Driver') {
                     
                   // }else{
                   //    $mobil = Mobil::find($Mobil_id[$count]); 
                   //    $table_template_relokasi->merek = $mobil->id;
                   // }

                   $table_template_relokasi->template_id = $template_relokasi->id;
                   $table_template_relokasi->po_id = $po->id;
                   // $table_template_relokasi->merek = $mobil->id;
                   $table_template_relokasi->nopol = $request->nopol;
                   // $table_template_relokasi->status_cabang_lama = $request->status_cabang_lama;
                   // $table_template_relokasi->nama_cabang_lama = $request->nama_cabang_lama;
                   // $table_template_relokasi->kode_cabang_lama = $request->kode_cabang_lama;
                   $table_template_relokasi->status_cabang_baru = $cabang->StatusCabang;
                   $table_template_relokasi->nama_cabang_baru = $cabang->NamaCabang;
                   $table_template_relokasi->kode_cabang_baru = $cabang->KodeCabang;
                   $table_template_relokasi->tgl_efektif = $Efisien_relokasi[$count];
                   $table_template_relokasi->save();
                    // $relokasi = Relokasi::where('Po_id',$Po_id[$count])->latest()->first();

              }
                   
             return redirect('/backend/po/table/2');
             // return $table_template_relokasi;
    }

    public function form_delete_relokasi_multiple_po($id,$template_id,$table_template_id)
    {
                   
                   $table_template_relokasi = table_template_relokasi::where('template_id',$template_id)->get();
                   $table_template_relokasi_single = table_template_relokasi::where('template_id',$template_id)->first();
                   $table_template_relokasi_count = table_template_relokasi::where('template_id',$template_id)->count();
                   
                   if($table_template_relokasi_count == 1){

                     $po = tpo::find($table_template_relokasi_single->po_id);
                     $relokasi = Relokasi::where('Po_id',$table_template_relokasi_single->po_id)->latest()->first();
                     $timeline = timeline::where('Po_id',$table_template_relokasi_single->po_id)->where('judul','Relokasi - BPD')->orWhere('judul','Relokasi - BOP')->latest()->first();



                     $po->Cabang_relokasi = null;
                     $po->Efisien_relokasi = null;
                     $po->Nopo_relokasi = null;
                     $po->Hargasewadriver_relokasi = $po->HargaSewaDriver2019;
                     $po->save();

                     $relokasi->delete();

                     $cabang = Cabang::find($po->Cabang_id);

                     $timeline->delete();

                    // return $po->id;

                   }else{

                     foreach ($table_template_relokasi as $table_template_relokasis) {
                       if ($table_template_relokasis->template_id == $template_id) {
                         $po = tpo::find($table_template_relokasis->po_id);
                         $relokasi = Relokasi::where('Po_id',$table_template_relokasis->po_id)->latest()->first();
                         $timeline = timeline::where('Po_id',$table_template_relokasis->po_id)->where('judul','Relokasi - BPD')->orWhere('judul','Relokasi - BOP')->latest()->first();
                          

                          $po->Cabang_relokasi = null;
                          $po->Efisien_relokasi = null;
                          $po->Nopo_relokasi = null;
                          $po->Hargasewadriver_relokasi = $po->HargaSewaDriver2019;
                          $po->save();

                          $relokasi->delete();

                          $cabang = Cabang::find($po->Cabang_id); 

                          $timeline->delete();

                       }
                     }

                   }
                  
                   $table_template_relokasi_delete = table_template_relokasi::where('template_id',$template_id)->delete();
                   $template_relokasi = template_relokasi::find($template_id)->delete();
                   approve::where('template_id',$template_id)->where('kategori','relokasi')->delete();
        	                     
                   return redirect('/backend/po/table/2')->with('success', 'Relokasi berhasil di batalkan');
                  //  // return $table_template_relokasi;

                    // // $po = tpo::find($id);
                  // //  $relokasi = Relokasi::where('Po_id',$id)->latest()->first();
                  // //  $timeline = timeline::where('Po_id',$id)->where('judul','Relokasi - BPD')->orWhere('judul','Relokasi - BOP')->latest()->first();


                  // //  $po->Cabang_relokasi = null;
                  // //  $po->Efisien_relokasi = null;
                  // //  $po->Nopo_relokasi = null;
                  // //  $po->Hargasewadriver_relokasi = $po->HargaSewaDriver2019;
                  // //  $po->save();

                  // //  $relokasi->delete();

                  // //  $cabang = Cabang::find($po->Cabang_id);


                  // //  $timeline->delete();

                  //  // $table_template_relokasi->delete();
                  //  // $template_relokasi->delete();


                   
    }

    public function form_pembatalan_relokasi($po_id,$template_id,$table_template_id)
    {
         
         
         $table_template_relokasi = table_template_relokasi::where('template_id',$template_id)->get();
         $table_template_relokasi_count = table_template_relokasi::where('template_id',$template_id)->count();



         foreach ($table_template_relokasi as $table_template_relokasis) {
           
             $po = tpo::find($table_template_relokasis->po_id);
             $relokasi = Relokasi::where('Po_id',$table_template_relokasis->po_id)->latest()->first();

             $po->Cabang_relokasi = null;
             $po->Efisien_relokasi = null;
             $po->Nopo_relokasi = null;
             $po->Hargasewadriver_relokasi = $po->HargaSewaDriver2019;

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
             $timeline->judul = 'Pembatalan relokasi - '.$user_status;
             // $timeline->ket1 = 'nopo : '.$Nopo_relokasi[$count];
             $timeline->ket1 = 'nopo : '.$table_template_relokasis->template->no_surat;
             $timeline->ket2 = 'relokasi : '.$table_template_relokasis->kode_cabang_baru.' - '.$table_template_relokasis->nama_cabang_baru.' - '.$table_template_relokasis->status_cabang_baru;
             $timeline->user_id = auth::user()->name;

             $relokasi->delete();
             $timeline->save();
             $po->save();
           
         }

         
         $table_template_relokasi_delete = table_template_relokasi::where('template_id',$template_id)->delete();

         $template_relokasi = template_relokasi::where('id',$template_id)->delete();
        

         return redirect('/backend/po/table/2')->with('success', 'Relokasi berhasil di batalkan');
    }

    public function form_relokasi_refresh()
    {
        return redirect('/backend/po/relokasi')->with('warning', 'refresh page not support in this page');
    }

    public function approve_relokasi($id,$single_id)
    {
        $template_relokasi = template_relokasi::find($id);
        $template_relokasi->status = '1';
        $template_relokasi->save();

        approve::where('template_id',$id)->where('kategori','relokasi')->delete();
        
        return redirect('/backend/po/table/2')->with('success','PO relokasi berhasil di approve');
    }

    public function tampungan_relokasi($id)
    {
      $tp_relokasi = new tampungan_relokasi();

      $tp_relokasi->po_id = $id;
      $tp_relokasi->save();

      return redirect('/backend/po/relokasi');
    }

    public function delete_tampungan_relokasi($id)
    {
      $tp_relokasi = tampungan_relokasi::find($id);

      $tp_relokasi->delete();

      return redirect('/backend/po/relokasi');
    }


}
