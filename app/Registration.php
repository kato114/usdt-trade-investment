<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Registration extends Model
{
    use Notifiable;

    protected $guarded = ['id'];

    public function selfieProof()
    {
        return $this->belongsTo(File::class, 'selfie_upload');
    }

    public function addressProof()
    {
        return $this->belongsTo(File::class, 'residential_upload');
    }

    public function idNumberProof()
    {
        return $this->belongsTo(File::class, 'id_number_upload');
    }

    public function apply()
    {
        $client = new Client([
            'name' => $this->name,
            'email' => $this->email,
            'commission' => 50,
            'status' => 'active',
            'client_deposit_total' => true,
            'password' => $this->password
        ]);
        $client->save();
    }
}
