<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tpo extends Model
{
    //
    protected $table = "tpos";

	protected $dates = ['MulaiSewa','SelesaiSewa','MulaiSewa2','SelesaiSewa2','Tgl_cutoff','Tgl_relokasi','Efisien_relokasi'];

    protected $fillable = ['Sewa','CP','Cabang_id','Ump_id','Mobil_id','Type','Nopol','Vendor_Mobil','Vendor_Driver','Driver_id','UserPengguna','NoPo','MulaiSewa','Tgl_bastk','Tgl_bastd','Tgl_relokasi','Efisien_relokasi','Cabang_relokasi','Tgl_cutoff','SelesaiSewa','HargaSewaMobil','Hargasewamobil_pengurangan','HargaSewaDriver2019','Hargasewadriver_relokasi','HargaSewaMobilDriver','status','Nopo_permanent','Sewa_sementara','Sewa_permanent','Cabang_permanent','bbm','jenis_bbm','NoRegister','user_id'];
                                                   
    protected $guarded = [];

    public function mcu()
    {
    	return $this->hasMany('App\mcu');
    }

    public function service()
    {
    	return $this->hasMany('App\Service');
    }

    public function salon()
    {
        return $this->hasMany('App\salon');
    }

    public function nopo()
    {
        return $this->belongsTo('App\Nopo');
    }

    public function mobil()
    {
        return $this->belongsTo('App\Mobil','Mobil_id','id');
    }

    public function cabang()
    {
        return $this->belongsTo('App\Cabang','Cabang_id','id');
    }

    public function cabang_relokasi()
    {
        return $this->belongsTo('App\Cabang','Cabang_relokasi','id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Driver','Driver_id','id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor','Vendor_Driver','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    
}
