<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_template_relokasi extends Model
{
    //
    public function po()
    {
        return $this->belongsTo('App\tpo','po_id','id');
    }

    public function template()
    {
        return $this->belongsTo('App\template_relokasi','template_id','id');
    }
}
