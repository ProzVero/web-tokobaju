<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Transaksi;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('user_id', 'user')->get();
        $id =  Auth::user()->id;
        $register = User::where('user_id', 'user')->count();
        $transaksi = Transaksi::where('toko_id', $id)->count();
        $user->makeHidden('user_id');
        return view('user', compact('user', 'register', 'transaksi'));
    }

    public function create()
    {
        //
    }

    private function _validasi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'konf_pass' => 'required|min:6|same:password',
        ]);
    }

    public function store(Request $request)
    {
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
        //
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}
