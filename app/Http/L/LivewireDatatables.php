<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\pengajuan; 
use App\Models\kegiatan;
use App\Models\rekening;
use App\Models\unit;
use App\Models\attachment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LivewireDatatables extends LivewireDatatable
{
    //public $model;
    public $pengajuans,$kegiatans,$rekenings,$units,$ajuans, $kegiatan_id, $rekening_id, $unit_id, $tanggal_buat, $pengajuan_id;
    public $exportable = true;

    
    public function builder()
    {

        DB::enableQueryLog();
            return pengajuan::query()
		  //$model = DB::table('pengajuans')
          //->join('ajuans', 'ajuans.pengajuan_id', '=', 'pengajuans.id')
            ->join('kegiatans', 'pengajuans.kegiatan_id', '=', 'kegiatans.id')
            ->join('rekenings', 'pengajuans.rekening_id', '=', 'rekenings.id')
            ->join('units', 'pengajuans.unit_id', '=', 'units.id')
          //->join('uraians', 'ajuans.uraian_id', '=', 'uraians.id')
	        ->select('kegiatans.no_kegiatan','kegiatans.nama_kegiatan','rekenings.no_rekening','rekenings.nama_rekening','units.no_unit','units.nama_unit','tanggal_buat','pengajuans.id as pengajuan_id');
		  //->orderBy('pengajuans.id','desc')
            //->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA
          //$this->kegiatans = $model;
    }
    function columns()
    {
    	return [




    		NumberColumn::name('id')->label('ID')->sortBy('id'),
			Column::name('kegiatans.nama_kegiatan')->label('Kegiatan')->searchable()->truncate(),
    		Column::name('rekenings.nama_rekening')->label('No Rekening')->searchable()->truncate(),
    		Column::name('units.nama_unit')->label('Unit')->searchable()->truncate(),
    		DateColumn::name('tanggal_buat')->label('Tanggal Buat')
            
    
        

    	];
    }
}