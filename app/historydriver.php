<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historydriver extends Model
{
    //
    public function po()
    {
    	return $this->belongsTo('App\tpo','Po_id','id');
    }

    public function driver()
    {
        return $this->belongsTo('App\driver','Driver_id','id');
    }
}
