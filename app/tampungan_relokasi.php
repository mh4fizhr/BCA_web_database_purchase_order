<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tampungan_relokasi extends Model
{
    //

    public function po()
    {
        return $this->belongsTo('App\tpo','po_id','id');
    }
}
