<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $fillable = [
        'nama_kategori'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, "id", "kategori_id");
    }
}