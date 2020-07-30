<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $guarded = ['id'];
    public function produk ()
    {
        return $this->hasMany('App\Produk');
    }


    public function getRouteKeyName()
    {
        return 'kategori';
    }
}
