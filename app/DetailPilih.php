<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPilih extends Model
{
    protected $primaryKey = 'no_pilih';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "detail_pilih";
    protected $fillable=['nama_pilih','notelp_pilih','alamat_pilih','no_pilih','kd_brg','qty_pilih','subtotal'];

}