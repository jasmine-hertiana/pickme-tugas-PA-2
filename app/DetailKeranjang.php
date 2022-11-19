<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    protected $primaryKey = 'no_checkout';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "detail_keranjang";
    protected $fillable=['no_checkout','kd_brg','qty_checkout','sub_checkout'];
}
