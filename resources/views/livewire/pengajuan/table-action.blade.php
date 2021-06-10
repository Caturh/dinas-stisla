    <!-- modal div -->
    <div class="mt-6" x-data="{ open: false }" x-cloak>

        <!-- Button (blue), duh! -->
    <button @click="open = true"> <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg></button>

                <!-- Button (blue), duh! -->
    <span x-on:click="delete = true">
         <button class="p-1 text-red-600 rounded hover:bg-red-600 hover:text-white"><x-icons.trash /></button>
    </span>

        <!-- Dialog (full screen) -->
        <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open"  >

          <!-- A basic modal dialog with title, body and one button to close -->
          <div  x-cloak class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-3xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false" style="z-index:9999">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                Modal Title {{$id}}
              </h3>

			<div class="mt-4">
				<x-jet-label for="" >KEGIATAN {{$hasil->kegiatan_id}}</x-jet-label>
                <input type="hidden" value="selected_id">
				<select name="kegiatan_id" id="select" class="block w-full mt-1 rounded-md shadow-sm form-select">
					<option value="">-- Pilih Kegiatan --</option>
                    @foreach($kegiatans as $row)
					<option value="{{ $row->id }}" {{ $hasil->kegiatan_id == $row->id ? "selected" :""}} >{{ $row->no_kegiatan }} - {{ $row->nama_kegiatan }}</option>
                  @endforeach

				</select>
				<x-jet-input-error for="text" class="mt-2" />

			</div>

			<div class="mt-4">
				<x-jet-label for="" >{{$id}} REKENING {{$hasil->rekening_id}}</x-jet-label>
				<select name="rekening_id" id="select2" class="block w-full mt-1 rounded-md shadow-sm form-select">
					<option value="">-- Pilih Rekening --</option>
                    @foreach($rekenings as $row2)

					<option value="{{ $row2->id }}" {{ $hasil->rekening_id == $row2->id ? "selected" :""}}>{{ $row2->no_rekening }} {{ $row2->nama_rekening }}</option>
                  @endforeach

				</select>
				<x-jet-input-error for="text" class="mt-2" />
			</div>
			<div class="mt-4">
				<x-jet-label for="" >UNIT {{$hasil->unit_id}}</x-jet-label>
				<select name="unit_id" id="select3" class="block w-full mt-1 rounded-md shadow-sm form-select">
					<option value="">-- Pilih Unit --</option>
                    @foreach($units as $row3)

					<option value="{{ $row3->id }}" {{ $hasil->unit_id == $row3->id ? "selected" :""}}>{{ $row3->no_unit }} {{ $row3->nama_unit }}</option>
                  @endforeach

				</select>
				<x-jet-input-error for="text" class="mt-2" />
			</div>
            <div class="mt-4">
				<x-jet-label for="" >Sub Rekening {{$hasil->subrekening_id}}</x-jet-label>
				<select name="subrekening_id" id="select4" class="block w-full mt-1 rounded-md shadow-sm form-select">
					<option value="">-- Pilih Sub Rekening --</option>
                    @foreach($subrekenings as $row4)

					<option value="{{ $row4->id }}" {{ $hasil->subrekening_id == $row4->id ? "selected" :""}}>{{$hasil->subrekening_id}} == {{$row4->id}}{{ $row4->nama_subrekening }}</option>
                  @endforeach

				</select>
				<x-jet-input-error for="text" class="mt-2" />
			</div>
            <div class="mt-4">
				<x-jet-label for="" >Keterangan {{$hasil->tanggal_buat}}{{$hasil->jml_pencairan}}{{$hasil->sub2rekening_id}}</x-jet-label>
				<select name="sub2rekening_id" id="select5" class="block w-full mt-1 rounded-md shadow-sm form-select">
					<option value="">-- Pilih Keterangan --</option>
                    @foreach($sub2rekenings as $row5)
					<option value="{{ $row5->id }}" {{ $hasil->sub2rekening_id == $row5->id ? "selected" :""}}>{{ $row5->nama_sub2rekening }}</option>
                  @endforeach

				</select>
				<x-jet-input-error for="text" class="mt-2" />
			</div>
			<div class="mt-4">
				<x-jet-label for="formtanggal_buat" value="{{ __('Tanggal') }}" />
				<x-jet-input name="tanggal_buat" type="date" value="{{$hasil->tanggal_buat}}" id="basicDate" placeholder="Please select Date Time" data-input style="width:450px" />
				<x-jet-input-error for="name" class="mt-2" />
			</div>
			<div class="mt-4">
				<x-jet-label for="name" value="{{ __('Jumlah Pencairan') }}" />
				<x-jet-input type="text" value="Rp {{$hasil->jml_pencairan}}" name="jml_pencairan" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" data-input style="width:450px"/>
				<x-jet-input-error for="name" class="mt-2" />
			</div>
          </div>

            <!-- One big close button.  --->
            <div class="mt-5 sm:mt-6">

              <span class="flex w-full rounded-md shadow-sm">
                <button wire:click.prevent="updatePengajuan({{$id}})" class="inline-flex justify-center px-4 py-2 text-white bg-blue-500 rounded w-half hover:bg-blue-700">
                    Submit
                  </button>
                <button @click="open = false" class="inline-flex justify-center px-4 py-2 text-white bg-blue-500 rounded w-half hover:bg-blue-700">
                  Cancel
                </button>
              </span>
            </div>

          </div>
        </div>
      </div>

      @push('scripts')
      <script defer>

          //select2 jquery + default value
        $(document).ready(function() {

            $('.select2').select2({
                   placeholder: '{{__('Silahkan Pilih')}}',
                  allowClear: true
                });
                $('.select2').on('change', function (e) {
                    let elementName = $(this).attr('id');
                    var data = $(this).select2("val");
                     @this.set(elementName, data);
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
        //  if (blur === "blur") {
        //    input_val += ".00";
        //  }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
      }

      </script>
      @endpush
