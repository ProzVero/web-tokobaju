<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index($id)
    {
        $user  = User::where('id', $id)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'user' => $user
        ]);
    }
    public function Login(Request $request)
    {

        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->error('Login gagal');
        }

        $validpassowrd = Hash::check($password, $user->password);

        if (!$validpassowrd) {
            return $this->error('Login gagal');
        }

        $user->update([
            'fcm' => $request->fcm
        ]);
        return response()->json([
            'success' => 1,
            'data' => $user,
            'message' => "Login sukses"
        ]);
    }

    public function register(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = Hash::make($request->input('password'));
        $fcm = $request->input('fcm');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'fcm' => $fcm,
            'user_id' => 'user'
        ]);

        return response()->json([
            'success' => 1,
            'data' => $user,
            'message' => "Login sukses"
        ]);
    }

    public function ubahpassword(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'password' => 'required|min:6'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $password = Hash::make($request->input('password'));

        User::where('id', $id)->update([
            'password' => $password
        ]);

        return response()->json([
            'success' => 1,
            'message' => "Ubah password sukses"
        ]);
    }

    public function ubahprofil(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:costumers',
            'phone' => 'required|unique:costumers'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $name = $request->input('nama');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $alamat = $request->input('alamat');

        User::where('id', $id)->update([
            'nama' => $name,
            'email' => $email,
            'phone' => $phone,
            'alamat' => $alamat
        ]);

        return response()->json([
            'success' => 1,
            'message' => "Ubah profile sukses"
        ]);
    }

    public function upload_image(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $file = '';
        if ($request->image->getClientOriginalName()) {
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
            $request->image->storeAs('public/logo_toko', $fileName);

            $user->update([
                'image' => $fileName
            ]);

            return response()->json([
                'success' => 1,
                'message' => "Berhasil upload gambar",
                'image' => $fileName
            ]);
        } else {
            return $this->error('gagal memuat data');
        }
    }

    public function error($pesan)
    {
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}
