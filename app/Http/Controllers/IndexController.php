<?php

namespace App\Http\Controllers;

use App\VirtualAccount;
use App\VirtualClient;
use App\VirtualTransaction;
use App\VirtualNames;
use App\User;
use App\Notifications\ContactRequest;

class IndexController extends Controller
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $date = date("Y-m-d H:i:s");
        session()->put("date", $date);
        
        $data["account_list"] = VirtualAccount::orderby('amount', 'desc')
            ->paginate(7);
        $data["pclient_list"] = VirtualClient::orderby('profit', 'desc')
            ->paginate(10);

        $data["deposit_list"] = VirtualTransaction::where('type', '=', '1')
            ->where('created_at', '<=', $date)
            ->orderby("created_at", "desc")
            ->take(10)
            ->get();
        $data["withdraw_list"] = VirtualTransaction::where('type', '=', '0')
            ->where('created_at', '<=', $date)
            ->orderby("created_at", "desc")
            ->take(10)
            ->get();


        $data["registered_account"] = round((strtotime("now") - strtotime("2016-02-27 02:00:00")) /  15000) + VirtualAccount::sum('counts');
        $data["invested_amoumt"] = round((strtotime("now") - strtotime("1980-03-27 02:00:00")) /  150) + VirtualAccount::sum('amount');
        $data["average_amoumt"] = $data["invested_amoumt"] / $data["registered_account"];
        $data["aibot_dates"] = round((strtotime("now") - strtotime("2019-05-16 02:00:00")) /  3600 / 24);

        return view('index.index', $data);
    }

    public function investor()
    {
        $account_list = VirtualAccount::get();

        foreach ($account_list as $account) {
            if(rand() % 10 <= 4) {
                $account->amount = $account->amount + rand() % 5;
                $account->counts = $account->counts + rand() % 3;
                $account->save();
            }
        }

        echo json_encode(array('status' => 'success'));
    }

    public function client()
    {
        $client_list = VirtualClient::get();

        foreach ($client_list as $client) {
            $client->deposit = rand() % 10 < 1 ? $client->deposit + rand() % 10 : $client->deposit;
            $client->withdraw = rand() % 10 < 1 ? $client->withdraw + rand() % 7 : $client->withdraw;
            $client->profit = $client->profit + $client->deposit / 104;
            $client->save();
        }

        echo json_encode(array('status' => 'success'));
    }

    public function mail()
    {
        foreach (User::query()->where('user_mail', '=', '1')->get() as $user)
        {
           $user->notify(new ContactRequest(request("name"), request("email"), request("message")));
        }

        echo json_encode(array("success" => "true"));
    }
    
    public function transaction()
    {
        $count = rand() % 3;

        for($i = 0; $i < $count; $i ++)
        {
            if(rand() % 1000 < 100)
                $amount = rand() % 10000;
            else if(rand() % 1000 < 300)
                $amount = rand() % 1000;
            else
                $amount = rand() % 100;

            if($amount < 50)
                $amount = 50;

            $amount = $amount - $amount % 10 + 10;

            $transaction = VirtualTransaction::query()->firstOrNew([
                'type' => rand() % 2,
                'vclient_id' => rand() % VirtualNames::count(),
                'amount' => $amount,
                'created_at' => date("Y-m-d H:i:s", mt_rand(time(), time() + rand() % 120)),
                'updated_at' => date("Y-m-d H:i:s", mt_rand(time(), time() + rand() % 120)),
            ]);
            $transaction->save();
        }
    }
    
    public function transdata()
    {
        $ndate = date("Y-m-d H:i:s");
        $odate = session()->get("date");
        session()->put("date", $ndate);

        $deposit_list = VirtualTransaction::where('type', '=', '1')
            ->where('created_at', '<=', $ndate)
            ->where('created_at', '>', $odate)
            ->orderby("created_at", "desc")->take(10)->get();

        foreach ($deposit_list as $key => $deposit) {
            $deposit_list[$key] = array(
                'name' => $deposit->client->firstname . " " . $deposit->client->lastname,
                'amount' => number_format($deposit->amount, 2),
                'date' => $deposit->created_at->toDateTimeString(),
            );
        }

        $withdraw_list = VirtualTransaction::where('type', '=', '0')
            ->where('created_at', '<=', $ndate)
            ->where('created_at', '>', $odate)
            ->orderby("created_at", "desc")->take(10)->get();

        foreach ($withdraw_list as $key => $withdraw) {
            $withdraw_list[$key] = array(
                'name' => $withdraw->client->firstname . " " . $withdraw->client->lastname,
                'amount' => number_format($withdraw->amount, 2),
                'date' => $withdraw->created_at->toDateTimeString(),
            );
        }

        echo json_encode(array("deposit_list" => $deposit_list, "withdraw_list" => $withdraw_list));
    }
}
