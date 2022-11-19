<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_pilih extends Model
{
    protected $primaryKey = 'kd_brg';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "view_temp_pilih";
    protected $fillable=['kd_brg','nm_brg','harga','stok'];

}