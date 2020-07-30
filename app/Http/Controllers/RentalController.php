<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Pesanan;
use App\PesananDetail;
use Auth;
use Carbon\Carbon;
use DateTime;
use App\User;

class RentalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $produk = Produk::where('id', $id)->first();
        return view('client/rental', compact('produk'));
    }

    public function store(Request $request, $id)
    {
        //dd($request);
        $produk = Produk::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi > stok
        if($request->jumlah > $produk->stok)
        {
            return redirect('rental/'.$id);
        }


        //cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();;

        //simpan database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status_pembayaran = 0;
            $pesanan->status_pengambilan = 0;
            $pesanan->status_pengembalian = 0;
            $pesanan->total_harga = 0;
            $pesanan->save();
        }
        

        //simpan ke db pesanan_detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_kembali);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_pinjam);

        $diff_in_days = $to->diffInDays($from);
        $jml_hari = $diff_in_days + 1;

        //cek pesanan detail

        $cek_pesanan_detail = PesananDetail::where('produk_id',$produk->id)->where('pesanan_id',$pesanan_baru->id)->first();

        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->produk_id = $produk->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->tanggal_pinjam = $request->tanggal_pinjam;
            $pesanan_detail->tanggal_kembali = $request->tanggal_kembali;
            $pesanan_detail->jml_hari = $jml_hari;
            $pesanan_detail->jumlah = $request->jumlah;
            $pesanan_detail->jumlah_harga = $produk->harga_sewa * $request->jumlah * $jml_hari;
            $pesanan_detail->save();

            
        }else
        {
            $pesanan_detail = PesananDetail::where('produk_id',$produk->id)->where('pesanan_id',$pesanan_baru->id)->first();
            $pesanan_detail->tanggal_pinjam = $request->tanggal_pinjam;
            $pesanan_detail->tanggal_kembali = $request->tanggal_kembali;
            $pesanan_detail->jml_hari = $jml_hari;
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah;

            //harga baru 
            $harga_pesanan_detail_baru = $produk->harga_sewa * $request->jumlah * $jml_hari;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();

        }
        
        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();
        $pesanan->total_harga = $pesanan->total_harga + $produk->harga_sewa * $request->jumlah * $jml_hari ;
        $pesanan->update();

        return redirect ('produk')->with('sukses', 'Produk Ditambahkan ke Keranjang');
        
    }


    public function checkout()
    {
        
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();
        if (!empty($pesanan))
        {
            $pesanan_detail = PesananDetail::where('pesanan_id',$pesanan->id)->get();
            return view('client.checkout', compact('pesanan','pesanan_detail'));
        }
        return view('client.checkout');
        
    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id',$id)->first();
        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->total_harga = $pesanan->total_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();
        
        $pesanan_detail->delete();
        
        return redirect ('checkout')->with('sukses', 'Pesanan Berhasil dihapus');
    }

}
