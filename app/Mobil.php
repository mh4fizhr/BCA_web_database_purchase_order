<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    //
    protected $fillable = ['id','KodeMobil','MerekMobil','Tahun','Type','active'];

    // public function po()
    // {
    //     return $this->hasMany('App\tpo','Mobil_id','id');
    // }
}
