<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['periode','po_id','mobil_id','cabang_id','vendor_id','driver_id','TglService','km','Keterangan'];

    public function po()
    {
    	return $this->belongsTo('App\tpo','po_id','id');
    }

    public function cabang()
    {
        return $this->belongsTo('App\Cabang','cabang_id','id');
    }

    public function mobil()
    {
        return $this->belongsTo('App\Mobil','mobil_id','id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\vendor','vendor_id','id');
    }

    public function driver()
    {
    	return $this->belongsTo('App\driver','driver_id','id');
    }

}
