<?php

namespace App\Http\Livewire\Pengajuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\subrekening;
use App\Models\sub2rekening;
use App\Models\rekening;
use App\Models\kegiatan;
use App\Models\unit;
use App\Models\pengajuan;
use Livewire\Component;

class Form extends Component
{

    public $defaultkeg, $defaultrek, $defaultunit = '';

    public function render()
    {

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

        return view('livewire.pengajuan.form',['rekenings'=>$rekenings,'kegiatans'=>$kegiatans,'units'=>$units,'subrekenings'=>$subrekenings,'sub2rekenings'=>$sub2rekenings]);
    }

    /**
     * Indicates if Post deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingPengajuanCreation = false;
    public $name = '';
    public $select = '';
    public $select2 = '';
    public $select3 = '';
    public $select4 = '';
    public $select5 = '';
    //public $kegiatan_id = '';
    //public $rekening_id = '';
    //public $subrekening_id = '';
    //public $sub2rekening_id = '';
    //public $unit_id = '';
    public $tanggal_buat = '';
    public $jml_pencairan = '';
    public $replace = array("Rp "," ",",");
    public $jml_pencairan2 = '';
    public $jml_pencairan3 = '';
    public $pengajuan;
    public $pengajuanArray;

    protected $rules = [
        'select' => 'required|not_in:0',
        'select2' => 'required|not_in:0',
        'select3' => 'required|not_in:0',
        'tanggal_buat' => 'required|string',
        'jml_pencairan' => 'required|string',
    ];

    /**
     * Confirm that the User would like to create Post.
     *
     * @return void
     */
    public function confirmPengajuanCreate()
    {
        $this->password = '';

        $this->dispatchBrowserEvent('confirming-create-post');

        $this->confirmingPengajuanCreation = true;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */


    /**
     * Save Post.
     *
     * @return void
     */

    protected function clearForm()
    {
        $this->kegiatan_id = '';
        $this->rekening_id = '';
        $this->unit_id = '';
        $this->subrekening_id = '';
        $this->sub2rekening_id = '';
        $this->tanggal_buat = '';
        $this->jml_pencairan = '';
        $this->jml_pencairan2 = '';
    }


    public function savePengajuan()
    {
        $this->validate();


        $jml_pencairan2 = $this->jml_pencairan;
        $jml_pencairan2 = str_replace(",","",$jml_pencairan2);
        $jml_pencairan2 = str_replace("Rp ","",$jml_pencairan2);
        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU


        $jml_pencairan3 = pengajuan::updateOrCreate([
            'kegiatan_id' => $this->select,
            'rekening_id' => $this->select2,
            'unit_id' => $this->select3,
            'subrekening_id' => $this->select4,
            'sub2rekening_id' => $this->select5,
            'tanggal_buat' => $this->tanggal_buat,
            'jml_pencairan' => $jml_pencairan2
        ]);

        //dd($jml_pencairan3);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI


        session()->flash('message', 'Pencairan telah sukses di tambahkan.');

        $this->clearForm();

        $this->emit('refreshDropdown');

        $this->confirmingPengajuanCreation = false;
    }


}
