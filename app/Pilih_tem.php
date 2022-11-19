<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilih_tem extends Model
{
    protected $primaryKey = 'kd_brg';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "temp_pilih";
    protected $fillable=['kd_brg','qty_pilih'];

}