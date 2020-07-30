<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use DataTables;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rekening=Rekening::all();
        if ($request->ajax()) {
            return Datatables::of($rekening)
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
        return view('admin.rekening.index',compact('rekening'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //dd($request->all());
        Rekening::updateOrCreate([
            'id' => $request->rekening_id
        ],[
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Rekening Berhasil Disimpan.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekening $rekening
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening $rekening)
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
        $rekening = Rekening::find($id);
        return response()->json($rekening);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        $response = [
            'success' => true,
            'message' => 'Rekening Berhasil Dihapus',
        ];
        return response()->json($response, 200);
    }
}
