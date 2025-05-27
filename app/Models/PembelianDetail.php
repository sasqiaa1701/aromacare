<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    //
    protected $table = 'detail_pembelian';


    protected $guarded = ['id'];


    public function obat(){
        return $this->belongsTo(Obat::class , "id_obat" , "id");
    }

}
