<?php

namespace App\Http\Controllers;

use App\Imports\PoImport;
use App\Imports\SalonImport;
use App\Imports\ServiceImport;
use App\Imports\McuImport;
use App\Imports\PkwtImport;
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
use App\salon;
use App\Service;
use App\mcu;
use App\User;
use App\Nopo;
use App\Relokasi;
use App\Pengurangan;
use App\harga_ump;
use App\kota;
use App\historydriver;
use App\report_service;
use App\report_salon;
use App\report_mcu;
use App\report_driver;
use App\report_database;
use App\report_pkwt;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $po = tpo::where('status','1')->count();
        $po_date = tpo::where('status','1')->latest()->first();

        $salon = salon::where('active',null)->orwhere('active','')->count();
        $salon_date = salon::where('active',null)->orwhere('active','')->latest()->first();

        $service = service::where('active',null)->orwhere('active','')->count();
        $service_date = service::where('active',null)->orwhere('active','')->latest()->first();

        $mcu = mcu::where('active',null)->orwhere('active','')->count();
        $mcu_date = mcu::where('active',null)->orwhere('active','')->latest()->first();

        $driver = historydriver::all()->count();
        $driver_date = historydriver::all()->sortByDesc('Driver_id')->first();

        $pkwt = pkwt::where('active',null)->orwhere('active','')->count();
        $pkwt_date = pkwt::where('active',null)->orwhere('active','')->latest()->first();
        return view('report/all',compact('po','salon','service','mcu','driver','po_date','salon_date','service_date','mcu_date','driver_date','pkwt','pkwt_date'));
    }

    public function index_service()
    {
        $services = Service::all()->sortBy('periode');
        $r_services = report_service::all()->sortBy('periode');
        $sss = report_service::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $pos = tpo::all();
        $tahun = 'All';
        return view('report/service',compact('services','pos','ss','tahun','r_services'));
    }

    public function index_service_filter($periode)
    {
        
        $services = Service::where('periode',$periode)->get()->sortBy('TglService');
        $r_services = report_service::where('periode',$periode)->get()->sortBy('TglService');
        $sss = report_service::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $pos = tpo::all();
        $tahun = $periode;
        return view('report/service',compact('services','pos','ss','tahun','periode','r_services'));
    }


    public function edit_service($id)
    {
        $service = report_service::find($id);
        $pos = tpo::all();
        return view('report/edit_service',compact('service','pos'));
    }


    public function edit_proses_service(Request $request,$id)
    {   
        $r_service = report_service::find($id); 
        $service = Service::where('id',$r_service->service_id)->first();
        $request->validate([
            'km' => 'nullable',
            'tgl_service' => 'nullable',
            'keteragan' => 'nullable'
        ]);

        $r_service->TglService = $request->tgl_service;
        $r_service->km = $request->km;
        $r_service->Keterangan = $request->keterangan;

        $service->TglService = $request->tgl_service;
        $service->km = $request->km;
        $service->Keterangan = $request->keterangan;

        $service->save();
        $r_service->save();

        return redirect('backend/report/service');
    }

    public function destroy_service($id)
    {
        $service = Service::find($id);

        if ($service->active == '1') {
            $service->active = '';
            $service->save();

            return redirect('/backend/report/service')->with('success','service berhasil direstore');
        }else{
            $service->active = '1';
            $service->save();

            return redirect('/backend/po/service/'.$service->po_id)->with('success','service berhasil dihapus');
        }

    }

    public function destroy_service_report($id)
    {
        $service = Service::find($id);

        if ($service->active == '1') {
            $service->active = '';
            $service->save();

            return redirect('/backend/report/service')->with('success','service berhasil direstore');
        }else{
            $service->active = '1';
            $service->save();

            return redirect('/backend/report/service/')->with('success','service berhasil dihapus');
        }

    }

    //_________________________________________________________

    public function index_salon()
    {
        $salons = salon::all()->sortBy('periode');
        $r_salons = report_salon::all()->sortBy('periode');
        $sss = report_salon::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $pos = tpo::all();
        $tahun = 'All';
        return view('report/salon',compact('salons','pos','ss','tahun','r_salons'));
    }

    public function index_salon_filter($periode)
    {
        
        $salons = salon::where('periode',$periode)->get();
        $r_salons = report_salon::where('periode',$periode)->get();
        $sss = report_salon::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $pos = tpo::all();
        $tahun = $periode;
        return view('report/salon',compact('salons','pos','ss','tahun','periode','r_salons'));
    }

    public function edit_salon($id)
    {
        $salon = report_salon::find($id);
        $pos = tpo::all();
        return view('report/edit_salon',compact('salon','pos'));
    }


    public function edit_proses_salon(Request $request,$id)
    {
        $r_salon = report_salon::find($id);
        $salon = salon::where('id',$r_salon->salon_id)->first();
        $request->validate([
            'salon1' => 'nullable',
            'salon2' => 'nullable'
        ]);

        $salon->Salon1 = $request->salon1;
        $salon->Salon2 = $request->salon2;

        $r_salon->Salon1 = $request->salon1;
        $r_salon->Salon2 = $request->salon2;

        $salon->save();
        $r_salon->save();

        return redirect('backend/report/salon');
    }

    public function destroy_salon($id)
    {
        $salon = salon::find($id);

        if ($salon->active == '1') {
            $salon->active = '';
            $salon->save();

            return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
        }else{
            $salon->active = '1';
            $salon->save();

            return redirect('/backend/po/salon/'.$salon->po_id)->with('success','salon berhasil dihapus');
        }

    }

    public function destroy_salon_report($id)
    {
        $salon = salon::find($id);

        if ($salon->active == '1') {
            $salon->active = '';
            $salon->save();

            return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
        }else{
            $salon->active = '1';
            $salon->save();

            return redirect('/backend/report/salon/')->with('success','salon berhasil dihapus');
        }

    }


    //_________________________________________________________


    public function index_mcu()
    {
        $mcus = mcu::all()->sortBy('periode');
        $r_mcus = report_mcu::all()->sortBy('periode');
        $sss = report_mcu::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $pos = tpo::all();
        $tahun = 'All';
        return view('report/mcu',compact('mcus','pos','ss','tahun','r_mcus'));
    }

    public function index_mcu_filter($periode)
    {
        $mcus = mcu::where('periode',$periode)->get();
        $r_mcus = report_mcu::where('periode',$periode)->get();
        $sss = report_mcu::all()->sortBy('periode');
        $ss = $sss->unique('periode');
        $pos = tpo::all();
        $tahun = $periode;
        return view('report/mcu',compact('mcus','pos','ss','tahun','periode','r_mcus'));
    }

    public function edit_mcu($id)
    {
        $mcu = report_mcu::find($id);
        $pos = tpo::all();
        return view('report/edit_mcu',compact('mcu','pos'));
    }

    public function edit_proses_mcu(Request $request,$id)
    {
        $r_mcu = report_mcu::find($id);
        $mcu = mcu::where('id',$r_mcu->mcu_id)->first();
        $request->validate([
            'mcu' => 'nullable',
            'seragam' => 'nullable'
        ]);

        $mcu->mcu = $request->mcu;
        $mcu->Seragam = $request->seragam;

        $r_mcu->mcu = $request->mcu;
        $r_mcu->Seragam = $request->seragam;

        $mcu->save();
        $r_mcu->save();

        return redirect('backend/report/mcu');
    }

    public function destroy_mcu($id)
    {
        $mcu = mcu::find($id);

        if ($mcu->active == '1') {
            $mcu->active = '';
            $mcu->save();


            return redirect('/backend/report/mcu')->with('success','mcu berhasil direstore');
        }else{
            $mcu->active = '1';
            $mcu->save();

            return redirect('/backend/po/mcu/'.$mcu->po_id)->with('success','mcu berhasil dihapus');
        }

    }

    
        //_________________________________________________________

    public function index_driver()
    {
        $r_drivers = report_driver::all()->sortBy('NamaDriver');
        $sss = report_driver::all()->sortBy('NamaDriver');
        $ss = $sss->unique('NamaDriver');
        $driver = 'All';
        return view('report/driver',compact('ss','tahun','r_drivers','driver'));
    }

    public function index_driver_filter($namadriver)
    {
        
        $drivers = report_driver::where('NamaDriver',$namadriver)->get();
        $r_drivers = report_driver::where('NamaDriver',$namadriver)->get();
        $sss = report_driver::all()->sortBy('NamaDriver');
        $ss = $sss->unique('NamaDriver');
        $pos = tpo::all();
        $driver = $namadriver;
        return view('report/driver',compact('salons','pos','ss','driver','periode','r_salons','r_drivers'));
    }

    // public function edit_salon($id)
    // {
    //     $salon = report_salon::find($id);
    //     $pos = tpo::all();
    //     return view('report/edit_salon',compact('salon','pos'));
    // }


    // public function edit_proses_salon(Request $request,$id)
    // {
    //     $r_salon = report_salon::find($id);
    //     $salon = salon::where('id',$r_salon->salon_id)->first();
    //     $request->validate([
    //         'salon1' => 'nullable',
    //         'salon2' => 'nullable'
    //     ]);

    //     $salon->Salon1 = $request->salon1;
    //     $salon->Salon2 = $request->salon2;

    //     $r_salon->Salon1 = $request->salon1;
    //     $r_salon->Salon2 = $request->salon2;

    //     $salon->save();
    //     $r_salon->save();

    //     return redirect('backend/report/salon');
    // }

    // public function destroy_salon($id)
    // {
    //     $salon = salon::find($id);

    //     if ($salon->active == '1') {
    //         $salon->active = '';
    //         $salon->save();

    //         return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
    //     }else{
    //         $salon->active = '1';
    //         $salon->save();

    //         return redirect('/backend/po/salon/'.$salon->po_id)->with('success','salon berhasil dihapus');
    //     }

    // }

    // public function destroy_salon_report($id)
    // {
    //     $salon = salon::find($id);

    //     if ($salon->active == '1') {
    //         $salon->active = '';
    //         $salon->save();

    //         return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
    //     }else{
    //         $salon->active = '1';
    //         $salon->save();

    //         return redirect('/backend/report/salon/')->with('success','salon berhasil dihapus');
    //     }

    // }


        //_________________________________________________________

    public function index_pkwt()
    {
        $r_pkwts = report_pkwt::all()->sortBy('NamaDriver');
        $sss = report_pkwt::all()->sortBy('NamaDriver');
        $ss = $sss->unique('NamaDriver');
        $driver = 'All';
        return view('report/pkwt',compact('ss','tahun','r_pkwts','driver'));
    }

    public function index_pkwt_filter($namadriver)
    {
        
        $pkwts = report_pkwt::where('NamaDriver',$namadriver)->get();
        $r_pkwts = report_pkwt::where('NamaDriver',$namadriver)->get();
        $sss = report_pkwt::all()->sortBy('NamaDriver');
        $ss = $sss->unique('NamaDriver');
        $pos = tpo::all();
        $driver = $namadriver;
        return view('report/pkwt',compact('ss','driver','r_pkwts'));
    }

    // public function edit_salon($id)
    // {
    //     $salon = report_salon::find($id);
    //     $pos = tpo::all();
    //     return view('report/edit_salon',compact('salon','pos'));
    // }


    // public function edit_proses_salon(Request $request,$id)
    // {
    //     $r_salon = report_salon::find($id);
    //     $salon = salon::where('id',$r_salon->salon_id)->first();
    //     $request->validate([
    //         'salon1' => 'nullable',
    //         'salon2' => 'nullable'
    //     ]);

    //     $salon->Salon1 = $request->salon1;
    //     $salon->Salon2 = $request->salon2;

    //     $r_salon->Salon1 = $request->salon1;
    //     $r_salon->Salon2 = $request->salon2;

    //     $salon->save();
    //     $r_salon->save();

    //     return redirect('backend/report/salon');
    // }

    // public function destroy_salon($id)
    // {
    //     $salon = salon::find($id);

    //     if ($salon->active == '1') {
    //         $salon->active = '';
    //         $salon->save();

    //         return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
    //     }else{
    //         $salon->active = '1';
    //         $salon->save();

    //         return redirect('/backend/po/salon/'.$salon->po_id)->with('success','salon berhasil dihapus');
    //     }

    // }

    // public function destroy_salon_report($id)
    // {
    //     $salon = salon::find($id);

    //     if ($salon->active == '1') {
    //         $salon->active = '';
    //         $salon->save();

    //         return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
    //     }else{
    //         $salon->active = '1';
    //         $salon->save();

    //         return redirect('/backend/report/salon/')->with('success','salon berhasil dihapus');
    //     }

    // }

            //_________________________________________________________

    public function index_database()
    {
        $r_databases = report_database::all()->sortByDesc('po_id');
        $sss = report_database::all()->sortByDesc('po_id');
        $ss = $sss->unique('Nopo');
        $database = 'All';
        return view('report/database',compact('ss','r_databases','database'));
    }

    // public function index_driver_filter($namadriver)
    // {
        
    //     $drivers = report_driver::where('NamaDriver',$namadriver)->get();
    //     $r_drivers = report_driver::where('NamaDriver',$namadriver)->get();
    //     $sss = report_driver::all()->sortBy('NamaDriver');
    //     $ss = $sss->unique('NamaDriver');
    //     $pos = tpo::all();
    //     $driver = $namadriver;
    //     return view('report/driver',compact('salons','pos','ss','driver','periode','r_salons','r_drivers'));
    // }

    // public function edit_salon($id)
    // {
    //     $salon = report_salon::find($id);
    //     $pos = tpo::all();
    //     return view('report/edit_salon',compact('salon','pos'));
    // }


    // public function edit_proses_salon(Request $request,$id)
    // {
    //     $r_salon = report_salon::find($id);
    //     $salon = salon::where('id',$r_salon->salon_id)->first();
    //     $request->validate([
    //         'salon1' => 'nullable',
    //         'salon2' => 'nullable'
    //     ]);

    //     $salon->Salon1 = $request->salon1;
    //     $salon->Salon2 = $request->salon2;

    //     $r_salon->Salon1 = $request->salon1;
    //     $r_salon->Salon2 = $request->salon2;

    //     $salon->save();
    //     $r_salon->save();

    //     return redirect('backend/report/salon');
    // }

    // public function destroy_salon($id)
    // {
    //     $salon = salon::find($id);

    //     if ($salon->active == '1') {
    //         $salon->active = '';
    //         $salon->save();

    //         return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
    //     }else{
    //         $salon->active = '1';
    //         $salon->save();

    //         return redirect('/backend/po/salon/'.$salon->po_id)->with('success','salon berhasil dihapus');
    //     }

    // }

    // public function destroy_salon_report($id)
    // {
    //     $salon = salon::find($id);

    //     if ($salon->active == '1') {
    //         $salon->active = '';
    //         $salon->save();

    //         return redirect('/backend/report/salon')->with('success','salon berhasil direstore');
    //     }else{
    //         $salon->active = '1';
    //         $salon->save();

    //         return redirect('/backend/report/salon/')->with('success','salon berhasil dihapus');
    //     }

    // }

    public function import_excel_salon(Request $request) 
    {

        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file'); //GET FILE
            salon::truncate();
            Excel::import(new SalonImport, $file); //IMPORT FILE 
            return redirect('/backend/report/all')->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function import_excel_service(Request $request) 
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Service::truncate();
            Excel::import(new ServiceImport, $file); //IMPORT FILE 
            return redirect('/backend/report/all')->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function import_excel_mcu(Request $request) 
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            mcu::truncate();
            Excel::import(new McuImport, $file); //IMPORT FILE 
            return redirect('/backend/report/all')->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function import_excel_pkwt(Request $request) 
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            pkwt::truncate();
            Excel::import(new PkwtImport, $file); //IMPORT FILE 
            return redirect('/backend/report/all')->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

}
