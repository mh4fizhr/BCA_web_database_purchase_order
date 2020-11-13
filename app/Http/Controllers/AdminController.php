<?php

namespace App\Http\Controllers;

use App\Imports\PoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
use App\tahun_mobil;
use App\tahun;
use App\jkk;
use App\report_service;
use App\report_salon;
use App\report_mcu;
use App\report_driver;
use App\report_database;
use App\report_pkwt;
use App\cp;
use App\bbm;
use App\pejabat;
use App\jabatan;
use App\unitkerja;
use App\pks;
use App\addendum;
use App\template_relokasi;
use App\table_template_relokasi;
use App\template_pengurangan;
use App\table_template_pengurangan;
use App\template_perubahan;
use App\table_template_perubahan;
use App\filter_date;
use Hash;

class AdminController extends Controller
{
    public function index_po()
    {
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
            $pos = tpo::limit(100)->get()->sortByDesc('id');
        }
        $statuss = 'all';
        $nopos = Nopo::all();
        $pengurangans = Pengurangan::all();
        $history_drivers = historydriver::all()->sortByDesc('id');
        return view('admin/PO/index',compact('pos','cabangs','umps','vendors','drivers','mobils','nopos','pengurangans','statuss','history_drivers','filter_date'));
    }

    public function delete_po(Request $request)
    {
        $request->validate([
            'po.*' => 'nullable',
        ]);

        $po = $request->po;

        for($count = 0; $count < count($po); $count++)
            {

               $Po = tpo::find($po[$count]);
               $Po->delete();
               $historynopol = historynopol::where('po_id',$po[$count]);
               $historymobil = historymobil::where('po_id',$po[$count]);
               $timeline = timeline::where('po_id',$po[$count]);
               $historymobil->delete();
               $historynopol->delete();
               $timeline->delete();

             }
        return redirect('backend/admin/po')->with('success','PO berhasil dihapus dari database');

    }

    // _______________________DRIVER_________________________

    public function index_driver()
    {
        $drivers = Driver::all()->sortBy('NamaDriver');
        $vendors = Vendor::all();
        $pos = tpo::all();
        $pkwts = pkwt::all();
        $s = 'active';
        return view('admin/driver/index',compact('drivers','vendors','pos','pkwts','s'));
    }

    public function index_driver_status($status)
    {
        if ($status == 'deactive') {
            $active = 1;
        }else{
            $active = null;
        }
        $drivers = Driver::where('active',$active)->get()->sortBy('NamaDriver');
        $vendors = Vendor::all();
        $pos = tpo::all();
        $pkwts = pkwt::all();
        $s = $status;
        return view('admin/driver/index',compact('drivers','vendors','pos','pkwts','s'));
    }

    public function delete_driver(Request $request)
    {
        $request->validate([
            'driver.*' => 'nullable',
        ]);

        $driver = $request->driver;

        for($count = 0; $count < count($driver); $count++)
            {

               $Driver = Driver::find($driver[$count]);

               $Driver->delete();

             }

        return redirect('backend/admin/driver')->with('success','driver berhasil dihapus dari database');

    }

    // _______________________PKWT_________________________

    public function index_pkwt()
    {
        $pkwts = pkwt::all()->sortBy('driver_id');
        $drivers = Driver::all();
        return view('admin/pkwt/index',compact('pkwts','drivers'));
    }

    public function delete_pkwt(Request $request)
    {
        $request->validate([
            'pkwt.*' => 'nullable',
        ]);

        $pkwt = $request->pkwt;

        for($count = 0; $count < count($pkwt); $count++)

            {

               $Pkwt = pkwt::find($pkwt[$count]);

               $Pkwt->delete();
               
             }
        return redirect('backend/admin/pkwt')->with('success','pkwt berhasil dihapus dari database');
    }

    // _______________________CABANG_________________________

    public function index_cabang()
    {
        $umps = ump::all();
        $cabangs = Cabang::all();
        $kotas = kota::all()->sortBy('Kota');
        $unique = Cabang::all();
        $cabuts = $unique->unique('CabangUtama');
        $s = '';
        return view('admin/cabang/index',compact('cabangs','umps','kotas','cabuts','s'));
    }

    public function index_cabang_status($status)
    {
        if ($status == 'deactive') {
            $cabangs = cabang::where('active','1')->get();
        }else{
            $cabangs = cabang::where('active',null)->orwhere('active','')->get();
        }

        $umps = ump::all();  
        $kotas = kota::all()->sortBy('Kota');
        $unique = Cabang::all();
        $cabuts = $unique->unique('CabangUtama');
        $s = $status;
        return view('admin/cabang/index',compact('cabangs','umps','kotas','cabuts','s'));
    }

    public function delete_cabang(Request $request)
    {
        $request->validate([
            'cabang.*' => 'nullable',
        ]);

        $cabang = $request->cabang;

        for($count = 0; $count < count($cabang); $count++)
            {

               $Cabang = Cabang::find($cabang[$count]);

               $Cabang->delete();

             }

        return redirect('backend/admin/cabang')->with('success','cabang berhasil dihapus dari database');

    }

    // _______________________cp_________________________

    public function index_cp()
    {
        //
        $cps = cp::all()->sortBy('kota');
        $s = '';
        $kotas = kota::all()->sortBy('Kota');
        return view('admin/CP/index',compact('cps','s','kotas'));
    }

    public function index_cp_status($status)
    {
        //
        if ($status == 'deactive') {
            $cps = cp::where('active','1')->get();
        }else{
            $cps = cp::where('active',null)->orwhere('active','')->get();
        }
        
        $s = $status;
        $kotas = kota::all()->sortBy('Kota');
        return view('admin/CP/index',compact('cps','s','kotas'));
    }

    public function delete_cp(Request $request)
    {
        $request->validate([
            'cp.*' => 'nullable',
        ]);

        $cp = $request->cp;

        for($count = 0; $count < count($cp); $count++)
            {

               $Cp = cp::find($cp[$count]);

               $Cp->delete();

             }

        return redirect('backend/admin/cp')->with('success','carpooling berhasil dihapus dari database');

    }

    // _______________________MOBIL_________________________

    public function index_mobil()
    {
        $mobils = Mobil::paginate(50)->sortBy('Tahun');
        $s = '';
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        return view('admin/mobil/index',compact('mobils','s','tahuns'));
    }

    public function index_mobil_status($status)
    {
        if ($status == 'deactive') {
            $active = 1;
        }else{
            $active = null;
        }
        $mobils = Mobil::where('active',$active)->get()->sortBy('Tahun');
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        $s = $status;
        return view('admin/mobil/index',compact('mobils','s','tahuns'));
    }

    public function delete_mobil(Request $request)
    {
        $request->validate([
            'mobil.*' => 'nullable',
        ]);

        $mobil = $request->mobil;

        for($count = 0; $count < count($mobil); $count++)
            {

               $Mobil = Mobil::find($mobil[$count]);

               $Mobil->delete();

             }

        return redirect('backend/admin/mobil')->with('success','mobil berhasil dihapus dari database');

    }


    // _______________________TAHUN_________________________

    public function index_tahun_mobil()
    {
        $tahuns = tahun_mobil::all()->sortBy('Tahun');
        $s = '';
        return view('admin/tahun_mobil/index',compact('tahuns','s'));
    }

    public function delete_tahun_mobil(Request $request)
    {
        $request->validate([
            'tahun.*' => 'nullable',
        ]);

        $tahun = $request->tahun;

        for($count = 0; $count < count($tahun); $count++)
            {

               $Tahun = tahun_mobil::find($tahun[$count]);

               $Tahun->delete();

             }

        return redirect('backend/admin/tahun_mobil')->with('success','tahun berhasil dihapus dari database');

    }

    // _______________________bbm_________________________

    public function index_bbm()
    {
        //
        $bbms = bbm::all()->sortBy('kota');
        $s = '';
        return view('admin/bbm/index',compact('bbms','s'));
    }

    public function index_bbm_status($status)
    {
        //
        if ($status == 'deactive') {
            $bbms = bbm::where('active','1')->get();
        }else{
            $bbms = bbm::where('active',null)->orwhere('active','')->get();
        }
        $s = $status;
        return view('admin/bbm/index',compact('bbms','s'));
    }

    public function delete_bbm(Request $request)
    {
        $request->validate([
            'bbm.*' => 'nullable',
        ]);

        $bbm = $request->bbm;

        for($count = 0; $count < count($bbm); $count++)
            {

               $Bbm = bbm::find($bbm[$count]);

               $Bbm->delete();

             }

        return redirect('backend/admin/bbm')->with('success','bbm berhasil dihapus dari database');

    }

    // _______________________pejabat_________________________

    public function index_pejabat()
    {
        //
        $pejabats = pejabat::all()->sortBy('nama');
        $s = '';
        $jabatans = jabatan::all()->sortBy('jabatan');
        $unitkerjas = unitkerja::all()->sortBy('unitkerja');
        return view('admin/pejabat/index',compact('pejabats','s','jabatans','unitkerjas'));
    }

    public function index_pejabat_status($status)
    {
        //
        if ($status == 'deactive') {
            $pejabats = pejabat::where('active','1')->get();
        }else{
            $pejabats = pejabat::where('active',null)->orwhere('active','')->get();
        }
        
        $s = $status;
        return view('admin/pejabat/index',compact('pejabats','s'));
    }

    public function delete_pejabat(Request $request)
    {
        $request->validate([
            'pejabat.*' => 'nullable',
        ]);

        $pejabat = $request->pejabat;

        for($count = 0; $count < count($pejabat); $count++)
            {

               $Pejabat = pejabat::find($pejabat[$count]);

               $Pejabat->delete();

             }

        return redirect('backend/admin/pejabat')->with('success','pejabat berhasil dihapus dari database');

    }

    // _______________________jabatan_________________________

    public function index_jabatan()
    {
        //
        $jabatans = jabatan::all()->sortBy('jabatan');
        $s = '';
        return view('admin/jabatan/index',compact('jabatans','s'));
    }

    public function index_jabatan_status($status)
    {
        //
        if ($status == 'deactive') {
            $jabatans = jabatan::where('active','1')->get();
        }else{
            $jabatans = jabatan::where('active',null)->orwhere('active','')->get();
        }
        
        $s = $status;
        return view('admin/jabatan/index',compact('jabatans','s'));
    }

    public function delete_jabatan(Request $request)
    {
        $request->validate([
            'jabatan.*' => 'nullable',
        ]);

        $jabatan = $request->jabatan;

        for($count = 0; $count < count($jabatan); $count++)
            {

               $Jabatan = jabatan::find($jabatan[$count]);

               $Jabatan->delete();

             }

        return redirect('backend/admin/jabatan')->with('success','jabatan berhasil dihapus dari database');

    }

    // _______________________unitkerja_________________________

    public function index_unitkerja()
    {
        //
        $unitkerjas = unitkerja::all()->sortBy('unitkerja');
        $s = '';
        return view('admin/unitkerja/index',compact('unitkerjas','s'));
    }

    public function index_unitkerja_status($status)
    {
        //
        if ($status == 'deactive') {
            $unitkerjas = unitkerja::where('active','1')->get();
        }else{
            $unitkerjas = unitkerja::where('active',null)->orwhere('active','')->get();
        }
        
        $s = $status;
        return view('admin/unitkerja/index',compact('unitkerjas','s'));
    }

    public function delete_unitkerja(Request $request)
    {
        $request->validate([
            'unitkerja.*' => 'nullable',
        ]);

        $unitkerja = $request->unitkerja;

        for($count = 0; $count < count($unitkerja); $count++)
            {

               $Unitkerja = unitkerja::find($unitkerja[$count]);

               $Unitkerja->delete();

             }

        return redirect('backend/admin/unitkerja')->with('success','unit kerja berhasil dihapus dari database');

    }

    // _______________________pks_________________________

    public function index_pks()
    {
        //
        $pkss = pks::all()->sortByDesc('id');
        $s = '';
        $addendums = addendum::all()->sortByDesc('id');
        $vendors = Vendor::all()->sortByDesc('id');
        $vendor_uniques = $pkss->unique('vendor')->sortBy('vendor');
        return view('admin/pks/index',compact('pkss','s','addendums','vendors','vendor_uniques'));
    }

    public function index_pks_status($status)
    {
        //
        if ($status == 'deactive') {
            $pkss = pks::where('active','1')->get();
        }else{
            $pkss = pks::where('active',null)->orwhere('active','')->get();
        }
        
        $s = $status;
        $addendums = addendum::all()->sortByDesc('id');
        $vendors = Vendor::all()->sortByDesc('id');
        return view('admin/pks/index',compact('pkss','s','addendums','vendors'));
    }

    public function delete_pks(Request $request)
    {
        $request->validate([
            'pks.*' => 'nullable',
        ]);

        $pks = $request->pks;

        for($count = 0; $count < count($pks); $count++)
            {

               $Pks = pks::find($pks[$count]);

               $Pks->delete();

             }

        return redirect('backend/admin/pks')->with('success','pks berhasil dihapus dari database');

    }

    // _______________________addendum_________________________

    public function index_addendum()
    {
        //
        $addendums = addendum::all()->sortByDesc('id');
        $s = '';
        $pkss = pks::all()->sortByDesc('id');
        $vendors = Vendor::all()->sortByDesc('id');
        $vendor_uniques = $addendums->unique('vendor')->sortBy('vendor');
        return view('admin/addendum/index',compact('addendums','s','pkss','vendors','vendor_uniques'));
    }

    public function index_addendum_status($status)
    {
        //
        if ($status == 'deactive') {
            $addendums = addendum::where('active','1')->get();
        }else{
            $addendums = addendum::where('active',null)->orwhere('active','')->get();
        }
        
        $s = $status;
        $pkss = pks::all()->sortByDesc('id');
        $vendors = Vendor::all()->sortByDesc('id');
        return view('admin/addendum/index',compact('addendums','s','pkss','vendors'));
    }

    public function delete_addendum(Request $request)
    {
        $request->validate([
            'addendum.*' => 'nullable',
        ]);

        $addendum = $request->addendum;

        for($count = 0; $count < count($addendum); $count++)
            {

               $Addendum = addendum::find($addendum[$count]);

               $Addendum->delete();

             }

        return redirect('backend/admin/addendum')->with('success','addendum berhasil dihapus dari database');

    }

    // _______________________harga_ump_________________________

    public function index_harga_ump()
    {
        $harga_umps = harga_ump::all()->sortBy('Tahun_id');
        $kotas = kota::all()->sortBy('Kota');
        $tahuns = tahun::all()->sortBy('Tahun');
        $tahun_drops = tahun::all()->sortByDesc('Tahun');
        $vendors = Vendor::all()->sortBy('NamaVendor');
        $jkks = jkk::all()->sortBy('jkk');
        $s = 'active';
        return view('admin/harga_ump/index',compact('harga_umps','s','kotas','tahuns','vendors','jkks','s'));
    }

    public function delete_harga_ump(Request $request)
    {
        $request->validate([
            'harga_ump.*' => 'nullable',
        ]);

        $harga_ump = $request->harga_ump;

        for($count = 0; $count < count($harga_ump); $count++)
            {

               $Harga_ump = harga_ump::find($harga_ump[$count]);

               $Harga_ump->delete();

             }

        return redirect('backend/admin/harga_ump')->with('success','harga_ump berhasil dihapus dari database');

    }


    // _______________________JKK_________________________

    public function index_jkk()
    {
        $jkks = jkk::all()->sortBy('jkk');
        $s = 'active';
        return view('admin/jkk/index',compact('jkks','s'));
    }

    public function delete_jkk(Request $request)
    {
        $request->validate([
            'jkk.*' => 'nullable',
        ]);

        $jkk = $request->jkk;

        for($count = 0; $count < count($jkk); $count++)
            {

               $Jkk = jkk::find($jkk[$count]);

               $Jkk->delete();

             }

        return redirect('backend/admin/jkk')->with('success','jkk berhasil dihapus dari database');

    }

    // _______________________KOTA_________________________

    public function index_kota()
    {
        $kotas = kota::all()->sortBy('Kota');
        $s = 'active';
        return view('admin/kota/index',compact('kotas','s'));
    }

    public function delete_kota(Request $request)
    {
        $request->validate([
            'kota.*' => 'nullable',
        ]);

        $kota = $request->kota;

        for($count = 0; $count < count($kota); $count++)
            {

               $Kota = kota::find($kota[$count]);

               $Kota->delete();

             }

        return redirect('backend/admin/kota')->with('success','kota berhasil dihapus dari database');

    }

    // _______________________TAHUN_________________________

    public function index_tahun()
    {
        $tahuns = tahun::all()->sortBy('Tahun');
        $s = 'active';
        return view('admin/tahun/index',compact('tahuns','s'));
    }

    public function delete_tahun(Request $request)
    {
        $request->validate([
            'tahun.*' => 'nullable',
        ]);

        $tahun = $request->tahun;

        for($count = 0; $count < count($tahun); $count++)
            {

               $Tahun = tahun::find($tahun[$count]);

               $Tahun->delete();

             }

        return redirect('backend/admin/tahun')->with('success','tahun berhasil dihapus dari database');

    }

    // _______________________vendor_________________________

    public function index_vendor()
    {
        $vendors = vendor::all()->sortBy('NamaVendor');
        $s = 'active';
        return view('admin/vendor/index',compact('vendors','s'));
    }

    public function delete_vendor(Request $request)
    {
        $request->validate([
            'vendor.*' => 'nullable',
        ]);

        $vendor = $request->vendor;

        for($count = 0; $count < count($vendor); $count++)
            {

               $Vendor = Vendor::find($vendor[$count]);

               $Vendor->delete();

            }

        return redirect('backend/admin/vendor')->with('success','report database berhasil dihapus dari database');
    }

    // _______________________relokasi_________________________

    public function index_relokasi()
    {
        //
        $template_relokasis = template_relokasi::all()->sortByDesc('id');
        $vendor_uniques = $template_relokasis->unique('nama_vendor')->sortBy('nama_vendor');
        $table_template_relokasis = table_template_relokasi::all();
        $vendors = vendor::all()->sortBy('NamaVendor');
        return view('admin/surat/relokasi/index',compact('template_relokasis','table_template_relokasis','vendor_uniques','vendors'));
    }

    public function delete_relokasi(Request $request)
    {
        $request->validate([
            'relokasi.*' => 'nullable',
        ]);

        $relokasi = $request->relokasi;

        for($count = 0; $count < count($relokasi); $count++)
            {

               $Relokasi = template_relokasi::find($relokasi[$count]);
               $table_template_relokasi = table_template_relokasi::where('template_id',$relokasi->id);
               $Relokasi->delete();
               $table_template_relokasi->delete();

             }

        return redirect('backend/admin/surat/relokasi')->with('success','surat relokasi berhasil dihapus dari database');

    }

    // _______________________pengurangan_________________________

    public function index_pengurangan()
    {
             $template_pengurangans = template_pengurangan::all()->sortByDesc('id');
             $vendor_uniques = $template_pengurangans->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_pengurangans = table_template_pengurangan::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             return view('admin/surat/pengurangan/index',compact('template_pengurangans','table_template_pengurangans','vendor_uniques','vendors'));
    }   


    public function delete_pengurangan(Request $request)
    {
        $request->validate([
            'pengurangan.*' => 'nullable',
        ]);

        $pengurangan = $request->pengurangan;

        for($count = 0; $count < count($pengurangan); $count++)
            {

               $Pengurangan = template_pengurangan::find($pengurangan[$count]);
               $table_template_pengurangan = table_template_pengurangan::where('template_id',$Pengurangan->id);
               $Pengurangan->delete();
               $table_template_pengurangan->delete();

             }

        return redirect('backend/admin/surat/pengurangan')->with('success','surat cutoff berhasil dihapus dari database');

    }

    // _______________________perubahan_________________________

    public function index_perubahan()
    {
             $template_perubahans = template_perubahan::all()->sortByDesc('id');
             $vendor_uniques = $template_perubahans->unique('nama_vendor')->sortBy('nama_vendor');
             $table_template_perubahans = table_template_perubahan::all();
             $vendors = vendor::all()->sortBy('NamaVendor');
             return view('admin/surat/perubahan/index',compact('template_perubahans','table_template_perubahans','vendor_uniques','vendors'));
    }    


    public function delete_perubahan(Request $request)
    {
        $request->validate([
            'perubahan.*' => 'nullable',
        ]);

        $perubahan = $request->perubahan;

        for($count = 0; $count < count($perubahan); $count++)
            {

               $perubahan = template_perubahan::find($perubahan[$count]);
               $table_template_perubahan = table_template_perubahan::where('template_id',$perubahan->id);
               $perubahan->delete();
               $table_template_perubahan->delete();

             }

        return redirect('backend/admin/surat/perubahan')->with('success','surat perubahan berhasil dihapus dari database');

    }

    // _______________________report database_________________________

    public function index_report_database()
    {
        $report_databases = report_database::all()->sortBy('NoPo');
        $s = 'active';
        return view('admin/report_database/index',compact('report_databases','s'));
    }

    public function delete_report_database(Request $request)
    {
        $request->validate([
            'report_database.*' => 'nullable',
        ]);

        $report_database = $request->report_database;

        for($count = 0; $count < count($report_database); $count++)
            {

               $Report_database = report_database::find($report_database[$count]);

               $Report_database->delete();

            }

        return redirect('backend/admin/report_database')->with('success','report database berhasil dihapus dari database');
    }

    // _______________________report service_________________________

    public function index_report_service()
    {
        $report_services = report_service::all();
        $s = 'active';
        return view('admin/report_service/index',compact('report_services','s'));
    }

    public function delete_report_service(Request $request)
    {
        $request->validate([
            'report_service.*' => 'nullable',
        ]);

        $report_service = $request->report_service;

        for($count = 0; $count < count($report_service); $count++)
            {

               $Report_service = report_service::find($report_service[$count]);

               $Report_service->delete();

            }

        return redirect('backend/admin/report_service')->with('success','report service berhasil dihapus dari database');
    }

    // _______________________report salon_________________________

    public function index_report_salon()
    {
        $report_salons = report_salon::all();
        $s = 'active';
        return view('admin/report_salon/index',compact('report_salons','s'));
    }

    public function delete_report_salon(Request $request)
    {
        $request->validate([
            'report_salon.*' => 'nullable',
        ]);

        $report_salon = $request->report_salon;

        for($count = 0; $count < count($report_salon); $count++)
            {

               $Report_salon = report_salon::find($report_salon[$count]);

               $Report_salon->delete();

            }

        return redirect('backend/admin/report_salon')->with('success','report salon berhasil dihapus dari database');
    }

    // _______________________report driver_________________________

    public function index_report_driver()
    {
        $report_drivers = report_driver::all();
        $s = 'active';
        return view('admin/report_driver/index',compact('report_drivers','s'));
    }

    public function delete_report_driver(Request $request)
    {
        $request->validate([
            'report_driver.*' => 'nullable',
        ]);

        $report_driver = $request->report_driver;

        for($count = 0; $count < count($report_driver); $count++)
            {

               $Report_driver = report_driver::find($report_driver[$count]);

               $Report_driver->delete();

            }

        return redirect('backend/admin/report_driver')->with('success','report driver berhasil dihapus dari database');
    }

    // _______________________report mcu_________________________

    public function index_report_mcu()
    {
        $report_mcus = report_mcu::all();
        $s = 'active';
        return view('admin/report_mcu/index',compact('report_mcus','s'));
    }

    public function delete_report_mcu(Request $request)
    {
        $request->validate([
            'report_mcu.*' => 'nullable',
        ]);

        $report_mcu = $request->report_mcu;

        for($count = 0; $count < count($report_mcu); $count++)
            {

               $Report_mcu = report_mcu::find($report_mcu[$count]);

               $Report_mcu->delete();

            }

        return redirect('backend/admin/report_mcu')->with('success','report seragam & mcu berhasil dihapus dari database');
    }

    // _______________________user_________________________

    public function index_user()
    {
        $users = User::all()->sortBy('name');
        $s = 'active';
        return view('admin/user/index',compact('users','s'));
    }

    public function add_user(Request $request)
    {
        $user = new user();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $hash_password = Hash::make($request->get('password'));
        $user->password = $hash_password;
        $user->status = $request->get('status');

        $user->save();

        return redirect('/backend/admin/user')->with('success','User berhasil ditambahkan dari database');
    }

    public function delete_user(Request $request)
    {
        $request->validate([
            'user.*' => 'nullable',
        ]);

        $user = $request->user;

        for($count = 0; $count < count($user); $count++)
            {

               $User = User::find($user[$count]);

               $User->delete();

            }

        return redirect('/backend/admin/user')->with('success','User berhasil dihapus dari database');
    }
}
