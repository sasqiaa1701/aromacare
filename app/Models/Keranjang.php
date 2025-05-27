<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    //
    protected $table = 'keranjang';

    protected $guarded = ['id'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, "id_pelanggan", "id");
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, "id_obat", "id");
    }
}
