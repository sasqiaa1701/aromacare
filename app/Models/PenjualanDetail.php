<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    //
    protected $table = 'detail_penjualan';

    protected $guarded = ['id'];


    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
