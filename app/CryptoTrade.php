<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoTrade extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];
}
