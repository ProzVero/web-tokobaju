<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $produk  = Produk::with('user')->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produklimit' => $produk
        ]);
    }

    public function get_limit_id($id)
    {
        $produk  = Produk::with('user')->where('user_id', $id)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produklimit' => $produk
        ]);
    }

    public function get_id($id)
    {
        $produk  = Produk::with('user')->where('user_id', $id)->limit(4)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produklimit' => $produk
        ]);
    }

    public function get_id_all($id)
    {
        $produk  = Produk::where('kategori_id', $id)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produk' => $produk
        ]);
    }
}
