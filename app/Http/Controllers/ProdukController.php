<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\Brand;
use File;
use Input;
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
        $produk = Produk::latest()->paginate(5);
        $kategori = Kategori::all();
        $brand = Brand::all();
        return view('admin.produk.index', compact('produk', 'kategori', 'brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brand = Brand::all();
        $kategori = Kategori::all();
        return view('admin.produk.create',compact('brand', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk'=> 'required',
            'kategori_id'=> 'required',
            'brand_id'=> 'required',
            'harga_sewa'=> 'required',
            'stok'=> 'required',
            'deskripsi'=> 'required',
            'spesifikasi'=> 'required',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);
     
        $foto = $request->file('foto');
        $nama_foto = time()."_".$foto->getClientOriginalName();
        $foto->move('img/produk',$nama_foto);
     
        Produk::create([
            'file' => $nama_foto,
            'keterangan' => $request->keterangan,
            'nama_produk' => $request->nama_produk,
            'merek' => $request->merek,
            'kategori_id' => $request->kategori_id,
            'brand_id' => $request->brand_id,
            'harga_sewa' => $request->harga_sewa,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'spesifikasi' => $request->spesifikasi,
            'foto' => $nama_foto
        ]);

        return redirect()->route('list-produk.index')->with('sukses', 'Data Produk Berhasil Ditambahkan');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        $brand = Brand::all();
        return view('admin.produk.edit',compact('produk','kategori','brand'));
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
        // dd($request->all());
        $this->validate($request, [
            'nama_produk'=> 'required',
            'kategori_id'=> 'required',
            'brand_id'=> 'required',
            'harga_sewa'=> 'required',
            'stok'=> 'required',
            'deskripsi'=> 'required',
            'spesifikasi'=> 'required'
        ]);

        $produk = Produk::find($id);
        $produk->update($request->all());
        // // update foto            
        if($request->hasFile('foto')){
            File::delete('img/produk/'.$produk->foto);
            $foto = $request->file('foto');
            $nama_foto = time()."_".$foto->getClientOriginalName();
            $foto->move('img/produk',$nama_foto);
            $produk->foto = $nama_foto;
            $produk->update();            
        }
        return redirect()->route('list-produk.index')->with('sukses', 'Data Berhasil Update');
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
        $produk = Produk::find($id);
        File::delete('img/produk/'.$produk->foto);
        
        $produk->delete();
        return redirect()->route('list-produk.index')->with('sukses','Data Produk Berhasil Dihapus');
    }
}
