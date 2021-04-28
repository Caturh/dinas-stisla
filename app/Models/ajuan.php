<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ajuan extends Model
{
    use HasFactory;
	public function pengajuan(){
	return $this->belongsTo('App\Models\pengajuan');
    }

    public function uraian(){
    return $this->hasOne('App\Models\uraian','id','uraian_id');
    }
}
