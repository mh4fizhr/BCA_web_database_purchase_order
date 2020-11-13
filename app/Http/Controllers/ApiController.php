<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tpo;
use App\Driver;
use App\Mobil;
use App\pkwt;
use App\Service;
use App\mcu;
use App\ump; 
use App\User;
use App\kota;

class ApiController extends Controller
{

    public function update_po(Request $request,$id) 
    {
                    
        // get database row id
        $pk = $request->input('pk');

        // get column name
        $col = $request->input('name');

        // get new value
        $value = $request->input('value');

        // get id row of line item and edit/save
        if ($finditem = tpo::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }

    }
    public function update_tgl_po(Request $request,$id) 
    {
                    
        // get database row id
        $pk = $request->input('pk');

        // get column name
        $col = $request->input('name');

        // get new value
        $value = $request->input('value');

        // get id row of line item and edit/save
        if ($finditem = tpo::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }

	}

    public function update_driver(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = Driver::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_mobil(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = Mobil::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_pkwt(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = pkwt::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_service(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = Service::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_mcu(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = mcu::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_ump(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = ump::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_user(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = User::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }

    public function update_kota(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = kota::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }
    

    public function update_jkk(Request $request,$id) 
    {              
        $pk = $request->input('pk');
        $col = $request->input('name');
        $value = $request->input('value');
        if ($finditem = jkk::where('id', $pk)->update([$col => $value]))
        {
            return \Response::json(array('status' => 1));
        }
        else
        {
            return \Response::json(array('status' => 0));
        }
    }
}
