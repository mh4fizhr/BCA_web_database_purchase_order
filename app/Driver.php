<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['nik','nip','NamaDriver','vendor_id','active'];

    public function pkwt()
    {
    	return $this->hasMany('App\pkwt');
    }
}
