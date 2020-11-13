<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_template_perubahan extends Model
{
    //
    public function po()
    {
        return $this->belongsTo('App\tpo','po_id','id');
    }

    public function template()
    {
        return $this->belongsTo('App\template_perubahan','template_id','id');
    }
}
