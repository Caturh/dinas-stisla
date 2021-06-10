<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\pengajuan;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NeracaDatatable2 extends LivewireDatatable
{
    public $model;
    public $pengajuans,$kegiatans,$rekenings,$units,$ajuans, $kegiatan_id, $rekening_id, $unit_id, $tanggal_buat, $pengajuan_id;
    //public $exportable = true;
    public $hideable = "inline";

    public function builder()
    {

        DB::enableQueryLog();
            return pengajuan::query()
            ->leftjoin('kegiatans', 'pengajuans.kegiatan_id', '=', 'kegiatans.id')
            ->leftjoin('rekenings', 'pengajuans.rekening_id', '=', 'rekenings.id')
            ->leftjoin('units', 'pengajuans.unit_id', '=', 'units.id')
	        ->select('kegiatans.no_kegiatan','kegiatans.nama_kegiatan','rekenings.no_rekening','rekenings.nama_rekening','units.no_unit','units.nama_unit','tanggal_buat','pengajuans.id as pengajuan_id',DB::raw('YEAR(tanggal_buat) AS tahun, MONTH(tanggal_buat) AS bulan'))
            ->groupBy('no_kegiatan',DB::raw('MONTH(tanggal_buat)'));
    }
    function columns()
    {
    	return [
    		//NumberColumn::name('id')->label('ID')->sortBy('id'),
            Column::name('kegiatans.no_kegiatan')
            ->label('Kegiatan')
            ->truncate(5)
            ->searchable()
            //->filterable()
            ,
    		Column::name('kegiatans.nama_kegiatan')
            ->label('Kegiatan')
            ->truncate(32)
            ->searchable()
            //==->filterable()
            ,
            Column::name('rekenings.no_rekening')
            ->label('Kegiatan')
            ->truncate(7)
            ->searchable()
            //->filterable()
            ,
    		Column::name('rekenings.nama_rekening')
            ->label('No Rekening')
            ->truncate(32)
            ->searchable()
            //->filterable()
            ,
            Column::name('units.no_unit')
            ->label('Kegiatan')
            ->truncate(7)
            ->searchable()
            //->filterable()
            ,
    		Column::name('units.nama_unit')
            ->label('Unit')
            ->truncate(20)
            ->searchable()
            ->filterable()
            ,
            //DateColumn::name('tanggal_buat AS tanggal2')
            //->label('Bulan')
            //->format('F')
            //->searchable()
            //->sortBy(DB::raw('DATE_FORMAT(tanggal_buat, "%m")'))
            //->filterable()
            //,
            NumberColumn::raw('SUM(jml_pencairan) AS jumlah')
            ->label('Jumlah Pencairan')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 1, jml_pencairan, 0 ) ) AS januari,')
            ->label('Januari')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 2, jml_pencairan, 0 ) ) AS februari,')
            ->label('Februari')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 3, jml_pencairan, 0 ) ) AS maret,')
            ->label('Maret')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 4, jml_pencairan, 0 ) ) AS april,')
            ->label('April')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
           ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 5, jml_pencairan, 0 ) ) AS mei,')
            ->label('Mei')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 6, jml_pencairan, 0 ) ) AS juni,')
            ->label('Juni')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 7, jml_pencairan, 0 ) ) AS juli,')
            ->label('Juli')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 8, jml_pencairan, 0 ) ) AS agustus,')
            ->label('Agustus')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 9, jml_pencairan, 0 ) ) AS September,')
            ->label('September')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 10, jml_pencairan, 0 ) ) AS Oktober,')
            ->label('Oktober')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 11, jml_pencairan, 0 ) ) AS November,')
            ->label('November')
            ->view('livewire.pengajuan.currencyview')
            //->searchable()
            //->filterable()
            ,
            NumberColumn::raw('	SUM( IF ( MONTH ( tanggal_buat ) = 12, jml_pencairan, 0 ) ) AS Desember,')
            ->label('Desember')
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
