<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangAwal extends Model
{
    //jika tidak di definisikan, maka primary akan terdetek id
    protected $primaryKey = 'kd_brgawal';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "barang_awal";
    protected $fillable=['kd_brgawal','nm_brg','harga','jenis','stok_awal'];
}