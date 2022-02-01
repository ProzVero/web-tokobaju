<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'name', 'harga', 'deskripsi', 'kategori_id', 'image', 'stok', 'berat', 'user_id', 'nama_toko'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function kategori_model()
    {
        return $this->belongsTo(KategoriModel::class, "kategori_id", "id");
    }
}
