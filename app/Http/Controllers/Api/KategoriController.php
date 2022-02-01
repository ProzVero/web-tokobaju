<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use App\KategoriModel;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori  = KategoriModel::with('produk')->get();

        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'kategori' => $kategori
        ]);
    }
}
