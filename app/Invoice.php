<?php

namespace App;

use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getNumberAttribute()
    {
        return substr("000000" . $this->id, strlen($this->id), 6);
    }

    public function getInvoiceAttribute()
    {
        return $this->html;
    }

    public function scopeByAdminRole(Builder $query)
    {
        return user()->club == '*' ? $query : $query->whereIn('account_id', Account::query()->whereIn('server_id', Server::query()->where('name', 'regexp', sprintf("^(P)"))->pluck('id'))->pluck('id'));
    }

    public function getHtmlAttribute()
    {
        return view('client.invoice', ['invoice' => $this])->render();
    }

    public function getPdfAttribute()
    {
        $client = new \GuzzleHttp\Client();
        return $client->post('https://api.loopy.co.ke/v1/convert/pdf', [
            RequestOptions::FORM_PARAMS => [
                'name' => 'Invoice Number: ' . $this->number,
                'body' => $this->html
            ]
        ])->getBody()->getContents();
    }
}
