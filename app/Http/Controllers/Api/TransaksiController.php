<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use App\Transaksi;
use App\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'user_id' => 'required',
            'total_item' => 'required',
            'total_harga' => 'required',
            'name' => 'required',
            'jasa_pengiriman' => 'required',
            'ongkir' => 'required',
            'total_transfer' => 'required',
            'bank' => 'required',
            'phone' => 'required',
            'toko_id' => 'required'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_payment = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_trx = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_unik = rand(100, 999);
        $status = "MENUNGGU";
        $expired_at = now()->addDay();

        $dataTransaksi = array_merge($request->all(), [
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'expired_at' => $expired_at
        ]);

        DB::beginTransaction();
        $transaksi = Transaksi::create($dataTransaksi);

        foreach ($request->produks as $produk) {
            $detail = [
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk['id'],
                'total_item' => $produk['total_item'],
                'catatan' => $produk['catatan'],
                'total_harga' => $produk['total_harga']
            ];
            $transaksiDetail = TransaksiDetail::create($detail);

            $getproduk = Produk::where('id', $produk['id'])->get();
            foreach ($getproduk as $id_produk) {
                $arr_produk = [
                    'stok' => abs($id_produk['stok'] - $produk['total_item'])
                ];
            }
            $update_produk = Produk::where('id', $produk['id'])->update($arr_produk);
        }

        if (!empty($transaksi) && !empty($transaksiDetail) && !empty($update_produk)) {
            DB::commit();
            return response()->json([
                'success' => 1,
                'message' => "Transaksi sukses",
                'transaksi' => collect($transaksi)
            ]);
        } else {
            DB::rollBack();
            $this->error('Transaksi gagal');
        }
    }

    public function history($id)
    {
        $gettransaksis = Transaksi::with(['user'])->whereHas('user', function ($query) use ($id) {
            $query->whereId($id);
        })->orderBy("id", "desc")->get();

        foreach ($gettransaksis as $transaksi) {

            $details = $transaksi->details;

            foreach ($details as $detail) {
                $detail->produk;
            }
        }

        if (!empty($gettransaksis)) {
            return response()->json([
                'success' => 1,
                'message' => "Transaksi sukses",
                'transaksis' => collect($gettransaksis)
            ]);
        } else {
            $this->error('Transaksi gagal');
        }
    }

    public function batal($id)
    {
        $transaksi  = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
        if ($transaksi) {
            $transaksi->update([
                'status' => "BATAL"
            ]);

            $this->pushNotif("Transaksi dibatalkan", "Transaksi produk " . $transaksi->details[0]->produk->name . ", berhasil dibatalkan",  $transaksi->user->fcm);

            return response()->json([
                'success' => 1,
                'message' => "sukses",
                'transaksi' => $transaksi
            ]);
        }
        return $this->error('gagal memuat transaksi');
    }

    public function pushNotif($title, $message, $mfcm)
    {

        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mfcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAAsAziE3k:APA91bHNQBXv6ldDQGr8a5k7RJWU5sMlJmFBkttTpOK6dmETvEbVeFXWEhKlhTgqgLs7KdiXOt-2GbfLHvkUldZihu009ZKZx0_O7cadJuL2WusR9Y7VAE5mddc5vj0e34Sh6eRm7hPW"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }

    public function upload(Request $request, $id)
    {

        $transaksi  = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
        if ($transaksi) {

            $file = '';
            if ($request->image->getClientOriginalName()) {
                $file = str_replace(' ', '', $request->image->getClientOriginalName());
                $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
                $request->image->storeAs('public/transfer', $fileName);

                $transaksi->update([
                    'status' => "DIBAYAR",
                    'bukti_transfer' => $fileName
                ]);

                $this->pushNotif("Transaksi dibayar", "Transaksi produk " . $transaksi->details[0]->produk->name . ", berhasil dibayar",  $transaksi->user->fcm);

                return response()->json([
                    'success' => 1,
                    'message' => "Berhasil upload gambar",
                    'image' => $fileName
                ]);
            } else {
                return $this->error('gagal memuat data');
            }
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
