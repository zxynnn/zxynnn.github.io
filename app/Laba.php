<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Laba extends Model
{
    protected $table = 'laba';

    protected $fillable = [
        'tgl', 'user', 'beban', 'jumlah', 'keterangan', 'photo'
    ];    

    protected $hidden = [];
}
