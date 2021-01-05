<?php

namespace App\Http\Controllers\Reports;
use DB;
use App\Account;
use App\Client;
use App\DepositRequest;
use App\Server;
use App\Transaction;
use App\User;
use App\MailLog;
use App\OperationData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait FinancialReport
{


    private function accountStatement(Request $request, $report)
    {
        $account = Account::query()->find($request->account);
        $dates = [];
        for ($i = 0; $i < 12; $i++) {
            $dates [] = now()->subMonth($i)->firstOfMonth(Carbon::SATURDAY);
        }
        $load = ['report' => $report, 'from' => $request->from, 'dates' => $dates];
        if ($account) {
            $load['account'] = $account;
        }
        if (request()->has('from') && request()->has('to')) {
            list($from, $to) = $this->parseDates();
            if ($account) {
                $query = $account->transactions();
            } else {
                $query = Transaction::query();
            }
            $query->whereBetween('closed_at', [$from, $to])
                ->orderBy('created_at');

            $load['transactions'] = $query;
            $load['to'] = $to;
            $load['from'] = $from;
        }
        return view('reports.finance.statement', $load);
    }

    private function clientDeposits(Request $request, $report)
    {

        $load = ['report' => $report];

        $query = Client::query()->orderBy('name');
        $load['query'] = $query;
        return view('reports.finance.deposits', $load);
    }
    private function clientDepositsByUser(Request $request, $report)
    {

        $load = ['report' => $report];

        $query = User::query()->whereNotIn('id',[1,3])->orderBy('name');
        $load['query'] = $query;
        return view('reports.finance.deposits_by_user', $load);
    }

    private function pendingDeposits(Request $request, $report)
    {

        $load = ['report' => $report];

        $query = Client::query()->orderBy('name')->whereHas('deposits', function (Builder $query) {
            $query->where('status', 'pending');
        });
        $load['query'] = $query;
        return view('reports.finance.pending_deposits', $load);
    }

 /*   private function approvedDeposits(Request $request, $report)
    {

        $load = ['report' => $report];

        $query = Client::query()->orderBy('name')->whereHas('deposits', function (Builder $query) {
            $query->where('status', 'approved');
        });
        $load['query'] = $query;
        return view('reports.finance.approval_deposits', $load);
    }*/
    	 private function pendingWithdraw(Request $request, $report)
    {

        $load = ['report' => $report];

        $query = Client::query()->orderBy('name')->whereHas('withdrawalRequests', function (Builder $query) {
            $query->where('status', 'pending');
        });
           
        $load['query'] = $query;
        return view('reports.finance.pending_withdraw', $load);
    }
     private function referralsList(Request $request, $report)
    {

        $load = ['report' => $report];
        $query = Client::query()
            ->orderBy('name');
          
        $load['clients'] = $query;
       
        return view('reports.finance.referrals_list', $load);
    }
     private function mailList(Request $request, $report)
    {

        $load = ['report' => $report];
    
       $query = MailLog::query()
            ->orderBy('id', 'desc');
            
        $load['clients'] = $query;
            
        return view('reports.finance.mail_list', $load);
    }
	   private function operationData(Request $request, $report)
    {


        $load = ['report' => $report];
    
       $query = OperationData::query()
            ->orderBy('id');
            
        $load['clients'] = $query;

        return view('reports.finance.operation_data', $load);
    }

    private function pendingBitcoinTransaction(Request $request, $report)
    {
        $load = ['report' => $report];
    
        $deposit = Client::query()->orderBy('name')->whereHas('deposits', function (Builder $query) {
            $query->where('status', 'pending');
        });

        $withdraw = Client::query()->orderBy('name')->whereHas('withdrawalRequests', function (Builder $query) {
            $query->where('status', 'pending');
        });
            
        $load['deposit'] = $deposit;
        $load['withdraw'] = $withdraw;

        return view('reports.finance.pending_transaction', $load);
    }

    private function bitcoinTransactionLog(Request $request, $report)
    {
        $network = new App\BlockExplorer\NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));

        $transaction_list = $network->callCoin('listtransactions',[]);
            
        $load['transaction'] = $transaction_list;

        return view('reports.finance.pending_transaction', $load);
    }
}
