<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\filter_date;
use PDF;
use DataTables;
use App\approve;
use App\tampungan_relokasi;
use App\tampungan_pengurangan;
use App\tampungan_pengurangan_driver;
use App\tampungan_perubahan;
use Illuminate\Support\Facades\Auth;


class ServersideController extends Controller
{
    public function json_cabang_active(){
    	// $users = Cabang::select(['id', 'KodeCabang', 'NamaCabang', 'InisialCabang', 'CabangUtama','StatusCabang','KWL','Kota']);
        $users = Cabang::where('active',null)->orwhere('active','')->get();

        return Datatables::of($users)
        ->addColumn('action', function ($user) {
                return '<a class="btn btn-success btn-sm" href="cabang/edit/'.$user->id.'" ><i class="fas fa-pencil-alt" ></i></a>'; 
            })
        ->addColumn('delete', function ($user) {
                return '<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="cabang[]" id="customCheck'.$user->id.'" value="'.$user->id.'">
                                <label class="custom-control-label" for="customCheck'.$user->id.'"></label>
                              </div>';
            })
        ->rawColumns(['action', 'delete'])
        ->addIndexColumn()
        ->make(true);
    }

    public function json_cabang_notactive(){
        // $users = Cabang::select(['id', 'KodeCabang', 'NamaCabang', 'InisialCabang', 'CabangUtama','StatusCabang','KWL','Kota']);
        $users = Cabang::where('active','1')->get();

        return Datatables::of($users)
        ->addColumn('action', function ($user) {
                return '<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="cabang[]" id="customCheck'.$user->id.'" value="'.$user->id.'">
                                <label class="custom-control-label" for="customCheck'.$user->id.'"></label>
                              </div>';
            })
        ->addIndexColumn()
            ->make(true);
    }

    public function index(){
        return view('cabang/index');
    }





    public function json_po(Request $request){

        $tpo = tpo::with('cabang','vendor','mobil','driver','user')->wherein('status',[1]);
        

        return Datatables::eloquent($tpo)
        ->editColumn('Sewa', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            // _________________________APPROVE________________________
            $status_approve = 'null';
            if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                $status_approve = 'waiting bop';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting2')->exists()) {
                $status_approve = 'waiting2';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                $status_approve = 'waiting';
            }else{
                $status_approve = 'null';
            }
            // _________________________APPROVE________________________

            if ($status_approve == 'waiting bop' || $status_approve == 'waiting2') {
                return 'Mobil';
            }
            elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null'){
              return $po->Sewa_sementara;
            }
            else{
              return $po->Sewa;
            }
        })
        ->editColumn('Mobil_id', function(tpo $po) {
            $mobils = Mobil::all();
            if($po->Mobil_id == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Mobil_id == ''){
              return 'Tanpa unit';
            }else{
              foreach ($mobils as $mobil) {
                  if ($po->Mobil_id == $mobil->id) {
                      return $mobil->MerekMobil .' '. $mobil->Type;
                  }
              }  
            }
        })
        ->editColumn('Nopol', function(tpo $po) {
            if($po->Nopol == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Nopol == ''){
              return 'Tanpa unit';
            }
            else{
              return $po->Nopol;
            }
        })
        ->editColumn('Vendor_Driver', function(tpo $po) {
            $vendors = Vendor::find($po->Vendor_Driver);
            return $vendors->KodeVendor;
            // $vendors = Vendor::all();
            // foreach($vendors as $vendor){
            //   if($po->Vendor_Driver == $vendor->id){
            //     return $vendor->KodeVendor;
            //   }
            // }

        })
        ->editColumn('Cabang_id', function(tpo $po) {
                $cabang = Cabang::find($po->Cabang_id);
                if (!empty($cabang)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
                    $currentDate = date('m/d/Y');
                    $status_approve = 'null';

                    if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                        $status_approve = 'waiting bop';
                    }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                        $status_approve = 'waiting';
                    }else{
                        $status_approve = 'null';
                    }

                    if(empty($po->Cabang_relokasi)){
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                    }else{
                      if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                        return $po->cabang_relokasi->KodeCabang.' - '.$po->cabang_relokasi->NamaCabang;
                      }else{
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                      }
                    }  
                }
                
        })
        ->addColumn('Kota', function(tpo $po) {
            $cabang = Cabang::find($po->Cabang_id);
            if (!empty($cabang)) {
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');
                $currentDate = date('m/d/Y');
                $status_approve = 'null';

                if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                    $status_approve = 'waiting bop';
                }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                    $status_approve = 'waiting';
                }else{
                    $status_approve = 'null';
                }

                if(empty($po->Cabang_relokasi)){
                    return $po->cabang->Kota;
                }
                else{
                  if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                    return $po->cabang_relokasi->Kota;
                  }else{
                    return $po->cabang->Kota;
                  }
                }  
            }
        })
        ->editColumn('Driver_id', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->NamaDriver;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->NamaDriver;
            }       
        })->editColumn('Nip', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->nip;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->nip;
            }       
        })
        ->addColumn('status_po', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            $status_approve = 'null';

            if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                $status_approve = 'waiting bop';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                $status_approve = 'waiting';
            }else{
                $status_approve = 'null';
            }


            if($status_approve == 'waiting' || $status_approve == 'waiting bop'){
            
                return '<span class="badge badge-sm badge-secondary">outstanding</span>';
              
            }else{
              $tgl_selesai_sewa = date('m/d/Y', strtotime($po->SelesaiSewa));
            
            
              if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $status_approve == 'null'){

                  if(($po->Sewa_sementara == 'null' || $po->SelesaiSewa < $currentDateTime) && $status_approve == 'null'){
                      return '<span class="badge badge-sm badge-danger">Not Active</span>';
                  }
                  else{
                      return '<span class="badge badge-sm badge-success">Active</span>';
                  }
              }elseif($po->SelesaiSewa < $currentDateTime && $status_approve == 'null'){
                  return '<span class="badge badge-sm badge-danger">Not Active</span>';
              }
              else{
                  return '<span class="badge badge-sm badge-success">Active</span>';
              }
              
            }


            // if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' ){
            //     if($po->Sewa_sementara == 'null' || $po->SelesaiSewa <= $currentDateTime){
            //         return '<span class="badge badge-sm badge-danger">Not Active</span>';
            //     }
            //     else{
            //         return '<span class="badge badge-sm badge-success">Active</span>';
            //     }
            // }
            // elseif($po->SelesaiSewa <= $currentDateTime){
            //   return '<span class="badge badge-sm badge-danger">Not Active</span>';
            // }
            // else{
            //   return '<span class="badge badge-sm badge-success">Active</span>';
            // }
        })


        ->editColumn('created_at', function(tpo $po) {
            return date('d-M-Y', strtotime($po->created_at));
        })
        ->editColumn('created_by', function(tpo $po) {
            return $po->user->name;
        })
        ->addColumn('lihat_detail', function(tpo $po) {
            if (auth::user()->status == 'admin') {
                return
                                    '<a class="btn btn-success btn-sm" href="/pengadaanmobil/backend/po/edit_pengada/'.$po->id.'" ><i class="fas fa-pencil-alt" ></i> Edit</a>'.'
                                    <a class="btn btn-warning btn-sm" href="/pengadaanmobil/backend/po/show/'.$po->id.'"><i class="fas fa-folder"></i> Lihat detail</a>';
            }else{
                return'
                                    <a class="btn btn-warning btn-sm" href="/pengadaanmobil/backend/po/show/'.$po->id.'"><i class="fas fa-folder"></i> Lihat detail</a>';
            }
        })
        ->rawColumns(['status_po', 'lihat_detail'])
        ->addIndexColumn()
        ->make(true);
    }






























    // ______________________relokasi__________________________


    public function json_po_relokasi(){

        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('m/d/Y');

        $tpo = tpo::with('cabang','vendor','mobil','driver')->where('status','1')->where('SelesaiSewa','>',$currentDateTime);
        
        
        return Datatables::eloquent($tpo)
        ->editColumn('Sewa', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            // _________________________APPROVE________________________
            $status_approve = 'null';
            if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                $status_approve = 'waiting bop';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                $status_approve = 'waiting';
            }else{
                $status_approve = 'null';
            }
            // ________________________________________________________

            if ($status_approve == 'waiting bop') {
                return 'Mobil';
            }
            elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null'){
              return $po->Sewa_sementara;
            }
            else{
              return $po->Sewa;
            }
        })
        ->editColumn('Mobil_id', function(tpo $po) {
            $mobils = Mobil::all();
            if($po->Mobil_id == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Mobil_id == ''){
              return 'Tanpa unit';
            }else{
              foreach ($mobils as $mobil) {
                  if ($po->Mobil_id == $mobil->id) {
                      return $mobil->MerekMobil .' '. $mobil->Type;
                  }
              }  
            }
        })
        ->editColumn('Nopol', function(tpo $po) {
            if($po->Nopol == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Nopol == ''){
              return 'Tanpa unit';
            }
            else{
              return $po->Nopol;
            }
        })
        ->editColumn('Vendor_Driver', function(tpo $po) {
            $vendors = Vendor::find($po->Vendor_Driver);
            return $vendors->KodeVendor;
            // $vendors = Vendor::all();
            // foreach($vendors as $vendor){
            //   if($po->Vendor_Driver == $vendor->id){
            //     return $vendor->KodeVendor;
            //   }
            // }

        })
        ->editColumn('Cabang_id', function(tpo $po) {
                $cabang = Cabang::find($po->Cabang_id);
                if (!empty($cabang)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
                    $currentDate = date('m/d/Y');
                    $status_approve = 'null';

                    if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                        $status_approve = 'waiting bop';
                    }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                        $status_approve = 'waiting';
                    }else{
                        $status_approve = 'null';
                    }

                    if(empty($po->Cabang_relokasi)){
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                    }else{
                      if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                        return $po->cabang_relokasi->KodeCabang.' - '.$po->cabang_relokasi->NamaCabang;
                      }else{
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                      }
                    }  
                }
                        
                
        })
        ->addColumn('Kota', function(tpo $po) {
            $cabang = Cabang::find($po->Cabang_id);
            if (!empty($cabang)) {
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');
                $currentDate = date('m/d/Y');
                $status_approve = 'null';

                if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                    $status_approve = 'waiting bop';
                }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                    $status_approve = 'waiting';
                }else{
                    $status_approve = 'null';
                }

                if(empty($po->Cabang_relokasi)){
                    return $po->cabang->Kota;
                }
                else{
                  if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                    return $po->cabang_relokasi->Kota;
                  }else{
                    return $po->cabang->Kota;
                  }
                }  
            }
        })

        ->editColumn('Driver_id', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->NamaDriver;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->NamaDriver;
            }       
        })->editColumn('Nip', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->nip;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->nip;
            }       
        })
        ->addColumn('check_box', function(tpo $po) {
            return '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck'.$po->id.'" value="'.$po->id.'"><label class="custom-control-label" for="customCheck'.$po->id.'"></label></div>';
        })


        ->editColumn('created_at', function(tpo $po) {
            return date('m/d/Y', strtotime($po->created_at));
        })
        ->addColumn('select', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            if (table_template_relokasi::where('po_id',$po->id)->exists()) {
                $table_template_relokasi = table_template_relokasi::where('po_id',$po->id)->latest()->first();

                $status_approve = $table_template_relokasi->template->status;
                $id_approve = $table_template_relokasi->template->id;
            }else{
                $status_approve = 1;
                $id_approve = 'null';
            }


            $tp_approve = '';
            if(approve::where('po_id',$po->id)->exists()){
                $tp_approve = 1;
            }

            if (tampungan_relokasi::where('po_id',$po->id)->exists()) {
                return '<a class="btn btn-info btn-sm disabled" href="/pengadaanmobil/backend/po/relokasi/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelected</a>';
            }else{
                if (($status_approve == '' && $id_approve != '') || ($status_approve == '1' && $po->Efisien_relokasi != '' && $po->Efisien_relokasi >= $currentDateTime)) {
                    return '<a class="btn btn-secondary btn-sm disabled" href="/pengadaanmobil/backend/po/relokasi/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspOutstanding</a>';
                }elseif($tp_approve == '' && $po->Sewa_sementara == 'null'){
                    return '<a class="btn btn-warning btn-sm disabled" href="/pengadaanmobil/backend/po/relokasi/tampungan/'.$po->id.'"><i class="fas fa-file-excel"></i> &nbspCut off</a>';
                }else{
                    return '<a class="btn btn-primary btn-sm" href="/pengadaanmobil/backend/po/relokasi/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelect</a>';
                }
            }
        
            
            
        })
        ->rawColumns(['check_box', 'select'])
        ->addIndexColumn()
        ->make();
    }
















    // ______________________pengurangan__________________________


    public function json_po_pengurangan(){

        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('m/d/Y');

        $tpo = tpo::with('cabang','vendor','mobil','driver')->where('status','1')->where('Sewa_sementara','<>','Driver')->where('SelesaiSewa','>',$currentDateTime);
        

        return Datatables::eloquent($tpo)
        ->editColumn('Sewa', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            // _________________________APPROVE________________________
            $status_approve = 'null';
            if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                $status_approve = 'waiting bop';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                $status_approve = 'waiting';
            }else{
                $status_approve = 'null';
            }
            // ________________________________________________________

            if ($status_approve == 'waiting bop') {
                return 'Mobil';
            }
            elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null'){
              return $po->Sewa_sementara;
            }
            else{
              return $po->Sewa;
            }
        })
        ->editColumn('Mobil_id', function(tpo $po) {
            $mobils = Mobil::all();
            if($po->Mobil_id == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Mobil_id == ''){
              return 'Tanpa unit';
            }else{
              foreach ($mobils as $mobil) {
                  if ($po->Mobil_id == $mobil->id) {
                      return $mobil->MerekMobil .' '. $mobil->Type;
                  }
              }  
            }
        })
        ->editColumn('Nopol', function(tpo $po) {
            if($po->Nopol == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Nopol == ''){
              return 'Tanpa unit';
            }
            else{
              return $po->Nopol;
            }
        })
        ->editColumn('Vendor_Driver', function(tpo $po) {
            $vendors = Vendor::find($po->Vendor_Driver);
            return $vendors->KodeVendor;
            // $vendors = Vendor::all();
            // foreach($vendors as $vendor){
            //   if($po->Vendor_Driver == $vendor->id){
            //     return $vendor->KodeVendor;
            //   }
            // }

        })
        ->editColumn('Cabang_id', function(tpo $po) {
                $cabang = Cabang::find($po->Cabang_id);
                if (!empty($cabang)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
                    $currentDate = date('m/d/Y');
                    $status_approve = 'null';

                    if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                        $status_approve = 'waiting bop';
                    }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                        $status_approve = 'waiting';
                    }else{
                        $status_approve = 'null';
                    }

                    if(empty($po->Cabang_relokasi)){
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                    }
                    else{
                      if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                        return $po->cabang_relokasi->KodeCabang.' - '.$po->cabang_relokasi->NamaCabang;
                      }else{
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                      }
                    }  
                }
                        
                
        })
        ->addColumn('Kota', function(tpo $po) {
            $cabang = Cabang::find($po->Cabang_id);
            if (!empty($cabang)) {
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');
                $currentDate = date('m/d/Y');
                $status_approve = 'null';

                if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                    $status_approve = 'waiting bop';
                }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                    $status_approve = 'waiting';
                }else{
                    $status_approve = 'null';
                }

                if(empty($po->Cabang_relokasi)){
                    return $po->cabang->Kota;
                }
                else{
                  if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                    return $po->cabang_relokasi->Kota;
                  }else{
                    return $po->cabang->Kota;
                  }
                }  
            }
        })

        ->editColumn('Driver_id', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->NamaDriver;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->NamaDriver;
            }       
        })->editColumn('Nip', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->nip;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->nip;
            }       
        })
        ->addColumn('check_box', function(tpo $po) {
            return '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck'.$po->id.'" value="'.$po->id.'"><label class="custom-control-label" for="customCheck'.$po->id.'"></label></div>';
        })


        ->editColumn('created_at', function(tpo $po) {
            return date('m/d/Y', strtotime($po->created_at));
        })
        ->addColumn('select', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            if (table_template_pengurangan::where('po_id',$po->id)->exists()) {
                $table_template_pengurangan = table_template_pengurangan::where('po_id',$po->id)->latest()->first();

                $status_approve = $table_template_pengurangan->template->status;
                $id_approve = $table_template_pengurangan->template->id;
            }else{
                $status_approve = 1;
                $id_approve = 'null';
            }

            $tp_approve = '';
            if(approve::where('po_id',$po->id)->exists()){
                $tp_approve = 1;
            }

            if (tampungan_pengurangan::where('po_id',$po->id)->exists()) {
                return '<a class="btn btn-info btn-sm disabled" href="/pengadaanmobil/backend/po/pengurangan/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelected</a>';
            }else{
                if (($status_approve == '' && $id_approve != '')) {
                    return '<a class="btn btn-secondary btn-sm disabled" href="/pengadaanmobil/backend/po/pengurangan/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspOutstanding</a>';
                }elseif($tp_approve == '' && $po->Sewa_sementara == 'null'){
                    return '<a class="btn btn-warning btn-sm disabled" href="/pengadaanmobil/backend/po/pengurangan/tampungan/'.$po->id.'"><i class="fas fa-file-excel"></i> &nbspCut off</a>';
                }else{
                    return '<a class="btn btn-primary btn-sm" href="/pengadaanmobil/backend/po/pengurangan/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelect</a>';
                }
            }
            
        })
        ->rawColumns(['check_box', 'select'])
        ->addIndexColumn()
        ->make();
    }




















    // ______________________pengurangan driver__________________________


    public function json_po_pengurangan_driver(){

        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('m/d/Y');

        $tpo = tpo::with('cabang','vendor','mobil','driver')->where('status','1')->where('Sewa_sementara','driver')->where('SelesaiSewa','>',$currentDateTime);
        

        return Datatables::eloquent($tpo)
        ->editColumn('Sewa', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            // _________________________APPROVE________________________
            $status_approve = 'null';
            if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                $status_approve = 'waiting bop';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                $status_approve = 'waiting';
            }else{
                $status_approve = 'null';
            }
            // ________________________________________________________

            if ($status_approve == 'waiting bop') {
                return 'Mobil';
            }
            elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null'){
              return $po->Sewa_sementara;
            }
            else{
              return $po->Sewa;
            }
        })
        ->editColumn('Mobil_id', function(tpo $po) {
            $mobils = Mobil::all();
            if($po->Mobil_id == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Mobil_id == ''){
              return 'Tanpa unit';
            }else{
              foreach ($mobils as $mobil) {
                  if ($po->Mobil_id == $mobil->id) {
                      return $mobil->MerekMobil .' '. $mobil->Type;
                  }
              }  
            }
        })
        ->editColumn('Nopol', function(tpo $po) {
            if($po->Nopol == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Nopol == ''){
              return 'Tanpa unit';
            }
            else{
              return $po->Nopol;
            }
        })
        ->editColumn('Vendor_Driver', function(tpo $po) {
            $vendors = Vendor::find($po->Vendor_Driver);
            return $vendors->KodeVendor;
            // $vendors = Vendor::all();
            // foreach($vendors as $vendor){
            //   if($po->Vendor_Driver == $vendor->id){
            //     return $vendor->KodeVendor;
            //   }
            // }

        })
        ->editColumn('Cabang_id', function(tpo $po) {
                $cabang = Cabang::find($po->Cabang_id);
                if (!empty($cabang)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
                    $currentDate = date('m/d/Y');
                    $status_approve = 'null';

                    if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                        $status_approve = 'waiting bop';
                    }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                        $status_approve = 'waiting';
                    }else{
                        $status_approve = 'null';
                    }

                    if(empty($po->Cabang_relokasi)){
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                    }
                    else{
                      if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                        return $po->cabang_relokasi->KodeCabang.' - '.$po->cabang_relokasi->NamaCabang;
                      }else{
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                      }
                    }  
                }
                        
                
        })
        ->addColumn('Kota', function(tpo $po) {
            $cabang = Cabang::find($po->Cabang_id);
            if (!empty($cabang)) {
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');
                $currentDate = date('m/d/Y');
                $status_approve = 'null';

                if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                    $status_approve = 'waiting bop';
                }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                    $status_approve = 'waiting';
                }else{
                    $status_approve = 'null';
                }

                if(empty($po->Cabang_relokasi)){
                    return $po->cabang->Kota;
                }
                else{
                  if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                    return $po->cabang_relokasi->Kota;
                  }else{
                    return $po->cabang->Kota;
                  }
                }  
            }
        })

        ->editColumn('Driver_id', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->NamaDriver;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->NamaDriver;
            }       
        })->editColumn('Nip', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->nip;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->nip;
            }       
        })
        ->addColumn('check_box', function(tpo $po) {
            return '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck'.$po->id.'" value="'.$po->id.'"><label class="custom-control-label" for="customCheck'.$po->id.'"></label></div>';
        })


        ->editColumn('created_at', function(tpo $po) {
            return date('m/d/Y', strtotime($po->created_at));
        })
        ->addColumn('select', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            if (table_template_pengurangan::where('po_id',$po->id)->exists()) {
                $table_template_pengurangan = table_template_pengurangan::where('po_id',$po->id)->latest()->first();

                $status_approve = $table_template_pengurangan->template->status;
                $id_approve = $table_template_pengurangan->template->id;
            }else{
                $status_approve = 1;
                $id_approve = 'null';
            }

            $tp_approve = '';
            if(approve::where('po_id',$po->id)->exists()){
                $tp_approve = 1;
            }

            if (tampungan_pengurangan_driver::where('po_id',$po->id)->exists()) {
                return '<a class="btn btn-info btn-sm disabled" href="/pengadaanmobil/backend/po/pengurangan_driver/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelected</a>';
            }else{
                if (($status_approve == '' && $id_approve != '')) {
                    return '<a class="btn btn-secondary btn-sm disabled" href="/pengadaanmobil/backend/po/pengurangan_driver/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspOutstanding</a>';
                }elseif($tp_approve == '' && $po->Sewa_sementara == 'null'){
                    return '<a class="btn btn-warning btn-sm disabled" href="/pengadaanmobil/backend/po/pengurangan/tampungan/'.$po->id.'"><i class="fas fa-file-excel"></i> &nbspCut off</a>';
                }else{
                    return '<a class="btn btn-primary btn-sm" href="/pengadaanmobil/backend/po/pengurangan_driver/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelect</a>';
                }
            }


        })
        ->rawColumns(['check_box', 'select'])
        ->addIndexColumn()
        ->make();
    }


    


















    // ______________________perubahan__________________________


    public function json_po_perubahan(){
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('m/d/Y');

        $tpo = tpo::with('cabang','vendor','mobil','driver')->where('status','1')->wherein('Sewa_sementara',['Mobil+Driver','Mobil'])->where('SelesaiSewa','>',$currentDateTime);
        

        return Datatables::eloquent($tpo)
        ->editColumn('Sewa', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            // _________________________APPROVE________________________
            $status_approve = 'null';
            if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                $status_approve = 'waiting bop';
            }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                $status_approve = 'waiting';
            }else{
                $status_approve = 'null';
            }
            // ________________________________________________________

            if ($status_approve == 'waiting bop') {
                return 'Mobil';
            }
            elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null'){
              return $po->Sewa_sementara;
            }
            else{
              return $po->Sewa;
            }
        })
        ->editColumn('Mobil_id', function(tpo $po) {
            $mobils = Mobil::all();
            if($po->Mobil_id == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Mobil_id == ''){
              return 'Tanpa unit';
            }else{
              foreach ($mobils as $mobil) {
                  if ($po->Mobil_id == $mobil->id) {
                      return $mobil->MerekMobil .' '. $mobil->Type;
                  }
              }  
            }
        })
        ->editColumn('Nopol', function(tpo $po) {
            if($po->Nopol == 'null'){
              return 'Tanpa unit';
            }
            elseif($po->Nopol == ''){
              return 'Tanpa unit';
            }
            else{
              return $po->Nopol;
            }
        })
        ->editColumn('Vendor_Driver', function(tpo $po) {
            $vendors = Vendor::find($po->Vendor_Driver);
            return $vendors->KodeVendor;
            // $vendors = Vendor::all();
            // foreach($vendors as $vendor){
            //   if($po->Vendor_Driver == $vendor->id){
            //     return $vendor->KodeVendor;
            //   }
            // }

        })
        ->editColumn('Cabang_id', function(tpo $po) {
                $cabang = Cabang::find($po->Cabang_id);
                if (!empty($cabang)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
                    $currentDate = date('m/d/Y');
                    $status_approve = 'null';

                    if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                        $status_approve = 'waiting bop';
                    }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                        $status_approve = 'waiting';
                    }else{
                        $status_approve = 'null';
                    }

                    if(empty($po->Cabang_relokasi)){
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                    }
                    else{
                      if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                        return $po->cabang_relokasi->KodeCabang.' - '.$po->cabang_relokasi->NamaCabang;
                      }else{
                        return $po->cabang->KodeCabang.' - '.$po->cabang->NamaCabang;
                      }
                    }  
                }
                        
                
        })
        ->addColumn('Kota', function(tpo $po) {
            $cabang = Cabang::find($po->Cabang_id);
            if (!empty($cabang)) {
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');
                $currentDate = date('m/d/Y');
                $status_approve = 'null';

                if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                    $status_approve = 'waiting bop';
                }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                    $status_approve = 'waiting';
                }else{
                    $status_approve = 'null';
                }

                if(empty($po->Cabang_relokasi)){
                    return $po->cabang->Kota;
                }
                else{
                  if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null'){
                    return $po->cabang_relokasi->Kota;
                  }else{
                    return $po->cabang->Kota;
                  }
                }  
            }
        })

        ->editColumn('Driver_id', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->NamaDriver;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->NamaDriver;
            }       
        })->editColumn('Nip', function(tpo $po) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');
            if ($po->Driver_id == '' || $po->Driver_id == null) {
                $connect = 'no';
                $nopol_connect = '';  
                $drivers = driver::all();
                foreach($drivers as $driver){
                $history_driver = historydriver::where('Driver_id',$driver->id)->where('Po_id',$po->id)->first();
                if (!empty($history_driver)) {
                            if($history_driver->tgl_selesai > $currentDate){
                                return $driver->nip;
                                // $connect = 'yes';
                            }
                }else{
                 return ' - '; 
                }
               }
               if($connect == 'no'){
                 return ' - ';
               }
            }else{
                
                    return $driver->nip;
            }       
        })
        ->addColumn('check_box', function(tpo $po) {
            return '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck'.$po->id.'" value="'.$po->id.'"><label class="custom-control-label" for="customCheck'.$po->id.'"></label></div>';
        })


        ->editColumn('created_at', function(tpo $po) {
            return date('m/d/Y', strtotime($po->created_at));
        })
        ->addColumn('select', function(tpo $po) {

            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('m/d/Y');

            if (table_template_perubahan::where('po_id',$po->id)->exists()) {
                $table_template_perubahan = table_template_perubahan::where('po_id',$po->id)->latest()->first();

                $status_approve = $table_template_perubahan->template->status;
                $id_approve = $table_template_perubahan->template->id;
            }else{
                $status_approve = 1;
                $id_approve = 'null';
            }

            $tp_approve = '';
            if(approve::where('po_id',$po->id)->exists()){
                $tp_approve = 1;
            }


            if (tampungan_perubahan::where('po_id',$po->id)->exists()) {
                return '<a class="btn btn-info btn-sm disabled" href="/pengadaanmobil/backend/po/perubahan/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelected</a>';
            }else{
                if (($status_approve == '' && $id_approve != '')) {
                    return '<a class="btn btn-secondary btn-sm disabled" href="/pengadaanmobil/backend/po/perubahan/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspOutstanding</a>';
                }elseif($tp_approve == '' && $po->Sewa_sementara == 'null'){
                    return '<a class="btn btn-warning btn-sm disabled" href="/pengadaanmobil/backend/po/perubahan/tampungan/'.$po->id.'"><i class="fas fa-file-excel"></i> &nbspCut off</a>';
                }else{
                    return '<a class="btn btn-primary btn-sm" href="/pengadaanmobil/backend/po/perubahan/tampungan/'.$po->id.'"><i class="fas fa-file-upload"></i> &nbspSelect</a>';
                }
            }
            
        })
        ->rawColumns(['check_box', 'select'])
        ->addIndexColumn()
        ->make();
    }


}