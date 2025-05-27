<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    //
    protected $table = 'obat';

    protected $guarded = [];


    public function jenisObat(){
        return $this->belongsTo(JenisObat::class , "id_jenis");
    }

}
