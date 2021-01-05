<?php

namespace App;

use App\Foundation\Statement\TransactionExtract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id', 'dom'];
    protected $dates = ['date'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public static function fromExtract(TransactionExtract $extract)
    {
        $transaction = static::query()
            ->firstOrNew(['ticket' => $extract->ticket, 'client_id' => null]);
        $transaction->fill((array)$extract);
        $transaction->save();
    }

    public function scopeProfit(Builder $query)
    {
        return $query
            ->where('type', 'profit')
            ->sum('amount');
    }

    public function balanceAt($date)
    {
        return ($this->transactions()
            ->where('date', '<=', $date)
            ->selectRaw("sum( CASE WHEN type = 'withdrawal' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate')) ?: 0;
    }

    public function investorTransaction()
    {
        return $this->hasOne(InvestorTransaction::class);
    }

    public function scopeBalance(Builder $query)
    {
        return ($query
            ->whereIn('type', ['withdrawal', 'deposit'])
            ->selectRaw("sum( CASE WHEN type = 'withdrawal' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate')) ?: 0;
    }

    public function scopeDeposits(Builder $query)
    {
        return $query
            ->where('type', 'deposit');
    }

    public function scopeByAdminRole(Builder $query)
    {
        return user()->club == '*' ? $query : $query->whereIn('account_id', Account::query()->whereIn('server_id', Server::query()->where('name', 'regexp', sprintf("^(P)"))->pluck('id'))->pluck('id'));
    }

    public function scopeBalanceAt($query, $date)
    {
        return ($query->where('date', '<=', $date)
            ->selectRaw("sum( CASE WHEN type = 'withdrawal' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate')) ?: 0;
    }

    public function scopeWithdrawals(Builder $query)
    {
        return $query
            ->where('type', 'withdrawal');
    }
}
