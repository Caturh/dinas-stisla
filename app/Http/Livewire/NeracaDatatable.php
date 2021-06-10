<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\pengajuan;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NeracaDatatable extends LivewireDatatable
{
    public $model;
    public $pengajuans,$kegiatans,$rekenings,$units,$ajuans, $kegiatan_id, $rekening_id, $unit_id, $tanggal_buat, $pengajuan_id;
    public $exportable = true;


    public function builder()
    {

        DB::enableQueryLog();
            return pengajuan::query()
            ->leftjoin('kegiatans', 'pengajuans.kegiatan_id', '=', 'kegiatans.id')
            ->leftjoin('rekenings', 'pengajuans.rekening_id', '=', 'rekenings.id')
            ->leftjoin('units', 'pengajuans.unit_id', '=', 'units.id')
	        ->select('kegiatans.no_kegiatan','kegiatans.nama_kegiatan','rekenings.no_rekening','rekenings.nama_rekening','units.no_unit','units.nama_unit','tanggal_buat','pengajuans.id as pengajuan_id',DB::raw('YEAR(tanggal_buat) AS tahun, MONTH(tanggal_buat) AS bulan'))
            ->groupBy('no_kegiatan','bulan');
    }
    function columns()
    {
    	return [
    		//NumberColumn::name('id')->label('ID')->sortBy('id'),
            Column::name('kegiatans.no_kegiatan')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            //->filterable()
            ,
    		Column::name('kegiatans.nama_kegiatan')
            ->label('Kegiatan')
            //->truncate()
            ->searchable()
            //->filterable()
            ,
            Column::name('rekenings.no_rekening')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            //->filterable()
            ,
    		Column::name('rekenings.nama_rekening')
            ->label('No Rekening')
            //->truncate()
            ->searchable()
            //->filterable()
            ,
            Column::name('units.no_unit')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            //->filterable()
            ,
    		Column::name('units.nama_unit')
            ->label('Unit')
            //->truncate()
            ->searchable()
            //->filterable()
            ,
            DateColumn::name('tanggal_buat AS tanggal2')
            ->label('Bulan')
            ->format('F')
            ->searchable()
            ->sortBy(DB::raw('DATE_FORMAT(tanggal_buat, "%m")'))
            //->filterable()
            ,
            NumberColumn::raw('SUM(jml_pencairan) AS jumlah')
            ->label('Jumlah Pencairan')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
    	];
    }

    public function saved()
    {
        $this->builder();
    }
}
