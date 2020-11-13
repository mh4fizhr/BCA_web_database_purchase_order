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
use PDF;
use App\pejabat;
use App\unitkerja;
use App\jabatan;

class PejabatController extends Controller
{
   public function index_jabatan()
    {
        //
        $jabatans = jabatan::all()->sortBy('jabatan');
        $s = 'active';
        return view('pejabat/jabatan/index',compact('jabatans','s'));
    }

    public function index_jabatan_status($status)
    {
        //
        $jabatans = jabatan::all()->sortBy('jabatan');
        $s = $status;
        return view('pejabat/jabatan/index',compact('jabatans','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_jabatan()
    {
        //
        return view('pejabatan/jabatan/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_jabatan(Request $request)
    {
        //
        $jabatan = new jabatan();
        $request->validate([
            'jabatan' => 'required|unique:jabatans'
        ]);

        $jabatan->jabatan = $request->jabatan;

        $jabatan->save();
        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/jabatan')->with('success','jabatan berhasil ditambahkan');
        }else{
            return redirect('/backend/pejabat/jabatan')->with('success','jabatan berhasil ditambahkan');
        }
    }

    public function edit_jabatan($id){
        $jabatan = jabatan::find($id);
        return view('pejabat/jabatan/edit',compact('jabatan'));
    }


    public function edit_proses_jabatan(Request $request,$id){
        $jabatan = jabatan::find($id);
        if (strtoupper($request->get('jabatan')) == strtoupper($jabatan->jabatan)) {
            $request->validate([
                'jabatan' => 'required'
            ]);
            $pejabat = pejabat::where('jabatan_id',$jabatan->jabatan)->update(['jabatan_id'=> $request->jabatan]);  
            $jabatan->jabatan = $request->jabatan;
            $jabatan->save();

        }else{
            $request->validate([
                'jabatan' => 'required|unique:jabatans'
            ]);
            $pejabat = pejabat::where('jabatan_id',$jabatan->jabatan)->update(['jabatan_id'=> $request->jabatan]);  
            $jabatan->jabatan = $request->jabatan;
            $jabatan->save();

        }
        
        // $pejabat->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/jabatan')->with('success','jabatan berhasil diupdate');
        }else{
            return redirect('/backend/pejabat/jabatan')->with('success','jabatan berhasil diupdate');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_jabatan($id)
    {
        //
        $jabatan = jabatan::find($id);

        if ($jabatan->active == '1') {
            $jabatan->active = '';
            $jabatan->save();

            return redirect('/backend/ump/jabatan')->with('success','jabatan berhasil direstore');
        }else{
            $jabatan->active = '1';
            $jabatan->save();

            return redirect('/backend/pejabat/jabatan')->with('success','jabatan berhasil dihapus');
        }

    }


    public function destroy_jabatan_multiple(Request $request)
    {
        $request->validate([
            'pejabat.*' => 'nullable',
        ]);

        $jabatan = $request->pejabat;

        $return = 0;

        if ($jabatan == '') {
            return redirect('/backend/pejabat/jabatan')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($jabatan); $count++)
            {

               $Jabatan = jabatan::find($jabatan[$count]);
               if ($Jabatan->active != '1') {
                   $Jabatan->active = '1';
                   $Jabatan->save();
                   $return = 1;
               }else{
                    $Jabatan->active = '';
                    $Jabatan->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/pejabat/jabatan')->with('success','jabatan berhasil direstore');
            }else{
                return redirect('/backend/pejabat/jabatan')->with('success','jabatan berhasil dihapus');
            }
        }
        
    }


    public function check_jabatan(Request $request)
    {
        if($request->get('jabatan'))
        {
          $jabatan = $request->get('jabatan');
          $data = DB::table("jabatans")
                   ->where('jabatan', $jabatan)
                   ->count();
          if($data > 0)
          {
            echo 'not_unique';
          }
          else
          {
            echo 'unique';
          }
         }
    }


    // _____________________________unitkerja_______________________________

    public function index_unitkerja()
     {
         //
         $unitkerjas = unitkerja::all()->sortBy('unitkerja');
         $s = 'active';
         return view('pejabat/unitkerja/index',compact('unitkerjas','s'));
     }

     public function index_unitkerja_status($status)
     {
         //
         $unitkerjas = unitkerja::all()->sortBy('unitkerja');
         $s = $status;
         return view('pejabat/unitkerja/index',compact('unitkerjas','s'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create_unitkerja()
     {
         //
         return view('pejabat/unitkerja/create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store_unitkerja(Request $request)
     {
         //
         $unitkerja = new unitkerja();
         $request->validate([
             'unitkerja' => 'required|unique:unitkerjas'
         ]);

         $unitkerja->unitkerja = $request->unitkerja;

         $unitkerja->save();
         
         if (auth::user()->status == 'admin') {
             return redirect('/backend/admin/unitkerja')->with('success','unitkerja berhasil ditambahkan');
         }else{
             return redirect('/backend/pejabat/unitkerja')->with('success','unitkerja berhasil ditambahkan');
         }
     }

     public function edit_unitkerja($id){
         $unitkerja = unitkerja::find($id);
         return view('pejabat/unitkerja/edit',compact('unitkerja'));
     }


     public function edit_proses_unitkerja(Request $request,$id){
         $unitkerja = unitkerja::find($id);

         if (strtoupper($request->get('unitkerja')) == strtoupper($unitkerja->unitkerja)) {
             $request->validate([
                 'unitkerja' => 'required'
             ]);
             $pejabat = pejabat::where('unitkerja_id',$unitkerja->unitkerja)->update(['unitkerja_id'=> $request->unitkerja]); 
             $unitkerja->unitkerja = $request->unitkerja;

             $unitkerja->save();

         }else{
             $request->validate([
                 'unitkerja' => 'required|unique:unitkerjas'
             ]);
             $pejabat = pejabat::where('unitkerja_id',$unitkerja->unitkerja)->update(['unitkerja_id'=> $request->unitkerja]); 
             $unitkerja->unitkerja = $request->unitkerja;

             $unitkerja->save();

         }

         if (auth::user()->status == 'admin') {
             return redirect('/backend/admin/unitkerja')->with('success','unitkerja berhasil diupdate');
         }else{
             return redirect('/backend/pejabat/unitkerja')->with('success','unitkerja berhasil diupdate');
         }
     }
     
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy_unitkerja($id)
     {
         //
         $unitkerja = unitkerja::find($id);

         if ($unitkerja->active == '1') {
             $unitkerja->active = '';
             $unitkerja->save();

             return redirect('/backend/pejabat/unitkerja')->with('success','unitkerja berhasil direstore');
         }else{
             $unitkerja->active = '1';
             $unitkerja->save();

             return redirect('/backend/pejabat/unitkerja')->with('success','unitkerja berhasil dihapus');
         }

     }


     public function destroy_unitkerja_multiple(Request $request)
     {
         $request->validate([
             'pejabat.*' => 'nullable',
         ]);

         $unitkerja = $request->pejabat;

         $return = 0;

         if ($unitkerja == '') {
             return redirect('/backend/pejabat/unitkerja')->with('warning','Tidak ada item yang dipilih');
         }else{

             for($count = 0; $count < count($unitkerja); $count++)
             {

                $Unitkerja = unitkerja::find($unitkerja[$count]);
                if ($Unitkerja->active != '1') {
                    $Unitkerja->active = '1';
                    $Unitkerja->save();
                    $return = 1;
                }else{
                     $Unitkerja->active = '';
                     $Unitkerja->save();
                     $return = 0;
                }
             }

             if ($return == 0) {
                 return redirect('/backend/pejabat/unitkerja')->with('success','unitkerja berhasil direstore');
             }else{
                 return redirect('/backend/pejabat/unitkerja')->with('success','unitkerja berhasil dihapus');
             }
         }
         
     }


     public function check_unitkerja(Request $request)
     {
         if($request->get('unitkerja'))
         {
           $unitkerja = $request->get('unitkerja');
           $data = DB::table("unitkerjas")
                    ->where('unitkerja', $unitkerja)
                    ->count();
           if($data > 0)
           {
             echo 'not_unique';
           }
           else
           {
             echo 'unique';
           }
          }
     }


     // _____________________________pejabat_______________________________

    public function index_pejabat()
     {
         //
         $pejabats = pejabat::all()->sortBy('pejabat');
         $unitkerjas = unitkerja::all()->sortBy('unitkerja');
         $jabatans = jabatan::all()->sortBy('jabatan');
         $s = 'active';
         return view('pejabat/index',compact('pejabats','s','jabatans','unitkerjas'));
     }

     public function index_pejabat_status($status)
     {
         //
         $pejabats = pejabat::all()->sortBy('pejabat');
         $unitkerjas = unitkerja::all()->sortBy('unitkerja');
         $jabatans = jabatan::all()->sortBy('jabatan');
         $s = $status;
         return view('pejabat/index',compact('pejabats','s','jabatans','unitkerjas'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create_pejabat()
     {
         //
         return view('pejabat/create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store_pejabat(Request $request)
     {
         //
         $pejabat = new pejabat();
         $pejabat_alls = pejabat::all();
         $cek = '';
         $request->validate([
            'pejabat' => 'required',
            'jabatan' => 'required',
            'unitkerja' => 'required'
         ]);

         $pejabat->nama = $request->pejabat;
         $pejabat->jabatan_id = $request->jabatan;
         $pejabat->unitkerja_id = $request->unitkerja;

         foreach ($pejabat_alls as $pejabat_all) {
             if ($pejabat_all->nama == $request->pejabat && $pejabat_all->jabatan_id == $request->jabatan && $pejabat_all->unitkerja_id == $request->unitkerja) {
                $cek = 'ada';
                break;
             }
         }


         if ($cek == 'ada') {
             if (auth::user()->status == 'admin') {
                 return redirect('/backend/admin/pejabat')->with('warning','pejabat has already been taken.');
             }else{
                 return redirect('/backend/pejabat')->with('warning','pejabat has already been taken.');
             }
         }else{

            $pejabat->save();
            if (auth::user()->status == 'admin') {
                return redirect('/backend/admin/pejabat')->with('success','pejabat berhasil ditambahkan');
            }else{
                return redirect('/backend/pejabat')->with('success','pejabat berhasil ditambahkan');
            }
         }
         
         
     }

     public function edit_pejabat($id){
         $pejabat = pejabat::find($id);
         $unitkerjas = unitkerja::all()->sortBy('unitkerja');
         $jabatans = jabatan::all()->sortBy('jabatan');
         return view('pejabat/edit',compact('pejabat','unitkerjas','jabatans'));
     }

     public function edit_proses_pejabat(Request $request,$id){
         $pejabat = pejabat::find($id);
         $request->validate([
            'pejabat' => 'nullable',
            'jabatan' => 'nullable',
            'unitkerja' => 'nullable'
         ]);

         $pejabat->nama = $request->pejabat;
         $pejabat->jabatan_id = $request->jabatan;
         $pejabat->unitkerja_id = $request->unitkerja;

         $pejabat->save();

         if (auth::user()->status == 'admin') {
             return redirect('/backend/admin/pejabat')->with('success','pejabat berhasil diupdate');
         }else{
             return redirect('/backend/pejabat')->with('success','pejabat berhasil diupdate');
         }
     }
     
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy_pejabat($id)
     {
         //
         $pejabat = pejabat::find($id);

         if ($pejabat->active == '1') {
             $pejabat->active = '';
             $pejabat->save();

             return redirect('/backend/pejabat')->with('success','pejabat berhasil direstore');
         }else{
             $pejabat->active = '1';
             $pejabat->save();

             return redirect('/backend/pejabat')->with('success','pejabat berhasil dihapus');
         }

     }


     public function destroy_pejabat_multiple(Request $request)
     {
         $request->validate([
             'pejabat.*' => 'nullable',
         ]);

         $pejabat = $request->pejabat;

         $return = 0;

         if ($pejabat == '') {
             return redirect('/backend/pejabat')->with('warning','Tidak ada item yang dipilih');
         }else{

             for($count = 0; $count < count($pejabat); $count++)
             {

                $Pejabat = pejabat::find($pejabat[$count]);
                if ($Pejabat->active != '1') {
                    $Pejabat->active = '1';
                    $Pejabat->save();
                    $return = 1;
                }else{
                     $Pejabat->active = '';
                     $Pejabat->save();
                     $return = 0;
                }
             }

             if ($return == 0) {
                 return redirect('/backend/pejabat')->with('success','pejabat berhasil direstore');
             }else{
                 return redirect('/backend/pejabat')->with('success','pejabat berhasil dihapus');
             }
         }
         
     }


     public function check_pejabat(Request $request)
     {
         if($request->get('pejabat'))
         {
           $pejabat = $request->get('pejabat');
           $data = DB::table("pejabats")
                    ->where('pejabat', $unitkerja)
                    ->count();
           if($data > 0)
           {
             echo 'not_unique';
           }
           else
           {
             echo 'unique';
           }
          }
     }


     public function pb_ajax(Request $request)
    {

        $pejabat = pejabat::where('id',$request->get('id'))->get();

        return response()->json($pejabat);

    }
}
