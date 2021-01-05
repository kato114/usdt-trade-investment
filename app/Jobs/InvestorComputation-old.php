<?php

namespace App\Jobs;

use App\Account;
use App\Client;
use App\InvestorTransaction;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InvestorComputation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $account;

    public function __construct($id)
    {
        $this->account = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         $investors = Client::query()->get();
        $account = Account::query()->findOrFail($this->account);
        \DB::beginTransaction();
      $i=0;
        foreach ($account->transactions()->whereIn('type', ['profit'])->whereNotNull('date')->orderBy('id', 'desc')->cursor(0) as $transaction) {
                          if($i==0)
    {
                        foreach ($investors as $investor) {
                if ($investor->investorTransactions()->where('account_id', $account->id)->deposits() > 0) {
                    $balance = $investor->depositAt($transaction->date);
                    $totalBalance = InvestorTransaction::query()->depositAt($transaction->date);
                    $amount = $transaction->amount * ($balance / $totalBalance);
//                        if ($balance !== 0) {
                    if ($amount !== 0) {
                        $profitMaster = ((100 - $investor->commission) / 100) * $amount;
                        $profit = ($investor->commission / 100) * $amount;
                        if ($profit != 0) {
                            $t = new InvestorTransaction([
                                'transaction_id' => $transaction->id,
                                'investor_id' => $investor->id,
                                'account_id' => $account->id,
                                'amount' => $profit,
                                'narration' => 'Profit',
                                'type' => $transaction->type,
                                'date' => $transaction->date,
                            ]);
                            $t->save();
                        }
                        if ($profitMaster != 0) {
                            $refs = $investor->referrer;
                            $percent = 0;
                            if ($refs) {
                                $percent = 5;
                                $t = new InvestorTransaction([
                                    'transaction_id' => $transaction->id,
                                    'investor_id' => $refs->id,
                                    'account_id' => $account->id,
                                    'amount' => $profit * ($percent / 100),
                                    'narration' => 'Referral Commission [' . $investor->name . ']',
                                    'type' => $transaction->type,
                                    'date' => $transaction->date,
                                ]);
                                if ($t->amount != 0) {
                                    $t->save();
                                }
                            }
                            $s = new InvestorTransaction([
                                'transaction_id' => $transaction->id,
                                'investor_id' => Client::query()->first()->id,
                                'account_id' => $account->id,
                                'amount' => $profitMaster - ($profit * ($percent / 100)),
                                'narration' => 'Commission [' . $investor->name . ']',
                                'type' => $transaction->type,
                                'date' => $transaction->date,
                            ]);
                            $s->save();
                        }
                    }
                }
            }
                            $i++;
    }
          
       
          
        
}
//  die();
                   }
}
                   
