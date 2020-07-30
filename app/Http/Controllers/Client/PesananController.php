<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Pesanan;
use App\PesananDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      $pesanan = Pesanan::where('user_id', Auth::user()->id)->whereNotNull('bukti_pembayaran')->orderBy('tanggal','desc')->get();
      if(!empty($pesanan))
      {
          return view('client.pesanan', compact('pesanan'));
      }else
      return view('client.pesanan');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan_detail = PesananDetail::where('pesanan_id',$id)->get();
        return view('client.pesanan_detail', compact('pesanan_detail'));
    }
}
