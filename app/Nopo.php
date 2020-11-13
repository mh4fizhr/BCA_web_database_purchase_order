<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nopo extends Model
{
    //
    public function po()
    {
        return $this->hasMany('App\tpo');
    }
}
