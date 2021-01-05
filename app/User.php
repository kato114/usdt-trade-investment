<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $role = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status','acting_role'
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

    public function getPhoneNumberAttribute($value)
    {
        $phone = phone($value, $this->country_code);
        return $phone->formatE164();
    }

    public function getClubAttribute()
    {
        return $this->id < 4 ? '*' : 'P';
    }

    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = phone($value, $this->country_code)->formatE164();
    }

    public function getPhoneAttribute()
    {
        try {
            $phone = phone($this->attributes['phone_number'], $this->country_code);
            return $phone->formatInternational();
        } catch (\Exception $e) {
            return "";
        }
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, "profile");
    }

}
