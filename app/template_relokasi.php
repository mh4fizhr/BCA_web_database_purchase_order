<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class template_relokasi extends Model
{
    //
    protected $table = "template_relokasis";
    protected $fillable = ['template_id','po_id','merek','nopol','status_cabang_lama','nama_cabang_lama','kode_cabang_lama','status_cabang_baru','nama_cabang_baru','kode_cabang_baru','tgl_efektif','created_at','updated_at'];

}
