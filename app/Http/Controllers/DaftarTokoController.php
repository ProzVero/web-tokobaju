<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaksi;

class DaftarTokoController extends Controller
{
    public function index()
    {
        $user = User::where('user_id', 'seller')->get();
        $id =  Auth::user()->id;
        $register = User::where('user_id', 'user')->count();
        $transaksi = Transaksi::where('toko_id', $id)->count();
        $user->makeHidden('user_id');
        return view('daftartoko', compact('user', 'register', 'transaksi'));
    }
}
