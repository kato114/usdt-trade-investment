<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequests extends Model
{
    protected $guarded = ['id'];

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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getWithdrawNarrationAttribute()
    {
        switch ($this->withdraw_type) {
            case 'Paypal':
            case 'Skrill' :
                return $this->withdraw_type . " ({$this->email})";
            case 'Bitcoin Wallet':
                return $this->withdraw_type . " ({$this->wallet})";
            case 'Bank Account':

                return $this->withdraw_type . "<br>BANK\SWIFT CODE\ACCOUNT <br> " . " ({$this->bank_name}\\{$this->swift_code}\\{$this->bank_account})";


        }
    }

    public function getItemAttribute()
    {
        return 'USD';
    }
}
