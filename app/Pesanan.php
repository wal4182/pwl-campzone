<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['bukti_pembayaran','status_pembayaran','status_pengembalian',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail');
    }
}