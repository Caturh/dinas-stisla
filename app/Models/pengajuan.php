<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'kegiatan_id', 'rekening_id', 'unit_id','subrekening_id','sub2rekening_id','tanggal_buat','jml_pencairan','no_dokpencairan'];
}
