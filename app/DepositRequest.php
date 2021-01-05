<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositRequest extends Model
{
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function apply()
    {
        $time = now();
//        $this->client->investorTransactions()->save(new InvestorTransaction(['type' => 'deposit', 'amount' => $this->usd, 'account_id' => $this->account_id, 'narration' => 'Client Deposit', 'date' => $time]));
        $this->status = 'approved';
        $this->save();
    }

    public function reject()
    {
        $this->status = 'failed';
        $this->save();
    }

    public function getAmountAttribute()
    {
        return $this->usd;
    }

    public function getItemAttribute()
    {
        return 'USD';
    }
}
