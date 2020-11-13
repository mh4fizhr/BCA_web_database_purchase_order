<?php

namespace App\Http\Controllers;

use App\Imports\PoImport;
use App\Imports\CabangImport;
use App\Imports\MobilImport;
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

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_backup()
    {
        //
        return view('backuprestore/backup');
    }

    public function export_po()
    {
        return Excel::download(new PoExport, 'po.xlsx');
    }

    public function export_cabang()
    {
        return Excel::download(new CabangExport, 'cabang.xlsx');
    }

    public function export_mobil()
    {
        return Excel::download(new MobilExport, 'mobil.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
