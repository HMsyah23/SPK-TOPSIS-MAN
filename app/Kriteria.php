<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subkriteria;

class Kriteria extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class,'id_kriteria');
    }
}
