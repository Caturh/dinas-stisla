<?php

namespace App\Http\Livewire\Pengajuan;

use App\Models\rekening;
use App\Models\kegiatan;
use App\Models\unit;
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
        return view('livewire.pengajuan.form',['rekenings'=>$rekenings,'kegiatans'=>$kegiatans,'units'=>$units]);
    }

    /**
     * Indicates if Post deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingPostCreation = false;
    public $name = '';

    protected $rules = [
        'name' => 'required'
    ];

    /**
     * Confirm that the User would like to create Post.
     *
     * @return void
     */
    public function confirmPostCreate()
    {
        $this->password = '';

        $this->dispatchBrowserEvent('confirming-create-post');

        $this->confirmingPostCreation = true;
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
    public function savePost()
    {
        $this->validate();

        $this->resetErrorBag();

        $post = new Post();
        $post->name = $this->name;
        $post->save();

        $this->name = '';

        $this->emit('saved');

        $this->confirmingPostCreation = false;
    }
}
