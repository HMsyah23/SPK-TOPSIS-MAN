<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CalonPenerima;
use App\Subkriteria;

class NilaiCalon extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function calon(){
        return $this->belongsTo(CalonPenerima::class,'id_calon_penerima');
    }

    public function c1(){
        return $this->belongsTo(Subkriteria::class,'C1');
    }

    public function c2(){
        return $this->belongsTo(Subkriteria::class,'C2');
    }

    public function c3(){
        return $this->belongsTo(Subkriteria::class,'C3');
    }

    public function c4(){
        return $this->belongsTo(Subkriteria::class,'C4');
    }
}
