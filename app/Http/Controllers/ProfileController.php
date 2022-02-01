<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Produk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaksi;

class ProfileController extends Controller
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
        $jml_transaksi = Transaksi::count();
        $jml_produk = Produk::count();
        return view('profile', compact('register', 'transaksi', 'jml_transaksi', 'jml_produk'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->_validasi($request);
        User::create(array_merge($request->all()));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

        $file = '';
        if ($request->image->getClientOriginalName()) {
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
            $request->image->storeAs('public/logo_toko', $fileName);
        }

        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'alamat' => $request->get('alamat'),
            'nama_toko' => $request->get('nama_toko'),
            'image' => $fileName
        );

        User::where('id', $id)->update($data);
        notify()->success('Data berhail diupdate!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
