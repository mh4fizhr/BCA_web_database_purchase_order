<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class harga_ump extends Model
{
    //
    protected $fillable = ['Kota_id','Tahun_id','Jkk_id','Vendor_id','Harga_include','Harga_eksclude','active','created_by'];
} 	
