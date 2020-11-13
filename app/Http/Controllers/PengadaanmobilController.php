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
use App\filter_date;
use App\approve;
use App\tampungan_relokasi;
use App\tampungan_pengurangan;
use App\tampungan_pengurangan_driver;
use App\tampungan_perubahan;
use PDF;
use Hash;


class PengadaanmobilController extends Controller
{

// __________________________DASBOARD_VIEW___________________________

    public function view_dashboard($id)
    {
       $tpo = tpo::where('id',$id)->get();

       return response()->json($tpo);
    }

    public function view_vendor_dashboard($id)
    {
       $vendor = vendor::where('id',$id)->get();

       return response()->json($vendor);
    }

    public function view_cabang_dashboard($id)
    {
       $cabang = Cabang::where('id',$id)->get();

       return response()->json($cabang);
    }

    public function view_mobil_dashboard($id)
    {
       $mobil = Mobil::where('id',$id)->get();

       return response()->json($mobil);
    }
    
// __________________________DASBOARD___________________________


    public function date_dashboard($date)
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $currentDateTime = date('Y-m-d H:i:s');
        // $currentDateToday = date('m/d/Y');

        // ~~~~~~~~~~~~~~ input filter ~~~~~~~~~~~~~~~
        $input_date = filter_date::where('status','1')->first();
        $input_date->status = '0';
        $input_date->save();

        $input_date1 = filter_date::where('kategori',$date)->first();
        $input_date1->status = '1';
        $input_date1->save();
        // ~~~~~~~~~~~~~~ input filter ~~~~~~~~~~~~~~~

        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $filter_date = filter_date::where('status','1')->first();
        if ($filter_date->kategori == 'today') {
            $pos = tpo::whereDay('created_at', '=', date('d'))->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get()->sortByDesc('id');
        }elseif($filter_date->kategori == 'month'){
            $pos = tpo::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get()->sortByDesc('id');
        }elseif($filter_date->kategori == 'year'){
            $pos = tpo::whereYear('created_at', '=', date('Y'))->get()->sortByDesc('id');
        }else{
            // $pos = tpo::limit(100)->get()->sortByDesc('id');
            $pos = tpo::all()->sortByDesc('id');
        }
        $statuss = 'all';
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        return view('dashboard/index',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','statuss','history_drivers','filter_date'));
    }

    public function index_dashboard()
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $currentDateTime = date('Y-m-d H:i:s');
        // $currentDateToday = date('m/d/Y');


        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $filter_date = filter_date::where('status','1')->first();
        if ($filter_date->kategori == 'today') {
            $pos = tpo::whereDay('created_at', '=', date('d'))->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get()->sortByDesc('id');
        }elseif($filter_date->kategori == 'month'){
            $pos = tpo::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get()->sortByDesc('id');
        }elseif($filter_date->kategori == 'year'){
            $pos = tpo::whereYear('created_at', '=', date('Y'))->get()->sortByDesc('id');
        }else{
            $pos = tpo::limit(2000)->get()->sortByDesc('id');
            // $pos = tpo::all()->sortByDesc('id');
        }
        $statuss = 'all';
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');

        // ______________chart_____________

        $po_count = tpo::where('status','1')->count();
        $categori_vendors = [];
        $data_m = [];
        $data_d = [];
        $data_md = [];

        $vendors2 = vendor::where('active','<>','1')->get();

        foreach($vendors2 as $vendor){
            $categori_vendors[] = $vendor->KodeVendor;
            $data_m[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Mobil')->count();
            $data_d[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Driver')->count();
            $data_md[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Mobil+Driver')->count();
        }

        return view('dashboard/index',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','statuss','history_drivers','filter_date','categori_vendors','data_m','data_d','data_md','po_count'));
    }

    // public function filter_dashboard(Request $request)
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $currentDateTime = date('Y-m-d H:i:s');
        
    //     $pos = tpo::all()->sortByDesc('id');
    //     $request->validate([
    //         'nopo' => "nullable",
    //         'sewa' => "nullable",
    //         'CP'  => 'nullable',
    //         'cabang_id' => "nullable",
    //         'vendor_id' => "nullable",
    //         'mulaisewa' => "nullable",
    //         'selesaisewa' => "nullable",
    //         'user_pengguna' => "nullable",
    //         'hargasewamobil' => "nullable",
    //         'hargasewadriver' => "nullable",
    //         'nopol' => "nullable",
    //         'mobil_id' => "nullable"
    //     ]);
    //     $pos = tpo::select('*')->limit(2000)
    //             ->where('Nopo_permanent','LIKE', '%'.$request->nopo.'%')
    //             ->where('Sewa_permanent','LIKE', '%'.$request->sewa.'%')
    //             ->where('Vendor_Driver','LIKE', '%'.$request->vendor_id.'%')
    //             ->where('Mobil_id','LIKE', '%'.$request->mobil_id.'%')
    //             ->where('Nopol','LIKE', '%'.$request->nopol.'%')
    //             ->where('Cabang_permanent','LIKE', '%'.$request->cabang_id.'%')
    //             ->where('CP','LIKE',$request->CP)
    //             // ->where('MulaiSewa','LIKE','%'.date('Y-m-d H:i:s', strtotime($request->mulaisewa)).'%')
    //             ->get()->sortByDesc('id');

    //     $cabangs = Cabang::all();
    //     $mobils = Mobil::all();
    //     $umps = ump::all(); 
    //     $vendors = Vendor::all();
    //     $drivers = Driver::all();

    //     $po_count = tpo::where('status','1')->count();
    //     $categori_vendors = [];
    //     $data_m = [];
    //     $data_d = [];
    //     $data_md = [];

    //     $vendors2 = vendor::where('active','<>','1')->get();
    //     foreach($vendors2 as $vendor){
    //         $categori_vendors[] = $vendor->KodeVendor;
    //         $data_m[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Mobil')->count();
    //         $data_d[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Driver')->count();
    //         $data_md[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Mobil+Driver')->count();
    //     }
        
    //     $statuss = 'all';
    //     $nopos = Nopo::all();
    //     $pengurangans = Pengurangan::all();
    //     $history_drivers = historydriver::all()->sortByDesc('id');
    //     return view('dashboard/index',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','history_drivers','statuss','categori_vendors','data_m','data_d','data_md','po_count'));
    // }

    public function filter_dashboard2(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        
        $pos = tpo::all()->sortByDesc('id');
        $request->validate([
            'nopo' => "nullable",
            'sewa' => "nullable",
            'CP'  => 'nullable',
            'cabang_id' => "nullable",
            'vendor_id' => "nullable",
            'mulaisewa' => "nullable",
            'selesaisewa' => "nullable",
            'user_pengguna' => "nullable",
            'hargasewamobil' => "nullable",
            'hargasewadriver' => "nullable",
            'nopol' => "nullable",
            'mobil_id' => "nullable"
        ]);
        if($request->sewa == 'Driver'){
            $pos = tpo::select('*')->limit(2000)
                ->where('Sewa','Driver')
                ->where('Nopo_permanent','LIKE', '%'.$request->nopo.'%')
                ->where('Vendor_Driver','LIKE', '%'.$request->vendor_id.'%')
                ->where('Cabang_permanent','LIKE', '%'.$request->cabang_id.'%')
                ->where('CP','LIKE',$request->CP)
                // ->where('MulaiSewa','LIKE','%'.date('Y-m-d H:i:s', strtotime($request->mulaisewa)).'%')
                ->get()->sortByDesc('id');
        }elseif($request->sewa != '') {
            $pos = tpo::select('*')->limit(2000)
                ->where('Sewa',$request->get('sewa'))
                ->where('Nopo_permanent','LIKE', '%'.$request->nopo.'%')
                ->where('Vendor_Driver','LIKE', '%'.$request->vendor_id.'%')
                ->where('Mobil_id','LIKE', '%'.$request->mobil_id.'%')
                ->where('Nopol','LIKE', '%'.$request->nopol.'%')
                ->where('Cabang_permanent','LIKE', '%'.$request->cabang_id.'%')
                ->where('CP','LIKE',$request->CP)
                // ->where('MulaiSewa','LIKE','%'.date('Y-m-d H:i:s', strtotime($request->mulaisewa)).'%')
                ->get()->sortByDesc('id');
        }else{
            $pos = tpo::select('*')->limit(2000)
                ->where('Nopo_permanent','LIKE', '%'.$request->nopo.'%')
                ->where('Vendor_Driver','LIKE', '%'.$request->vendor_id.'%')
                ->where('Mobil_id','LIKE', '%'.$request->mobil_id.'%')
                ->where('Nopol','LIKE', '%'.$request->nopol.'%')
                ->where('Cabang_permanent','LIKE', '%'.$request->cabang_id.'%')
                ->where('CP','LIKE',$request->CP)
                // ->where('MulaiSewa','LIKE','%'.date('Y-m-d H:i:s', strtotime($request->mulaisewa)).'%')
                ->get()->sortByDesc('id');
        }
        

        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all(); 
        $vendors = Vendor::all();
        $drivers = Driver::all();

        $po_count = tpo::where('status','1')->count();
        $categori_vendors = [];
        $data_m = [];
        $data_d = [];
        $data_md = [];

        $vendors2 = vendor::where('active','<>','1')->get();
        foreach($vendors2 as $vendor){
            $categori_vendors[] = $vendor->KodeVendor;
            $data_m[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Mobil')->count();
            $data_d[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Driver')->count();
            $data_md[] = tpo::where('Vendor_Driver',$vendor->id)->where('Sewa_permanent','Mobil+Driver')->count();
        }
        
        $statuss = 'all';
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        return view('dashboard/backup_index',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','history_drivers','statuss','categori_vendors','data_m','data_d','data_md','po_count'));
    }

    public function po_filter_active()
    {
        $currentDateTime = date('m/d/y');
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $statuss = 'active';
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        return view('dashboard/index_active',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','statuss','history_drivers'));
    }

    public function po_filter_notactive()
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $statuss = 'notactive';
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        return view('dashboard/index_notactive',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','statuss','history_drivers'));
    }

// ___________________________ PO ___________________________

    public function index_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $pengurangans = Pengurangan::all();
        return view('PO/index',compact('pos','cabangs','umps','vendors','drivers','mobils','pengurangans'));
    }

    public function index_po_table()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $kategori = '0';
        $table_template_relokasis = table_template_relokasi::all();
        $template_relokasis = template_relokasi::all();
        $table_template_pengurangans = table_template_pengurangan::all();
        $template_pengurangans = template_pengurangan::all();
        $table_template_perubahans = table_template_perubahan::all();
        $template_perubahans = template_perubahan::all();
        $pengurangans = Pengurangan::whereNotNull('perubahan')->get();
        $history_drivers = historydriver::all()->sortByDesc('id');
        tampungan_relokasi::truncate();
        return view('PO/index_table_mode',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','kategori','table_template_relokasis','template_relokasis','pengurangans','history_drivers','table_template_pengurangans','template_pengurangans','table_template_perubahans','template_perubahans'));

        return $pengurangans;
    }

    public function index_po_table_kategori($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('updated_at');
        $nopos = Nopo::all();
        $kategori = $id;
        $table_template_relokasis = table_template_relokasi::all();
        $template_relokasis = template_relokasi::all();
        $pengurangans = Pengurangan::whereNotNull('perubahan')->get();
        $table_template_perubahans = table_template_perubahan::all();
        $template_perubahans = template_perubahan::all();
        $table_template_pengurangans = table_template_pengurangan::all();
        $template_pengurangans = template_pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');

        return view('PO/index_table_mode',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','kategori','table_template_relokasis','template_relokasis','pengurangans','table_template_perubahans','template_perubahans','table_template_pengurangans','template_pengurangans','history_drivers'));
    }

    public function form_add_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all()->sortBy('KodeVendor');
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $cps = Cp::all()->sortBy('kota');
        $bbms = bbm::all();
        return view('PO/form_add',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','cps','bbms'));
    }

    public function form_add_multiple_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        $cps = Cp::all()->sortBy('kota');
        $bbms = bbm::all();
        return view('PO/form_add_multiple',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','cps','bbms'));
    }

    public function penambahan_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        return view('PO/penambahan',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'));
    }

    public function form_penambahan_po()
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all()->sortByDesc('id');
        $nopos = Nopo::all();
        return view('PO/form_penambahan',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'));
    }

    

    

    public function po_edit_pengada($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all()->sortBy('KodeVendor');
        $drivers = Driver::all();
        $po = tpo::find($id);
        $nopos = Nopo::all();
        $cps = Cp::all()->sortBy('kota');
        $pos = tpo::all();
        $bbms = bbm::all();
        return view('PO/table/edit_pengada',compact('po','cabangs','umps','vendors','drivers','mobils','nopos','cps','pos','bbms'));
    }

    public function proses_tambah_po(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
    
        $tpo = new tpo();
        $nopo = new Nopo();
        $service = new Service();
        $mcu = new mcu();
        $relokasi = new Relokasi();
        $pengurangan = new Pengurangan();
        $report_database = new report_database();
        $timeline = new timeline();
        $history_nopol = new historynopol();
        $history_mobil = new historymobil();

        $request->validate([
            'nopo' => 'required',
            'id'=> 'nullable'
            // 'sewa.*' => "required",
            // 'CP.*' => "required",
            // 'cabang_id.*' => "required",
            // 'vendor_id.*' => "required",
            // 'mulaisewa.*' => "required",
            // 'selesaisewa.*' => "required",
            // 'user_pengguna.*' => "required",
            // 'hargasewamobil.*' => "required",
            // 'hargasewadriver.*' => "required",
            // 'type.*' => "required"
        ]);

        $rules = array(
            'nopo' => "nullable",
            'sewa' => "nullable",
            'CP'  => 'nullable',
            'cabang_id' => "nullable",
            'vendor_id' => "nullable",
            'mulaisewa' => "nullable",
            'selesaisewa' => "nullable",
            'hargasewamobil' => "nullable",
            'hargasewadriver' => "nullable",
            'nopol' => "nullable",
            'mobil_id' => "nullable",
            'user_pengguna' => "nullable",
            'bbm' => "nullable",
            'jenis_bbm' => "nullable"
        );

        // $nopo->NoPo = $request->nopo;
        // $nopo->save();

        $error = Validator::make($request->all(), $rules);
          if($error->fails())
          {
           return response()->json([
            'error'  => $error->errors()->all()
           ]);
          }

        // $po = tpo::find($request->id);
        if($request->nopol != 'null' && $request->nopol != '')
        {
            $approve = new approve();
            $pos = tpo::where('Nopol',$request->nopol)->first();
            $po = tpo::find($pos->id);
            $report_database = report_database::where('po_id',$po->id)->first();
            $po->Sewa = "Mobil+Driver";
            $po->Sewa_Sementara = "Mobil+Driver";
            // $po->Sewa_permanent = "Mobil+Driver";
            $po->MulaiSewa2 = $request->mulaisewa;
            $po->SelesaiSewa2 = $request->selesaisewa;
            $po->HargaSewaDriver2019 = $request->hargasewadriver;
            $po->Hargasewadriver_relokasi = $request->hargasewadriver;

            $po->UserPengguna = $request->user_pengguna;
            $po->bbm = $request->bbm;
            $po->jenis_bbm = $request->jenis_bbm;
            $po->status = '5';

            $po->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $penambahan = new Pengurangan();
            $penambahan->Po_id = $po->id;
            $penambahan->Nopo_pengurangan = $request->nopo;
            $penambahan->penambahan = "Driver";
            $penambahan->tgl_efektif = $request->mulaisewa;

            $penambahan->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
            $timeline->judul = 'Pairing driver - '.$user_status;
            $timeline->ket1 = 'No.po : '.$request->nopo;
            $timeline->ket2 = 'mulai sewa : '.$request->mulaisewa;
            $timeline->ket3 = 'mulai selesai : '.$request->selesaisewa;
            $timeline->user_id = auth::user()->name;
            
            $timeline->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $report_database->Sewa = "Mobil+Driver";
            $report_database->SelesaiSewa = $request->selesaisewa;
            $report_database->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $report_database->Sewa = "Mobil+Driver";
            $report_database->SelesaiSewa = $request->selesaisewa;
            $report_database->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $approve->po_id = $po->id;
            $approve->kategori = 'penambahan';
            $approve->approve = 'waiting bop';
            $approve->save();

             return redirect('/backend/po/table');
        }else{
            $tpo->NoPo = $request->nopo;
            $tpo->CP = $request->CP;
            $tpo->Cabang_id = $request->cabang_id;
            $tpo->Vendor_Mobil = $request->vendor_id;
            $tpo->Sewa = $request->sewa;
            $tpo->Vendor_Driver = $request->vendor_id;
            $tpo->MulaiSewa = $request->mulaisewa;
            $tpo->SelesaiSewa = $request->selesaisewa;
            if ($request->sewa == 'Driver') {
                $tpo->HargaSewaMobil = 0;
                $tpo->Hargasewamobil_pengurangan = 0;
            }else{
                $tpo->HargaSewaMobil = $request->hargasewamobil;
                $tpo->Hargasewamobil_pengurangan = $request->hargasewamobil;
            }

            if ($request->sewa == 'Mobil') {
                $tpo->HargaSewaDriver2019 = 0;
                $tpo->Hargasewadriver_relokasi = 0;
            }else{
                $tpo->HargaSewaDriver2019 = $request->hargasewadriver;
                $tpo->Hargasewadriver_relokasi = $request->hargasewadriver;
            }
            $tpo->Nopol = $request->nopol;
            $tpo->Mobil_id = $request->mobil_id;
            $tpo->UserPengguna = $request->user_pengguna;
            $tpo->bbm = $request->bbm;
            $tpo->jenis_bbm = $request->jenis_bbm;
            $tpo->status = '5';

            $tpo->Nopo_permanent = $request->nopo;
            $tpo->Cabang_permanent = $request->cabang_id;
            $tpo->Sewa_sementara = $request->sewa;
            $tpo->Sewa_permanent = $request->sewa;
            $tpo->user_id = auth::user()->id;
            
            

            $tpo->save();

            // for($count = 0; $count < count($Nopo); $count++)
            // {
            //        $data = array(
            //         'NoPo' => $Nopo[$count],
            //         'Sewa' => $Sewa[$count],
            //         'CP' => $CP[$count],
            //         'Cabang_id' => $Cabang_id[$count],
            //         'Vendor_Mobil' => $Vendor_Driver[$count],
            //         'Vendor_Driver' => $Vendor_Driver[$count],
            //         'MulaiSewa' => $MulaiSewa[$count],
            //         'SelesaiSewa' => $SelesaiSewa[$count],
            //         'HargaSewaMobil' => $HargaSewaMobil[$count],
            //         'HargaSewaDriver2019' => $HargaSewaDriver2019[$count],
            //         'Nopol' => $Nopol[$count],
            //         'Mobil_id' => $Mobil_id[$count],

            //         'Nopo_permanent' => $Nopo_permanent[$count],
            //         'Cabang_permanent' => $Cabang_permanent[$count],
            //         'Sewa_sementara' => $Sewa_sementara[$count],
            //         'Sewa_permanent' => $Sewa_permanent[$count],
            //         'Hargasewamobil_pengurangan' => $Hargasewamobil_pengurangan[$count],
            //         'Hargasewadriver_relokasi' => $Hargasewadriver_relokasi[$count],
            //         'status' => '5',

            //         // 'UserPengguna' => $UserPengguna[$count],
            //         'bbm' => $Bbm[$count],
            //         'jenis_bbm' => $Jenis_bbm[$count],
            //         'created_at' => $currentDateTime,
            //        );
            //        $insert_data[] = $data; 
            // }
            // tpo::insert($insert_data);
            
            // $tpo->NoPo = $nopo->id;
            // $tpo->CP = $request->CP;
            // $tpo->Sewa = $request->sewa;
            // $tpo->Cabang_id = $request->cabang_id;
            // $tpo->Vendor_Mobil = $request->vendor_id;
            // $tpo->Vendor_Driver = $request->vendor_id;
            // $tpo->MulaiSewa = $request->mulaisewa;
            // $tpo->SelesaiSewa = $request->selesaisewa;
            // $tpo->UserPengguna = $request->user_pengguna;
            // $tpo->HargaSewaMobil = $request->hargasewamobil;
            // $tpo->HargaSewaDriver2019 = $request->hargasewadriver;
            // $tpo->Type = $request->type;
            // $tpo->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            // $id_po = DB::getPdo()->lastInsertId();

            // $timeline->po_id = $id_po;
            // date_default_timezone_set('Asia/Jakarta');
            // $currentDateTime = date('Y-m-d H:i:s');
            // $timeline->tanggal = $currentDateTime;
            // $timeline->judul = 'Create PO - BPD';

            // $timeline->save();

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            // for($count = 0; $count < count($Nopo); $count++)
            // {
            //     $report_database->po_id = $id_po;
            //     $report_database->Nopo = $Nopo[$count];
            //     $report_database->Sewa = $Sewa[$count];
            //     $report_database->CP = $CP[$count];

            //     $cabang = Cabang::find($Cabang_id[$count]);

            //     $report_database->KodeCabang = $cabang->KodeCabang;
            //     $report_database->NamaCabang = $cabang->NamaCabang;
            //     $report_database->InisialCabang = $cabang->InisialCabang;
            //     $report_database->CabangUtama = $cabang->CabangUtama;
            //     $report_database->StatusCabang = $cabang->StatusCabang;
            //     $report_database->KWL = $cabang->KWL;
            //     $report_database->Kota = $cabang->Kota;

            //     $mobil = Mobil::find($Mobil_id[$count]);

            //     if($Sewa[$count] == 'Driver'){

            //     }else{
            //         $report_database->KodeMobil = $mobil->KodeMobil;
            //         $report_database->MerekMobil = $mobil->MerekMobil;
            //         $report_database->Type = $mobil->Type;
            //         $report_database->Tahun = $mobil->Tahun;
            //     }
                
            //     $vendor = Vendor::find($Vendor_Driver[$count]);

            //     $report_database->NamaVendor = $vendor->NamaVendor;

            //     $report_database->MulaiSewa = $MulaiSewa[$count];
            //     $report_database->SelesaiSewa =  $SelesaiSewa[$count];
            //     $report_database->Hargasewamobil = $HargaSewaMobil[$count];
            //     $report_database->Hargasewadriver = $HargaSewaDriver2019[$count];
            //     $report_database->Hargasewamobildriver = $HargaSewaMobil[$count]+$HargaSewaDriver2019[$count];
            //     // $report_database->UserPengguna = $UserPengguna[$count];
            //     $report_database->bbm = $Bbm[$count];
            //     $report_database->jenis_bbm = $Jenis_bbm[$count];

            //     $report_database->save();

            //     if($Sewa[$count] == 'Driver'){

            //     }else{

            //         $history_nopol->po_id = $id_po;
            //         $history_nopol->tgl_update = $MulaiSewa[$count];

            //         $history_nopol->save();

            //         $history_mobil->po_id = $id_po;
            //         $history_mobil->mobil_id = $Mobil_id[$count];
            //         $history_mobil->Nopo = $Nopo[$count];
            //         $history_mobil->tgl_update = $MulaiSewa[$count];
            //         $history_mobil->tgl_efektif = $MulaiSewa[$count];
            //         $history_mobil->Hargasewamobil = $HargaSewaMobil[$count];

            //         $history_mobil->save();
            //     }
            // }

             return redirect('/backend/po/table')->with('success','PO berhasil dibuat');
        }
            
            
        // }else{



        

            
        // }


       
    }

    public function proses_tambah_po_multiple(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
    
        $tpo = new tpo();
        $nopo = new Nopo();
        $service = new Service();
        $mcu = new mcu();
        
        $history_nopol = new historynopol();
        $history_mobil = new historymobil();
        $request->validate([
            'nopo' => 'required',
            'vendor_id' => "required",
            'po_multiple_end' => "nullable",
            'user_pengguna' => "nullable",
            // 'sewa.*' => "required",
            // 'CP.*' => "required",
            // 'cabang_id.*' => "required",
            // 'vendor_id.*' => "required",
            // 'mulaisewa.*' => "required",
            // 'selesaisewa.*' => "required",
            // 'user_pengguna.*' => "required",
            'hargasewamobil.*' => "required",
            'hargasewadriver.*' => "required",
            // 'type.*' => "required"
        ]);

        $vendor = $request->vendor_id;
        $user_pengguna = $request->user_pengguna;

        $rules = array(
            'sewa.*' => "nullable",
            'CP.*'  => 'required',
            'cabang_id.*' => "nullable",
            // 'vendor_id.*' => "required",
            'mulaisewa.*' => "nullable|date",
            'selesaisewa.*' => "nullable|date",
            'hargasewamobil.*' => "required",
            'hargasewadriver.*' => "required",
            'nopol.*' => 'nullable',
            'Po_multiple_start.*' => 'nullable', 
            'mobil_id.*' => "required",
            'bbm.*' => "nullable",
            'jenis_bbm.*' => "nullable"
        );

        $nopo->NoPo = $request->nopo;
        $nopo->save();

        $error = Validator::make($request->all(), $rules);
              if($error->fails())
              {
               return response()->json([
                'error'  => $error->errors()->all()
               ]);
              }

        $Nopo = $nopo->NoPo;
        $CP = $request->CP;
        $Cabang_id = $request->cabang_id;
        $Vendor_Mobil = $vendor;
        $Sewa = $request->sewa;
        $Vendor_Driver = $vendor;
        $MulaiSewa = $request->mulaisewa;
        $SelesaiSewa = $request->selesaisewa;
        $UserPengguna = $user_pengguna;
        $HargaSewaMobil = $request->hargasewamobil;
        $HargaSewaDriver2019 = $request->hargasewadriver;
        $Nopol = $request->nopol;
        $Mobil_id = $request->mobil_id;
        $Po_multiple_start = $request->po_multiple_start;
        $Po_multiple_end = $request->po_multiple_end; 
        $Bbm = $request->bbm;
        $Jenis_bbm = $request->jenis_bbm;

        $Nopo_permanent = $request->nopo;
        $Sewa_sementara = $request->sewa;
        $Cabang_permanent = $request->cabang_id;
        $Sewa_permanent = $request->sewa;
        $Hargasewamobil_pengurangan = $request->hargasewamobil;
        $Hargasewadriver_relokasi = $request->hargasewadriver;


        for($count = 0; $count < count($Sewa); $count++){
            if($request->nopol[$count] != 'null' && $request->nopol[$count] != '')
            {
                $approve = new approve();
                $pos = tpo::where('Nopol',$request->nopol[$count])->first();
                $po = tpo::find($pos->id);
                $po->Sewa = "Mobil+Driver";
                $po->Sewa_Sementara = "Mobil+Driver";
                // $po->Sewa_permanent = "Mobil+Driver";
                $po->MulaiSewa2 = $request->mulaisewa[$count];
                $po->SelesaiSewa2 = $request->selesaisewa[$count];
                $po->HargaSewaDriver2019 = $request->hargasewadriver[$count];
                $po->Hargasewadriver_relokasi = $request->hargasewadriver[$count];
                $po->bbm = $request->bbm[$count];
                $po->jenis_bbm = $request->jenis_bbm[$count];
                $po->status = '5';

                $po->save();

                // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                $penambahan = new Pengurangan();
                $penambahan->Po_id = $po->id;
                $penambahan->Nopo_pengurangan = $Nopo;
                $penambahan->penambahan = "Driver";
                $penambahan->tgl_efektif = $request->mulaisewa[$count];

                $penambahan->save();

                // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
                $timeline->judul = 'Pairing driver - '.$user_status;
                $timeline->ket1 = 'No.po : '.$Nopo;
                $timeline->ket2 = 'mulai sewa : '.$request->mulaisewa[$count];
                $timeline->ket3 = 'mulai selesai : '.$request->selesaisewa[$count];
                $timeline->user_id = auth::user()->name;


                $timeline->save();

                // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                $approve->po_id = $po->id;
                $approve->kategori = 'penambahan';
                $approve->approve = 'waiting bop';
                $approve->save();

            }else{

                $mulaisewa = date('Y-m-d H:i:s', strtotime($MulaiSewa[$count]));
                $selesaisewa = date('Y-m-d H:i:s', strtotime($SelesaiSewa[$count]));

                if ($Cabang_id[$count] == 'unknown'){

                }else{

                    if($Sewa[$count] == 'Mobil'){

                        $data = array(
                         'NoPo' => $Nopo,
                         'Sewa' => $Sewa[$count],
                         'CP' => $CP[$count],
                         'Cabang_id' => $Cabang_id[$count],
                         'Vendor_Mobil' => $Vendor_Driver,
                         'Vendor_Driver' => $Vendor_Driver,
                         'MulaiSewa' => $mulaisewa,
                         'SelesaiSewa' => $selesaisewa,
                         // 'UserPengguna' => $UserPengguna,
                         'HargaSewaMobil' => $HargaSewaMobil[$count],
                         'HargaSewaDriver2019' => 0,
                         'Nopol' => $Nopol[$count],
                         'Mobil_id' => $Mobil_id[$count],
                         'Po_multiple_start' => $Po_multiple_start[$count],
                         'Po_multiple_end' => $Po_multiple_end,
                         'Nopo_permanent' => $Nopo,
                         'Cabang_permanent' => $Cabang_permanent[$count],
                         'Sewa_sementara' => $Sewa_sementara[$count],
                         'Sewa_permanent' => $Sewa_permanent[$count],
                         'Hargasewamobil_pengurangan' => $Hargasewamobil_pengurangan[$count],
                         'Hargasewadriver_relokasi' => 0,
                         'bbm' => $Bbm[$count],
                         'jenis_bbm' => $Jenis_bbm[$count],
                         'status' => '5',
                         'created_at' => $currentDateTime,
                         'user_id' => auth::user()->id,
                        );
                        $insert_data = $data; 

                        tpo::insert($insert_data);

                        // $id[$count] = DB::table('tpos')->where('Po_multiple_start',$Po_multiple_start[$count])->value('id');

                        // date_default_timezone_set('Asia/Jakarta');
                        // $currentDateTime2 = date('Y-m-d H:i:s');

                        // $data_timeline = array(
                        //  'po_id' => $id[$count],
                        //  'tanggal' => $currentDateTime2,
                        //  'judul' => 'Create PO - BPD',
                        // );

                        // timeline::insert($data_timeline);

                        // $cabang_report = Cabang::find($Cabang_id[$count]);
                        // $mobil_report = Mobil::find($Mobil_id[$count]);
                        // $vendor_report = Vendor::find($Vendor_Driver);

                        // $data_report_database = array(
                        //  'po_id' => $id[$count], 
                        //  'NoPo' => $Nopo,
                        //  'Sewa' => $Sewa[$count],
                        //  'CP' => $CP[$count],

                        //  'KodeCabang' => $cabang_report->KodeCabang,
                        //  'NamaCabang' => $cabang_report->NamaCabang,
                        //  'InisialCabang' => $cabang_report->InisialCabang,
                        //  'CabangUtama' => $cabang_report->CabangUtama,
                        //  'StatusCabang' => $cabang_report->StatusCabang,
                        //  'KWL' => $cabang_report->KWL,
                        //  'Kota' => $cabang_report->Kota,

                        //  'KodeMobil' => $mobil_report->KodeMobil,
                        //  'MerekMobil' => $mobil_report->MerekMobil,
                        //  'Type' => $mobil_report->Type,
                        //  'Tahun' => $mobil_report->Tahun,
                        //  'Nopol' => $Nopol[$count],

                        //  'NamaVendor' => $vendor_report->NamaVendor,

                        //  'MulaiSewa' => $MulaiSewa[$count],
                        //  'SelesaiSewa' => $SelesaiSewa[$count],
                        //  'Hargasewamobil' => $HargaSewaMobil[$count],
                        //  'Hargasewadriver' => '0',
                        //  'Hargasewamobildriver' => $HargaSewaMobil[$count],
                        //  'bbm' => $Bbm[$count],
                        //  'jenis_bbm' => $Jenis_bbm[$count],
                        //  // 'UserPengguna' => $UserPengguna,
                        // );
                        // report_database::insert($data_report_database);

                        // $data_history_nopol = array(
                        //  'po_id' => $id[$count], 
                        //  'tgl_update' => $MulaiSewa[$count],
                        // );
                        // historynopol::insert($data_history_nopol);

                        // $data_history_mobil = array(
                        //  'po_id' => $id[$count], 
                        //  'mobil_id' => $Mobil_id[$count],
                        //  'Nopo' => $Nopo[$count],
                        //  'tgl_update' => $MulaiSewa[$count],
                        //  'tgl_efektif' => $MulaiSewa[$count],
                        //  'hargasewamobil' => $HargaSewaMobil[$count],
                        // );
                        // historymobil::insert($data_history_mobil);

                    }else{

                        if ($Sewa[$count] == 'Driver') {
                            $Mobil_id[$count] = null;
                        }
                        
                       $data = array(
                        'NoPo' => $Nopo,
                        'Sewa' => $Sewa[$count],
                        'CP' => $CP[$count],
                        'Cabang_id' => $Cabang_id[$count],
                        'Vendor_Mobil' => $Vendor_Driver,
                        'Vendor_Driver' => $Vendor_Driver,
                        'MulaiSewa' => $mulaisewa,
                        'SelesaiSewa' => $selesaisewa,
                        // 'UserPengguna' => $UserPengguna,
                        'HargaSewaMobil' => $HargaSewaMobil[$count],
                        'HargaSewaDriver2019' => $HargaSewaDriver2019[$count],
                        'Nopol' => $Nopol[$count],
                        'Mobil_id' => $Mobil_id[$count],
                        'Po_multiple_start' => $Po_multiple_start[$count],
                        'Po_multiple_end' => $Po_multiple_end,
                        'Nopo_permanent' => $Nopo,
                        'Cabang_permanent' => $Cabang_permanent[$count],
                        'Sewa_sementara' => $Sewa_sementara[$count],
                        'Sewa_permanent' => $Sewa_permanent[$count],
                        'Hargasewamobil_pengurangan' => $Hargasewamobil_pengurangan[$count],
                        'Hargasewadriver_relokasi' => $Hargasewadriver_relokasi[$count],
                        'status' => '5',
                        'bbm' => $Bbm[$count],
                        'jenis_bbm' => $Jenis_bbm[$count],
                        'created_at' => $currentDateTime,
                        'user_id' => auth::user()->id,
                       );
                       $insert_data = $data; 

                       tpo::insert($insert_data);

                       // $id[$count] = DB::table('tpos')->where('Po_multiple_start',$Po_multiple_start[$count])->value('id');

                       // date_default_timezone_set('Asia/Jakarta');
                       // $currentDateTime2 = date('Y-m-d H:i:s');

                       // $data_timeline = array(
                       //  'po_id' => $id[$count],
                       //  'tanggal' => $currentDateTime2,
                       //  'judul' => 'Create PO - BPD',
                       // );

                       // timeline::insert($data_timeline);

                       // $cabang_report = Cabang::find($Cabang_id[$count]);
                       //  $mobil_report = Mobil::find($Mobil_id[$count]);
                       //  $vendor_report = Vendor::find($Vendor_Driver);

                       //  $data_report_database = array(
                       //   'po_id' => $id[$count], 
                       //   'NoPo' => $Nopo,
                       //   'Sewa' => $Sewa[$count],
                       //   'CP' => $CP[$count],

                       //   'KodeCabang' => $cabang_report->KodeCabang,
                       //   'NamaCabang' => $cabang_report->NamaCabang,
                       //   'InisialCabang' => $cabang_report->InisialCabang,
                       //   'CabangUtama' => $cabang_report->CabangUtama,
                       //   'StatusCabang' => $cabang_report->StatusCabang,
                       //   'KWL' => $cabang_report->KWL,
                       //   'Kota' => $cabang_report->Kota,

                       //   'NamaVendor' => $vendor_report->NamaVendor,

                       //   'MulaiSewa' => $MulaiSewa[$count],
                       //   'SelesaiSewa' => $SelesaiSewa[$count],
                       //   'Hargasewamobil' => $HargaSewaMobil[$count],
                       //   'Hargasewadriver' => $HargaSewaDriver2019[$count],
                       //   'Hargasewamobildriver' => $HargaSewaMobil[$count] + $HargaSewaDriver2019[$count],
                       //   'bbm' => $Bbm[$count],
                       //   'jenis_bbm' => $Jenis_bbm[$count],
                       //   // 'UserPengguna' => $UserPengguna,
                       //  );
                       //  report_database::insert($data_report_database);

                       //  if ($Sewa[$count] == 'Mobil+Driver') {
                       //      $data_history_nopol = array(
                       //       'po_id' => $id[$count], 
                       //       'tgl_update' => $MulaiSewa[$count],
                       //      );
                       //      historynopol::insert($data_history_nopol);

                       //      $data_history_mobil = array(
                       //       'po_id' => $id[$count], 
                       //       'mobil_id' => $Mobil_id[$count],
                       //       'Nopo' => $Nopo[$count],
                       //       'tgl_update' => $MulaiSewa[$count],
                       //       'tgl_efektif' => $MulaiSewa[$count],
                       //       'hargasewamobil' => $HargaSewaMobil[$count],
                       //      );
                       //      historymobil::insert($data_history_mobil);
                       //  }
                        
                   }

                }
            }
            
        }


        // tpo::insert($insert_data);

        

        // $tpo->NoPo = $nopo->id;
        // $tpo->CP = $request->CP;
        // $tpo->Cabang_id = $request->cabang_id;
        // $tpo->Vendor_Mobil = $request->vendor_id;
        // $tpo->Sewa = $request->sewa;
        // $tpo->Vendor_Driver = $request->vendor_id;
        // $tpo->MulaiSewa = $request->mulaisewa;
        // $tpo->SelesaiSewa = $request->selesaisewa;
        // $tpo->UserPengguna = $request->user_pengguna;
        // $tpo->HargaSewaMobil = $request->hargasewamobil;
        // $tpo->HargaSewaDriver2019 = $request->hargasewadriver;
        // $tpo->Type = $request->type;
        // $tpo->save();

        // $service->po_id = $tpo->id;
        // $mcu->po_id = $tpo->id;

        // $service->save();
        // $mcu->save();

        return redirect('/backend/po/table')->with('success','PO berhasil dibuat');

        // return $request;
    }


    public function po_edit_pengada_proses(Request $request, $id)
    {
        $tpo = tpo::find($id);
        $request->validate([
            'user_pengguna' => "nullable",
            'nopo' => "nullable",
            'sewa' => "nullable",
            'CP' => "nullable",
            'cabang_id' => "nullable",
            'vendor_id' => "nullable",
            'mulaisewa' => "nullable",
            'mulaisewa2' => "nullable",
            'selesaisewa' => "nullable",
            'hargasewamobil' => "nullable",
            'hargasewadriver' => "nullable",
            'bbm' => "nullable",
            'jenis_bbm' => "nullable",
            'type' => "nullable"
        ]);

        // $tpo->UserPengguna = $request->user_pengguna;
        $tpo->NoPo = $request->nopo;
        $tpo->CP = $request->CP;
        $tpo->Cabang_id = $request->cabang_id;
        $tpo->Vendor_Mobil = $request->vendor_id;
        $tpo->Sewa = $request->sewa;
        $tpo->Vendor_Driver = $request->vendor_id;
        $tpo->MulaiSewa = $request->mulaisewa;
        $tpo->MulaiSewa2 = $request->mulaisewa2;
        $tpo->SelesaiSewa = $request->selesaisewa;
        $tpo->HargaSewaMobil = $request->hargasewamobil;
        $tpo->HargaSewaDriver2019 = $request->hargasewadriver;
        $tpo->bbm = $request->bbm;
        $tpo->jenis_bbm = $request->jenis_bbm;
        $tpo->Type = $request->type;

        $tpo->Nopo_permanent = $request->nopo;
        $tpo->Cabang_permanent = $request->cabang_id;
        $tpo->Sewa_sementara = $request->sewa;
        $tpo->Sewa_permanent = $request->sewa;
        $tpo->Hargasewamobil_pengurangan = $request->hargasewamobil;
        $tpo->hargasewadriver_relokasi = $request->hargasewadriver;

        $tpo->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/dashboard');
        }else{
            return redirect('/backend/po/table');
        }

        

    }

    public function check_po_multiple_nopol(Request $request)
    {
        // abort_unless(\Gate::allows('city_access'), 401);

        if (!$request->nopol) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            // $pos = DB::table('tpos')->where('Nopol','!=',$request->nopol)->get();
            $pos = tpo::all();
            $html .= '<option value="null">Tanpa Unit</option>';
            foreach ($pos as $po) {
                if ($po->Sewa_sementara == "Mobil" && $po->status == "1" && $po->Nopol != $request->nopol) {
                    // $html  = '<option value="null">Tanpa Unit</option>';
                    $html .= '<option value="'.$po->Nopol.'">'.$po->Nopol.'</option>';
                }elseif($po->Sewa_sementara == "Mobil" && $po->status == "1" && $po->Nopol == $request->nopol) {
                    // $html  = '<option value="null">Tanpa Unit</option>';
                    $html .= '<option value="'.$po->Nopol.'" selected>'.$po->Nopol.'</option>';
                }
            }
        }

        return response()->json(['html' => $html]);
    }

    public function po_edit_dashboard($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $po = tpo::find($id);
        $nopos = Nopo::all();
        return view('dashboard/edit',compact('po','cabangs','umps','vendors','drivers','mobils','nopos'));
    }


    public function po_edit_dashboard_proses(Request $request, $id)
    {
        $tpo = tpo::find($id);
        $request->validate([
            'nopo' => "nullable",
            'CP' => "nullable",
            'cabang_id' => "nullable",
            'vendor_id' => "nullable",
            'mulaisewa' => "nullable",
            'selesaisewa' => "nullable",
            'user_pengguna' => "nullable",
            'hargasewamobil' => "nullable",
            'hargasewadriver' => "nullable",
            'noregister' => "nullable",
            'type' => "nullable",
            'tgl_bastd' => "nullable",
            'tgl_bastk' => "nullable"
        ]);

        $tpo->NoPo = $request->nopo;
        $tpo->CP = $request->CP;
        $tpo->Cabang_id = $request->cabang_id;
        $tpo->Vendor_Mobil = $request->vendor_id;
        $tpo->Vendor_Driver = $request->vendor_id;
        $tpo->MulaiSewa = $request->mulaisewa;
        $tpo->SelesaiSewa = $request->selesaisewa;
        $tpo->Tgl_bastd = $request->tgl_bastd;
        $tpo->Tgl_bastk = $request->tgl_bastk;
        $tpo->UserPengguna = $request->user_pengguna;
        $tpo->HargaSewaMobil = $request->hargasewamobil;
        $tpo->HargaSewaDriver2019 = $request->hargasewadriver;
        $tpo->NoRegister = $request->noregister;
        $tpo->Type = $request->type;

        $tpo->save();

        return redirect('/backend/dashboard');

    }

    public function po_import_excel(Request $request) 
    {

        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new PoImport, $file); //IMPORT FILE 
            return redirect('/backend/po/table')->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    // public function proses_tambah_po(Request $request)
    // {
    //     $tpo = new tpo();
    //     $nopo = new Nopo();
    //     $service = new Service();
    //     $mcu = new mcu();
    //     $request->validate([
    //         'nopo' => 'required'
    //     ]);

    //     $nopo->NoPo = $request->nopo;
    //     $nopo->save();

    //     $CP = $request->CP;
    //     $Cabang_id = $request->cabang_id;
    //     $Vendor_Mobil = $request->vendor_id;
    //     $Sewa = $request->sewa;
    //     $Vendor_Driver = $request->vendor_id;
    //     $MulaiSewa = $request->mulaisewa;
    //     $SelesaiSewa = $request->selesaisewa;
    //     $UserPengguna = $request->user_pengguna;
    //     $HargaSewaMobil = $request->hargasewamobil;
    //     $HargaSewaDriver2019 = $request->hargasewadriver;
    //     $Type = $request->type;

    //     foreach($CP as $key => $no)
    //     {
    //         $input['CP'] = $no;
    //         $input['NoPo'] = $nopo->id[$key];
    //         $input['Cabang_id '] = $Cabang_id[$key];
    //         $input['Vendor_Mobil'] = $Vendor_Mobil[$key];
    //         $input['Sewa'] = $Sewa[$key];
    //         $input['Vendor_Driver'] = $Vendor_Driver[$key];
    //         $input['MulaiSewa'] = $MulaiSewa[$key];
    //         $input['SelesaiSewa'] = $SelesaiSewa[$key];
    //         $input['UserPengguna'] = $UserPengguna[$key];
    //         $input['HargaSewaMobil'] = $HargaSewaMobil[$key];
    //         $input['HargaSewaDriver2019'] = $HargaSewaDriver2019[$key];
    //         $input['Type'] = $Type[$key];

    //         tpo::create($input);
    //     }

    //     $service->po_id = $tpo->id;
    //     $mcu->po_id = $tpo->id;

    //     $service->save();
    //     $mcu->save();

    //     return redirect('/backend/po/table');
    // }

    public function po_completing($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::find($id);
        $nopos = Nopo::all();
        return view('PO/table/table_operasional_completing',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos'));
    }

    public function po_completing_proses(Request $request, $id)
    {
        $po = tpo::find($id);
        
        $report_database = report_database::where('po_id',$id)->first();
        $history_nopol = historynopol::where('po_id',$id)->first();
        $request->validate([
            'nopol' => 'nullable',
            'tgl_bastk' => 'nullable',
            'tgl_bastd' => 'nullable',
            'noregister' => 'nullable',
            'user_pengguna' => 'nullable'
        ]);

        $po->Nopol = $request->nopol;
        $po->Tgl_bastk = $request->tgl_bastk;
        $po->Tgl_bastd = $request->tgl_bastd;
        $po->NoRegister = $request->noregister;
        $po->UserPengguna = $request->user_pengguna;

        $po->save();

        $report_database->Nopol = $request->nopol;
        $report_database->Tgl_bastk = $request->tgl_bastk;
        $report_database->Tgl_bastd = $request->tgl_bastd;
        $report_database->No_register = $request->noregister;
        $report_database->UserPengguna = $request->user_pengguna;
        
        $report_database->save();    

        if($po->Sewa == 'Driver'){

        }else{
            $history_nopol->nopol = $request->nopol;
            $history_nopol->save();  
        }      

        $approve = approve::where('po_id',$id)->where('kategori','penambahan');
        $approve->delete();

        return redirect('/backend/po/table');
    }


    public function update_tgl_po(Request $reques)
    {
        return $request->all();
    }

    public function update_po_status(Request $request,$id)
    {
        $po = tpo::find($id);
        $request->validate([
            'status' => 'required'
        ]);
        $po->status = $request->status;

        $po->save();

        return redirect('/backend/dashboard')->with('success', 'PO berhasil ditambahkan ke Database');
    }

    public function update_po_status_multiple(Request $request)
    {
        $request->validate([
            'status.*' => 'nullable',
        ]);

        $status = $request->status;

        if ($status == '') {
            return redirect('/backend/po/table')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {
               $po = tpo::find($status[$count]);
               $po->status = '1';
               $po->Po_multiple_start = null;
               $po->Po_multiple_end = null;
               $po->save();

               $timeline = new timeline();
               $timeline->po_id = $status[$count];
               date_default_timezone_set('Asia/Jakarta');
               $currentDateTime = date('Y-m-d H:i:s');
               $timeline->tanggal = $currentDateTime;
               $timeline->judul = 'Completing PO - BOP';
               $timeline->user_id = auth::user()->name;
               $timeline->save();

               $approve = approve::where('po_id',$po->id)->where('kategori','penambahan');
               $approve->delete();
            }
            return redirect('/backend/dashboard')->with('success','PO berhasil ditambahkan ke Database');
        }
    }

    public function update_po_pengada_status_multiple(Request $request)
    {
        $request->validate([
            'dpo.*' => 'nullable',
        ]);

        $status = $request->dpo;

        if ($status == '') {
            return redirect('/backend/po/table')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {
               $po = tpo::find($status[$count]);
               $po->status = '0';
               $po->save();

               if (($po->Sewa == 'Mobil+Driver' || $po->Sewa == 'Mobil') && ($po->Nopol == '' || $po->Nopol == null)) {
                       
                       date_default_timezone_set('Asia/Jakarta');
                       $currentDateTime2 = date('Y-m-d H:i:s');

                       $timeline = new timeline();
                       $timeline->po_id = $po->id;
                       $timeline->tanggal = $currentDateTime2;
                       if ($po->user->status == 'pengada') {
                        $timeline->judul = 'Create PO - BPD';
                       }elseif ($po->user->status == 'blk') {
                         $timeline->judul = 'Create PO - BLK';
                       }else{
                        $timeline->judul = 'Create PO - BPD';
                       }
                       $timeline->user_id = $po->user->name;
                       $timeline->save();

                       $cabang_report = Cabang::find($po->Cabang_id);
                       $mobil_report = Mobil::find($po->Mobil_id);
                       $vendor_report = Vendor::find($po->Vendor_Driver);

                       $data_report_database = new report_database();
                       $data_report_database->po_id = $po->id;
                       $data_report_database->NoPo = $po->NoPo;
                       $data_report_database->Sewa = $po->Sewa;
                       $data_report_database->CP = $po->CP;
                       $data_report_database->KodeCabang = $cabang_report->KodeCabang;
                       $data_report_database->NamaCabang = $cabang_report->NamaCabang;
                       $data_report_database->InisialCabang = $cabang_report->InisialCabang;
                       $data_report_database->CabangUtama = $cabang_report->CabangUtama;
                       $data_report_database->StatusCabang = $cabang_report->StatusCabang;
                       $data_report_database->KWL = $cabang_report->KWL;
                       $data_report_database->Kota = $cabang_report->Kota;
                       $data_report_database->KodeMobil = $po->mobil->KodeMobil;
                       $data_report_database->MerekMobil = $po->mobil->MerekMobil;
                       $data_report_database->Type = $po->mobil->Type;
                       $data_report_database->Tahun = $po->mobil->Tahun;
                       $data_report_database->NamaVendor = $vendor_report->NamaVendor;
                       $data_report_database->MulaiSewa = $po->MulaiSewa;
                       $data_report_database->SelesaiSewa = $po->SelesaiSewa;
                       $data_report_database->Hargasewamobil = $po->HargaSewaMobil;
                       $data_report_database->Hargasewadriver = $po->HargaSewaDriver2019; 
                       $data_report_database->Hargasewamobildriver = $po->HargaSewaMobil + $po->HargaSewaDriver2019;
                       $data_report_database->bbm = $po->bbm;
                       $data_report_database->jenis_bbm = $po->jenis_bbm;
                       $data_report_database->save();

                       $historynopol = new historynopol();
                       $historynopol->po_id = $po->id;
                       $historynopol->tgl_update = $po->MulaiSewa;
                       $historynopol->save();

                       $historymobil = new historymobil();
                       $historymobil->po_id = $po->id;
                       $historymobil->mobil_id = $po->Mobil_id;
                       $historymobil->Nopo = $po->Nopo;
                       $historymobil->tgl_update = $po->MulaiSewa;
                       $historymobil->tgl_efektif = $po->MulaiSewa;
                       $historymobil->hargasewamobil = $po->HargaSewaMobil;
                       $historymobil->save();

               }else if($po->Sewa == 'Driver' && ($po->Nopol == '' || $po->Nopol == 'null' || $po->Nopol == null)){

                       date_default_timezone_set('Asia/Jakarta');
                       $currentDateTime2 = date('Y-m-d H:i:s');

                       $timeline = new timeline();
                       $timeline->po_id = $po->id;
                       $timeline->tanggal = $currentDateTime2;
                       if ($po->user->status == 'pengada') {
                        $timeline->judul = 'Create PO - BPD';
                       }elseif ($po->user->status == 'blk') {
                         $timeline->judul = 'Create PO - BLK';
                       }else{
                        $timeline->judul = 'Create PO - BPD';
                       }
                       $timeline->user_id = $po->user->name;
                       $timeline->save();

                       $cabang_report = Cabang::find($po->Cabang_id);
                       $mobil_report = Mobil::find($po->Mobil_id);
                       $vendor_report = Vendor::find($po->Vendor_Driver);

                       $data_report_database = new report_database;
                       $data_report_database->po_id = $po->id;
                       $data_report_database->NoPo = $po->NoPo;
                       $data_report_database->Sewa = $po->Sewa;
                       $data_report_database->CP = $po->CP;
                       $data_report_database->KodeCabang = $cabang_report->KodeCabang;
                       $data_report_database->NamaCabang = $cabang_report->NamaCabang;
                       $data_report_database->InisialCabang = $cabang_report->InisialCabang;
                       $data_report_database->CabangUtama = $cabang_report->CabangUtama;
                       $data_report_database->StatusCabang = $cabang_report->StatusCabang;
                       $data_report_database->KWL = $cabang_report->KWL;
                       $data_report_database->Kota = $cabang_report->Kota;
                       $data_report_database->NamaVendor = $vendor_report->NamaVendor;
                       $data_report_database->MulaiSewa = $po->MulaiSewa;
                       $data_report_database->SelesaiSewa = $po->SelesaiSewa;
                       $data_report_database->Hargasewamobil = $po->HargaSewaMobil;
                       $data_report_database->Hargasewadriver = $po->HargaSewaDriver2019; 
                       $data_report_database->Hargasewamobildriver = $po->HargaSewaMobil + $po->HargaSewaDriver2019;
                       $data_report_database->bbm = $po->bbm;
                       $data_report_database->jenis_bbm = $po->jenis_bbm;
                       $data_report_database->save();
               }
            }
            return redirect('/backend/po/table')->with('success','PO berhasil dikirim ke BOP');
        }
    }

    public function database_confirm(Request $request)
    {
        $request->validate([
            'dpo.*' => 'nullable',
        ]);

        $status = $request->dpo;

        if ($status == '') {
            return redirect('/backend/po/table/5')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {
               $po = tpo::find($status[$count]);             
               if ($po->Driver_id != null) {
                   $driver_report = Driver::find($po->Driver_id);
                   if ($driver_report->Po_id != '' || $driver_report->Po_id != null) {
                       return redirect('/backend/po/table/5')->with('warning','No.PO : '.$po->NoPo.' - Driver sudah connect dengan PO lain.');
                   }
               }
               $po->status = '1';
               $po->save();

               if (($po->Sewa == 'Mobil+Driver' || $po->Sewa == 'Mobil')) {
                       
                       date_default_timezone_set('Asia/Jakarta');
                       $currentDateTime2 = date('Y-m-d H:i:s');

                       $timeline = new timeline();
                       $timeline->po_id = $po->id;
                       $timeline->tanggal = $currentDateTime2;
                       $timeline->judul = 'Create PO - BPD';
                       $timeline->user_id = auth::user()->name;
                       $timeline->save();

                       // $timeline = new timeline();
                       // $timeline->po_id = $status[$count];
                       // date_default_timezone_set('Asia/Jakarta');
                       // $currentDateTime = date('Y-m-d H:i:s');
                       // $timeline->tanggal = $currentDateTime;
                       // $timeline->judul = 'Completing PO - BOP';
                       // $timeline->save();

                       $cabang_report = Cabang::find($po->Cabang_id);
                       $mobil_report = Mobil::find($po->Mobil_id);
                       $vendor_report = Vendor::find($po->Vendor_Driver);
                       if ($po->Driver_id != null) {
                           $driver_report = Driver::find($po->Driver_id);
                       }

                       $data_report_database = new report_database();

                       $data_report_database->po_id = $po->id;
                       $data_report_database->NoPo = $po->NoPo;
                       $data_report_database->Sewa = $po->Sewa;
                       $data_report_database->CP = $po->CP;
                       $data_report_database->Nopol = $po->Nopol;
                       if ($po->Driver_id != null) {
                            $data_report_database->NamaDriver = $driver_report->NamaDriver;
                            $data_report_database->nik = $driver_report->nik;
                            $data_report_database->nip = $driver_report->nip;
                       }
                       $data_report_database->KodeCabang = $cabang_report->KodeCabang;
                       $data_report_database->NamaCabang = $cabang_report->NamaCabang;
                       $data_report_database->InisialCabang = $cabang_report->InisialCabang;
                       $data_report_database->CabangUtama = $cabang_report->CabangUtama;
                       $data_report_database->StatusCabang = $cabang_report->StatusCabang;
                       $data_report_database->KWL = $cabang_report->KWL;
                       $data_report_database->Kota = $cabang_report->Kota;
                       $data_report_database->NamaVendor = $vendor_report->NamaVendor;
                       $data_report_database->MulaiSewa = $po->MulaiSewa;
                       $data_report_database->Tgl_bastk = $po->Tgl_bastk;
                       $data_report_database->SelesaiSewa = $po->SelesaiSewa;
                       $data_report_database->Hargasewamobil = $po->HargaSewaMobil;
                       $data_report_database->Hargasewadriver = $po->HargaSewaDriver2019; 
                       $data_report_database->Hargasewamobildriver = $po->HargaSewaMobil + $po->HargaSewaDriver2019;
                       $data_report_database->bbm = $po->bbm;
                       $data_report_database->jenis_bbm = $po->jenis_bbm;
                       $data_report_database->No_register = $po->NoRegister;
                       $data_report_database->UserPengguna = $po->UserPengguna;
                       $data_report_database->save();

                       if ($po->Driver_id != null) {
                            $driver = Driver::find($po->Driver_id);
                            $driver->Po_id = $po->id;
                            $driver->save();

                            $historydriver = new historydriver();
                            $historydriver->Driver_id = $po->Driver_id;
                            $historydriver->Po_id = $po->id;
                            $historydriver->tgl_mulai = $po->Tgl_bastd;
                            $historydriver->save();
                       }

                       $historynopol = new historynopol();
                       $historynopol->po_id = $po->id;
                       $historynopol->nopol = $po->Nopol;
                       $historynopol->tgl_update = $po->MulaiSewa;
                       $historynopol->save();

                       $historymobil = new historymobil();
                       $historymobil->po_id = $po->id;
                       $historymobil->mobil_id = $po->Mobil_id;
                       $historymobil->Nopo = $po->Nopo;
                       $historymobil->tgl_update = $po->MulaiSewa;
                       $historymobil->tgl_efektif = $po->MulaiSewa;
                       $historymobil->hargasewamobil = $po->HargaSewaMobil;
                       $historymobil->save();

               }else if($po->Sewa == 'Driver'){

                       date_default_timezone_set('Asia/Jakarta');
                       $currentDateTime2 = date('Y-m-d H:i:s');

                       $timeline = new timeline();
                       $timeline->po_id = $po->id;
                       $timeline->tanggal = $currentDateTime2;
                       $timeline->judul = 'Create PO - BPD'; 
                       $timeline->user_id = auth::user()->name;
                       $timeline->save();

                       // $timeline = new timeline();
                       // $timeline->po_id = $status[$count];
                       // date_default_timezone_set('Asia/Jakarta');
                       // $currentDateTime = date('Y-m-d H:i:s');
                       // $timeline->tanggal = $currentDateTime;
                       // $timeline->judul = 'Completing PO - BOP';
                       // $timeline->save();

                       $cabang_report = Cabang::find($po->Cabang_id);
                       $mobil_report = Mobil::find($po->Mobil_id);
                       $vendor_report = Vendor::find($po->Vendor_Driver);
                       if ($po->Driver_id != null) {
                           $driver_report = Driver::find($po->Driver_id);
                       }

                       $data_report_database = new report_database;
                       $data_report_database->po_id = $po->id;
                       $data_report_database->NoPo = $po->NoPo;
                       $data_report_database->Sewa = $po->Sewa;
                       $data_report_database->CP = $po->CP;
                       $data_report_database->Nopol = $po->Nopol;
                       if ($po->Driver_id != null) {
                            $data_report_database->NamaDriver = $driver_report->NamaDriver;
                            $data_report_database->nik = $driver_report->nik;
                            $data_report_database->nip = $driver_report->nip;
                       }
                       $data_report_database->KodeCabang = $cabang_report->KodeCabang;
                       $data_report_database->NamaCabang = $cabang_report->NamaCabang;
                       $data_report_database->InisialCabang = $cabang_report->InisialCabang;
                       $data_report_database->CabangUtama = $cabang_report->CabangUtama;
                       $data_report_database->StatusCabang = $cabang_report->StatusCabang;
                       $data_report_database->KWL = $cabang_report->KWL;
                       $data_report_database->Kota = $cabang_report->Kota;
                       $data_report_database->NamaVendor = $vendor_report->NamaVendor;
                       $data_report_database->MulaiSewa = $po->MulaiSewa;
                       $data_report_database->SelesaiSewa = $po->SelesaiSewa;
                       $data_report_database->Hargasewamobil = $po->HargaSewaMobil;
                       $data_report_database->Hargasewadriver = $po->HargaSewaDriver2019; 
                       $data_report_database->Hargasewamobildriver = $po->HargaSewaMobil + $po->HargaSewaDriver2019;
                       $data_report_database->bbm = $po->bbm;
                       $data_report_database->jenis_bbm = $po->jenis_bbm;
                       $data_report_database->No_register = $po->NoRegister;
                       $data_report_database->UserPengguna = $po->UserPengguna;
                       $data_report_database->save();

                       if ($po->Driver_id != null) {
                            $driver = Driver::find($po->Driver_id);
                            $driver->Po_id = $po->id;
                            $driver->save();

                            $historydriver = new historydriver();
                            $historydriver->Driver_id = $po->Driver_id;
                            $historydriver->Po_id = $po->id;
                            $historydriver->tgl_mulai = $po->Tgl_bastd;
                            $historydriver->save();
                       }
               }
            }
            return redirect('/backend/po/table/5')->with('success','PO berhasil dikirim ke database');
        }
    }

    public function database_confirm_batalkan(Request $request)
    {
        $request->validate([
            'dpo.*' => 'nullable',
        ]);

        $status = $request->dpo;

        if ($status == '') {
            return redirect('/backend/po/table/5')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($status); $count++)
            {
               $po = tpo::find($status[$count]);             
               $po->delete();
            }
            return redirect('/backend/po/table/5')->with('success','PO berhasil dibatalkan');
        }
    }

    public function show_po($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $po = tpo::find($id);
        if (approve::where('po_id', $id)->exists()) {
            $status_approve = 'waiting';
        }else{
            $status_approve = 'null';
        }

        if (timeline::where('po_id', $id)->exists()) {
           $check_timeline = 'yes';
        }else{
           $check_timeline = 'no';
        }
        $nopos = Nopo::all();
        $relokasis = Relokasi::where('Po_id',$id)->get()->sortByDesc('id');
        $services = Service::all();
        $pengurangans = Pengurangan::all();
        $harga_umps = harga_ump::all();
        $kotas = kota::all();
        $historymobils = historymobil::where('po_id',$id)->get()->sortByDesc('id');
        $historymobils2 = historymobil::where('po_id',$id)->get()->sortByDesc('id');
        $total_historymobil = historymobil::where('po_id',$id)->count();
        $historynopols = historynopol::where('po_id',$id)->get()->sortByDesc('id');
        $historys = historydriver::all()->sortByDesc('id');
        $history_driver = historydriver::where('Po_id',$id)->latest()->first();
        $restore2 = historydriver::where('po_id', '=', $id)->get();
        $restores = $restore2->unique('Driver_id');
        $pkwts = pkwt::all();
        $timelines = timeline::all()->sortBy('id');
        $table_template_relokasis = table_template_relokasi::all();
        $template_relokasis = template_relokasi::all();
        $table_template_pengurangans = table_template_pengurangan::all();
        $template_pengurangans = template_pengurangan::all();
        $table_template_perubahans = table_template_perubahan::all();
        $template_perubahans = template_perubahan::all();
        $bbms = bbm::all();
        $approves = approve::all();
        return view('PO/view',compact('po','cabangs','umps','vendors','drivers','mobils','nopos','relokasis','services','pengurangans','harga_umps','kotas','historys','restores','historymobils','historymobils2','historynopols','pkwts','timelines','total_historymobil','template_relokasis','table_template_relokasis','bbms','template_pengurangans','table_template_pengurangans','template_perubahans','table_template_perubahans','history_driver','approves','check_timeline','status_approve'));

    }

    public function show_po_pdf($id)
    {
        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $po = tpo::find($id);
        $nopos = Nopo::all();
        $relokasis = Relokasi::all()->sortByDesc('id');
        $services = Service::all();
        $pengurangans = Pengurangan::all();
        $harga_umps = harga_ump::all();
        $kotas = kota::all();
        $historymobils = historymobil::where('po_id',$id)->get()->sortByDesc('id');
        $historymobils2 = historymobil::where('po_id',$id)->get()->sortByDesc('id');
        $total_historymobil = historymobil::where('po_id',$id)->count();
        $historynopols = historynopol::where('po_id',$id)->get()->sortByDesc('id');
        $historys = historydriver::all()->sortByDesc('id');
        $restore2 = historydriver::where('po_id', '=', $id)->get();
        $restores = $restore2->unique('Driver_id');
        $pkwts = pkwt::all();
        $timelines = timeline::all()->sortBy('id');
        return view('PO/show/index',compact('po','cabangs','umps','vendors','drivers','mobils','nopos','relokasis','services','pengurangans','harga_umps','kotas','historys','restores','historymobils','historymobils2','historynopols','pkwts','timelines','total_historymobil'));
    }



    public function destroy_po($id)
    {
        $po = tpo::find($id);
        $service = Service::where('po_id',$id);
        $mcu = mcu::where('po_id',$id);
        $timeline = timeline::where('po_id',$id);
        $report_database = report_database::where('po_id',$id);
        $historynopol = historynopol::where('po_id',$id);
        $historymobil = historymobil::where('po_id',$id);
        // $service = Service::where('po_id',$id);
        // $service = Searvice::find($id);
        $po->delete();
        $service->delete();
        $mcu->delete();
        $report_database->delete();
        $timeline->delete();
        $historynopol->delete();
        $historymobil->delete();
        // $service->delete();
        // $service->delete();

        return redirect('/backend/po/table')->with('success','PO berhasil di batalkan');;
    }

    public function destroy_po_all_excel()
    {
        $po = tpo::where('status','7')->delete();

        return redirect('/backend/po/table/5')->with('success','PO berhasil di batalkan');;
    }

    public function po_delete_driver_eksisting($id)
    {
        $pengurangan = pengurangan::where('Po_id',$id)->whereNotNull('penambahan')->latest()->first(); 
        $timeline = timeline::where('Po_id',$id)->where('judul','Pairing driver - BPD')->orWhere('judul','Pairing driver - BOP')->latest()->first(); 
        $report_database = report_database::where('po_id',$id)->first();
        $po = tpo::find($id);    

        $po->Sewa = "Mobil";
        $po->Sewa_Sementara = "Mobil";
        $po->MulaiSewa2 = null;
        $po->SelesaiSewa2 = null;
        $po->HargaSewaDriver2019 = null;
        $po->Hargasewadriver_relokasi = null;
        $po->status = '1';

        $report_database->Sewa = "Mobil";
        
        $po->save();
        $report_database->save();
        $pengurangan->delete();
        $timeline->delete();      

        if (approve::where('po_id',$id)->where('kategori','penambahan')->exists()) {
            $approve = approve::where('po_id',$id)->where('kategori','penambahan');
            $approve->delete();
        }

        return redirect('/backend/po/table')->with('success','PO berhasil di batalkan');
    }

    public function vendor_multiple_add(Request $request){

        $value = $request->get('value');

        if (!$request->get('value')) {
                
            } else {
                $html = '<option value="null">'."Tanpa unit".'</option>';
                $cities = tpo::where('Vendor_Driver',$value)->get();
                foreach ($cities as $po) {
                    $html .= '<option value="'.$po->Nopol.'">'.$po->Nopol.'</option>';
                }
            }

        return response()->json(['html' => $html]);
    }


    public function perpanjang($id)
    {
        $po = tpo::find($id);

        return view('PO/edit/perpanjang',compact('po'));
    }

    public function perpanjang_proses(Request $request, $id)
    {
        $po = tpo::find($id);
        $timeline = new timeline;

        $po->SelesaiSewa = $request->get('selesaisewa');

        $timeline->po_id = $request->po_id;
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
        $timeline->judul = 'Perpanjang PO - '.$user_status;
        $timeline->ket1 = 'Selesai Sewa : '.$request->get('selesaisewa');
        $timeline->user_id = auth::user()->name;

        $timeline->save();
        
        $po->save();

        return redirect('/backend/po/show/'.$id);
    }


// ___________________________CABANG____________________________

    public function index_cabang()
    {
        $umps = ump::all();
        $cabangs = Cabang::all();
        $kotas = kota::all()->sortBy('Kota');
        $unique = Cabang::all();
        $cabuts = $unique->unique('CabangUtama');
        $s = 'active';
        return view('cabang/index',compact('cabangs','umps','kotas','cabuts','s'));
    }

    public function index_cabang_status($status)
    {
        $umps = ump::all();
        $cabangs = Cabang::all();
        $kotas = kota::all()->sortBy('Kota');
        $unique = Cabang::all();
        $cabuts = $unique->unique('CabangUtama');
        $s = $status;
        return view('cabang/index',compact('cabangs','umps','kotas','cabuts','s'));
    }

    public function proses_tambah_cabang(Request $request)
    {
        $cabang = new Cabang();
        $request->validate([
            'kodecabang' => 'required|unique:cabangs',
            'namacabang' => 'required',
            'inisialcabang' => 'required',
            'statuscabang' => 'required',
            'cabangutama' => 'required',
            'kwl' => 'required',
            'kota' =>'required'
            // 'ump_id' => 'required'
        ]);

        $kota_id = Kota::where('Kota',$request->kota)->first();

        $cabang->KodeCabang = $request->kodecabang;
        $cabang->NamaCabang = $request->namacabang;
        $cabang->InisialCabang = $request->inisialcabang;
        $cabang->StatusCabang = $request->statuscabang;
        $cabang->CabangUtama = $request->cabangutama;
        $cabang->KWL = $request->kwl;
        $cabang->Kota = $request->kota;
        $cabang->Ump_id = $kota_id->id;

        $cabang->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/cabang')->with('success','Cabang berhasil ditambahkan');
        }else{
            return redirect('/backend/cabang')->with('success','Cabang berhasil ditambahkan');
        }

    }

    public function cabang_edit($id)
    {
        $cabang = Cabang::find($id);
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::all();
        $nopos = Nopo::all();
        return view('cabang/edit',compact('pos','cabang','umps','vendors','drivers','mobils','nopos'));
    }

    public function cabang_edit_proses(Request $request, $id)
    {
        $cabang = Cabang::find($id);
        $request->validate([
            'kodecabang' => 'required',
            'namacabang' => 'required',
            'inisial' => 'required',
            'statuscabang' => 'required',
            'cabangutama' => 'required',
            'kwl' => 'required',
            'kota' =>'required'
        ]);

        $cabang->KodeCabang = $request->kodecabang;
        $cabang->NamaCabang = $request->namacabang;
        $cabang->InisialCabang = $request->inisial;
        $cabang->StatusCabang = $request->statuscabang;
        $cabang->CabangUtama = $request->cabangutama;
        $cabang->KWL = $request->kwl;
        $cabang->Kota = $request->kota;

        $cabang->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/cabang')->with('success','Cabang berhasil diupdate');
        }else{
            return redirect('/backend/cabang')->with('success','Cabang berhasil diupdate');
        }
    }

    public function destroy_cabang($id)
    {
        $cabang = Cabang::find($id);

        if ($cabang->active == '1') {
            $cabang->active = '';
            $cabang->save();

            return redirect('/backend/cabang')->with('success','Cabang berhasil direstore');
        }else{
            $cabang->active = '1';
            $cabang->save();

            return redirect('/backend/cabang')->with('success','Cabang berhasil dihapus');
        }

    }

    public function destroy_cabang_multiple(Request $request)
    {
        $request->validate([
            'cabang.*' => 'nullable',
        ]);

        // return $request->cabang;
        
        $cabang = $request->cabang;

        $return = 0;

        if ($cabang == '') {
            return redirect('/backend/cabang')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($cabang); $count++)
            {

               $Cabang = Cabang::find($cabang[$count]);
               if ($Cabang->active != '1') {
                   $Cabang->active = '1';
                   $Cabang->save();
                   $return = 1;
               }else{
                   $Cabang->active = '';
                   $Cabang->save();
                   $return = 0;
               }

            }if ($return == 0) {
                return redirect('/backend/cabang')->with('success','cabang berhasil direstore');
            }else{
                return redirect('/backend/cabang')->with('success','cabang berhasil dihapus');
            }
            
        }
        
    }

    public function check_cabang(Request $request)
    {
        if($request->get('cabut') != ''){
            $cabut = $request->get('cabut');
            $data = Cabang::where('CabangUtama',$cabut)->get();
            $cabang = DB::table('cabangs')->where('CabangUtama','LIKE', '%'.$cabut.'%')->get();

            return response()->json($cabang);
        }else{
            $cabut = $request->get('cabut');
            $cabang = Cabang::where('CabangUtama',$cabut)->get();
            return response()->json($cabang);
        }

    }

    public function check_cabang_all(Request $request)
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

// ___________________________DRIVER____________________________

    public function index_driver()
    {
        $drivers = Driver::all()->sortByDesc('id');
        $vendors = Vendor::all()->sortBy('NamaVendor');
        $pos = tpo::all();
        $pkwts = pkwt::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        $s = 'active';
        return view('driver/index',compact('drivers','vendors','pos','pkwts','s','history_drivers'));
    }

    public function index_driver_status($status)
    {
        $drivers = Driver::all()->sortByDesc('id');
        $vendors = Vendor::all()->sortBy('NamaVendor');
        $pos = tpo::all();
        $pkwts = pkwt::all();
        $s = $status;
        return view('driver/index',compact('drivers','vendors','pos','pkwts','s'));
    }

    public function proses_tambah_driver(Request $request)
    {
        $driver = new Driver();
        $pkwt = new pkwt();
        $request->validate([
            'nik' => 'required',
            'nip' => 'required',
            'namadriver' => 'required',
            'vendor_id' => 'required'
        ]);

        $driver->nik = $request->nik;
        $driver->nip = $request->nip;
        $driver->NamaDriver = $request->namadriver;
        $driver->Vendor_id = $request->vendor_id;
        $driver->Po_id = '';

        $driver->save();
        // $pkwt->driver_id = $driver->id;

        // $pkwt->save();
        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/driver');
        }else{
            return redirect('/backend/driver');
        }
    }

    public function driver_edit($id)
    {
        $cabang = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $driver = Driver::find($id);
        $pos = tpo::all();
        $nopos = Nopo::all();
        return view('driver/edit',compact('pos','cabang','umps','vendors','driver','mobils','nopos'));
    }

    public function driver_edit_proses(Request $request, $id)
    {
        $driver = Driver::find($id);
        $request->validate([
            'nik' => 'required',
            'nip' => 'required',
            'namadriver' => 'required',
            'vendor_id' => 'required'
        ]);

        $driver->nik = $request->nik;
        $driver->nip = $request->nip;
        $driver->NamaDriver = $request->namadriver;
        $driver->vendor_id = $request->vendor_id;

        $driver->save();

        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/driver');
        }else{
            return redirect('/backend/driver');
        }
    }

    public function destroy_driver($id)
    {
        $driver = Driver::find($id);

        if ($driver->active == '1') {
            $driver->active = '';
        }else{
            $driver->active = '1';
        }

        $driver->save();

        return redirect('/backend/driver');
    }


    public function destroy_driver_multiple(Request $request)
    {
        $request->validate([
            'driver.*' => 'nullable',
        ]);

        $driver = $request->driver;

        if ($driver == '') {
            return redirect('/backend/driver')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($driver); $count++)
            {

               $Driver = driver::find($driver[$count]);
               if ($Driver->active != '1') {
                   $Driver->active = '1';
                   $Driver->save();
               }

            }
            return redirect('/backend/driver')->with('success','driver berhasil dihapus');
        }
        
    }


    public function connect_driver($id)
    {
        $driver = Driver::find($id);
        $pos = tpo::all()->sortByDesc('id');
        $cabangs = Cabang::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        return view('driver/connect_po',compact('pos','driver','cabangs','history_drivers'));
    }


    public function history_driver($id)
    {

        // $historys = historydriver::where('Driver_id',$id)->get();
        $historys = historydriver::all()->sortByDesc('id');
        $drivers = Driver::find($id);
        $pos = tpo::all();
        return view('driver/history',compact('drivers','pos','historys'));
    }

    public function history_driver_delete($id)
    {

        $historydriver = historydriver::find($id);
        $historydriver->delete();
        return redirect('/backend/driver')->with('success','History driver berhasil');
    }

    public function proses_connect_driver(Request $request, $id)
    {
        $driver = Driver::find($id);
        $timeline = new timeline;
        $request->validate([
            'po_id' => 'required',
            'driver_id' => 'required',
            'mulai' => 'required'
        ]);

        $driver->Po_id = $request->po_id;
        $driver->save();

        $po = tpo::find($request->po_id);
        $po->Driver_id = $request->driver_id;
        $po->Tgl_cutoff_driver = null;
        if ($po->Tgl_bastd == '') {
            $po->Tgl_bastd = $request->mulai;
        }
        $po->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        

        $history = new historydriver();

        $history->Driver_id = $id;
        $history->Po_id = $request->po_id;
        $currentDateTime = date('Y-m-d H:i:s');
        $history->tgl_mulai = $request->mulai;

        $history->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $report_driver = new report_driver();

        $cabang = Cabang::find($po->Cabang_id);
        $vendor = Vendor::find($po->Vendor_Driver);

        if ($po->Sewa != 'Driver') {
            $mobil = Mobil::find($po->Mobil_id);
        }

        $report_driver->driver_id = $driver->id;
        $report_driver->NamaDriver = $driver->NamaDriver;
        $report_driver->nik = $driver->nik;
        $report_driver->nip = $driver->nip;
        $report_driver->Nopo = $po->NoPo;
        $report_driver->Sewa = $po->Sewa;
        $report_driver->CP = $po->CP;
        $report_driver->Nopol = $po->Nopol;
        $report_driver->KodeCabang = $cabang->KodeCabang;
        $report_driver->NamaCabang = $cabang->NamaCabang;
        $report_driver->InisialCabang = $cabang->InisialCabang;
        $report_driver->CabangUtama = $cabang->CabangUtama;
        $report_driver->StatusCabang = $cabang->StatusCabang;
        $report_driver->KWL = $cabang->KWL;
        $report_driver->Kota = $cabang->Kota;
        if ($po->Sewa != 'Driver') {
            $report_driver->KodeMobil = $mobil->KodeMobil;
            $report_driver->MerekMobil = $mobil->MerekMobil;
            $report_driver->Tahun = $mobil->Tahun;
            $report_driver->Type = $mobil->Type;
        }
        $report_driver->NamaVendor = $vendor->NamaVendor;
        $report_driver->tgl_mulai = $request->mulai;

        $report_driver->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $driver = Driver::find($request->driver_id);

        $timeline->po_id = $request->po_id;
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
        $timeline->judul = 'Add driver - '.$user_status;
        $timeline->ket1 = 'driver : '.$driver->NamaDriver;
        $timeline->ket3 = 'tgl mulai : '.$request->mulai;
        $timeline->user_id = auth::user()->name;

        $timeline->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $report_database = report_database::where('po_id',$request->po_id)->first();

        $report_database->NamaDriver = $driver->NamaDriver;
        $report_database->nip = $driver->nip;
        $report_database->nik = $driver->nik;
        if ($report_database->Tgl_bastd == '') {
            $report_database->Tgl_bastd = $request->mulai;
        }

        $report_database->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        return redirect('/backend/po/show/'.$request->get('po_id'));
    }


    public function proses_restore_driver(Request $request)
    {
        
        $driver = Driver::find($request->get('driver_id'));
        $driverss = Driver::all();
        $poss = tpo::all();
        $po = tpo::find($request->get('po_id'));
        $pkwts = pkwt::all();
        $currentDateTime = date('m/d/y');

        foreach($pkwts as $pkwt)
        {
          if($driver->id == $pkwt->driver_id && $pkwt->active != '1')
          {
            if($pkwt->PeriodeJeda_start >= $currentDateTime && $pkwt->PeriodeJeda_end <= $currentDateTime && $pkwt->TanggalMasuk != '')
              return redirect()->back()->with('warning','Status driver Non Active - driver tidak bisa direstore');  
            elseif($pkwt->TanggalMasuk == '')
              return redirect()->back()->with('warning','Status driver Non Active - driver tidak bisa direstore'); 
            else
              return view('driver/restore_driver',compact('po','driver','poss','driverss'));  
          }   
        }

        return redirect()->back()->with('warning','Status driver Non Active - driver tidak bisa direstore'); 
              

        
    }


    public function proses_restore_driver2(Request $request)
    {
        $timeline = new timeline;

        $request->validate([
            'po_id' => 'required',
            'driver_id' => 'required',
            'mulai' => 'required'
        ]);

        $driver = Driver::find($request->driver_id);
        $driver->Po_id = $request->po_id;
        $driver->save();

        $po = tpo::find($request->po_id);
        $po->Driver_id = $request->driver_id;
        $po->save();

        $history = new historydriver();
        $history->Driver_id = $request->driver_id;
        $history->Po_id = $request->po_id;
        
        $history->tgl_mulai = $request->mulai;

        $history->save();

        $report_driver = new report_driver();

        $cabang = Cabang::find($po->Cabang_id);
        $vendor = Vendor::find($po->Vendor_Driver);

        if ($po->Mobil_id != '') {
            $mobil = Mobil::find($po->Mobil_id);
        }

        $report_driver->driver_id = $driver->id;
        $report_driver->NamaDriver = $driver->NamaDriver;
        $report_driver->nik = $driver->nik;
        $report_driver->nip = $driver->nip;
        $report_driver->Nopo = $po->NoPo;
        $report_driver->Sewa = $po->Sewa;
        $report_driver->CP = $po->CP;
        $report_driver->Nopol = $po->Nopol;
        $report_driver->KodeCabang = $cabang->KodeCabang;
        $report_driver->NamaCabang = $cabang->NamaCabang;
        $report_driver->InisialCabang = $cabang->InisialCabang;
        $report_driver->CabangUtama = $cabang->CabangUtama;
        $report_driver->StatusCabang = $cabang->StatusCabang;
        $report_driver->KWL = $cabang->KWL;
        $report_driver->Kota = $cabang->Kota;
        if ($po->Mobil_id != '') {
            $report_driver->KodeMobil = $mobil->KodeMobil;
            $report_driver->MerekMobil = $mobil->MerekMobil;
            $report_driver->Tahun = $mobil->Tahun;
            $report_driver->Type = $mobil->Type;
        }
        $report_driver->NamaVendor = $vendor->NamaVendor;
        $report_driver->tgl_mulai = $request->mulai;

        $report_driver->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $driver = Driver::find($request->driver_id);

        $timeline->po_id = $request->po_id;
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
        $timeline->judul = 'Add driver - '.$user_status;
        $timeline->ket1 = 'driver : '.$driver->NamaDriver;
        $timeline->ket3 = 'tgl mulai : '.$request->mulai;
        $timeline->user_id = auth::user()->name;

        $timeline->save();

        return redirect('/backend/po/show/'.$request->get('po_id'));

    }


    public function po_delete_driver(Request $request)
    {
        $driver = Driver::find($request->get('driver_id'));
        $po = tpo::find($request->get('po_id'));
        return view('driver/po_delete_driver',compact('po','driver'));
    }


    public function po_delete_driver_proses(Request $request)
    {

        $po = tpo::where('Driver_id',$request->get('driver_id'))->first();
        $history = historydriver::where('Driver_id',$request->get('driver_id'))->WhereNull('tgl_selesai')->first();
        $report_driver = report_driver::where('driver_id',$request->get('driver_id'))->WhereNull('tgl_selesai')->first();
        $driver = Driver::find($request->get('driver_id'));
        $report_database = report_database::where('po_id',$po->id)->first();
        $timeline = new timeline;
        $po->Driver_id = '';
        $po->Tgl_cutoff_driver = $request->get('selesai');
        $driver->Po_id = '';
        
        // $currentDateTime = date('Y-m-d H:i:s');
        $history->tgl_selesai = $request->get('selesai');
        $report_driver->tgl_selesai = $request->get('selesai');

        $po->save();
        $driver->save();
        $history->save();
        $report_driver->save();
        
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
        $timeline->judul = 'Delete driver - '.$user_status;
        $timeline->ket1 = 'driver : '.$driver->NamaDriver;
        $timeline->ket3 = 'tgl selesai : '.$request->get('selesai');
        $timeline->user_id = auth::user()->name;

        $timeline->save();

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $report_database->NamaDriver = null;
        $report_database->nik = null;
        $report_database->nip = null;

        $report_database->save();

        return redirect('/backend/po/show/'.$request->get('po_id'));

    }


    public function edit_cutoff_driver($po_id,$driver_id)
    {
        $driver = Driver::find($driver_id);
        $po = tpo::find($po_id);
        return view('driver/edit_cutoff_driver',compact('po','driver'));
    }

    public function edit_cutoff_driver_proses(Request $request)
    {
        $po = tpo::find($request->get('po_id'));
        $timeline = timeline::where('Po_id',$request->get('po_id'))->where('judul','Delete driver - BPD')->orWhere('judul','Delete driver - BOP')->latest()->first();    
        $history = historydriver::where('Po_id',$request->get('po_id'))->latest()->first();
        $report_driver = report_driver::where('driver_id',$request->get('driver_id'))->latest()->first();

        $po->Tgl_cutoff_driver = $request->get('selesai');
        $history->tgl_selesai = $request->get('selesai');
        $report_driver->tgl_selesai = $request->get('selesai');
        $timeline->ket3 = 'tgl selesai : '.$request->get('selesai');

        $po->save();
        $history->save();
        $report_driver->save();
        $timeline->save();

        return redirect('/backend/po/show/'.$request->get('po_id'));
    }



// ________________________MOBIL______________________________

    public function index_mobil()
    {
        $mobils = Mobil::all()->sortBy('Tahun');
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        $s = 'active';
        return view('mobil/index',compact('mobils','s','tahuns'));
    }

    public function index_mobil_status($status)
    {
        $mobils = Mobil::all()->sortBy('Tahun');
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        $s = $status;
        return view('mobil/index',compact('mobils','s','tahuns'));
    }

    public function proses_tambah_mobil(Request $request)
    {
        $mobil = new Mobil();
        $request->validate([
            'kodemobil' => 'required',
            'merekmobil' => 'required',
            'tahun' => 'required',
            'type' => 'required'
        ]);

        $mobil->KodeMobil = $request->kodemobil;
        $mobil->MerekMobil = $request->merekmobil;
        $mobil->Tahun = $request->tahun;
        $mobil->Type = $request->type;

        $mobil->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/mobil')->with('success','Data Mobil berhasil ditambahkan');
        }else{
            return redirect('/backend/mobil')->with('success','Data Mobil berhasil ditambahkan');
        }
    }

    public function edit_mobil($id){
        $mobil = Mobil::find($id);
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        return view('mobil/edit',compact('mobil','tahuns'));
    }
    

    public function edit_proses_mobil(Request $request,$id){
        $mobil = mobil::find($id);
        $request->validate([
            'kodemobil' => 'required',
            'merekmobil' => 'required',
            'tahun' => 'required',
            'type' => 'required'
        ]);

        $mobil->KodeMobil = $request->kodemobil;
        $mobil->MerekMobil = $request->merekmobil;
        $mobil->Tahun = $request->tahun;
        $mobil->Type = $request->type;

        $mobil->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/mobil')->with('success','Data Mobil berhasil diupdate');
        }else{
            return redirect('/backend/mobil')->with('success','Data Mobil berhasil diupdate');
        }
    }

    public function destroy_mobil_multiple(Request $request)
    {
        $request->validate([
            'mobil.*' => 'nullable',
        ]);

        $Mobil = $request->mobil;

        $return = 0;

        if ($Mobil == '') {
            return redirect('/backend/mobil')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($Mobil); $count++)
            {

               $mobil = Mobil::find($Mobil[$count]);
               if ($mobil->active != '1') {
                   $mobil->active = '1';
                   $mobil->save();
                   $return = 1;
               }else{
                   $mobil->active = '';
                   $mobil->save();
                   $return = 0;
               }

            }
            if ($return == 0) {
                return redirect('/backend/mobil')->with('success','Mobil berhasil direstore');
            }else{
                return redirect('/backend/mobil')->with('success','Mobil berhasil dihapus');
            }
            
        }
        
    }


    public function destroy_mobil($id)
    {

        $mobil = Mobil::find($id);

        if ($mobil->active == '1') {
            $mobil->active = '';
            $mobil->save();

            return redirect('/backend/mobil')->with('success','Mobil berhasil direstore');
        }else{
            $mobil->active = '1';
            $mobil->save();

            return redirect('/backend/mobil')->with('success','Mobil berhasil dihapus');
        }
    }

    public function check_mobil(Request $request)
    {
        if($request->get('typemobil'))
        {
          $kodemobil = $request->get('kodemobil');
          $merekmobil = $request->get('merekmobil');
          $typemobil = $request->get('typemobil');
          $tahun = $request->get('tahun');
          $data = DB::table("mobils")
                   ->where('KodeMobil', $kodemobil)
                   ->where('MerekMobil', $merekmobil)
                   ->where('Tahun', $tahun)
                   ->where('Type', $typemobil)
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

    // public function cetak_mobil()
    // {
    //     $mobils = Mobil::all();
    //     $tahuns = tahun_mobil::all()->sortBy('Tahun');
    //     $s = 'active';

    //     $pdf = PDF::loadview('mobil/index',compact('mobils','s','tahuns'));
    //     return $pdf->download('laporan-mobil-pdf');
    // }

// ________________________MOBIL TAHUN______________________________

    public function index_tahun()
    {
        //
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        $s = 'active';
        return view('mobil/tahun/index',compact('tahuns','s'));
    }

    public function index_tahun_status($status)
    {
        //
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        $s = $status;
        return view('mobil/tahun/index',compact('tahuns','s'));
    }


    public function create_tahun()
    {
        //
        return view('mobil/tahun/create');
    }


    public function store_tahun(Request $request)
    {
        //
        $tahun = new tahun_mobil();
        $request->validate([
            'tahun' => 'required|unique:tahun_mobils'
        ]);

        $tahun->Tahun = $request->tahun;

        $tahun->save();

        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/tahun_mobil')->with('success','Tahun mobil berhasil ditambahkan');
        }else{
            return redirect('/backend/mobil2/tahun')->with('success','Tahun mobil berhasil ditambahkan');
        }
    }



    public function edit_tahun($id){
        $tahun = tahun_mobil::find($id);
        return view('mobil/tahun/edit',compact('tahun'));
    }
    

    public function edit_proses_tahun(Request $request,$id){
        $tahun = tahun_mobil::find($id);

        if ($request->get('tahun') == $tahun->Tahun) {
            $tahun->Tahun = $request->tahun;
            $tahun->save();

        }else{
            $request->validate([
                'tahun' => 'required|unique:tahun_mobils'
            ]);

            $tahun->Tahun = $request->tahun;
            $tahun->save();
        }


        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/tahun_mobil')->with('success','Tahun berhasil diupdate');
        }else{
            return redirect('/backend/mobil2/tahun')->with('success','Tahun berhasil diupdate');
        }
    }
    

    public function destroy_tahun($id)
    {
        //
        $tahun = tahun_mobil::find($id);

        if ($tahun->active == '1') {
            $tahun->active = '';
            $tahun->save();

            return redirect('/backend/mobil2/tahun')->with('success','Tahun berhasil direstore');
        }else{
            $tahun->active = '1';
            $tahun->save();

            return redirect('/backend/mobil2/tahun')->with('success','Tahun berhasil dihapus');
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
            return redirect('/backend/mobil2/tahun')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($tahun); $count++)
            {
               $Tahun = tahun_mobil::find($tahun[$count]);
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
                return redirect('/backend/mobil2/tahun')->with('success','tahun berhasil direstore');
            }else{
                return redirect('/backend/mobil2/tahun')->with('success','tahun berhasil dihapus');
            }
            
        }

    }



    public function check_tahun_mobil(Request $request)
    {
        if($request->get('tahun'))
        {
          $tahun = $request->get('tahun');
          $data = DB::table("tahun_mobils")
                   ->where('Tahun', $tahun)
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

// ________________________BBM______________________________

    public function index_bbm()
    {
        //
        $bbms = bbm::all()->sortBy('jenis_bbm');
        $s = 'active';
        return view('mobil/bbm/index',compact('bbms','s'));
    }

    public function index_bbm_status($status)
    {
        //
        $bbms = bbm::all()->sortBy('jenis_bbm');
        $s = $status;
        return view('mobil/bbm/index',compact('bbms','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_bbm()
    {
        //
        return view('mobil/bbm/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_bbm(Request $request)
    {
        //
        $bbm = new bbm();
        $request->validate([
            'jenis_bbm' => 'required|unique:bbms'
        ]);

        $bbm->jenis_bbm = $request->jenis_bbm;

        $bbm->save();
        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/bbm')->with('success','bbm berhasil ditambahkan');
        }else{
            return redirect('/backend/bbm')->with('success','bbm berhasil ditambahkan');
        }
    }

    public function edit_bbm($id){
        $bbm = bbm::find($id);
        return view('mobil/bbm/edit',compact('bbm'));
    }


    public function edit_proses_bbm(Request $request,$id){
        $bbm = bbm::find($id);

        if (strtoupper($request->get('jenis_bbm')) == strtoupper($bbm->jenis_bbm)) {
            $bbm->jenis_bbm = $request->jenis_bbm;
            $bbm->save();

        }else{
            $request->validate([
                'jenis_bbm' => 'required|unique:bbms'
            ]);

            $bbm->jenis_bbm = $request->jenis_bbm;
            $bbm->save();
        }
        

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/bbm')->with('success','bbm berhasil diupdate');
        }else{
            return redirect('/backend/bbm')->with('success','bbm berhasil diupdate');
        }
    }

    public function destroy_bbm_multiple(Request $request)
    {
        $request->validate([
            'bbm.*' => 'nullable',
        ]);

        $bbm = $request->bbm;
        $return = 0;

        if ($bbm == '') {
            return redirect('/backend/bbm')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($bbm); $count++)
            {
               $Bbm = bbm::find($bbm[$count]);
               if ($Bbm->active != '1') {
                   $Bbm->active = '1';
                   $Bbm->save();
                   $return = 1;
               }else{
                    $Bbm->active = '';
                    $Bbm->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/bbm')->with('success','bbm berhasil direstore');
            }else{
                return redirect('/backend/bbm')->with('success','bbm berhasil dihapus');
            }
            
        }

    }

    public function check_bbm(Request $request)
    {
        if($request->get('bbm'))
        {
          $bbm = $request->get('bbm');
          $data = DB::table("bbms")
                   ->where('jenis_bbm', $bbm)
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

// ________________________Carpooling______________________________

    public function index_cp()
    {
        //
        $cps = Cp::all()->sortBy('kota');
        $s = 'active';
        $kotas = kota::all()->sortBy('Kota');
        return view('CP/index',compact('cps','s','kotas'));
    }

    public function index_cp_status($status)
    {
        //
        $cps = Cp::all()->sortBy('kota');
        $s = $status;
        $kotas = kota::all()->sortBy('Kota');
        return view('CP/index',compact('cps','s','kotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_cp()
    {
        //
        return view('CP/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_cp(Request $request)
    {
        //
        $cp = new Cp();
        $request->validate([
            'jenis' => 'nullable',
            'kota' => 'required|unique:cps'
        ]);

        $cp->jenis = $request->jenis;
        $cp->kota = $request->kota;

        $cp->save();
        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/cp')->with('success','Carpooling berhasil ditambahkan');
        }else{
            return redirect('/backend/cp')->with('success','Carpooling berhasil ditambahkan');
        }
    }

    public function edit_cp($id){
        $cp = Cp::find($id);
        $kotas = kota::all()->sortBy('Kota');
        return view('CP/edit',compact('cp','kotas'));
    }


    public function edit_proses_cp(Request $request,$id){
        $cp = Cp::find($id);

        if (strtoupper($request->get('kota')) == strtoupper($cp->kota)) {
            $request->validate([
                'jenis' => 'nullable',
                'kota' => 'nullable'
            ]);

            $cp->jenis = $request->jenis;
            $cp->kota = $request->kota;

            $cp->save();

        }else{
            $request->validate([
                'jenis' => 'nullable',
                'kota' => 'required|unique:cps'
            ]);

            $cp->jenis = $request->jenis;
            $cp->kota = $request->kota;

            $cp->save();
        }

        

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/cp')->with('success','Carpooling berhasil diupdate');
        }else{
            return redirect('/backend/cp')->with('success','Carpooling berhasil diupdate');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_cp($id)
    {
        //
        $cp = Cpp::find($id);

        if ($cp->active == '1') {
            $cp->active = '';
            $cp->save();

            return redirect('/backend/cp')->with('success','CP berhasil direstore');
        }else{
            $cp->active = '1';
            $cp->save();

            return redirect('/backend/cp')->with('success','CP berhasil dihapus');
        }

    }


    public function destroy_cp_multiple(Request $request)
    {
        $request->validate([
            'carpooling.*' => 'nullable',
        ]);

        $cp = $request->carpooling;

        $return = 0;

        if ($cp == '') {
            return redirect('/backend/cp')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($cp); $count++)
            {

               $Cp = Cp::find($cp[$count]);
               if ($Cp->active != '1') {
                   $Cp->active = '1';
                   $Cp->save();
                   $return = 1;
               }else{
                    $Cp->active = '';
                    $Cp->save();
                    $return = 0;
               }
            }

            if ($return == 0) {
                return redirect('/backend/cp')->with('success','Carpooling berhasil direstore');
            }else{
                return redirect('/backend/cp')->with('success','Carpooling berhasil dihapus');
            }
        }
        
    }


    public function check_cp(Request $request)
    {
        if($request->get('kota'))
        {
          $kota = $request->get('kota');
          $data = DB::table("cps")
                   ->where('kota', $kota)
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


// ________________________VENDOR______________________________

    public function index_vendor()
    {
        $vendors = vendor::paginate(50)->sortBy('NamaVendor');
        $s = 'active';
        return view('vendor/index',compact('vendors','s'));
    }

    public function index_vendor_status($status)
    {
        $vendors = vendor::paginate(50)->sortBy('NamaVendor');
        $s = $status;
        return view('vendor/index',compact('vendors','s'));
    }

    public function proses_tambah_vendor(Request $request)
    {
        $vendor = new Vendor();
        $request->validate([
            'kodevendor' => 'required',
            'namavendor' => 'required',
            'picvendor' => 'required',
            'nohpvendor' => 'required',
            'pejabatvendor' => 'required',
            'jabatanvendor' => 'required',
            'alamatvendor' => 'required'
        ]);

        $vendor->KodeVendor = $request->kodevendor;
        $vendor->NamaVendor = $request->namavendor;
        $vendor->PICvendor = $request->picvendor;
        $vendor->Nohpvendor = $request->nohpvendor;
        $vendor->Pejabatvendor = $request->pejabatvendor;
        $vendor->Jabatanvendor = $request->jabatanvendor;
        $vendor->AlamatVendor = $request->alamatvendor;

        $vendor->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/vendor')->with('success','Vendor berhasil ditambahkan');
        }else{
            return redirect('/backend/vendor')->with('success','Vendor berhasil ditambahkan');
        }

    }

    public function edit_vendor($id){
        $vendor = Vendor::find($id);
        return view('vendor/edit',compact('vendor'));
    }
    

    public function edit_proses_vendor(Request $request,$id){
        $vendor = Vendor::find($id);
        $request->validate([
            'kodevendor' => 'nullable',
            'namavendor' => 'nullable',
            'picvendor' => 'nullable',
            'nohpvendor' => 'required',
            'pejabatvendor' => 'required',
            'jabatanvendor' => 'required',
            'alamatvendor' => 'nullable'
        ]);

        $vendor->KodeVendor = $request->kodevendor;
        $vendor->NamaVendor = $request->namavendor;
        $vendor->PICvendor = $request->picvendor;
        $vendor->Nohpvendor = $request->nohpvendor;
        $vendor->Pejabatvendor = $request->pejabatvendor;
        $vendor->Jabatanvendor = $request->jabatanvendor;
        $vendor->AlamatVendor = $request->alamatvendor;

        $vendor->save();

        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/vendor')->with('success','Vendor berhasil diupdate');
        }else{
            return redirect('/backend/vendor')->with('success','Vendor berhasil diupdate');
        }
    }

    public function destroy_vendor($id)
    {
        $vendor = Vendor::find($id);

        if ($vendor->active == '1') {
            $vendor->active = '';
            $vendor->save();

            return redirect('/backend/vendor')->with('success','Vendor berhasil direstore');
        }else{
            $vendor->active = '1';
            $vendor->save();

            return redirect('/backend/vendor')->with('success','Vendor berhasil dihapus');
        }
    }

    public function destroy_vendor_multiple(Request $request)
    {
        $request->validate([
            'vendor.*' => 'nullable',
        ]);

        $vendor = $request->vendor;

        $return = 0;

        if ($vendor == '') {
            return redirect('/backend/vendor')->with('warning','Tidak ada item yang dipilih');
        }else{

            for($count = 0; $count < count($vendor); $count++)
            {

               $Vendor = vendor::find($vendor[$count]);
               if ($Vendor->active != '1') {
                   $Vendor->active = '1';
                   $Vendor->save();
                   $return = 1;
               }else{
                    $Vendor->active = '';
                   $Vendor->save();
                   $return = 0;
               }

            }
            if ($return == 0) {
                return redirect('/backend/vendor')->with('success','vendor berhasil direstore');
            }else{
                return redirect('/backend/vendor')->with('success','vendor berhasil dihapus');
            }
            
        }
        
    }

    public function check_vendor(Request $request)
    {
        if($request->get('vendor'))
        {
          $vendor = $request->get('vendor');
          $data = DB::table("vendors")
                   ->where('NamaVendor', $vendor)
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




// ______________________PKWT_______________________

    public function show_pkwt(Request $request,$id)
    {
        $pkwts = pkwt::all();
        $drivers = Driver::find($id);
        // $pkwt_tgl_masuk = pkwt::where('driver_id',$id)->where('active','<>','1')->first();
        $pkwt_tgl_masuk = DB::table('pkwts')->where('driver_id',$id)->where('active',null)->orwhere('active','')->first();
        if (isset($pkwt_tgl_masuk->TanggalMasuk)) {
            $tm = 1;
        }else{
            $tm = 0;
        }
        $did = $id;
        $s = 'active';
        return view('driver/pkwt',compact('pkwts','drivers','pkwt_tgl_masuk','tm','s'));
    }

    public function show_pkwt_status(Request $request,$id,$status)
    {
        $pkwts = pkwt::all();
        $drivers = Driver::find($id);
        // $pkwt_tgl_masuk = pkwt::where('driver_id',$id)->where('active','<>','1')->first();
        $pkwt_tgl_masuk = DB::table('pkwts')->where('driver_id',$id)->where('active',null)->orwhere('active','')->first();
        if (isset($pkwt_tgl_masuk->TanggalMasuk)) {
            $tm = 1;
        }else{
            $tm = 0;
        }
        $did = $id;
        $s = $status;
        return view('driver/pkwt',compact('pkwts','drivers','pkwt_tgl_masuk','tm','s'));
    }

    public function create_pkwt(Request $request,$id)
    {
        $pkwt = new pkwt();
        $report_pkwt = new report_pkwt();

        $request->validate([
            'driver_id' => 'nullable',
            'tanggalmasuk' => 'nullable'
        ]);

        $pkwt->driver_id = $request->driver_id;
        $pkwt->TanggalMasuk = $request->tanggalmasuk;

        $pkwt->save();

        $driver = Driver::find($request->driver_id);

        $report_pkwt->pkwt_id = $pkwt->id;
        $report_pkwt->driver_id = $request->driver_id;
        $report_pkwt->NamaDriver = $driver->NamaDriver;
        $report_pkwt->nik = $driver->nik;
        $report_pkwt->nip = $driver->nip;
        $report_pkwt->NamaVendor = $driver->vendor_id;
        $report_pkwt->TanggalMasuk = $request->tanggalmasuk;

        $report_pkwt->save();

        return redirect('/backend/driver/pkwt/'.$id);
    }

    public function edit_pkwt($id)
    {
        $pkwt = pkwt::find($id);
        $drivers = Driver::all();
        return view('driver/pkwt_edit',compact('pkwt','drivers'));
    }

    public function edit_pkwt_proses(Request $request,$id)
    {
        $pkwt = pkwt::find($id);
        $report_pkwt = report_pkwt::where('pkwt_id',$id)->first();

        pkwt::where('driver_id',$request->get('driver_id'))->where('active',null)->orwhere('active','')->update(['TanggalMasuk'=>$request->get('tanggalmasuk')]);
        report_pkwt::where('driver_id',$request->get('driver_id'))->where('active',null)->orwhere('active','')->update(['TanggalMasuk'=>$request->get('tanggalmasuk')]);

        $request->validate([
            'tanggalmasuk' => 'nullable',
            'pkwt1_start' => 'nullable',
            'pkwt1_end' => 'nullable',
            'pkwt2_start' => 'nullable',
            'pkwt2_end' => 'nullable',
            'durasijeda' => 'nullable',
            'periodejeda_start' => 'nullable',
            'periodejeda_end' => 'nullable',
            'keterangan' => 'nullable',
            'driver_id' => 'nullable'
        ]);

        $pkwt->pkwt1_start = $request->pkwt1_start;
        $pkwt->pkwt1_end = $request->pkwt1_end;
        $pkwt->pkwt2_start = $request->pkwt2_start;
        $pkwt->pkwt2_end = $request->pkwt2_end;
        $pkwt->DurasiJeda = $request->durasijeda;
        $pkwt->PeriodeJeda_start = $request->periodejeda_start;
        $pkwt->PeriodeJeda_end = $request->periodejeda_end;
        $pkwt->keterangan = $request->keterangan;
        $pkwt->driver_id = $request->driver_id;

        $report_pkwt->pkwt1_start = $request->pkwt1_start;
        $report_pkwt->pkwt1_end = $request->pkwt1_end;
        $report_pkwt->pkwt2_start = $request->pkwt2_start;
        $report_pkwt->pkwt2_end = $request->pkwt2_end;
        $report_pkwt->DurasiJeda = $request->durasijeda;
        $report_pkwt->PeriodeJeda_start = $request->periodejeda_start;
        $report_pkwt->PeriodeJeda_end = $request->periodejeda_end;
        $report_pkwt->keterangan = $request->keterangan;
        $report_pkwt->driver_id = $request->driver_id;

        $pkwt->save();
        $report_pkwt->save();

        
        if (auth::user()->status == 'admin') {
            return redirect('/backend/admin/pkwt/');
        }else{
            return redirect('/backend/driver/pkwt/'.$pkwt->driver_id);
        }
    }

    public function destroy_pkwt($id)
    {

        $pkwt = pkwt::find($id);
        // $report_pkwt = report_pkwt::where('pkwt_id',$id)->first();

        if ($pkwt->active == '1') {
            $pkwt->active = '';
            // $report_pkwt->active = '';
            $pkwt->save();
            // $report_pkwt->save();

            return redirect('/backend/driver/pkwt/'.$pkwt->driver_id)->with('success','pkwt berhasil direstore');
        }else{
            $pkwt->active = '1';
            // $report_pkwt->active = '1';
            $pkwt->save();
            // $report_pkwt->save();

            return redirect('/backend/driver/pkwt/'.$pkwt->driver_id)->with('success','pkwt berhasil dihapus');
        }
    }

// _______________________NOPOL____________________________

    public function edit_nopol($id)
    {
        $po = tpo::find($id);
        return view('PO/edit/nopol',compact('po'));
    }

    public function edit_nopol_proses(Request $request,$id)
    {
        $po = tpo::find($id);
        $historynopol = new historynopol;
        $timeline = new timeline;
        $report_database = report_database::where('po_id',$id)->first();
        $request->validate([
            'nopol' => 'nullable',
            'keterangan' => 'nullable'
        ]);

        $po->Nopol = $request->nopol;
        $historynopol->nopol = $request->nopol;
        $historynopol->keterangan = $request->keterangan;
        $historynopol->po_id = $id;
        $currentDateTime = date('m/d/y');
        $historynopol->tgl_update = $currentDateTime;

        $po->save();
        $historynopol->save();

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
        $timeline->judul = 'Penggantian nopol - '.$user_status;
        $timeline->ket1 = 'nopol : '.$request->nopol;
        $timeline->ket2 = 'keterangan : '.$request->keterangan;
        $timeline->user_id = auth::user()->name;

        $timeline->save();

        $report_database->Nopol = $request->nopol;

        $report_database->save();

        return redirect('/backend/po/show/'.$id);
    }

// _______________________Type & merek____________________________

    public function edit_type($id)
    {
        $po = tpo::find($id);
        $mobils = Mobil::all()->sortBy('MerekMobil');
        return view('PO/edit/mobil',compact('po','mobils'));
    }

    public function edit_type_proses(Request $request,$id)
    {
        $po = tpo::find($id);
        $historymobil = new historymobil;
        $timeline = new timeline;
        $report_database = report_database::where('po_id',$id)->first();

        $request->validate([
            'nopo' => 'nullable',
            'mobil_id' => 'nullable',
            'tgl_efektif' => 'nullable',
            'hargasewamobil' => 'nullable'
        ]);

        $po->Mobil_id = $request->mobil_id;
        $po->HargaSewaMobil = $request->hargasewamobil;
        $po->Hargasewamobil_pengurangan = $request->hargasewamobil;

        $historymobil->po_id = $id;
        $historymobil->Nopo = $request->nopo;
        $historymobil->mobil_id = $request->mobil_id;
        $currentDateTime = date('m/d/y');
        $historymobil->tgl_update = $currentDateTime;
        $historymobil->tgl_efektif = $request->tgl_efektif;
        $historymobil->Hargasewamobil = $request->hargasewamobil;

        $po->save();
        $historymobil->save();

        $mobil = Mobil::find($request->mobil_id);

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
        $timeline->judul = 'Penggantian mobil - '.$user_status;
        $timeline->ket1 = 'nopo : '.$request->nopo;
        $timeline->ket2 = $mobil->MerekMobil.' '.$mobil->Type.' - '.$mobil->Tahun;
        $timeline->ket3 = 'tgl efektif : '.$request->tgl_efektif;
        $timeline->user_id = auth::user()->name;

        $timeline->save();

        $mobil = Mobil::find($request->mobil_id);

        $report_database->KodeMobil = $mobil->KodeMobil;
        $report_database->MerekMobil = $mobil->MerekMobil;
        $report_database->Type = $mobil->Type;
        $report_database->Tahun = $mobil->Tahun;
        $report_database->Hargasewamobil = $request->hargasewamobil;

        $report_database->save();

        return redirect('/backend/po/show/'.$id);
    }

// _______________________Tgl____________________________

    public function edit_tgl($id)
    {
        $po = tpo::find($id);
        return view('PO/edit/tgl',compact('po'));
    }

    public function edit_tgl_proses(Request $request,$id)
    {
        $po = tpo::find($id);
        $report_database = report_database::where('po_id',$id)->first();
        $request->validate([
            'mulaisewa' => 'nullable',
            'mulaisewa2' => 'nullable',
            'tgl_bastd' => 'nullable',
            'tgl_bastk' => 'nullable',
            'selesaisewa' => 'nullable',
        ]);

        $po->MulaiSewa = $request->mulaisewa;
        $po->MulaiSewa2 = $request->mulaisewa2;
        $po->Tgl_bastd = $request->tgl_bastd;
        $po->Tgl_bastk = $request->tgl_bastk;
        $po->SelesaiSewa = $request->selesaisewa;
        $po->save();

        $report_database->MulaiSewa = $request->mulaisewa;
        // $report_database->MulaiSewa2 = $request->mulaisewa2;
        $report_database->Tgl_bastd = $request->tgl_bastd;
        $report_database->Tgl_bastk = $request->tgl_bastk;
        $report_database->SelesaiSewa = $request->selesaisewa;
        $report_database->save();
        
        return redirect('/backend/po/show/'.$id);
    }

// _______________________SERVICE____________________________

    public function show_service(Request $request,$id)
    {
        // $pkwt = pkwt::find($id);
        // $drivers = Driver::all();

        $services = Service::all()->sortBy('periode')->sortBy('TglService');
        $sss = Service::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $salons = salon::all()->sortBy('periode');
        $tpo = tpo::find($id);
        $tahun = 'All';
        return view('service/index',compact('services','tpo','salons','tahun','ss'));
    }


    public function show_service_filter($tpo,$periode)
    {
        // $pkwt = pkwt::find($id);
        // $drivers = Driver::all();
        $sss = Service::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $services = Service::where('periode',$periode)->where('po_id',$tpo)->get();
        $salons = salon::where('periode',$periode)->where('po_id',$tpo)->get();
        $tpo = tpo::find($tpo);
        $tahun = $periode;
        return view('service/index',compact('services','tpo','salons','tahun','ss'));
    }



    public function add_service(Request $request,$id)
    {
        $service = new Service;
        $report_service = new report_service;
        $request->validate([
            'po_id' => 'nullable',
            'periode' => 'required'
        ]);

        $po = tpo::find($request->po_id);

        $service->po_id = $request->po_id;
        $service->periode = $request->periode;
        $service->cabang_id = $po->Cabang_id;
        $service->mobil_id = $po->Mobil_id;
        $service->vendor_id = $po->Vendor_Driver;
        $service->driver_id = $po->Driver_id;

        $service->save();

        $cabang = Cabang::find($po->Cabang_id);
        $mobil = Mobil::find($po->Mobil_id);
        $vendor = Vendor::find($po->Vendor_Driver);

        if ($po->Driver_id != '') {
            $driver = Driver::find($po->Driver_id);
        }

        $report_service->periode = $request->periode;
        $report_service->service_id = $service->id;
        $report_service->Nopo = $po->NoPo;
        $report_service->Sewa = $po->Sewa;
        $report_service->CP = $po->CP;
        $report_service->Nopol = $po->Nopol;
        $report_service->KodeCabang = $cabang->KodeCabang;
        $report_service->NamaCabang = $cabang->NamaCabang;
        $report_service->InisialCabang = $cabang->InisialCabang;
        $report_service->CabangUtama = $cabang->CabangUtama;
        $report_service->StatusCabang = $cabang->StatusCabang;
        $report_service->KWL = $cabang->KWL;
        $report_service->Kota = $cabang->Kota;
        $report_service->KodeMobil = $mobil->KodeMobil;
        $report_service->MerekMobil = $mobil->MerekMobil;
        $report_service->Tahun = $mobil->Tahun;
        $report_service->Type = $mobil->Type;
        $report_service->NamaVendor = $vendor->NamaVendor;

        if ($po->Driver_id != '') {
            $report_service->nik = $driver->nik;
            $report_service->nip = $driver->nip;
            $report_service->NamaDriver = $driver->NamaDriver;
        }

        $report_service->save();

        return redirect('/backend/po/service/'.$id);
    }

    public function edit_service($id)
    {
        $service = Service::find($id);
        $salons = salon::all()->sortBy('periode');
        $tpo = tpo::find($id);
        return view('service/edit',compact('service','tpo','salons'));
    }

    public function edit_service_proses(Request $request,$id)
    {
        $service = Service::find($id);
        $report_service = report_service::where('service_id',$id)->first();
        $request->validate([
            'tgl_service' => 'nullable',
            'km' => 'nullable',
            'keterangan' => 'nullable'
        ]);

        $service->TglService = $request->tgl_service;
        $service->km = $request->km;
        $service->keterangan = $request->keterangan;

        $report_service->TglService = $request->tgl_service;
        $report_service->km = $request->km;
        $report_service->keterangan = $request->keterangan;

        $service->save();
        $report_service->save();

        return redirect('/backend/po/service/'.$request->get('po_id'));
    }
    

    public function add_tgl_service(Request $request)
    {
        $service = new Service;
        $report_service = new report_service;
        $request->validate([
            'po_id' => 'nullable',
            'periode' => 'nullable'
        ]);

        $service->po_id = $request->po_id;
        $service->periode = $request->periode;

        $service->save();

        $po = tpo::find($request->po_id);

        $cabang = Cabang::find($po->Cabang_id);
        $mobil = Mobil::find($po->Mobil_id);
        $vendor = Vendor::find($po->Vendor_Driver);
        if ($po->Driver_id != '') {
            $driver = Driver::find($po->Driver_id);
        }

        $report_service->periode = $request->periode;
        $report_service->service_id = $service->id;
        $report_service->Nopo = $po->NoPo;
        $report_service->Sewa = $po->Sewa;
        $report_service->CP = $po->CP;
        $report_service->Nopol = $po->Nopol;
        $report_service->KodeCabang = $cabang->KodeCabang;
        $report_service->NamaCabang = $cabang->NamaCabang;
        $report_service->InisialCabang = $cabang->InisialCabang;
        $report_service->CabangUtama = $cabang->CabangUtama;
        $report_service->StatusCabang = $cabang->StatusCabang;
        $report_service->KWL = $cabang->KWL;
        $report_service->Kota = $cabang->Kota;
        $report_service->KodeMobil = $mobil->KodeMobil;
        $report_service->MerekMobil = $mobil->MerekMobil;
        $report_service->Tahun = $mobil->Tahun;
        $report_service->Type = $mobil->Type;
        $report_service->NamaVendor = $vendor->NamaVendor;

        if ($po->Driver_id != '') {
            $report_service->nik = $driver->nik;
            $report_service->nip = $driver->nip;
            $report_service->NamaDriver = $driver->NamaDriver;
        }

        $report_service->save();

        return redirect('/backend/po/service/'.$request->po_id);
    }

    public function destroy_service($id)
    {
        $service = Service::find($id);

        if ($service->active == '1') {
            $service->active = '';
            $service->save();

            return redirect('/backend/service')->with('success','service berhasil direstore');
        }else{
            $service->active = '1';
            $service->save();

            return redirect('/backend/service')->with('success','service berhasil dihapus');
        }
    }

    public function check_tahun_service(Request $request)
    {
        if($request->get('tahun'))
        {
          $tahun = $request->get('tahun');
          $po_id = $request->get('po_id');
          $data = DB::table("services")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)
                   ->where('active','') 
                   ->count();

          $data2 = DB::table("services")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)     
                   ->where('active',null)  
                   ->count();

          if($data > 0 || $data2 > 0)
          {
            echo 'not_unique';
          }
          else
          {
            echo 'unique';
          }
         }
    }


// _______________________ SALON ____________________________

    public function add_salon(Request $request,$id)
    {
        $salon = new salon;
        $report_salon = new report_salon;
        $request->validate([
            'po_id' => 'nullable',
            'periode' => 'required|unique:salons'
        ]);

        $po = tpo::find($request->po_id);

        $salon->po_id = $request->po_id;
        $salon->periode = $request->periode;
        $salon->cabang_id = $po->Cabang_id;
        $salon->mobil_id = $po->Mobil_id;
        $salon->vendor_id = $po->Vendor_Driver;
        $salon->driver_id = $po->Driver_id;

        $salon->save();

        $cabang = Cabang::find($po->Cabang_id);
        $mobil = Mobil::find($po->Mobil_id);
        $vendor = Vendor::find($po->Vendor_Driver);

        if ($po->Driver_id != '') {
            $driver = Driver::find($po->Driver_id);
        }

        $report_salon->periode = $request->periode;
        $report_salon->salon_id = $salon->id;
        $report_salon->Nopo = $po->NoPo;
        $report_salon->Sewa = $po->Sewa;
        $report_salon->CP = $po->CP;
        $report_salon->Nopol = $po->Nopol;
        $report_salon->KodeCabang = $cabang->KodeCabang;
        $report_salon->NamaCabang = $cabang->NamaCabang;
        $report_salon->InisialCabang = $cabang->InisialCabang;
        $report_salon->CabangUtama = $cabang->CabangUtama;
        $report_salon->StatusCabang = $cabang->StatusCabang;
        $report_salon->KWL = $cabang->KWL;
        $report_salon->Kota = $cabang->Kota;
        $report_salon->KodeMobil = $mobil->KodeMobil;
        $report_salon->MerekMobil = $mobil->MerekMobil;
        $report_salon->Tahun = $mobil->Tahun;
        $report_salon->Type = $mobil->Type;
        $report_salon->NamaVendor = $vendor->NamaVendor;

        if ($po->Driver_id != '') {
            $report_salon->nik = $driver->nik;
            $report_salon->nip = $driver->nip;
            $report_salon->NamaDriver = $driver->NamaDriver;
        }

        $report_salon->save();

        return redirect('/backend/po/salon/'.$id);
    }

    public function show_salon(Request $request,$id)
    {
        // $pkwt = pkwt::find($id);
        // $drivers = Driver::all();

        $salons = salon::all()->sortBy('periode');
        $sss = salon::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $tpo = tpo::find($id);
        $tahun = 'All';
        return view('salon/index',compact('tpo','salons','tahun','ss'));
    }

    public function show_salon_filter($tpo,$periode)
    {
        // $pkwt = pkwt::find($id);
        // $drivers = Driver::all();
        $sss = salon::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $salons = salon::where('periode',$periode)->where('po_id',$tpo)->get();
        $tpo = tpo::find($tpo);
        $tahun = $periode;
        return view('salon/index',compact('tpo','salons','tahun','ss'));
    }

    public function edit_salon($id)
    {
        $salon = salon::find($id);
        $salons = salon::all()->sortBy('periode');
        $tpo = tpo::find($id);
        return view('salon/edit',compact('salon','tpo','salons'));
    }

    public function edit_salon_proses(Request $request,$id)
    {
        $salon = salon::find($id);
        $report_salon = report_salon::where('salon_id',$id)->first();
        $request->validate([
            'salon1' => 'nullable',
            'salon2' => 'nullable'
        ]);

        $salon->Salon1 = $request->salon1;
        $salon->Salon2 = $request->salon2;

        $report_salon->Salon1 = $request->salon1;
        $report_salon->Salon2 = $request->salon2;

        $salon->save();
        $report_salon->save();

        return redirect('/backend/po/salon/'.$request->get('po_id'));
    }

    public function check_tahun_salon(Request $request)
    {
        if($request->get('tahun'))
        {
          $tahun = $request->get('tahun');
          $po_id = $request->get('po_id');
          $data = DB::table("salons")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)     
                   ->where('active','')  
                   ->count();

          $data2 = DB::table("salons")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)     
                   ->where('active',null)  
                   ->count();

          if($data > 0 || $data2 > 0)
          {
            echo 'not_unique';
          }
          else
          {
            echo 'unique';
          }
         }
    }


// _______________________MCU____________________________


    public function add_mcu(Request $request,$id)
    {
        $mcu = new mcu;
        $report_mcu = new report_mcu;
        $request->validate([
            'tahun' => 'nullable',
            'po_id' => 'nullable'
        ]);

        $po = tpo::find($request->po_id);

        $mcu->periode = $request->tahun;
        $mcu->po_id = $request->po_id;
        $mcu->cabang_id = $po->Cabang_id;
        $mcu->mobil_id = $po->Mobil_id;
        $mcu->vendor_id = $po->Vendor_Driver;
        $mcu->driver_id = $po->Driver_id;

        $mcu->save();

        $cabang = Cabang::find($po->Cabang_id);
        $mobil = Mobil::find($po->Mobil_id);
        $vendor = Vendor::find($po->Vendor_Driver);

        if ($po->Driver_id != '') {
            $driver = Driver::find($po->Driver_id);
        }

        $report_mcu->periode = $request->tahun;
        $report_mcu->mcu_id = $mcu->id;
        $report_mcu->Nopo = $po->NoPo;
        $report_mcu->Sewa = $po->Sewa;
        $report_mcu->CP = $po->CP;
        $report_mcu->Nopol = $po->Nopol;
        $report_mcu->KodeCabang = $cabang->KodeCabang;
        $report_mcu->NamaCabang = $cabang->NamaCabang;
        $report_mcu->InisialCabang = $cabang->InisialCabang;
        $report_mcu->CabangUtama = $cabang->CabangUtama;
        $report_mcu->StatusCabang = $cabang->StatusCabang;
        $report_mcu->KWL = $cabang->KWL;
        $report_mcu->Kota = $cabang->Kota;
        $report_mcu->KodeMobil = $mobil->KodeMobil;
        $report_mcu->MerekMobil = $mobil->MerekMobil;
        $report_mcu->Tahun = $mobil->Tahun;
        $report_mcu->Type = $mobil->Type;
        $report_mcu->NamaVendor = $vendor->NamaVendor;

        if ($po->Driver_id != '') {
            $report_mcu->nik = $driver->nik;
            $report_mcu->nip = $driver->nip;
            $report_mcu->NamaDriver = $driver->NamaDriver;
        }

        $report_mcu->save();

        return redirect('/backend/po/mcu/'.$id);
    }

    public function show_mcu(Request $request,$id)
    {
        // $pkwt = pkwt::find($id);
        // $drivers = Driver::all();

        $mcus = mcu::all()->sortBy('periode');
        $sss = mcu::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $tpo = tpo::find($id);
        $tahun = 'All';
        return view('mcu/index',compact('mcus','tpo','ss','tahun'));
    }

    public function show_mcu_filter($tpo,$periode)
    {
        // $pkwt = pkwt::find($id);
        // $drivers = Driver::all();

        $sss = mcu::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $mcus = mcu::where('periode',$periode)->where('po_id',$tpo)->get();
        $tpo = tpo::find($tpo);
        $tahun = $periode;
        return view('mcu/index',compact('mcus','tpo','ss','tahun'));
    }

    public function edit_mcu($id)
    {
        $mcu = mcu::find($id);
        $tpo = tpo::find($id);
        return view('mcu/edit',compact('mcu','tpo'));
    }

    public function edit_mcu_proses(Request $request,$id)
    {
        $mcu = mcu::find($id);
        $report_mcu = report_mcu::where('mcu_id',$id)->first();
        $request->validate([
            'mcu' => 'nullable',
            'seragam' => 'nullable'
        ]);

        $mcu->mcu = $request->mcu;
        $mcu->Seragam = $request->seragam;

        $report_mcu->mcu = $request->mcu;
        $report_mcu->Seragam = $request->seragam;

        $mcu->save();
        $report_mcu->save();

        return redirect('/backend/po/mcu/'.$request->get('po_id'));
    }

    public function check_tahun_mcu_service(Request $request)
    {
        if($request->get('tahun'))
        {
          $tahun = $request->get('tahun');
          $po_id = $request->get('po_id');
          $data = DB::table("mcus")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)
                   ->where('active','')  
                   ->count();

          $data2 = DB::table("mcus")
                   ->where('periode', $tahun)
                   ->where('po_id', $po_id)     
                   ->where('active',null)  
                   ->count();

          if($data > 0 || $data2 > 0)
          {
            echo 'not_unique';
          }
          else
          {
            echo 'unique';
          }
         }
    }



// ________________________ USER __________________________

    public function index_user()
    {
        $users = User::all();
        return view('user/index',compact('users'));
    }


// ________________________USER PENGGUNA__________________________

    public function edit_userpengguna($id)
    {
        $po = tpo::find($id);
        return view('PO/edit/userpengguna',compact('po'));
    }

    public function edit_userpengguna_proses(Request $request)
    {
        $po = tpo::find($request->get('po_id'));
        $report_database = report_database::where('po_id',$request->get('po_id'))->first();
        $request->validate([
            'po_id' => 'required',
            'userpengguna' => 'nullable'
        ]);

        $po->UserPengguna = $request->userpengguna;
        $report_database->UserPengguna = $request->userpengguna;

        $report_database->save();
        $po->save();

        return redirect('/backend/po/show/'.$request->get('po_id'));
    }




// _________________________ AJAX _________________________
    public function kota_ajax($id,$vendor_id)
    {

        $ump_id = Cabang::where('id',$id)->pluck('Kota');

        $vendor = Vendor::where('id',$vendor_id)->pluck('KodeVendor');

        $harga_driver = harga_ump::where('Kota_id',$ump_id)->Where('Vendor_id',$vendor)->get();

        return response()->json($harga_driver);

    }

    public function kota_ajax_noid(Request $request)
    {

        $kota_id = $request->get('kota');
        
        $vendor_id = $request->get('vendor');

        $ump_id = Cabang::where('id',$kota_id)->pluck('Kota');

        $vendor = Vendor::where('id',$vendor_id)->pluck('KodeVendor');

        $harga_driver = harga_ump::where('Kota_id',$ump_id)->Where('Vendor_id',$vendor)->Where('activated','1')->get();

        return response()->json($harga_driver);

    }

    public function connect_po_ajax($id)
    {


        $po_id = tpo::where('id',$id)->pluck('Ump_id');

        $harga_driver = ump::where('id',$ump_id)->get();

       return response()->json($harga_driver);

    }

    public function nopol_ajax($id)
    {

        $po = tpo::where('Nopol',$id)->get();

       return response()->json($po);

    }

    public function nopol_filter_ajax(Request $request)
    {
        // if ($id == 0) {
        //     $pos = tpo::where('Nopol','null')->get();
        // }else{
        //     $pos = tpo::where('Nopol','!=','null')->get();
        // }

        $cabangs = Cabang::all();
        $mobils = Mobil::all();
        $umps = ump::all();
        $vendors = Vendor::all();
        $drivers = Driver::all();
        $pos = tpo::where('Nopol','null')->get();
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        return view('dashboard/index',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans'));

    }


    public function myprofile(Request $request)
    {
        $user = user::find(auth::user()->id);

        $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password == null) {
            # code...
        }else{
            $hash_password = Hash::make($request->password);
            $user->password = $hash_password;
        }
        

        $user->save();

        return redirect('/backend/dashboard')->with('success','Profil berhasil diupdate');
    }
}


