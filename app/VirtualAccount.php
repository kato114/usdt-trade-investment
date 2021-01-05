<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    protected $table = 'virtual_accounts';

    protected $guarded = [''];
}