<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $primaryKey = 'no_pilih';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "tampil_pilih";
    protected $fillable=['kd_brg','no_pilih','nm_brg','qty_pilih','sub_total'];
}
