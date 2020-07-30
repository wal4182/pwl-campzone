<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brand = Brand::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($brand)
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

        return view('admin.brand.index', compact('brand'));
    }

    /**
     * Store/update resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Brand::updateOrCreate([
            'id' => $request->brand_id
        ],[
            'nama_brand' => $request->nama_brand,
            'slug' => $request->slug
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Brand Berhasil Disimpan.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
       
        $brand->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Brand Berhasil Dihapus.',
        ];
        return response()->json($response, 200);
    
    }
}
