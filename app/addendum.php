<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class addendum extends Model
{
    //
    public function pks()
    {
        return $this->belongsTo('App\pks','pks_id','id');
    }
}
