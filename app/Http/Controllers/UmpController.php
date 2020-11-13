<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\kota;
use App\tahun;
use App\jkk;
use App\Vendor;
use App\harga_ump;

use Alert;

class UmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_kota()
    {
        //
        $kotas = kota::all()->sortBy('Kota');
        $s = 'active';
        return view('ump/kota/index',compact('kotas','s'));
    }

    public function index_kota_status($status)
    {
        //
        $kotas = kota::all()->sortBy('Kota');
        $s = $status;
        return view('ump/kota/index',compact('kotas','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_kota()
    {
        //
        return view('ump/kota/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_kota(Request $request)
    {
        //
        $kota = new kota();

        $request->validate([
            'kota' => 'required|unique:kotas'
        ]);

        $kota->Kota = $request->kota;

        $kota->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/kota')->with('success', 'Kota berhasil ditambahkan');
        }else{
            return redirect('/backend/ump/kota')->with('success', 'Kota berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_kota($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit_kota($id){
        $kota = kota::find($id);
        return view('ump/kota/edit',compact('kota'));
    }
    

    public function edit_proses_kota(Request $request,$id){
        $kota = kota::find($id);

        if (strtoupper($request->get('kota')) == strtoupper($kota->Kota)) {
            $request->validate([
                'kota' => 'required'
            ]);

            $kota->Kota = $request->kota;

            $kota->save();

        }else{
            $request->validate([
                'kota' => 'required|unique:kotas'
            ]);

            $kota->Kota = $request->kota;

            $kota->save();
        }

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/kota')->with('success', 'Kota berhasil diupdate');
        }else{
            return redirect('/backend/ump/kota')->with('success', 'Kota berhasil diupdate');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy_kota($id)
    {
        //
        $kota = kota::find($id);

        if ($kota->active == '1') {
            $kota->active = '';
            $kota->save();

            return redirect('/backend/ump/kota')->with('success','Kota berhasil direstore');
        }else{
            $kota->active = '1';
            $kota->save();

            return redirect('/backend/ump/kota')->with('success','Kota berhasil dihapus');
        }
   
    }


    public function destroy_kota_multiple(Request $request)
    {
        $request->validate([
            'ump.*' => 'nullable',
        ]);

        $kota = $request->ump;
        $return = 0;

        if ($kota == '') {
            return redirect('/backend/ump/kota')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($kota); $count++)
            {

               $Kota = kota::find($kota[$count]);
               if ($Kota->active != '1') {
                   $Kota->active = '1';
                   $Kota->save();
                   $return = 1;
               }else{
                   $Kota->active = '';
                   $Kota->save();
                   $return = 0;
               }

            }

            if ($return == 1) {
                return redirect('/backend/ump/kota')->with('success','kota berhasil dihapus');
            }else{
                return redirect('/backend/ump/kota')->with('success','kota berhasil direstore');
            }
            
        }
        
    }


    public function check_kota(Request $request)
    {
        if($request->get('kota'))
        {
          $kota = $request->get('kota');
          $data = DB::table("kotas")
                   ->where('Kota', $kota)
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





// _______________________TAHUN________________________


       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_tahun()
    {
        //
        $tahuns = tahun::all()->sortBy('Tahun');
        $s = 'active';
        return view('ump/tahun/index',compact('tahuns','s'));
    }

    public function index_tahun_status($status)
    {
        //
        $tahuns = tahun::all()->sortBy('Tahun');
        $s = $status;
        return view('ump/tahun/index',compact('tahuns','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_tahun()
    {
        //
        return view('ump/tahun/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_tahun(Request $request)
    {
        //
        $tahun = new tahun();
        $request->validate([
            'tahun' => 'required|unique:tahuns'
        ]);

        $tahun->Tahun = $request->tahun;

        $tahun->save();

        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/tahun')->with('success','Tahun berhasil ditambahkan');
        }else{
            return redirect('/backend/ump/tahun')->with('success','Tahun berhasil ditambahkan');
        }
    }



    public function edit_tahun($id){
        $tahun = tahun::find($id);
        return view('ump/tahun/edit',compact('tahun'));
    }
    

    public function edit_proses_tahun(Request $request,$id){
        $tahun = tahun::find($id);
        if (strtoupper($request->get('tahun')) == strtoupper($tahun->Tahun)) {
            $request->validate([
                'tahun' => 'required'
            ]);

            $tahun->Tahun = $request->tahun;

            $tahun->save();

        }else{
            $request->validate([
                'tahun' => 'required|unique:tahuns'
            ]);

            $tahun->Tahun = $request->tahun;

            $tahun->save();

        }

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/tahun')->with('success','Tahun berhasil diupdate');
        }else{
            return redirect('/backend/ump/tahun')->with('success','Tahun berhasil diupdate');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_tahun($id)
    {
        //
        $tahun = tahun::find($id);

        if ($tahun->active == '1') {
            $tahun->active = '';
            $tahun->save();

            return redirect('/backend/ump/tahun')->with('success','Tahun berhasil direstore');
        }else{
            $tahun->active = '1';
            $tahun->save();

            return redirect('/backend/ump/tahun')->with('success','Tahun berhasil dihapus');
        }
        
    }


    public function destroy_tahun_multiple(Request $request)
    {
        $request->validate([
            'tahun.*' => 'nullable',
        ]);

        $tahun = $request->tahun;
        $return = 0;

        if ($tahun == '') {
            return redirect('/backend/ump/tahun')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($tahun); $count++)
            {
               $Tahun = tahun::find($tahun[$count]);
               if ($Tahun->active != '1') {
                   $Tahun->active = '1';
                   $Tahun->save();
                   $return = 1;
               }else{
                    $Tahun->active = '';
                    $Tahun->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/ump/tahun')->with('success','tahun berhasil direstore');
            }else{
                return redirect('/backend/ump/tahun')->with('success','tahun berhasil dihapus');
            }
            
        }

    }



    public function check_tahun(Request $request)
    {
        if($request->get('tahun'))
        {
          $tahun = $request->get('tahun');
          $data = DB::table("tahuns")
                   ->where('tahun', $tahun)
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


    public function check_tahun_mcu(Request $request)
    {
        if($request->get('tahun'))
        {
          $tahun = $request->get('tahun');
          $po_id = $request->get('po_id');
          $data = DB::table("mcus")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)
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




// _______________________JKK________________________


       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_jkk()
    {
        //
        $jkks = jkk::all()->sortBy('jkk');
        $s = 'active';
        return view('ump/jkk/index',compact('jkks','s'));
    }

    public function index_jkk_status($status)
    {
        //
        $jkks = jkk::all()->sortBy('jkk');
        $s = $status;
        return view('ump/jkk/index',compact('jkks','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_jkk()
    {
        //
        return view('ump/jkk/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_jkk(Request $request)
    {
        //
        $jkk = new jkk();
        $request->validate([
            'jkk' => 'required|unique:jkks'
        ]);

        $jkk->jkk = $request->jkk;

        $jkk->save();
        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/jkk')->with('success','JKK berhasil ditambahkan');
        }else{
            return redirect('/backend/ump/jkk')->with('success','JKK berhasil ditambahkan');
        }
    }

    public function edit_jkk($id){
        $jkk = jkk::find($id);
        return view('ump/jkk/edit',compact('jkk'));
    }


    public function edit_proses_jkk(Request $request,$id){
        $jkk = jkk::find($id);

        if (strtoupper($request->get('jkk')) == strtoupper($jkk->jkk)) {
            $request->validate([
                'jkk' => 'required'
            ]);

            $jkk->jkk = $request->jkk;

            $jkk->save();

        }else{
            $request->validate([
                'jkk' => 'required|unique:jkks'
            ]);

            $jkk->jkk = $request->jkk;

            $jkk->save();
        }

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/jkk')->with('success','JKK berhasil diupdate');
        }else{
            return redirect('/backend/ump/jkk')->with('success','JKK berhasil diupdate');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_jkk($id)
    {
        //
        $jkk = jkk::find($id);

        if ($jkk->active == '1') {
            $jkk->active = '';
            $jkk->save();

            return redirect('/backend/ump/jkk')->with('success','JKK berhasil direstore');
        }else{
            $jkk->active = '1';
            $jkk->save();

            return redirect('/backend/ump/jkk')->with('success','JKK berhasil dihapus');
        }

    }


    public function destroy_jkk_multiple(Request $request)
    {
        $request->validate([
            'ump.*' => 'nullable',
        ]);

        $jkk = $request->ump;

        $return = 0;

        if ($jkk == '') {
            return redirect('/backend/ump/jkk')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($jkk); $count++)
            {

               $Jkk = jkk::find($jkk[$count]);
               if ($Jkk->active != '1') {
                   $Jkk->active = '1';
                   $Jkk->save();
                   $return = 1;
               }else{
                    $Jkk->active = '';
                    $Jkk->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/ump/jkk')->with('success','jkk berhasil direstore');
            }else{
                return redirect('/backend/ump/jkk')->with('success','jkk berhasil dihapus');
            }
        }
        
    }


    public function check_jkk(Request $request)
    {
        if($request->get('jkk'))
        {
          $jkk = $request->get('jkk');
          $data = DB::table("jkks")
                   ->where('jkk', $jkk)
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



// _______________________Harga UMP________________________


       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_harga_ump()
    {
        //
        $tahun_active = tahun::where('activated','1')->count();
        if($tahun_active == 0){
            $harga_umps = harga_ump::all();
            $kotas = kota::all()->sortBy('Kota');
            $tahuns = tahun::all()->sortBy('Tahun');
            $tahun_drops = tahun::all()->sortByDesc('Tahun');
            $vendors = Vendor::all()->sortBy('KodeVendor');
            $jkks = jkk::all()->sortBy('jkk');
            $year = "all";
            $s = 'active';
            return view('ump/harga_ump/index',compact('harga_umps','kotas','tahuns','jkks','vendors','tahun_drops','year','s'));
        }else{
            $tahun_select = DB::table('tahuns')->where('activated','=','1')->first();
            $harga_umps = harga_ump::where('Tahun_id',$tahun_select->Tahun)->get();
            $kotas = kota::all()->sortBy('Kota');
            $tahuns = tahun::all()->sortBy('Tahun');
            $tahun_drops = tahun::all()->sortByDesc('Tahun');
            $vendors = Vendor::all()->sortBy('KodeVendor');
            $jkks = jkk::all()->sortBy('jkk');
            $year = tahun::where('Tahun',$tahun_select->Tahun)->first();
            $years = tahun::all();
            $s = 'active';
            return view('ump/harga_ump/index',compact('harga_umps','kotas','tahuns','jkks','vendors','tahun_drops','year','years','s'));
        }
        
    }

    public function tahun_harga_ump($id)
    {
        //
            $harga_umps = harga_ump::where('Tahun_id',$id)->get();
            $kotas = kota::all()->sortBy('Kota');
            $tahuns = tahun::all()->sortBy('Tahun');
            $tahun_drops = tahun::all()->sortByDesc('Tahun');
            $vendors = Vendor::all()->sortBy('KodeVendor');
            $jkks = jkk::all()->sortBy('jkk');
            $year = tahun::where('Tahun',$id)->first();
            $years = tahun::all();
            $s = 'active';
            return view('ump/harga_ump/index',compact('harga_umps','kotas','tahuns','jkks','vendors','tahun_drops','year','years','s'));
    }

    public function all_harga_ump()
    {
        //
            $harga_umps = harga_ump::all();
            $kotas = kota::all()->sortBy('Kota');
            $tahuns = tahun::all()->sortBy('Tahun');
            $tahun_drops = tahun::all()->sortByDesc('Tahun');
            $vendors = Vendor::all()->sortBy('KodeVendor');
            $jkks = jkk::all()->sortBy('jkk');
            $year = "all";
            $s = 'active';
            return view('ump/harga_ump/index',compact('harga_umps','kotas','tahuns','jkks','vendors','tahun_drops','year','s'));
    }

    public function deactive_harga_ump()
    {
        //
            $harga_umps = harga_ump::all();
            $kotas = kota::all()->sortBy('Kota');
            $tahuns = tahun::all()->sortBy('Tahun');
            $tahun_drops = tahun::all()->sortByDesc('Tahun');
            $vendors = Vendor::all()->sortBy('KodeVendor');
            $jkks = jkk::all()->sortBy('jkk');
            $year = "all";
            $s = 'deactive';
            return view('ump/harga_ump/index',compact('harga_umps','kotas','tahuns','jkks','vendors','tahun_drops','year','s'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_harga_ump()
    {
        //
        return view('ump/harga_ump/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_harga_ump(Request $request)
    {
        //
        $harga_ump = new harga_ump();
        $request->validate([
            'kota_id' => 'required',
            'vendor_id' => 'required',
            'tahun_id' => 'required',
            'jkk_id' => 'required',
            'harga_include_hidden' => 'required',
            'harga_eksclude_hidden' => 'required',
            'pembagi' => 'nullable',
            'toggle' => 'nullable'
        ]);

        $harga_ump->Kota_id = $request->kota_id;
        $harga_ump->Tahun_id = $request->tahun_id;
        $harga_ump->Jkk_id = $request->jkk_id;
        $harga_ump->Vendor_id = $request->vendor_id;
        $harga_ump->Harga_include = $request->harga_include_hidden;
        $harga_ump->Harga_eksclude = $request->harga_eksclude_hidden;
        $harga_ump->toggle = $request->toggle;
        $harga_ump->created_by = auth::user()->name;

        $harga_ump->save();

        //non-active kan semua ump
        $ump_active = harga_ump::where('activated','=','1')->update(['activated' => null]);
        $tahun_active = tahun::where('activated','=','1')->update(['activated' => null]);


        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/harga_ump')->with('success','harga ump berhasil ditambahkan');
        }else{
            return redirect('/backend/ump/harga_ump')->with('success','harga ump berhasil ditambahkan');
        }
    }

    public function edit_harga_ump($id){
        $harga_ump = harga_ump::find($id);
        $kotas = kota::all()->sortBy('Kota');
        $tahuns = tahun::all()->sortBy('Tahun');
        $tahun_drops = tahun::all()->sortByDesc('Tahun');
        $vendors = Vendor::all()->sortBy('KodeVendor');
        $jkks = jkk::all()->sortBy('jkk');
        return view('ump/harga_ump/edit',compact('harga_ump','kotas','tahuns','jkks','vendors'));
    }
    

    public function edit_proses_harga_ump(Request $request,$id){
        $harga_ump = harga_ump::find($id);
        $request->validate([
            'kota_id' => 'required',
            'vendor_id' => 'required',
            'tahun_id' => 'required',
            'jkk_id' => 'required',
            'harga_include_hidden' => 'required',
            'harga_eksclude_hidden' => 'required',
            'pembagi' => 'nullable',
            'toggle' => 'nullable'
        ]);

        $harga_ump->Kota_id = $request->kota_id;
        $harga_ump->Tahun_id = $request->tahun_id;
        $harga_ump->Jkk_id = $request->jkk_id;
        $harga_ump->Vendor_id = $request->vendor_id;
        $harga_ump->Harga_include = $request->harga_include_hidden;
        $harga_ump->Harga_eksclude = $request->harga_eksclude_hidden;
        $harga_ump->toggle = $request->toggle;
        $harga_ump->updated_by = auth::user()->name;

        $harga_ump->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/harga_ump')->with('success','harga ump berhasil diupdate');
        }else{
            return redirect('/backend/ump/harga_ump')->with('success','Harga ump berhasil diupdate');
        }
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_harga_ump($id)
    {
        //
        $harga_ump = harga_ump::find($id);

        if ($harga_ump->active == '1') {
            $harga_ump->active = '';
            $harga_ump->save();

            return redirect('/backend/ump/harga_ump')->with('success','Harga UMP berhasil direstore');
        }else{
            $harga_ump->active = '1';
            $harga_ump->save();

            return redirect('/backend/ump/harga_ump')->with('success','Harga UMP berhasil dihapus');
        }

    }


    public function destroy_harga_ump_multiple(Request $request)
    {
        $request->validate([
            'ump.*' => 'nullable',
        ]);

        $harga_ump = $request->ump;

        $return = 0;

        if ($harga_ump == '') {
            return redirect('/backend/ump/harga_ump')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($harga_ump); $count++)
            {

               $Harga_ump = harga_ump::find($harga_ump[$count]);
               if ($Harga_ump->active != '1') {
                   $Harga_ump->active = '1';
                   $Harga_ump->save();
                   $return = 1;
               }else{
                   $Harga_ump->active = '';
                   $Harga_ump->save();
                   $return = 0;
               }

            }

            if ($return == 0) {
                return redirect('/backend/ump/harga_ump')->with('success','harga ump berhasil direstore');
            }else{
                return redirect('/backend/ump/harga_ump')->with('success','harga ump berhasil dihapus');
            }
            
        }
        
    }



    public function activate_harga_ump(Request $request)
    {
        
        $request->validate([
            'tahun_id' => 'nullable',
            'tahun_id_non_activate' => 'nullable'
        ]);

        $harga_ump = harga_ump::where('Tahun_id','=',$request->tahun_id)->update(['activated' => '1']);
        $harga_ump = harga_ump::where('Tahun_id','=',$request->tahun_id_non_activate)->update(['activated' => null]);
        $tahun = tahun::where('Tahun','=',$request->tahun_id)->update(['activated' => '1']);
        $tahun = tahun::where('Tahun','=',$request->tahun_id_non_activate)->update(['activated' => null]);

        // $harga_ump->save();

        return redirect('/backend/ump/harga_ump');
    }



    public function check_harga_ump(Request $request)
    {
        if($request->get('kota'))
        {
          $tahun = $request->get('tahun');
          $kota = $request->get('kota');
          $vendor = $request->get('vendor');
          $data = DB::table("harga_umps")
                   ->where('Kota_id', $kota)
                   ->where('Tahun_id', $tahun)
                   ->where('Vendor_id', $vendor)
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


}
