<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualTransaction extends Model
{
    protected $table = 'virtual_transaction';

    protected $guarded = [''];

    public function client()
    {
        return $this->hasOne(VirtualNames::class, 'id', 'vclient_id');
    }
}