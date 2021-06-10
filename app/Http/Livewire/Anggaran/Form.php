<?php

namespace App\Http\Livewire\Anggaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\subrekening;
use App\Models\sub2rekening;
use App\Models\rekening;
use App\Models\kegiatan;
use App\Models\unit;
use App\Models\pengajuan;
use App\Models\anggaran;
use Livewire\Component;

class Form extends Component
{
    public function render()
    {
      $anggaran = unit::all();
      //dd($anggaran);
      return view('livewire.anggaran.form',["anggaran" => $anggaran]);
    }


    public function kegiatan(Request $request)
    {

        $unit_id = $request->unit_id;

        $kegiatan = anggaran::where('unit_id',$unit_id)
                            ->leftjoin('kegiatans', 'anggarans.kegiatan_id', '=', 'kegiatans.id')
                            ->distinct()
                            ->select('no_kegiatan','kegiatan_id','nama_kegiatan')
                            ->get();
        return response()->json([
            'json_kegiatan' => $kegiatan
        ]);
    }

    public function rekening(Request $request)
    {
        $unit_id = $request->unit_id;
        $kegiatan_id = $request->kegiatan_id;
        

        $rekening = anggaran::where('unit_id',$unit_id)
                            ->where('kegiatan_id',$kegiatan_id)
                            ->leftjoin('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
                            ->distinct()
                            ->select('no_rekening','rekening_id','nama_rekening')
                            ->get();
        return response()->json([
            'json_rekening' => $rekening
        ]);
    }


    public function subrekening(Request $request)
    {
        $unit_id = $request->unit_id;
        $kegiatan_id = $request->kegiatan_id;
        $rekening_id = $request->rekening_id;

        $subrekening = anggaran::where('unit_id',$unit_id)
                            ->where('kegiatan_id',$kegiatan_id)
                            ->where('rekening_id',$rekening_id)
                            ->leftjoin('subrekenings', 'anggarans.subrekening_id', '=', 'subrekenings.id')
                            ->distinct()
                            ->select('no_subrekening','subrekening_id','nama_subrekening')
                            ->get();
        return response()->json([
            'json_subrekening' => $subrekening
        ]);
    }

    public function sub2rekening(Request $request)
    {
        $unit_id = $request->unit_id;
        $kegiatan_id = $request->kegiatan_id;
        $rekening_id = $request->rekening_id;
        $subrekening_id = $request->subrekening_id;


        $sub2rekening = anggaran::where('unit_id',$unit_id)
                            ->where('kegiatan_id',$kegiatan_id)
                            ->where('rekening_id',$rekening_id)
                            ->where('subrekening_id',$subrekening_id)
                            ->leftjoin('sub2rekenings', 'anggarans.sub2rekening_id', '=', 'sub2rekenings.id')
                            ->distinct()
                            ->select('no_sub2rekening','sub2rekening_id','nama_sub2rekening')
                            ->get();
        return response()->json([
            'json_sub2rekening' => $sub2rekening
        ]);
    }


}
