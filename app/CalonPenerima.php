<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CalonPenerima;

class CalonPenerima extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function relasis()
    {
        return $this->hasMany(CalonPenerima::class,'id_calon_penerima');
    }
}
