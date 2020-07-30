<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama_produk','kategori_id','brand_id','harga_sewa','stok','deskripsi','spesifikasi','foto'];

    public function kategori() 
    {
        return $this->belongsTo('App\Kategori');
        
        // return $this->hasOne('App\Kategori');
    }

     public function brand() 
    {
        return $this->belongsTo('App\Brand');
        
        // return $this->hasOne('App\BRAND');
    }

    public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail');
    }

}