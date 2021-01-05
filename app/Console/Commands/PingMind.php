<?php

namespace App\Console\Commands;

use App\Account;
use App\Mail\MailMessage;
use App\Mail\SessionExpired;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PingMind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ping:mind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $account = Account::query()->find(cache('default_wallet'));
        $client = new Client(['allow_redirects' => false]);
        $cookies = new CookieJar();
        $cookies->setCookie(new SetCookie([
            'Name' => 'PHPSESSID',
            'Value' => $account->cookie,
            'Domain' => 'mind.capital',
            'Expires' => Carbon::now()->addDay(1)->toCookieString()]));
        $options = [
            RequestOptions::COOKIES => $cookies,
        ];
        $res = $client->get('https://mind.capital/admin/simuladoroperaciones', $options);
        if ($res->getStatusCode() != 200) {
            $this->comment("Token Failed");
         //   Mail::to(User::query()->get())->queue(new MailMessage('Session Expired', "The session for the background tasker['mindcapital'] for account '{$account->name}' has expired."));
        } else {
            $this->comment("Refreshed Token");
        }
    }
}
