<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $table = 'penjualan';

    protected $guarded = ['id'];

    public function metode_bayar()
    {
        return $this->belongsTo(MetodeBayar::class, "id_metode_bayar");
    }


    public function detail_penjualan()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan');
    }


    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, "id_pelanggan", "id");
    }
}
