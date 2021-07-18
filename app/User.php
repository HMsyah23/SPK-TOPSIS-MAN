<?php

namespace App;

use App\CalonPenerima;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    public $timestamps = false;
    protected $guarded = [];

    public function calon()
    {
        return $this->hasOne(CalonPenerima::class,'id_user');
    }

}
