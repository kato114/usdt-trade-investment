<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function apply($amount, $date)
    {
        $transaction = Transaction::query()
            ->create([
                'ticket' => md5($this->client->id . $this->id . time()),
                'amount' => $amount,
                'created_at' => $date,
                'account_id' => cache('default_wallet'),
                'type' => $this->operation,
                'item' => 'BTC',
                'client_id' => $this->client->id
            ]);
        $this->status = 'approved';
        $this->save();
        return $transaction;
    }
}
