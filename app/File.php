<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $guarded = ['id'];

    public static function from(UploadedFile $file, $directory)
    {
        $static = new static();
        $static->path = $file->storePublicly("public/{$directory}", []);
        $static->disk = config('filesystems.default');
        $static->name = $file->getClientOriginalName();
        $static->save();
        return $static;
    }

    public function getLinkAttribute()
    {
        return url(Storage::disk($this->disk)->url($this->path));
    }

    public function getMimeTypeAttribute()
    {
        return \GuzzleHttp\Psr7\mimetype_from_filename($this->name);
    }
}
