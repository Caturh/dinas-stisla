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

class TableAction extends Component
{


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
        if($id){
            pengajuan::where('id',$id)->delete();
            session()->flash('message', 'pengajuan Deleted Successfully.');
        }
    }

}
