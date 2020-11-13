<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relokasi extends Model
{
    //
    protected $dates = ['Efisien_relokasi'];

    public function cabang_lama()
    {
        return $this->belongsTo('App\Cabang','Cabang_id_lama','id');
    }

    public function cabang_baru()
    {
        return $this->belongsTo('App\Cabang','Cabang_id','id');
    }
}
