<?php


namespace App\Foundation\Statement;


use App\Account;
use PHPHtmlParser\Dom;

class DomExtract
{
    public $account = 0;

    public $currency = 0;

    public $balance = 0;

    public $equity = 0;

    public $freeMargin = 0;

    public $transactions = [];

    public static function process($file)
    {
        ini_set('memory_limit', '1024M');
        $extract = new static();
        $dom = new Dom;
        $dom->loadFromFile($file);
        $rows = $dom->find('tr');
        $extract->account = explode(" ", $rows[0]->find('td > b')[0]->text)[1];
        if (Account::query()->where('account', $extract->account)->exists()) {
            $extract->currency = explode(" ", $rows[0]->find('td > b')[2]->text)[1];
            $extract->balance = parse_number($rows[count($rows) - 1]->find('td > b')[1]->text);
            $extract->equity = parse_number($rows[count($rows) - 1]->find('td > b')[3]->text);
            $extract->freeMargin = parse_number($rows[count($rows) - 1]->find('td > b')[5]->text);

            foreach ($rows as $index => $row) {
                if ($index > 1) {
                    $pieces = $row->find('td');
                    if ($pieces[0]->text == "Working Orders:") {
                        break;
                    } else if ($pieces[0]->text != "Ticket" && ($pieces->count() == 14 || ($pieces->count() > 2 && $pieces[2]->text == 'balance'))) {
                        $transaction = new TransactionExtract();
                        $transaction->dom = $extract;
                        $transaction->ticket = $pieces[0]->text;
                        $transaction->type = $pieces[2]->text;
                        $transaction->date = str_replace(".", "-", str_replace("&nbsp;", "", $pieces[1]->text));
                        if (in_array($transaction->type, ['buy', 'sell'])) {
                            $transaction->size = $pieces[3]->text;
                            $transaction->item = $pieces[4]->text;
                            $transaction->commission = parse_number($pieces[10]->text);
                            $transaction->swap = parse_number($pieces[12]->text);
                            $transaction->closed_at = str_replace(".", "-", str_replace("&nbsp;", "", $pieces[8]->text));
                            $transaction->profit = parse_number($pieces[13]->text);
                            if ($transaction->closed_at == "") {
                                $transaction->closed_at = null;
                            }
                        } else if ($transaction->type == 'balance') {
                            continue;
                        }
                        $extract->transactions[] = $transaction;
                    }
                }
            }
            Account::importFromExtract($extract);
        }
    }
}
