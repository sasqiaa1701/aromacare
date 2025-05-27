<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    //
    protected $table = 'pelanggan';

    protected $guarded = [];

    protected $password = 'katakunci';


    public function getAuthPassword()
    {
        return $this->katakunci;
    }

    public function keranjangs()
    {
        
        return $this->hasMany(Keranjang::class, "id_pelanggan", "id");
    }
}
