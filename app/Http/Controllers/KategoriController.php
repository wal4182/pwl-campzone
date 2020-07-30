<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategori_produk=Kategori::all();
        if ($request->ajax()) {
            return Datatables::of($kategori_produk)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                   $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                            $btn .= '&nbsp;&nbsp;';
                            $btn .= '<button type="button" name="delete" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</button>';     
                            return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kategori.index',compact('kategori_produk'));
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
        Kategori::updateOrCreate([
            'id' => $request->kategori_id
        ],[
            'kategori' => $request->kategori
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Kategori Berhasil Disimpan.',
        ];
        return response()->json($response, 200);
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
        //
        $kategori_produk = Kategori::find($id);
        return response()->json($kategori_produk);
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
     * @param  \App\Kategori $kategori_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori_produk)
    {
        //
        $kategori_produk->delete();

        $response = [
            'success' => true,
            'message' => 'Kategori Berhasil Dihapus.',
        ];
        return response()->json($response, 200);
    }
}
