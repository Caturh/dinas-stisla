<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\pengajuan;
use App\Models\kegiatan;
use App\Models\rekening;
use App\Models\unit;
use App\Models\ajuan;

class pengajuans extends Controller
{
    public function index()
    {
        return view('kegiatan.index');
    }
}
