<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    //
    protected $table = 'pembelian';

    protected $guarded = ['id'];


    public function detailPembelians()
    {
        return $this->hasMany(PembelianDetail::class, "id_pembelian", 'id');
    }


    public function distributor()
    {
        return $this->belongsTo(Distributor::class, "id_distributor", "id");
    }
}
