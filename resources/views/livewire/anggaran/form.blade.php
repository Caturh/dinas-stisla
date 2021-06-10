<div class="mt-6" x-data="{ open: false }">

<!-- Button (blue), duh! -->
<button class="px-4 py-2 text-white bg-blue-500 rounded select-none no-outline focus:shadow-outline" @click="open = true" style="z-index:9999">Open Modal</button>

<!-- Dialog (full screen) -->
<div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.7); z-index:9999" x-show="open" x-cloak>

  <!-- A basic modal dialog with title, body and one button to close -->
  <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false" style="z-index:9999" x-cloak>
	<div class="mt-3 text-left sm:mt-0 sm:ml-4 sm:text-left">
	  <h2 class="text-lg font-medium leading-6 text-gray-900">
		Modal Title
	  </h2>

	  <div class="mt-2">
	  <form action="" >
	  @csrf <!-- {{ csrf_field() }} -->

										<h5>UNIT</h5>
										<select class="browser-default custom-select" name="unit" id="unit">
											<option selected>Pilih Unit</option>
@foreach ($anggaran as $item)
											<option value="{{ $item->id }}">{{ $item->no_unit }} {{ $item->nama_unit }}</option>
@endforeach
										</select>
										<h5>KEGIATAN</h5>
										<select class="browser-default custom-select" name="kegiatan" id="kegiatan"></select>
                                        <h5>REKENING</h5>
										<select class="browser-default custom-select" name="rekening" id="rekening"></select>
										<h5>SUB REKENING</h5>
										<select class="browser-default custom-select" name="subrekening" id="subrekening"></select>
                                        <h5>KETERANGAN</h5>
										<select class="browser-default custom-select" name="sub2rekening" id="sub2rekening"></select>

										<div class="mt-4">
										<h5>Tanggal Pencairan</h5>
										<input type="text" class="form-control" name="tanggal_buat" id="tanggal_buat" placeholder="Please select Date Time" wire:model="tanggal_buat" data-input style="width:450px" />
										</div>
										<div class="mt-4">
										<h5>Jumlah Pencairan</h5>
										<input type="text" class="form-control" name="jml_pencairan" id="jml_pencairan"  data-type="currency" data-input   style="width:450px"/>
										<h5>No Dokumen Pencairan</h5>
										<input type="text" class="form-control" name="no_dokpencairan" id="no_dokpencairan"  style="width:450px"/>
										</div>



            <span class="flex w-full rounded-md shadow-sm">
                <div class="form-group">
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
                <button @click="open = false" id="close" class="inline-flex justify-center px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                  Close this modal!
                </button>
              </span>
                                    </form>
	</div>
  </div>

  </div>
</div>
</div>

