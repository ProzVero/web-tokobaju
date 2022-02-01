<?php

namespace App\Http\Controllers;

use App\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Transaksi;
use App\User;

class KategoriController extends Controller
{
    public function index()
    {
        $id =  Auth::user()->id;
        $register = User::where('user_id', 'user')->count();
        $transaksi = Transaksi::where('toko_id', $id)->count();
        $kategori = KategoriModel::latest()->get();
        return view('kategori',compact('kategori','register','transaksi'));
    }

    public function create()
    {
        //
    }

    private function _validasi(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);
    }

    public function store(Request $request)
    {
        $this->_validasi($request);

        $file = '';
        KategoriModel::create(array_merge($request->all()));
        notify()->success('Kategori berhail ditambahkan!');
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
        
        $data = array(
            'nama_kategori' => $request->get('nama_kategori'),
        );
        KategoriModel::where('id', $id)->update($data);
        notify()->success('Kategori berhail diupdate!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        KategoriModel::where('id', $id)->delete();
        return redirect()->back();
    }
}
