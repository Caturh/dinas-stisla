<?php

use App\Http\Controllers\AnggaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pengajuans;
use App\Http\Livewire\LivewireDatatables;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('pengajuan', [pengajuans::class, 'index'])->name('pengajuan.index');
Route::delete('/deletePengajuan/{id}', [pengajuans::class, 'deletePengajuan'])->name('deletePengajuan');

Route::get('anggaran', [AnggaranController::class, 'index'])->name('anggaran.index');
Route::post('kegiatan', [AnggaranController::class, 'kegiatan'])->name('kegiatan');
Route::post('rekening', [AnggaranController::class, 'rekening'])->name('rekening');
Route::post('subrekening', [AnggaranController::class, 'subrekening'])->name('subrekening');
Route::post('sub2rekening', [AnggaranController::class, 'sub2rekening'])->name('sub2rekening');
Route::post('insertanggaran', [AnggaranController::class, 'insertanggaran'])->name('insertanggaran');
