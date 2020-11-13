<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pkwt extends Model
{
	protected $fillable = ['driver_id','TanggalMasuk','pkwt1_start','pkwt1_end','pkwt2_start','pkwt2_end','DurasiJeda','PeriodeJeda_start','PeriodeJeda_end','Keterangan','status','active','created_at','updated_at'];
    
    public function driver()
    {
    	return $this->belongsTo('App\Driver','driver_id','id');
    }
}
