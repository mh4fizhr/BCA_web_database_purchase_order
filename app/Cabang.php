<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    //
    protected $fillable = ['KodeCabang','NamaCabang','InisialCabang','CabangUtama','StatusCabang','KWL','Kota','Ump_id','active'];

    public function po()
    {
    	return $this->hasMany('App\tpo');
    }
}
