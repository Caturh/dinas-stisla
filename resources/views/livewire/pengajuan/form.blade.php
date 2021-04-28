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

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('No Kegiatan - Nama Kegiatan') }}" />
                <x-jet-input id="name" type="text" class="block w-full mt-1" wire:model.defer="name" autocomplete="current-password" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="" >KEGIATAN</x-jet-label>
                <select name="select2" id="select2" class="block w-full mt-1 rounded-md shadow-sm form-select">
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach($kegiatans as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_kegiatan }}</option>
                  @endforeach
                </select>
                <x-jet-input-error for="text" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="" >REKENING</x-jet-label>
                <select name="" id="select3" class="block w-full mt-1 rounded-md shadow-sm form-select">
                    <option value="">-- Pilih Rekening --</option>
                    @foreach($rekenings as $row2)
                    <option value="{{ $row2->id }}">{{ $row2->nama_rekening }}</option>
                  @endforeach
                </select>
                <x-jet-input-error for="text" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="" >UNIT</x-jet-label>
                <select name="" id="select4" class="block w-full mt-1 rounded-md shadow-sm form-select">
                    <option value="">-- Pilih Unit --</option>
                    @foreach($units as $row3)
                    <option value="{{ $row3->id }}">{{ $row3->nama_unit }}</option>
                  @endforeach
                </select>
                <x-jet-input-error for="text" class="mt-2" />
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
<script>

    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2("val");
            @this.set('defaultrek', data);
        });
    });

     $(document).ready(function() {
        $('#select3').select2();
        $('#select3').on('change', function (e) {
            var data = $('#select3').select2("val");
            @this.set('defaultkeg', data);
        });
    });

    $(document).ready(function() {
        $('#select4').select2();
        $('#select4').on('change', function (e) {
            var data = $('#select4').select2("val");
            @this.set('defaultunit', data);
        });
    });

</script>
@endpush
