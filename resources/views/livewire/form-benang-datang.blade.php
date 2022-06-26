<div>

    <div class="modal-body">

        {{-- cek error validation and show modal if error --}}
        @if ($errors->any())
            @section('modalErrorValidation')
                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#staticBackdrop').modal('show');
                    });
                </script>
            @endsection
        @endif
        {{-- cek error validation and show modal if error --}}

        <form action="{{ route('benang-datang.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Dibuat pada</label>
                <input type="date" class="form-control" name="created_at" value="{{ old('created_at') }}">
                @if ($errors->has('created_at'))
                    <small class="text-danger ml-3">{{ $message }}</small>
                @else
                    <small class="text-muted ml-3">Kosongi untuk waktu sekarang.</small>
                @endif
            </div>

            <h5>Benang Rayon</h5>
            <hr>

            @for ($i = 0; $i < $tambahRayon; $i++)
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Warna Benang<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="warna_benang_rayon[]" autofocus>
                            <option value="">---Pilih Warna Benang---</option>
                            @foreach ($warnaBenang as $item)
                                <option value="{{ $item->warna_benang }}">{{ $item->warna_benang }}
                                </option>
                            @endforeach
                        </select>
                        @error('warna_benang_rayon.*')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Benang<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <div class="input-group">
                            <input type="" class="form-control" name="jumlah_benang_rayon[]" step="any"
                                placeholder="100" value="{{ old('jumlah_benang') }}" autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">KG</span>
                            </div>
                        </div>
                        @error('jumlah_benang_rayon.*')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    @if ($i+1 == $tambahRayon)
                        <button type="button" class="btn btn-danger" style="margin-top: 35px" wire:click="kurangRayon">delete</button>
                    @endif
                </div>
            </div>
            @endfor
            <button type="button" class="btn btn-primary btn-sm mb-3" wire:click="tambahRayon">Tambahkan Warna</button>

            <h5>Benang TR</h5>
            <hr>

            @for ($i = 0; $i < $tambahTr; $i++)
            <div class="row">
                <div class="col">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Warna Benang<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="warna_benang_tr[]" autofocus>
                            <option value="">---Pilih Warna Benang---</option>
                            @foreach ($warnaBenang as $item)
                                @if (old('warna_benang') == $item->id)
                                    <option value="{{ $item->warna_benang }}" selected>
                                        {{ $item->warna_benang }}</option>
                                @endif
                                <option value="{{ $item->warna_benang }}">{{ $item->warna_benang }}
                                </option>
                            @endforeach
                        </select>
                        @error('warna_benang_tr.*')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Benang<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <div class="input-group">
                            <input type="" class="form-control" name="jumlah_benang_tr[]" step="any"
                                placeholder="100" value="{{ old('jumlah_benang') }}" autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">KG</span>
                            </div>
                        </div>
                        @error('jumlah_benang_tr.*')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    @if ($i+1 == $tambahTr)
                        <button type="button" class="btn btn-danger" style="margin-top: 35px" wire:click="kurangTr">delete</button>
                    @endif
                </div>
            </div>
            @endfor
            <button type="button" class="btn btn-primary btn-sm mb-3" wire:click="tambahTr">Tambahkan Warna</button>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

</div>
