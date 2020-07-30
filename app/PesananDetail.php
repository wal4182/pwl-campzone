<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $table = 'pesanan_detail';

    public function produk() 
    {
    	return $this->belongsTo('App\Produk');
    }

    public function pesanan() 
    {
    	return $this->belongsTo('App\Pesanan');
    }
    
}