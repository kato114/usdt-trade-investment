<?php

namespace App;

use App\Foundation\Statement\EmailExtract;
use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $role = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'notes', 'status', 'commission', 'payload', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoAttribute()
    {
        if ($this->photos()->count() > 0) {
            return $this->photos()->first()->link;
        }
        return Photo::avatar();
    }

    public function investorTransactions()
    {
        return $this->hasMany(InvestorTransaction::class, 'investor_id');
    }


    public function getAccountBalanceAttribute()
    {
        return $this->investorTransactions()->balance();
    }

    public function getReferrerAttribute()
    {
        return Client::query()
            ->find(
                optional(ClientReferral::query()
                    ->where('referral_id', $this->id)
                    ->first())
                    ->client_id);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, "profile");
    }

    public function scopeByAdminRole(Builder $query)
    {
        return user()->club == '*' ? $query : $query->where('club', 'regexp', sprintf("^(P)"));
    }

    public function getBalanceAttribute()
    {
        return $this->balanceAt(now()->endOfDay());
    }

    public function getPayloadAttribute()
    {
        return optional(json_decode($this->attributes['payload']));
    }

    public function setPayloadAttribute($details)
    {
        $this->attributes['payload'] = json_encode($details);
    }

    public function transactions()
    {
        return $this->hasMany(InvestorTransaction::class, 'investor_id');
    }

    public function getOpenedAtAttribute()
    {
        return coalesce(optional($this->transactions()->orderBy('date', 'asc')->first())->date, now());
    }

    public function chartOf($type)
    {
        switch ($type) {
            case  'weekly':
                return $this->weeklyChart();
            case  'monthly':
                return $this->monthlyChart();
            default:
                return $this->dailyChart();
        }
    }

    private function dailyChart()
    {
        $response = [ 'id' => $this->id, 'columns' => [['sample']], 'labels' => [] ];
        foreach ($this->transactions()->orderBy('date', 'asc')->get() as $transaction) {
            if(!in_array($transaction->date->format('D d, M Y'), $response['labels'])) 
            {
                $response['labels'][] = $transaction->date->format('D d, M Y');
                $response['columns'][0][] = round($this->balanceDWP($transaction->date->subDays(-1)),2);
            }
        }
        return $response;
    }

    private function weeklyChart()
    {
        $response = [
            'id' => $this->id,
            'labels' => [], 'series' => ['data']];
        foreach (range(8, 0) as $x) {
            $response['labels'][] = "Week " . now()->subWeeks($x)->format('W');
            $response['series'][] = $this->transactions()
                ->where('date', '<=',
                    now()->subWeeks($x)->endOfWeek())
                ->profit();
        }
        return $response;
    }

    private function monthlyChart()
    {
        $response = [
            'id' => $this->id,
            'labels' => [], 'series' => ['data']];
        foreach (range(12, 0) as $x) {
            $response['labels'][] = now()->subMonths($x)->format('M');
            $response['series'][] = $this->transactions()
                ->where('date', '<=',
                    now()->subMonths($x)->endOfMonth()
                )
                ->profit();
        }
        return $response;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposits()
    {
        return $this->hasMany(DepositRequest::class);
    }

    public function referrals()
    {
        return $this->hasMany(ClientReferral::class);
    }

    public function balanceAt($date)
    {
        return ($this->transactions()
            ->where('date', '<=', $date)
            ->selectRaw("sum(CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate')) ?: 0;
    }

    public function balanceDWP($date)
    {
        $deposit = ($this->transactions()->where('date', '<=', $date)
            ->where('type', 'deposit')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
        $withdraw = ($this->transactions()->where('date', '<=', $date)
            ->where('type', 'withdraw')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
        $profit = $this->transactions()->where('date', '<', $date)
           ->where('type', 'profit')
          ->selectRaw("sum( amount ) as aggregate")->value('aggregate') ?: 0;
    
        return $profit + $deposit - $withdraw;
    }


    public function profitOne($date, $flag = false)
    {
        if($flag)
         return ($this->transactions()->where('date', 'like', substr($date, 0, 10) . "%")
           ->where('type', 'profit')->where('narration', 'Profit')
          ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
        else
         return ($this->transactions()->where('date', 'like', substr($date, 0, 10) . "%")
           ->where('type', 'profit')
          ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }
    
    public function profitAt($date)
    {
		 return ($this->transactions()->where('date', '<=', $date)
           ->where('type', 'profit')
          ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }

   public function pprofitAt($date)
    {
        return ($this->transactions()
            ->where('date', '<=', $date)
            ->where('type', 'profit')
            ->selectRaw("sum(CASE WHEN type = 'withdraw' THEN 0 - amount ELSE amount END ) as aggregate")->value('aggregate')) ?: 0;
    }
    public function depositAt($date)
    {
        return ($this->transactions()->where('date', '<=', $date)
            ->where('type', 'deposit')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }
 
    
 public function withdrawAt($date)
    {
		//die(print_r("sd"));
        return ($this->transactions()->where('date', '<=', $date)
            ->where('type', 'withdraw')
            ->selectRaw("sum( amount ) as aggregate")->value('aggregate')) ?: 0;
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class, 'member_id');
    }

    public function account()
    {
        return $this->belongsTo(Inve::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawRequests::class);
    }

}
