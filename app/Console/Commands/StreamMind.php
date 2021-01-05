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
use PHPHtmlParser\Dom;

class StreamMind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:mind';

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
        $res = $client->post('https://mind.capital/admin/simuladoroperaciones', $options);
       // die(print_r($res->getStatusCode()));
        if ($res->getStatusCode() == 200) {
            $class = '.table-responsive';
            $class2 = '.content-wrapper';
            $dom = new Dom;
            $dom->load($res->getBody()->getContents());
            $rows = $dom->find($class);
            if (5>6) {
                cache()->forever('stream', $rows->innerHtml());
            } else {
                $rows = $dom->find($class2);
                $empty = sprintf('<div class="jumbotron text-center bg-transparent">%s</div>','<div class="no-market-img"> <img src="https://arbitrage-trading.io/images/waiting.gif" alt=""> </div> ');
                $empty = str_replace('<p', '<h2', $empty);
                $empty = str_replace('p>', 'h2>', $empty);
                $empty = str_replace('badge-', 'bg-', $empty);
                $empty = str_replace('/admin/assets/images/waiting.gif', asset('images/waiting.gif'), $empty);
                cache()->forever('stream', $empty);
            }
            $this->comment('updated stream');
        }
    }
}
