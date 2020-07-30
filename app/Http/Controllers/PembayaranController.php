<?php

namespace App\Http\Controllers;
use App\Pesanan;
use Auth;
use App\User;
use App\Rekening;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if(empty($user->alamat))
        {
            return redirect('profil')->with('gagal', 'Harap Lengkapi profil');
        }
        
        if(empty($user->hp))
        {
            return redirect('profil')->with('gagal', 'Harap Lengkapi profil');
        }

        if(empty($user->no_ktp))
        {
            return redirect('profil')->with('gagal', 'Harap Lengkapi profil');
        }
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();
        $rekening = Rekening::all();

        return view('client.pembayaran', compact('pesanan','rekening'));
        
    }
    public function uploadBukti(Request $request)
    {

        $user = User::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();

        if($request->hasFile('bukti_pembayaran')){
            $request->file('bukti_pembayaran')->move('img/pembayaran',time()."_".$request->file('bukti_pembayaran')->getClientOriginalName());
            $pesanan->bukti_pembayaran = time()."_".$request->file('bukti_pembayaran')->getClientOriginalName();
            $pesanan->save();
        }
        return redirect('pembayaran')->with('sukses', 'Upload Berhasil');
    }
}
