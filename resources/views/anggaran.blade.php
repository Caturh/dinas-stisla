<x-app-layout>


<div class="container" style="margin-top: 50px; margin-left: 300px">
							<div class="row">
								<div class="col-lg-6">
									<form action="">
										<h4>UNIT</h4>
										<select class="browser-default custom-select" name="unit" id="unit">
											<option selected>Pilih Unit</option>
@foreach ($anggaran as $item)
											<option value="{{ $item->id }}">{{ $item->no_unit }} {{ $item->nama_unit }}</option>
@endforeach
										</select>
										<h4>KEGIATAN</h4>
										<select class="browser-default custom-select" name="kegiatan" id="kegiatan"></select>
                                        <h4>REKENING</h4>
										<select class="browser-default custom-select" name="rekening" id="rekening"></select>
										<h4>SUB REKENING</h4>
										<select class="browser-default custom-select" name="subrekening" id="subrekening"></select>
                                        <h4>KETERANGAN</h4>
										<select class="browser-default custom-select" name="sub2rekening" id="sub2rekening"></select>

										<div class="mt-4">
										<h4>Tanggal Pencairan</h4>
										<input type="text" class="form-control" name="tanggal_buat" id="basicDate" placeholder="Please select Date Time" wire:model="tanggal_buat" data-input style="width:450px" />
										</div>
										<div class="mt-4">
										<h4>Jumlah Pencairan</h4>
										<input type="text" class="form-control" name="jml_pencairan" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" data-input  wire:model="jml_pencairan"  style="width:450px"/>
										</div>
                                    </form>
								</div>
							</div>
						</div>
                    </x-app-layout>
                    @push('scripts')
						<script defer>
                            $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                        });
						$(document).ready(function() {

							//$('.custom-select').select2({
                			//placeholder: '{{__('Silahkan Pilih')}}',
               				//allowClear: true
            				//});

									$('#unit').on('change', function(e) {
											var unit_id = e.target.value;

											$.ajax({url: "{{ route('kegiatan') }}",
													type: "POST",
													data: {
														unit_id: unit_id
													},
													success: function(data) {
                                                        //console.log(data)
														$('#kegiatan').empty();
                                                        $('#rekening').empty();
														$('#subrekening').empty();
                                                        $('#sub2rekening').empty();
                                                        $('#kegiatan').append(' <option value = ""> Pilih Kegiatan </option>');
														$.each(data.json_kegiatan, function(index, kegiatan) {
																$('#kegiatan').append(' <option value = "'+kegiatan.kegiatan_id+'"> '+kegiatan.kegiatan_id+kegiatan.no_kegiatan+' '+kegiatan.nama_kegiatan+' </option>');
                                                                })
														}
													})
											});


                                    $('#kegiatan').on('change', function(e) {
											var kegiatan_id = e.target.value;
                                            var unit_id = $('#unit').val();
											$.ajax({url: "{{ route('rekening') }}",
													type: "POST",
													data: {
                                                        unit_id: unit_id,
														kegiatan_id: kegiatan_id
													},
													success: function(data) {
                                                        //console.log(data)
														$('#subrekening').empty();
                                                        $('#sub2rekening').empty();
														$('#rekening').empty();
														$('#rekening').append(' <option value = ""> Pilih Rekening </option>');
														$.each(data.json_rekening, function(index, rekening) {
																$('#rekening').append(' <option value = "'+rekening.rekening_id+'"> '+rekening.rekening_id+rekening.no_rekening+' '+rekening.nama_rekening+' </option>');
																})
														}
													})
											});


									
											$('#rekening').on('change', function(e) {
											var rekening_id = e.target.value;
                                            var unit_id = $('#unit').val();
											var kegiatan_id = $('#kegiatan').val();
											$.ajax({url: "{{ route('subrekening') }}",
													type: "POST",
													data: {
                                                        unit_id: unit_id,
														kegiatan_id: kegiatan_id,
														rekening_id: rekening_id
													},
													success: function(data) {
                                                        //console.log(data)
														//$('#subrekening').empty();
														$('#subrekening').empty();
                                                        $('#sub2rekening').empty();
														$('#subrekening').append(' <option value = ""> Pilih Subrekening </option>');
														$.each(data.json_subrekening, function(index, subrekening) {
																$('#subrekening').append(' <option value = "'+subrekening.subrekening_id+'"> '+subrekening.subrekening_id+subrekening.no_subrekening+' '+subrekening.nama_subrekening+' </option>');
																})
														}
													})
											});

											$('#subrekening').on('change', function(e) {
											var subrekening_id = e.target.value;
                                            var unit_id = $('#unit').val();
											var kegiatan_id = $('#kegiatan').val();
											var rekening_id = $('#rekening').val();
											$.ajax({url: "{{ route('sub2rekening') }}",
													type: "POST",
													data: {
                                                        unit_id: unit_id,
														kegiatan_id: kegiatan_id,
														rekening_id: rekening_id,
														subrekening_id: subrekening_id
													},
													success: function(data) {
                                                        console.log(data)
														$('#sub2rekening').empty();
														$('#sub2rekening').append(' <option value = ""> Pilih Kegiatan </option>');
														$.each(data.json_sub2rekening, function(index, sub2rekening) {
																$('#sub2rekening').append(' <option value = "'+sub2rekening.sub2rekening_id+'"> '+sub2rekening.sub2rekening_id+sub2rekening.no_sub2rekening+' '+sub2rekening.nama_sub2rekening+' </option>');
																})
														}
													})
											});
											


									});


									
    //date-picker
    $("#basicDate").flatpickr({
    dateFormat: "Y-m-d",
    });

    //input currency
    $("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() {
      formatCurrency($(this), "blur");
    }
    });


    function formatNumber(n) {
  // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.

  // get input value
  var input_val = input.val();

  // don't validate empty input
  if (input_val === "") { return; }

  // original length
  var original_len = input_val.length;

  // initial caret position
  var caret_pos = input.prop("selectionStart");

  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);

    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }

    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "Rp " + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "Rp " + input_val;

    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }

  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

                        </script>

