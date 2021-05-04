
<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
    <div class="m-5">
        <x-jet-button wire:click="confirmPostCreate" wire:loading.attr="disabled">
            {{ __('TAMBAH PENGAJUAN') }}
        </x-jet-button>
    </div>
    <!-- Create post modal -->
    <x-jet-confirmation-modal wire:model="confirmingPostCreation" maxWidth="3xl">

        <x-slot name="icon">
            <svg class="w-6 h-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
        </x-slot>

        <x-slot name="title">
            TAMBAH PENGAJUAN
        </x-slot>

        <x-slot name="content">
            <div class="mt-4" wire:ignore>
                <x-jet-label for="" >KEGIATAN</x-jet-label>
                <select name="select2" id="select2" class="block w-full mt-1 rounded-md shadow-sm form-select" style="width:1150px">
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach($kegiatans as $row)
                    <option value="{{ $row->id }}">{{ $row->no_kegiatan }} - {{ $row->nama_kegiatan }}</option>
                  @endforeach
                </select>
                <x-jet-input-error for="text" class="mt-2" />
            </div>
            <div class="mt-4" wire:ignore>
                <x-jet-label for="" >REKENING</x-jet-label>
                <select name="select3" id="select3" class="block w-full mt-1 rounded-md shadow-sm form-select" style="width:1150px">
                    <option value="">-- Pilih Rekening --</option>
                    @foreach($rekenings as $row2)
                    <option value="{{ $row2->id }}">{{ $row2->no_rekening }} {{ $row2->nama_rekening }}</option>
                  @endforeach
                </select>
                <x-jet-input-error for="text" class="mt-2" />
            </div>
            <div class="mt-4" wire:ignore>
                <x-jet-label for="" >UNIT</x-jet-label>
                <select name="select4" id="select4" class="block w-full mt-1 rounded-md shadow-sm form-select" style="width:1150px">
                    <option value="disabled">-- Pilih Unit --</option>
                    @foreach($units as $row3)
                    <option value="{{ $row3->id }}">{{ $row3->no_unit }} {{ $row3->nama_unit }}</option>
                  @endforeach
                </select>
                <x-jet-input-error for="text" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="formtanggal_buat" value="{{ __('Tanggal') }}" />
                <x-jet-input type="text" id="basicDate" placeholder="Please select Date Time" data-input style="width:450px" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Jumlah Pencairan') }}" />
                <x-jet-input id="name" type="text" name="currency-field" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" wire:model.defer="name" autocomplete="current-password" style="width:450px"/>
                <x-jet-input-error for="name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingPostCreation')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="savePost" wire:loading.attr="disabled">
                TAMBAH PENGAJUAN
            </x-jet-button>

            <x-jet-action-message class="mr-3 text-green" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

        </x-slot>
    </x-jet-confirmation-modal>
</div>

@push('scripts')
<script defer>
    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2("val");
            @this.set('defaultkeg', data);
        });
        $('#select3').select2();
        $('#select3').on('change', function (e) {
            var data = $('#select3').select2("val");
            @this.set('defaultrek', data);
        });
        $('#select4').select2();
        $('#select4').on('change', function (e) {
            var data = $('#select4').select2("val");
            @this.set('defaultunit', data);
        });
    });


    flatpickr.localize(flatpickr.l10ns.id);
    $("#basicDate").flatpickr({
    dateFormat: "d m Y",
});


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
@endpush
