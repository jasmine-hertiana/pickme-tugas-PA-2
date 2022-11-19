<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $primaryKey = 'no_checkout';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "keranjang";
    protected $fillable=['no_checkout','tgl_checkout','no_invoice','total_checkout','no_pilih'];

}
