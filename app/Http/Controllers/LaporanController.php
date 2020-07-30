<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\PesananDetail;
use App\User;
use DB;
class LaporanController extends Controller
{
    //
    public function index()
    {
        $pesanan_selesai = Pesanan::where([
            'status_pembayaran' => 1,
            'status_pengambilan' => 1,
            'status_pengembalian' => 1
        ])->get();
        
        $pesanan_detail = PesananDetail::all();

        $users = User::all();
        
        return view('admin.laporan.index',compact('pesanan_selesai','pesanan_detail','users'));
    }
}
