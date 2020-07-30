<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\Brand;
use File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produk = Produk::latest()->get();
        $kategori = Kategori::all();
        $brand = Brand::all();


        return view('client.produk.index',compact('produk','kategori','brand'));
    }

    public function showBrand(Brand $brand)
    {
        $produk = $brand->Produk()->get();
        $kategori = Kategori::select('id', 'kategori')->get();
        $brand = Brand::all();
         
         return view('client.produk.index', compact( 'produk', 'brand', 'kategori'));
         
    }

    public function showKategori(Kategori $kategori)
    {
        $produk = $kategori->Produk()->get();
        $kategori = Kategori::select('id', 'kategori')->get();
        $brand = Brand::all();
         
        return view('client.produk.index', compact( 'produk', 'brand', 'kategori'));
         
     }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $produk = Produk::find($id);
        return view('client.produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
