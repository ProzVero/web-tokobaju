<?php

namespace App\Http\Controllers;

use App\KategoriModel;
use App\Produk;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id =  Auth::user()->id;

        $visitor = User::find($id)->increment('views');
        $produk = Produk::where('user_id', $id)->count();

        $register = User::where('user_id', 'user')->count();
        $transaksi = Transaksi::where('toko_id', $id)->count();

        $kategoriAll = KategoriModel::all();
        $produkAll = Produk::all();
        $kategori = [];
        $data = [];
        foreach ($kategoriAll as $get) {
            $kategori[] = $get->nama_kategori;
            $data[] = $produkAll->where('kategori_id', $get->id)->where('user_id', $id)->count();
        }

        return view('home', compact('produk', 'register', 'transaksi', 'kategori', 'data', 'visitor'));
    }
}
