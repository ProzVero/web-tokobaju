<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Transaksi;
use App\User;
use App\KategoriModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id =  Auth::user()->id;

        $register = User::where('user_id', 'user')->count();
        $transaksi = Transaksi::where('toko_id', $id)->count();
        $kategori = KategoriModel::latest()->get();

        $produk = Produk::with(['user'])->where('user_id', $id)->get();
        return view('produk', compact('produk', 'register', 'transaksi','kategori'));
    }

    public function create()
    {
        //
    }

    private function _validasi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'image' => 'required',
            'stok' => 'required',
            'berat' => 'required',
        ]);
    }

    public function store(Request $request)
    {
        $this->_validasi($request);

        $file = '';
        if ($request->image->getClientOriginalName()) {
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
            $request->image->storeAs('public/produk', $fileName);
        }
        Produk::create(array_merge($request->all(), [
            'image' => $fileName
        ]));
        notify()->success('Produk berhail ditambahkan!');
        return redirect()->back();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->_validasi($request);
        $file = '';
        if ($request->image->getClientOriginalName()) {
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
            $request->image->storeAs('public/produk', $fileName);
        }
        $data = array(
            'name' => $request->get('name'),
            'harga' => $request->get('harga'),
            'deskripsi' => $request->get('deskripsi'),
            'kategori_id' => $request->get('kategori_id'),
            'image' => $fileName,
            'stok' => $request->get('stok'),
            'berat' => $request->get('berat'),
            'user_id' => $request->get('user_id')
        );
        Produk::where('id', $id)->update($data);
        notify()->success('Produk berhail diupdate!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Produk::where('id', $id)->delete();
        return redirect()->back();
    }
}
