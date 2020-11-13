<?php

namespace App\Http\Controllers;

use App\Imports\PoImport;
use App\Imports\CabangImport;
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
use App\Exports\PoExport;
use App\Exports\CabangExport;
use App\Exports\service_export;
use App\Exports\salon_export;
use App\Exports\mcu_export;
use App\Exports\driver_export;
use App\Exports\database_export;
use App\Exports\pkwt_export;
use App\Exports\PkwtExport;

class ExportController extends Controller
{
    //
    public function cabang()
    {
    	return Excel::download(new CabangExport, 'cabang.xlsx');
    }

    public function service()
    {
    	return Excel::download(new service_export, 'report_service.xlsx');

    }

    public function salon()
    {
    	return Excel::download(new salon_export, 'report_salon.xlsx');
    	
    }

    public function mcu()
    {
    	return Excel::download(new mcu_export, 'report_mcu&seragam.xlsx');
    }

    public function driver()
    {
        return Excel::download(new driver_export, 'report_driver.xlsx');
    }

    public function database()
    {
        return Excel::download(new database_export, 'report_database.xlsx');
    }

    public function pkwt()
    {
        return Excel::download(new PkwtExport, 'report_pkwt.xlsx');
    }
}
