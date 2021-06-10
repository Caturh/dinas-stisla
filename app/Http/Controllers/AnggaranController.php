<?php
namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\subrekening;
use App\Models\sub2rekening;
use App\Models\kegiatan;
use App\Models\unit;
use App\Models\rekening;
use App\Models\pengajuan;


use Illuminate\Support\Facades\DB;
use illuminate\database\eloquent;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Response;


class AnggaranController extends Controller
{
    public function index(Request $request)
    {

      $anggaran = unit::all();
      //dd($anggaran);
      return view('menu.anggaran-index',["anggaran" => $anggaran]);
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

    public function insertanggaran(Request $request)
    {

        //dd(Request::all());
        //print_r(Input::all());
		$unit_id = $request->unit_id;
        $kegiatan_id = $request->kegiatan_id;
        $rekening_id = $request->rekening_id;
        $subrekening_id = $request->subrekening_id;
        $sub2rekening_id = $request->sub2rekening_id;
        $jml_pencairan2 = $request->jml_pencairan;
        $jml_pencairan2 = str_replace(",","",$jml_pencairan2);
        $jml_pencairan2 = str_replace("Rp ","",$jml_pencairan2);

        $anggaran = anggaran::where('unit_id',$unit_id)
        ->where('kegiatan_id',$kegiatan_id)
        ->where('rekening_id',$rekening_id)
        ->where('subrekening_id',$subrekening_id)
        ->where('sub2rekening_id',$sub2rekening_id)
        ->firstOrFail();

        $qty = $anggaran->jml_pencairan;

        $this->validate($request, [
            'unit_id' => 'required',
            'kegiatan_id' => 'required',
            'rekening_id' => 'required',
            'subrekening_id' => 'required',
            'sub2rekening_id' => 'required',
            'jml_pencairan' => 'required|numeric|min:1|max:'.$qty,
            'tanggal_buat' => 'required',
            'no_dokpencairan' => 'required',

        ]);



            pengajuan ::Create([
            'unit_id' => $unit_id, //This Code coming from ajax request
            'kegiatan_id' => $kegiatan_id, //This Code coming from ajax request
            'rekening_id' => $rekening_id, //This Chief coming from ajax request
            'subrekening_id' => $subrekening_id, //This Code coming from ajax request
            'sub2rekening_id' => $sub2rekening_id, //This Chief coming from ajax request
            'tanggal_buat' => $request->tanggal_buat, //This Chief coming from ajax request
            'jml_pencairan' => $jml_pencairan2, //This Code coming from ajax request
            'no_dokpencairan' => $request->no_dokpencairan, //This Chief coming from ajax request
        ]);


        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }


}
