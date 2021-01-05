<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InvestorTransaction extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function scopeProfit($query)
    {
        return $query
            ->where('type', 'profit')
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeProfitProfit($query)
    {
        return $query
            ->where('type', 'profit')
            ->where('narration', 'Profit')
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeProfitProfitDayAt($query, $date)
    {
        return $query
            ->where('type', 'profit')
            ->where('narration', 'Profit')
            ->where('date', '>=', $date->copy()->startOfDay())
            ->where('date', '<=', $date)
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }
    public function scopeProfitDayAt($query, $date)
    {
        return $query
            ->where('type', 'profit')
            ->where('date', '>=', $date->copy()->startOfDay())
            ->where('date', '<=', $date)
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeProfitLastMonth($query)
    {
        return $query
            ->where('type', 'profit')
            ->where('narration', 'Profit')
            ->where('date', '>=', now()->subDays(30)->startOfDay())
            ->where('date', '<=', now()->endOfDay())
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }
      public function scopeProfitLastDay($query,$date)
    {
        return $query
            ->where('type', 'profit')
            ->where('narration', 'Profit')
            ->where('date', '=', $date)
            ->where('date', '<=', now()->endOfDay())
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeProfitReferral($query)
    {
        return $query
            ->where('type', 'profit')
            ->where('narration', '!=', 'Profit')
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeProfitReferralDayAt($query, $date)
    {
        return $query
            ->where('type', 'profit')
            ->where('narration', '!=', 'Profit')
            ->where('date', '>=', $date->copy()->startOfDay())
            ->where('date', '<=', $date)
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate') ?: 0;
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }


    public function scopeDeposits($query)
    {
        return $query->where('type', 'deposit')->selectRaw("sum( amount ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeWithdrawals($query)
    {
        return $query->where('type', 'withdraw')->selectRaw("sum( amount ) as aggregate")->value('aggregate') ?: 0;
    }

    public function scopeBalanceAt(Builder $query, $date)
    {
        return ($query->where('date', '<=', $date)
            ->selectRaw("sum( CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate')) ?: 0;
    }

    public function scopeDepositAt(Builder $query, $date)
    {
        return ($query->where('date', '<=', $date)
            ->where('type', 'deposit')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }
    public function scopeProfitAt(Builder $query, $date)
    {
        return ($query->where('date', '<=', $date)
            ->where('type', 'profit')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }
     public function scopeWithdrawAt(Builder $query, $date)
    {
        return ($query->where('date', '<=', $date)
            ->where('type', 'withdraw')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }
  
    public function scopeBalance(Builder $query)
    {
        return $query->balanceAt(now()->endOfDay());
    }
}
