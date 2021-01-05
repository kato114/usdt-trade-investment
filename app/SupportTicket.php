<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class,'member_id');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'conversation');
    }

    public function getStatusAttribute($value)
    {
        if ($this->deleted_at != null) {
            return 'closed';
        }else{
            return $value;
        }
    }
}
