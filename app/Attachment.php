<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public static function from(File $file)
    {
        return new static(['type_id' => $file->id, 'type' => class_basename($file)]);
    }

    public function attachable()
    {
        return $this->morphTo('attachable', 'type', 'type_id');
    }
}
