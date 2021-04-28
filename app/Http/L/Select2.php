<?php
 
   
 
namespace App\Http\Livewire;
 
   
use App\Models\rekening;
use App\Models\kegiatan;
use App\Models\unit;
use Livewire\Component;
 
   
 
class Select2 extends Component
 
{
 
    public $defaultkeg, $defaultrek, $defaultunit = '';

 

 
    /**
 
     * Write code on Method
 
     *
 
     * @return response()
 
     */
 
    public function render()
 
    {
        $kegiatans = kegiatan::all();
		$this->kegiatans = $kegiatans;
		$rekenings = rekening::all();
		$this->rekenings = $rekenings;
        $units = unit::all();
		$this->units = $units;
        return view('livewire.select2',['rekenings'=>$rekenings,'kegiatans'=>$kegiatans,'units'=>$units])->extends('layouts.app');;
 
    }
 
 
}