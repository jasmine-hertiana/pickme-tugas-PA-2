<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilih extends Model
{
    //jika tidak di definisikan makan primary akan terdetek id
    protected $primaryKey = 'no_pilih';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pilih";
    protected $fillable=['no_pilih','tgl_pilih','total'];

}