<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alarm extends Model
{
    protected $table='alarm';
    protected $fillable=['nomor','email','isi','tanggal','waktu','status','pengulangan'];
}
