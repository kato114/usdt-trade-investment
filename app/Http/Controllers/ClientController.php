<?php

namespace App\Http\Controllers;

use App\Account;
use App\Mail\MailMessage;
use App\Mail\SessionExpired;
use App\Client;
use App\ClientReferral;
use App\DepositRequest;
use App\Foundation\Statement\DomExtract;
use App\Foundation\Statement\TransactionExtract;
use App\InvestorTransaction;
use App\Jobs\InvestorComputation;
use App\Notifications\RegistrationRequest;
use App\Notifications\TransactionRequest;
use App\Notifications\DepositRequestNotification;
use App\SupportTicket;
use App\Transaction;
use App\Options;
use App\User;
use App\WithdrawRequests;
use App\BlockExplorer\NetworkInfo;
use Carbon\Carbon;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\RequestOptions;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin,client',['except'=>['realtime', 'confirm_transaction']]);
    }
    
    public function realtime()
    {
                        $account = Account::query()->findOrFail(cache('default_wallet'));
            $domain = 'mind.capital';
            $Expires='2020-04-10T19:29:05.000Z';
                    //die(print_r($account));
                    $ch = curl_init();

            $url='http://34.193.131.158:8080/realtime.php?phpsession='.$account->cookie.'&mind_antiddos='.$account->mind_antiddos_;
            //die(print_r($url));

            // define options
            $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
            );

            // apply those options
            curl_setopt_array($ch, $optArray);

            // execute request and get response
            $result = curl_exec($ch);
            curl_close ($ch);
            //die(print_r($result));
            if (substr_count($result, 'zooms') > 0) {
                echo 'text found';
            }
            else
            {
               $chandan="jackryland@hotmail.com";
               $crontext = "Cron Run at ".date("r")." by eewew\n" ;
            $folder = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],"/")+1);
            $filename ="cron_test1.txt" ;
            $fp = fopen($filename,"a") or die("Open error!");
            fwrite($fp, $crontext) or die("Write error!");
            fclose($fp);
            //echo "Wrote to ".$filename."\n\n" ;
             Mail::to($chandan)->send(new MailMessage('34.193.131.158: Deposit Server Stopped Working for .io', 'Deposit Server Stopped Working'));
             echo 'Zooms text not found';
            }
        
    }

    public function index(Client $client)
    {
        //die(print_r("dd"));
        if (request()->action == null) {
            return redirect(route('client', ['client' => $client, 'action' => 'dashboard']));
        } else {
            $types = ['General', 'Dispute', 'Financial'];
            $periods = (object)[
                /**(object)[
                 * 'name' => 'Today',
                 * 'start' => now()->startOfDay(),
                 * 'end' => now()->endOfDay()],*/
                (object)[
                    'name' => ''/**'Total Profits' **/,
                    'start' => Carbon::parse('first day of jan 2019'),
                    'end' => now()->endOfDay()],
            ];
            
            $data = array(
                'client' => $client,
                'types' => $types,
                'periods' => $periods,
            );
            
            if (request('action') == 'operations') {
                if (request()->has('w')) {
                    switch (request('role')) {
                        case 'approval':
                            $withdraw = WithdrawRequests::query()->findOrFail(request('operation'));
                            $withdraw->apply();
                            break;
                        case 'rejection':
                            $withdraw = WithdrawRequests::query()->findOrFail(request('operation'));
                            $withdraw->reject();
                            break;
                        default:
                            break;
                    }
                } else {
                    switch (request('role')) {
                        case 'approval':
                            $deposit = DepositRequest::query()->findOrFail(request('operation'));
                            $deposit->apply();
                            break;
                        case 'rejection':
                            $deposit = DepositRequest::query()->findOrFail(request('operation'));
                            $deposit->reject();
                            break;
                        default:
                            break;
                    }
                }
            } else if (request('action') == 'beneficiary') {
                if (request()->isMethod('post')) {
                    $client->payload = request()->only('name', 'phone', 'email', 'relationship');
                    $client->save();
                    return back()->withSuccess('Updated');
                }
            } else if(request('action') == 'status') {
                $deposit_id = request('rid');
                $deposit_request = DepositRequest::where('id', '=', $deposit_id)->first();
                $data['deposit_request'] = $deposit_request;
            }
            
            return view('client.profile', $data);
        }
    }

    public function auto_profit()
    {
        $input = array(
            'opt_key' => 'auto_profit',
            'opt_value' => request('amount'),
        );

        \DB::beginTransaction();
        $options = Options::firstOrNew(['opt_key' => 'auto_profit']);
        $options->fill($input);
        $options->save();
        \DB::commit();

        return back()->withSuccess('Successful');
    }

    public function auto_profit_post()
    {
        if(Transaction::where('date', 'like', date("Y-m-d") . "%")->first() != NULL)
        {
            echo "Already Exists";
            return;
        }

        $input = array(
            'account_id' => Account::first()->id,
            'ticket' => Transaction::max('ticket') + 1,
            'type' => 'profit',
            'date' => date("Y-m-d"),
            'amount' => Options::where('opt_key', '=', 'auto_profit')->first()->opt_value,
        );

        \DB::beginTransaction();
        $transaction = Transaction::firstOrNew(['ticket' => $input['ticket'], 'client_id' => null]);
        $transaction->fill($input);
        $transaction->save();
        \DB::commit();

        $this->calcProfit($transaction->id);
        $this->calcNextProfit(request('date'));

        echo "Successful";
    }

    public function profit()
    {
       $input = array(
            'account_id' => request('account_id'),
            'ticket' => request('ticket'),
            'type' => 'profit',
            'date' => request('date'),
            'amount' => request('amount'),
        );

        \DB::beginTransaction();
        $transaction = Transaction::firstOrNew(['ticket' => $input['ticket'], 'client_id' => null]);
        $transaction->fill($input);
        $transaction->save();
        \DB::commit();

        $this->calcProfit($transaction->id);
        $this->calcNextProfit(request('date'));

        return back()->withSuccess('Successful');
    }

    public function calcNextProfit($date = null)
    {
        ini_set ('memory_limit', '4096M');

        if (user()->role == 'admin') {
            $transactions = Transaction::where('type', 'profit')->whereNotNull('date')->orderBy('date', 'asc')->get();

            foreach ($transactions as $transaction) {
                if($date == null || $date < $transaction->date) {
                    $this->calcProfit($transaction->id);
                }
            }
        }  else {
            return redirect(route('client', user()->id));            
        }
    }

    public function calcProfit($transaction_id)
    {
        $transaction = Transaction::query()->findOrFail($transaction_id);
        $account = Account::query()->findOrFail($transaction->account_id);

        InvestorTransaction::where('transaction_id', $transaction_id)->delete();

        $totalBalance = InvestorTransaction::query()->depositAt($transaction->date)+InvestorTransaction::query()->profitAt($transaction->date->subDays(1))-InvestorTransaction::query()->withdrawAt($transaction->date);

        if($totalBalance == 0)
            return;

           $master = Client::query()->first();
        $totalBalance -= $master->balanceDWP($transaction->date);
        
        $investors = Client::query()->get();
        foreach ($investors as $investor) {
            if($investor->id == $master->id)
                continue;
                
            $balance = $investor->balanceDWP($transaction->date);

            $amount = $transaction->amount * $balance / $totalBalance;

            if($amount <= 0)
                continue;

            $profitClient = $investor->commission * $amount / 100;

            if ($profitClient != 0) {
                $t = new InvestorTransaction([
                    'transaction_id' => $transaction->id,
                    'investor_id' => $investor->id,
                    'account_id' => $account->id,
                    'amount' => $profitClient,
                    'narration' => 'Profit',
                    'type' => $transaction->type,
                    'date' => $transaction->date,
                ]);
                $t->save();
            }

            $profitRef = 0;
            if($investor->referrer && $investor->referrer->created_at < $transaction->date)
            {
                $profitRef = 5 * $amount / 100;

                if($profitRef != 0)
                {
                    $t = new InvestorTransaction([
                        'transaction_id' => $transaction->id,
                        'investor_id' => $investor->referrer->id,
                        'account_id' => $account->id,
                        'amount' => $profitRef,
                        'narration' => 'Referral Commission [' . $investor->name . ']',
                        'type' => $transaction->type,
                        'date' => $transaction->date,
                    ]);
                    $t->save();
                }
            }


            $profitMaster = $amount - $profitClient - $profitRef;

            if ($profitMaster != 0) {
                $t = new InvestorTransaction([
                    'transaction_id' => $transaction->id,
                    'investor_id' => Client::query()->first()->id,
                    'account_id' => $account->id,
                    'amount' => $profitMaster,
                    'narration' => 'Commission [' . $investor->name . ']',
                    'type' => $transaction->type,
                    'date' => $transaction->date,
                ]);
                $t->save();
            }

            $t = null;
        }

        $account = null;
        $investors = null;
        $transaction = null;
        $totalBalance = null;
    }

    public function deposit(Client $client)
    {
        $network = new NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));
        
        $address = $network->callCoin('getnewaddress', [env('BTC_ACCOUNT'),'legacy']);
        $address_info = $network->callCoin('getaddressinfo', [$address]);

        $account = Account::query()->findOrFail(cache('default_wallet'));
        $amount = $this->convert(request('amount'));

        if ($address_info)
        {
            $prv_key = isset($address_info['hex']) ? $address_info['hex'] : $network->callCoin('dumpprivkey', [$address]);
            $pub_key = $address_info['pubkey'];
            
            DB::beginTransaction();
            $deposit = DepositRequest::query()->firstOrNew([
                'address' => $address,
                'qrcode' => 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $address . '&choe=UTF-8',
                'btc' => $amount["btc_amount"],
                'usd' => $amount["usd_amount"],
                'rbtc' => 0,
                'pub_key' => $pub_key,
                'prv_key' => $prv_key,
                'status' => 'pending',
                'client_id' => $client->id,
                'account_id' => $account->id,
                'deposit_id' => 'finiko']);
            $deposit->save();
            foreach (User::query()->where('user_mail', '=', '1')->get() as $user)
            {
               $user->notify(new TransactionRequest($deposit, 'Deposit', $amount["usd_amount"]));
            }
            DB::commit();
            //$deposit->btc = number_format($deposit->btc * 1.035, 8);

            $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $deposit->id));
            $client->notify(new DepositRequestNotification(0, 0, 0, $url));
            
            return $deposit;
        }
        else
        {
            return response()->json(['message' => 'Something wrong happened. '])->setStatusCode(500);
        }
    }
    
    public function deposit_status($deposit_id)
    {
        $deposit_request = DepositRequest::where('id', '=', $deposit_id)->first();
        
        if(user()->id == $deposit_request["client_id"] || user()->role == 'admin')
        {
            $network = new NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));
            
            $deposit_info = $network->callCoin('listreceivedbyaddress',[0, true, true, $deposit_request->address]);
    
            if(count($deposit_info) > 0) {
                if($deposit_request->status == "pending")
                {
                    $amount = $network->callCoin('getreceivedbyaddress',[$deposit_request->address, 3]);
                    $client = Client::where("id", "=", $deposit_request->client_id)->first();
                    
                    if($amount >= $deposit_request->btc)
                    {
                        $deposit_request->rbtc = $amount;
                        $deposit_request->status = "confirmed";
                        $deposit_request->save();
                        
                        $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $deposit_id));
                        $client->notify(new DepositRequestNotification(1, 0, 0, $url));

                        foreach (User::query()->where('user_mail', '=', '1')->get() as $user)
                        {
                           $user->notify(new DepositRequestNotification(4, $deposit_request->rbtc, $client->name, $url));
                        }
                    }
                    else if($amount > $deposit_request->rbtc)
                    {
                        $deposit_request->rbtc = $amount;
                        $deposit_request->save();
                        
                        $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $deposit_id));
                        $client->notify(new DepositRequestNotification(3, array($deposit_request->rbtc, ($deposit_request->btc - $deposit_request->rbtc)), $deposit_request->address, $url));
                    }
                }
                
                return json_encode(array('status' => 'success', 'data' => $deposit_info[0]));
            }
            else 
            {
                $diff = strtotime(date('Y-m-d H:i:s')) - strtotime("now");
                if($diff > 7200)
                {
                    $deposit_request->status = "rejected";
                    $deposit_request->save();
                    
                    $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $deposit_id));
                    $client->notify(new DepositRequestNotification(2, 0, 0, $url));
                    
                    return json_encode(array('status' => 'rejected'));
                }
            }
            
            return json_encode(array('status' => 'fail'));
        }
        
        return json_encode(array('status' => 'fail'));
    }
    
    public function confirm_transaction()
    {
        $network = new NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));
        
        $request_list = DepositRequest::where("status", "=", "pending")->get(); 
        foreach($request_list as $request)
        {
            $amount = $network->callCoin('getreceivedbyaddress',[$request->address, 3]);
            $client = Client::where("id", "=", $request->client_id)->first();
            
            if($amount >= $request->btc)
            {
                $request->rbtc = $amount;
                $request->status = "confirmed";
                $request->save();
                
                $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $request->id));
                $client->notify(new DepositRequestNotification(1, 0, 0, $url));

                foreach (User::query()->where('user_mail', '=', '1')->get() as $user)
                {
                   $user->notify(new DepositRequestNotification(4, $request->rbtc, $client->name, $url));
                }
            }
            else if($amount > $request->rbtc)
            {
                $request->rbtc = $amount;
                $request->save();

                $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $request->id));
                $client->notify(new DepositRequestNotification(3, array($request->rbtc, $request->btc - $request->rbtc), $request->address, $url));
            }
            else 
            {
                $diff = strtotime(date('Y-m-d H:i:s')) - strtotime("now");
                if($diff > 7200)
                {
                    $deposit_request->status = "rejected";
                    $deposit_request->save();
                    
                    $url = route('client', array('client' => $client->id, 'action' => 'status', 'rid' => $request->id, $url));
                    $client->notify(new DepositRequestNotification(2, 0, 0));
                }
            }
        }

        $request_list = WithdrawRequests::where("status", "=", "confirmed")->get(); 
        foreach($request_list as $request)
        {
            if (strlen($request->txn_id) != 64) 
                continue;

            $transfer = $network->callCoin('gettransaction', [$request->txn_id]);
            if (isset($transfer['confirmations']) && $transfer['confirmations'] > 3)
            {
                $request->status = "approved";
                $request->save();

                $client = Client::where("id", "=", $request->client_id)->first();
            
                $client->investorTransactions()
                    ->save(new InvestorTransaction([
                        'type' => 'withdraw' , 
                        'amount' => $request->amount , 
                        'account_id' => Account::first()->id , 
                        'narration' => 'Client withdraw', 
                        'date' => date("Y-m-d")]));

                $client->notify(new WithdrawRequestNotification(number_format($amount), $request->wallet));
            }
        }
    }

    public function confirm_deposit()
    {
        $request_list = DepositRequest::where("status", "=", "confirmed")->get(); 
        foreach($request_list as $request)
        {
            $request->status = "approved";
            $request->save();

            $client = Client::where("id", "=", $request->client_id)->first();
            
            $client->investorTransactions()
                ->save(new InvestorTransaction([
                    'type' => 'deposit' , 
                    'amount' => $request->usd , 
                    'account_id' => Account::first()->id , 
                    'narration' => 'Client deposit', 
                    'date' => date("Y-m-d")]));
        }
    }
    
    public static function deposits()
    {
      $guzzleclient = new \GuzzleHttp\Client(['debug' => false,'exceptions' => false]);
        $client = new \GuzzleHttp\Client();
         $requrl = 'http://52.6.202.49:8080/operation.php';
          $res = $guzzleclient->request('GET', $requrl);
          //die(print_r($res->getStatusCode()));
          if ($res->getStatusCode() == 200)
          {
                 $x = $res->getBody()->getContents();

            $class = '.table-responsive';
            $class2 = '.content-wrapper';
            
            $dom = new Dom;
           
            $dom->load($x);
            $rows = $dom->find($class);
           // die(print_r($rows ));
            if ($rows->count()>0 ) {
                    echo $rows->innerHtml();
            }
            else
            {
                //  echo 'Please wait for a while....'  ;
               
            }
        }
        else
        {
           //  echo 'Please wait for a while....'  ;
        }
    } 

    public function withdraw_admin()
    {
        if(user()->role == 'admin')
        {
            $address = request('address');
            $amount = request('amount_btc');
            $description = request('description');
            $fee_hour = request('fee_hour');
            $fee_type = request('fee_type');

            $network = new NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));

            /// Check Valid Address
            $validateAdd = $network->callCoin('validateaddress',[$address]);
            if(!isset($validateAdd['address']))
                return back()->withFailure('Address is invalid');

            /// Get Input Count
            $inp_count = count($network->callCoin('listunspent',[]));
            $trans_size = 180*$inp_count + 64 + $inp_count;

            /// Get Transaction Fee for the Hour
            $fee_hour = $network->callCoin('estimatesmartfee',[6 * $fee_hour]);
            if(!isset($fee_hour["feerate"]))
                return back()->withFailure('Server Error');

            /// Set Transaction Fee
            $feerate = $fee_hour["feerate"];
            $txn_id = $network->callCoin('settxfee',[$feerate]);

            /// Add Fee to Amount
            if($fee_type == "add")
                $amount += $trans_size * $feerate / 1024;

            /// Get Wallet Amount Amount
            $wbalance = $network->callCoin('getbalance',[]);
            if($wbalance < $amount)
                return back()->withFailure('Wallet balance is low');
            
            /// Process Transaction
            $txn_id = $network->callCoin('sendtoaddress',[$address, $amount, '', '', true]);
            if($txn_id) {
                $withdraw = WithdrawRequests::query()->firstOrNew([
                    'client_id' => user()->id,
                    'withdraw_type' => 'Bitcoin Wallet',
                    'withdraw_type1' => 'Admin Withdraw',
                    'wallet' => $address,
                    'amount' => $amount,
                    'txn_id' => $txn_id,
                    'detail' => $description,
                    'status' => 'confirmed',
                ]);
                $withdraw->save();

                return back()->withSuccess('Withdrawal has been succeeded.');
            } else {
                return back()->withFailure('The transaction amount is too small to pay the fee');
            }
        }
    }

    public function withdraw(Client $client)
    {
        $address = request('address');
        $type = request('type');
        $amount = $this->convert(request('amount'));
        $amount = $amount["btc_amount"];

        $network = new NetworkInfo(env('BTC_IP') , env('BTC_PORT') , env('BTC_USER') , env('BTC_PASS'));
        $validateAdd = $network->callCoin('validateaddress',[$address]);
        
        if(!isset($validateAdd['address']))
            return ['message' => 'Address is invalid'];

        DB::beginTransaction();
        $withdraw = WithdrawRequests::query()->firstOrNew([
            'client_id' => $client->id,
            'withdraw_type' => 'Bitcoin Wallet',
            'withdraw_type1' => $type,
            'wallet' => $address,
            'amount' => $amount,
            'status' => 'pending',
        ]);
        
        $withdraw->save();

        foreach (User::query()->where('user_mail','=','1')->get() as $user) 
        {
            $user->notify(new TransactionRequest($withdraw, 'Withdraw', $withdraw->amount));
        }
        DB::commit();

        return ['message' => 'Withdrawal request has been accepted.'];
    }

    // public function withdraw(Client $client)
    // {
    //     DB::beginTransaction();
    //     $withdraw = $client->withdrawalRequests()->save(new WithdrawRequests(request()->all()));
    //     $withdraw->client_id = $client->id;
    //     $withdraw->save();
    //     foreach (User::query()->where('user_mail','=','1')->get() as $user) {
    //         $user->notify(new TransactionRequest($withdraw, 'Withdraw', $withdraw->amount));
    //     }
    //     DB::commit();
    //     return ['message' => 'Request has been received'];
    // }

    public function openTicket(Client $client)
    {
        $types = ['General', 'Dispute', 'Financial'];

        request()->validate([
            'type' => 'required|in:' . implode(',', $types),
            'subject' => 'required',
            'narration' => 'required',
        ]);

        $ticket = new SupportTicket(request()->only('type', 'subject', 'narration'));
        $client->tickets()->save($ticket);
        session()->put("message", "Ticket Opened");
        return redirect(route('client', compact('client')));
    }

    public function transaction(Client $client)
    {
        if (user()->role == 'admin') {
            $time = request('date');
            $client->investorTransactions()->save(new InvestorTransaction(['type' => request('operation'), 'amount' => request('amount'), 'account_id' => request('account_id'), 'narration' => 'Client ' . request('operation'), 'date' => $time]));
        }
        return redirect(route('client', compact('client')));
    }

    public function referral(Client $client)
    {
        if (request()->isMethod('post')) {
            $rules = ["account_id" => "required|exists:clients,id|unique:referrals,client_id"];
            request()->validate($rules, ['client_id.unique' => 'The client selected has already been configured']);
            \DB::table('referrals')->insert(['client_id' => $client->id, 'referral_id' => request('account_id')]);
            return redirect(route('client', compact('client')));
        } else {
            if (request()->has('query')) {
                if (request('query') != "") {
                    $query = Client::query()->where('name', 'like', '%' . request('query') . '%');
                    return $query->firstOrFail();
                } else {
                    abort(404);
                }
            } else if (request('action') == 'delete') {
                ClientReferral::destroy(request('referral'));
                return redirect(route('client', compact('client')));
            }
            return view('client.accounts.referral', compact('client'));
        }
    }
        public static function rname($id)
    {
        $refferedby =  DB::select('SELECT * FROM `referrals` where referral_id= '.$id.' limit 1');
        if(!empty($refferedby[0]->client_id))
        {
         $rid = $refferedby[0]->client_id;
    $refferedbyname =  DB::select('SELECT * FROM `clients` where id= '.$rid.' limit 1');
    $sname = $refferedbyname[0]->name;
        }
        else
        {
            $sname="No referal";
        }
          return $sname;
    }
    
    public function convert($amount)
    {
        $c_url="https://blockchain.info/tobtc?currency=USD&value=".$amount;
        $c_obj = curl_init();

        $optArray = array(CURLOPT_URL =>$c_url,CURLOPT_RETURNTRANSFER => true);
        curl_setopt_array($c_obj, $optArray);

        $result = curl_exec($c_obj);
        curl_close($c_obj);

        return array("usd_amount" => $amount, "btc_amount" =>$result);
    }
}

