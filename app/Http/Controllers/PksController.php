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
use App\addendum;
use App\pks;

class PksController extends Controller
{
    // ____________________________addendum____________________________

    public function index_addendum()
    {
        //
        $addendums = addendum::all()->sortBy('addendum');
        $vendor_uniques = $addendums->unique('vendor')->sortBy('vendor');
        $pkss = pks::all();
        $vendors = vendor::all()->sortBy('KodeVendor');;
        $s = 'active';
        return view('pks/addendum/index',compact('addendums','s','pkss','vendors','vendor_uniques'));
    }

    public function index_addendum_status($status)
    {
        //
        $addendums = addendum::all()->sortBy('addendum');;
        $vendor_uniques = $addendums->unique('vendor')->sortBy('vendor');
        $pkss = pks::all();
        $vendors = vendor::all()->sortBy('KodeVendor');;
        $s = $status;
        return view('pks/addendum/index',compact('addendums','s','pkss','vendors','vendor_uniques'));
    }

    public function store_addendum(Request $request)
    {
        //
        $addendum = new addendum();
        $request->validate([
            'vendor' => 'required',
            // 'pks_id' => 'required',
            'no_addendum' => 'required',
            'tgl_addendum' => 'required',
            'nama_kontrak_addendum' => 'required',
            'deskripsi' => 'nullable',
            'file' => 'nullable'
            // 'file' => 'mimes:jpeg,jpg,png,docx,doc,ppt,pptx,pdf,txt,xlsx,xls'
        ]);

        $tempat_upload = public_path('/file/addendum');
        $document = $request->file;
        $filename = $document->getClientOriginalName();
        $document->move($tempat_upload,$filename);  

        $addendum->vendor = $request->vendor;
        // $addendum->pks_id = $request->pks_id;
        $addendum->no_addendum = $request->no_addendum;
        $addendum->tgl_addendum = $request->tgl_addendum;
        $addendum->nama_kontrak_addendum = $request->nama_kontrak_addendum;
        $addendum->deskripsi = $request->deskripsi;
        $addendum->file = $filename;

        $addendum->save();
        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/addendum')->with('success','PKS & addendum berhasil ditambahkan');
        }else{
            return redirect('/backend/addendum')->with('success','PKS & addendum berhasil ditambahkan');
        }
    }

    public function edit_addendum($id){
        $addendum = addendum::find($id);
        $pkss = pks::all();
        $vendors = vendor::all()->sortBy('KodeVendor');
        return view('pks/addendum/edit',compact('addendum','pkss','vendors'));
    }

    public function edit_proses_addendum(Request $request,$id){
        $addendum = addendum::find($id);
        $request->validate([
            'vendor' => 'nullable',
            // 'pks_id' => 'nullable',
            'no_addendum' => 'nullable',
            'tgl_addendum' => 'nullable',
            'nama_kontrak_addendum' => 'nullable',
            'deskripsi' => 'nullable',
            'file' => 'nullable'
        ]); 

        $addendum->vendor = $request->vendor;
        // $addendum->pks_id = $request->pks_id;
        $addendum->no_addendum = $request->no_addendum;
        $addendum->tgl_addendum = $request->tgl_addendum;
        $addendum->nama_kontrak_addendum = $request->nama_kontrak_addendum;
        $addendum->deskripsi = $request->deskripsi;

        if ($request->file != '') {
            $tempat_upload = public_path('/file/addendum');
            $document = $request->file;
            $filename = $document->getClientOriginalName();
            $document->move($tempat_upload,$filename);   

            $addendum->file = $filename;
        }

        $addendum->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/addendum')->with('success','PKS & addendum berhasil diupdate');
        }else{
            return redirect('/backend/addendum')->with('success','PKS & addendum berhasil diupdate');
        }
    }

    public function destroy_addendum_multiple(Request $request)
    {
        $request->validate([
            'pks.*' => 'nullable',
        ]);

        $addendum = $request->pks;

        $return = 0;

        if ($addendum == '') {
            return redirect('/backend/addendum')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($addendum); $count++)
            {

               $Addendum = addendum::find($addendum[$count]);
               if ($Addendum->active != '1') {
                   $Addendum->active = '1';
                   $Addendum->save();
                   $return = 1;
               }else{
                    $Addendum->active = '';
                    $Addendum->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/addendum')->with('success','PKS & addendum berhasil direstore');
            }else{
                return redirect('/backend/addendum')->with('success','PKS & addendum berhasil dihapus');
            }
        }
        
    }


    // public function check_pks(Request $request)
    // {
    //     if($request->get('pks'))
    //     {
    //       $pks = $request->get('pks');
    //       $data = DB::table("pks")
    //                ->where('no_pks', $pks)
    //                ->count();
    //       if($data > 0)
    //       {
    //         echo 'not_unique';
    //       }
    //       else
    //       {
    //         echo 'unique';
    //       }
    //      }
    // }

    public function addendum_ajax($id)
    {

        $po = pks::where('id',$id)->get();

       return response()->json($po);

    }

    public function all_addendum_ajax($id)
    {

        $po = pks::where('no_pks',$id)->get();

       return response()->json($po);

    }

    public function check_addendum_vendor(Request $request){

        $value = $request->get('value');

        if (!$request->get('value')) {
                $html = '<option value="">'."".'</option>';
            } else {
                $html = '';
                $cities = pks::where([['vendor','=',$value],['active','=','']])->orwhere([['vendor','=',$value],['active','=',null]])->get();
                $html = '<option value="">'."".'</option>';
                foreach ($cities as $pks) {
                    $html .= '<option value="'.$pks->id.'">'.$pks->no_pks." - ".$pks->nama_kontrak_pks." - ".date('d M Y', strtotime($pks->tgl_pks)).'</option>';
                }
            }

        return response()->json(['html' => $html]);
    }


    public function check_pilih_pks(Request $request){

        $value = $request->get('value');

        if (!$request->get('value')) {
                $html = '<option value="null">'."Tanpa Unit".'</option>';
            } else {
                $html = '';
                $html = '<option value="null">'."Tanpa Unit".'</option>';
                $cities = addendum::where('pks_id',$value)->get();
                // $html = '<option value="">'."".'</option>';
                foreach ($cities as $addendum) {
                    $html .= '<option value="'.$addendum->id.'">'.$addendum->no_addendum." - ".$addendum->nama_kontrak_addendum." - ".date('d M Y', strtotime($addendum->tgl_addendum)).'</option>';
                }
            }

        return response()->json(['html' => $html]);
    }




	// ______________________________PKS_______________________________




    public function index_pks()
    {
        //

        $pkss = pks::all()->sortBy('no_pks');
        $vendor_uniques = $pkss->unique('vendor')->sortBy('vendor');
        $addendums = addendum::all()->sortBy('no_addendum');
        $vendors = vendor::all()->sortBy('KodeVendor');
        $s = 'active';
        return view('pks/index',compact('pkss','s','addendums','vendors','vendor_uniques'));
    }

    public function index_pks_status($status)
    {
        //
        $pkss = pks::all()->sortBy('no_pks');
        $vendor_uniques = $pkss->unique('vendor')->sortBy('vendor');
        $addendums = addendum::all()->sortBy('no_addendum');
        $vendors = vendor::all()->sortBy('KodeVendor');
        $s = $status;
        return view('pks/index',compact('pkss','s','addendums','vendors','vendor_uniques'));
    }

    public function index_pks_addendum($id)
    {
        //
        $pks = pks::find($id);
        $addendums = addendum::where('pks_id',$id)->get()->sortBy('no_addendum');
        $all_addendums = addendum::all()->sortBy('no_addendum');
        $vendors = vendor::all()->sortBy('KodeVendor');
        return view('pks/index_pks_addendum',compact('pks','addendums','vendors','all_addendums'));
    }

    public function create_pks()
    {
    
        $pkss = pks::all()->sortBy('no_pks');
        $addendums = addendum::all()->sortBy('no_addendum');
        $vendors = vendor::all()->sortBy('KodeVendor');
        return view('pks/create',compact('pkss','addendums','vendors'));
    }

    public function store_pks(Request $request)
    {
        //
        
        $request->validate([
            'vendor' => 'required',
            'no_pks' => 'required',
            'tgl_pks' => 'required',
            'nama_kontrak_pks' => 'required',
            'deskripsi_pks' => 'nullable',
            'file_pks' => 'nullable',

            'no_addendum' => 'required',
            'tgl_addendum' => 'required',
            'nama_kontrak_addendum' => 'required',
            'deskripsi_addendum' => 'nullable',
            'file_addendum' => 'nullable'
        ]);

        $pks_find = pks::where('no_pks',$request->no_pks)->first();

        if ($pks_find) {
            
            $addendum = new addendum();
            // menyimpan data file yang diupload ke variabel $file
            $tempat_upload_addendum = public_path('/file/addendum');
            $document_addendum = $request->file_addendum;
            $filename_addendum = $document_addendum->getClientOriginalName();
            $document_addendum->move($tempat_upload_addendum,$filename_addendum);  
            
            $addendum->vendor = $request->vendor;
            $addendum->pks_id = $pks_find->id;
            $addendum->no_addendum = $request->no_addendum;
            $addendum->tgl_addendum = $request->tgl_addendum;
            $addendum->nama_kontrak_addendum = $request->nama_kontrak_addendum;
            $addendum->deskripsi = $request->deskripsi_addendum;
            $addendum->file = $filename_addendum;
            $addendum->save();

        }else{

            $pks = new pks();
            // menyimpan data file yang diupload ke variabel $file
            $tempat_upload_pks = public_path('/file/pks');
            $document_pks = $request->file_pks;
            $filename_pks = $document_pks->getClientOriginalName();
            $document_pks->move($tempat_upload_pks,$filename_pks);  
            
            $pks->vendor = $request->vendor;
            $pks->no_pks = $request->no_pks;
            $pks->tgl_pks = $request->tgl_pks;
            $pks->nama_kontrak_pks = $request->nama_kontrak_pks;
            $pks->deskripsi = $request->deskripsi_pks;
            $pks->file = $filename_pks;
            $pks->save();



            $addendum = new addendum();
            // menyimpan data file yang diupload ke variabel $file
            $tempat_upload_addendum = public_path('/file/addendum');
            $document_addendum = $request->file_addendum;
            $filename_addendum = $document_addendum->getClientOriginalName();
            $document_addendum->move($tempat_upload_addendum,$filename_addendum);  
            
            $addendum->vendor = $request->vendor;
            $addendum->pks_id = $pks->id;
            $addendum->no_addendum = $request->no_addendum;
            $addendum->tgl_addendum = $request->tgl_addendum;
            $addendum->nama_kontrak_addendum = $request->nama_kontrak_addendum;
            $addendum->deskripsi = $request->deskripsi_addendum;
            $addendum->file = $filename_addendum;
            $addendum->save();
        }

        


        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/addendum')->with('success','PKS & addendum berhasil ditambahkan');
        }else{
            return redirect('/backend/addendum')->with('success','PKS & addendum berhasil ditambahkan');
        }
    }

    public function edit_pks($id){
        $pks = pks::find($id);
        $addendums = addendum::all();
        $vendors = vendor::all()->sortBy('KodeVendor');
        return view('pks/edit',compact('pks','addendums','vendors'));
    }

    public function edit_proses_pks(Request $request,$id){
        $pks = pks::find($id);
        $request->validate([
            'vendor' => 'nullable',
            'no_pks' => 'nullable',
            'tgl_pks' => 'nullable',
            'nama_kontrak_pks' => 'nullable',
            'addendum_id' => 'nullable',
            'deskripsi' => 'nullable',
            'file' => 'nullable'
        ]);

        $pks->vendor = $request->vendor;
        $pks->no_pks = $request->no_pks;
        $pks->tgl_pks = $request->tgl_pks;
        $pks->nama_kontrak_pks = $request->nama_kontrak_pks;
        $pks->addendum_id = $request->addendum_id;
        $pks->deskripsi = $request->deskripsi;

        if ($request->file != '') {
            $tempat_upload = public_path('/file/pks');
            $document = $request->file;
            $filename = $document->getClientOriginalName();
            $document->move($tempat_upload,$filename);  

            $pks->file = $filename;
        }
    
        $pks->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/pks')->with('success','pks berhasil diupdate');
        }else{
            return redirect('/backend/pks')->with('success','pks berhasil diupdate');
        }
    }



    public function edit_addendum_all(Request $request,$id){
        $addendum = addendum::find($request->get('addendum_id'));
        $addendum->pks_id = $id;
    
        $addendum->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/pks')->with('success','addendum berhasil ditambahkan');
        }else{
            return redirect('/backend/pks/index_pks_addendum/'.$id)->with('success','addendum berhasil ditambahkan');
        }
    }


    public function delete_addendum_all($id,$pks_id){
        $addendum = addendum::find($id);
        $addendum->pks_id = null;
    
        $addendum->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/pks')->with('success','addendum berhasil dihilangkan');
        }else{
            return redirect('/backend/pks/index_pks_addendum/'.$pks_id)->with('success','addendum berhasil dihilangkan');
        }
    }



    public function destroy_pks($id)
    {
        //
        $pks = pks::find($id);

        if ($pks->active == '1') {
            $pks->active = '';
            $pks->save();

            return redirect('/backend/pks')->with('success','pks berhasil direstore');
        }else{
            $pks->active = '1';
            $pks->save();

            return redirect('/backend/pks')->with('success','pks berhasil dihapus');
        }

    }

    public function destroy_pks_multiple(Request $request)
    {
        $request->validate([
            'pks.*' => 'nullable',
        ]);

        $pks = $request->pks;

        $return = 0;

        if ($pks == '') {
            return redirect('/backend/pks')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($pks); $count++)
            {

               $Pks = pks::find($pks[$count]);
               if ($Pks->active != '1') {
                   $Pks->active = '1';
                   $Pks->save();
                   $return = 1;
               }else{
                    $Pks->active = '';
                    $Pks->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/pks')->with('success','pks berhasil direstore');
            }else{
                return redirect('/backend/pks')->with('success','pks berhasil dihapus');
            }
        }
        
    }


    public function check_pks(Request $request)
    {
        if($request->get('pks'))
        {
          $pks = $request->get('pks');
          $data = DB::table("pks")
                   ->where('no_pks', $pks)
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

     public function pks_ajax(Request $request)
    {

        $pks = pks::where('id',$request->get('id'))->get();

        return response()->json($pks);

    }

     public function pks_addendum_ajax(Request $request)
    {

        $addendum = addendum::where('id',$request->get('id'))->get();

        return response()->json($addendum);

    }

     public function check_pks_vendor(Request $request){

        $value = $request->get('value');

        if (!$request->get('value')) {
                $html = '<option value="">'."".'</option>';
            } else {
                $html = '';
                // $cities = addendum::where('vendor',$value)->where('active','!=','1')->get();
                $cities = addendum::where([['vendor','=',$value],['active','=','']])->orwhere([['vendor','=',$value],['active','=',null]])->get();
                foreach ($cities as $addendum) {
                    $html .= '<option value="'.$addendum->id.'">'.$addendum->no_addendum." - ".$addendum->nama_kontrak_addendum." - ".date('d M Y', strtotime($addendum->tgl_addendum)).'</option>';
                }
            }

        return response()->json(['html' => $html]);
    }
}
