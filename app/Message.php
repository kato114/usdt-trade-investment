<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function author()
    {
        return $this->morphTo("sender");
    }

    public function conversation()
    {
        return $this->morphTo();
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
