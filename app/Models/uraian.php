<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uraian extends Model
{
    use HasFactory;
    public function ajuan()
    {
     return $this->belongsTo('App\models\ajuan');
    }

    
}
