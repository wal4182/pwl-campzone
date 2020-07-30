<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\User;
use File;
use Auth;
use App\Pesanan;
use App\PesananDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        //$user = User::where('id', Auth::user()->id)->first();   
        return view('client.profil.index',compact('user'));
        
    }

    public function edit()
    {
        $user = Auth::user();
        return view('client.profil.edit',compact('user'));
    }

    public function editAvatar()
    {
        return view('client.profil.edit_avatar');
    }
    
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        File::delete('img/avatar/'.$user->foto_profil);
        $nama_foto = $user->id.'_avatar'.time().'.'.request()->foto_profil->getClientOriginalExtension();

        $request->file('foto_profil')->move('img/avatar',$nama_foto);

        $user->foto_profil = $nama_foto;
        $user->save();

        return redirect('profil')->with('sukses','Foto Profil Berhasil Diupdate');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'alamat' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'hp' => 'required',
            'no_ktp' => 'required',
        ]);

        $user = Auth::user();
        $user->update($request->all());
        return redirect ('profil')->with('sukses', 'Profil Berhasil Diupdate');
    }

    public function destroyAvatar(Request $request)
    {
        $user = Auth::user();
        File::delete('img/avatar/'.$user->foto_profil);
        $user->foto_profil = '';
        $user->save();
        return redirect('profil')->with('sukses','Foto Profil Berhasil Dihapus');
    }
}
