<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\pengajuan;
use App\Models\subrekening;
use App\Models\sub2rekening;
use App\Models\rekening;
use App\Models\kegiatan;
use App\Models\unit;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PengajuanDatatable extends LivewireDatatable
{
    public $model;
    public $pengajuans,$kegiatans,$rekenings,$units,$ajuans, $kegiatan_id, $rekening_id, $unit_id, $tanggal_buat, $pengajuan_id,$jml_pencairan,$select,$select2,$select3,$select4,$select5;
    public $exportable = true;
    public $confirmingPengajuanCreation = false;

    public function builder()
    {

            DB::enableQueryLog();
            return pengajuan::query()
            ->leftjoin('kegiatans', 'pengajuans.kegiatan_id', '=', 'kegiatans.id')
            ->leftjoin('rekenings', 'pengajuans.rekening_id', '=', 'rekenings.id')
            ->leftjoin('subrekenings', 'pengajuans.subrekening_id', '=', 'subrekenings.id')
            ->leftjoin('sub2rekenings', 'pengajuans.sub2rekening_id', '=', 'sub2rekenings.id')
            ->leftjoin('units', 'pengajuans.unit_id', '=', 'units.id')
	        //->select('kegiatans.no_kegiatan','kegiatans.nama_kegiatan','rekenings.no_rekening','rekenings.nama_rekening','units.no_unit','units.nama_unit','tanggal_buat','pengajuans.id as pengajuan_id')
            ->orderBy('tanggal_buat','asc');
    }
    function columns()
    {
    	return [
    		//NumberColumn::name('id')
            //->label('ID')
            //->sortBy('id')
            //,
            Column::name('units.no_unit')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            //->filterable()
            ,
    		Column::name('units.nama_unit')
            ->label('Unit')
            ->truncate()
            ->searchable()
            ->filterable()
            ,
            Column::name('kegiatans.no_kegiatan')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            //->filterable()
            ,
    		Column::name('kegiatans.nama_kegiatan')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            ->filterable()
            ,
            Column::name('rekenings.no_rekening')
            ->label('Kegiatan')
            ->truncate()
            ->searchable()
            //->filterable()
            ,
    		Column::name('rekenings.nama_rekening')
            ->label('No Rekening')
            ->truncate()
            ->searchable()
            ->filterable()
            ,
            Column::name('subrekenings.nama_subrekening')
            ->label('')
            ->truncate()
            ->searchable()
            ->filterable()
            ,
            Column::name('sub2rekenings.nama_sub2rekening')
            ->label('')
            ->truncate()
            ->searchable()
            ->filterable()
            //,
            //Column::name('subrekening_id')
            //->label('')
            //->truncate()
            //->searchable()
            //->filterable()
            //,
            //Column::name('sub2rekening_id')
            //->label('')
            //->truncate()
            //->searchable()
            //->filterable()
            ,
    		DateColumn::name('tanggal_buat')
            ->label('Tanggal Buat')
            ->searchable()
            ->filterable()
            ,
    		Column::name('jml_pencairan')
            ->label('Jumlah Pencairan')
            ->view('livewire.pengajuan.currencyview')
            ->searchable()
            //->filterable()
            ,
            Column::delete()
            ,
            Column::callback(['id'], function ($id) {

        $hasil = DB::table('pengajuans')->find($id);
        $this->hasil = $hasil;
        $kegiatans = kegiatan::all();
		$this->kegiatans = $kegiatans;
		$rekenings = rekening::all();
		$this->rekenings = $rekenings;
        $units = unit::all();
		$this->units = $units;
        $subrekenings  = subrekening::all();
		$this->subrekening = $subrekenings;
        $sub2rekenings = sub2rekening::all();
		$this->sub2rekening = $sub2rekenings;

                return view('livewire.pengajuan.table-action', ['id' => $id,'rekenings'=>$rekenings,'kegiatans'=>$kegiatans,'units'=>$units,'subrekenings'=>$subrekenings,'sub2rekenings'=>$sub2rekenings,'hasil'=>$hasil]);
            })
            ->excludeFromExport()

    	];
    }

    public function saved()
    {
        $this->builder();
    }

    public function updatePengajuan()
    {
        //$validatedDate = $this->validate([
        //    'name' => 'required',
        //    'email' => 'required|email',
        //]);
        $jml_pencairan2 = $this->jml_pencairan;
        $jml_pencairan2 = str_replace(",","",$jml_pencairan2);
        $jml_pencairan2 = str_replace("Rp ","",$jml_pencairan2);

        if ($this->id) {
            $pengajuan = pengajuan::find($this->id);
            $pengajuan->update([
                'kegiatan_id' => $this->select,
                'rekening_id' => $this->select2,
                'unit_id' => $this->select3,
                'subrekening_id' => $this->select4,
                'sub2rekening_id' => $this->select5,
                'tanggal_buat' => $this->tanggal_buat,
                'jml_pencairan' => $jml_pencairan2
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Updated Successfully.');

        }
    }

    public function deletePengajuan($id)
    {

            pengajuan::destroy($id);
            session()->flash('message', 'pengajuan Deleted Successfully.');

    }
}
