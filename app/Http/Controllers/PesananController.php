<?php

namespace App\Http\Controllers;
use App\Pesanan;
use App\User;
use App\PesananDetail;
use Illuminate\Http\Request;
use Auth;

class PesananController extends Controller
{
    public function index()
    {

        $user = User::all();
        // $pesanan = Pesanan::orderBy('tanggal','desc')->get();
        $pesanan = Pesanan::latest()->paginate(10);
        return view('admin.pesanan', compact('pesanan'));
    }

    public function client()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->orderBy('tanggal','desc')->get();
        if(!empty($pesanan))
        {
            return view('client.pesanan', compact('pesanan'));
        }else
        return view('client.pesanan');
    }

    public function konfirmasiPembayaran(Request $request, $id)
    {
       //dd($request->all());
        $pesanan = Pesanan::where('id',$request->id)->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);
        
        return redirect('admin/pesanan')->with('sukses', 'Berhasil');
    }
    
    public function batalKonfirmasiPembayaran(Request $request, $id)
    {
       //dd($request->all());
        $pesanan = Pesanan::where('id',$request->id)->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('admin/pesanan');
    }

    public function konfirmasiPengambilan(Request $request, $id)
    {
       //dd($request->all());
        $pesanan = Pesanan::where('id',$request->id)->update([
            'status_pengambilan' => $request->status_pengambilan
        ]);
        
        return redirect('admin/pesanan')->with('sukses', 'Berhasil');
    }
    public function batalKonfirmasiPengambilan(Request $request, $id)
    {
       //dd($request->all());
        $pesanan = Pesanan::where('id',$request->id)->update([
            'status_pengambilan' => $request->status_pengambilan
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('admin/pesanan');
    }

    
    public function konfirmasiPengembalian(Request $request, $id)
    {
        //dd($request->all());
        $pesanan = Pesanan::where('id',$request->id)->update([
            'status_pengembalian' => $request->status_pengembalian
        ]);
        
        return redirect('admin/pesanan')->with('sukses', 'Berhasil');
    }
    public function batalKonfirmasiPengembalian(Request $request, $id)
    {
       //dd($request->all());
        $pesanan = Pesanan::where('id',$request->id)->update([
            'status_pengembalian' => $request->status_pengembalian
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('admin/pesanan');
    }

    public function pesananDetail($id)
    {
        $user = User::all();
      //  $pesanan = Pesanan::orderBy('tanggal','desc')->get();
        $pesanan = Pesanan::all();
       // $pesanan_detail = PesananDetail::orderBy('created_at','desc')->get();
        $pesanan_detail = PesananDetail::where('pesanan_id',$id)->get();
        
        return view('admin.pesanan_detail', compact('pesanan','pesanan_detail','user'));
    }
}
