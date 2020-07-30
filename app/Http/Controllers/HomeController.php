<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function client()
    {
        $produk = Produk::latest()->paginate(4);
        return view('client.index',compact('produk'));
    
    }
    

    public function admin()
    {
        return view ('admin.home');
    }
}
