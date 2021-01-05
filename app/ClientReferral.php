<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientReferral extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'referrals';

    public function client()
    {
        return $this->belongsTo(Client::class, 'referral_id');
    }
}
