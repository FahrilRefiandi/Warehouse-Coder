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

            {{-- <div class="form-group">
                <label for="exampleInputEmail1">Kode Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                <input type="text" class="form-control" name="kode_sarung" placeholder="100" value="" autofocus>
                @error('kode_sarung')
                    <small class="text-danger ml-3" >{{$message}}</small>
                @enderror
            </div> --}}

            <label for="exampleInputEmail1">Kode Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="SAR-0098" value="{{ old('kode_sarung',"$kode_sarung") }}" name="kode_sarung" required readonly>
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="button" wire:click="generateCode">Generate</button>
                </div>
              </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                        <input type="number" class="form-control" name="jumlah_benang" placeholder="100" value="{{ old('jumlah_benang') }}" autofocus>
                        @error('jumlah_benang')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Satuan Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="satuan_benang" autofocus>
                            <option value="" >---Pilih Satuan---</option>
                            {{-- @foreach ($satuanBenang as $item)
                                @if (old('satuan_benang') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->satuan }}</option>
                                @endif
                                <option value="{{ $item->id }}">{{ $item->satuan }}</option>
                            @endforeach --}}
                        </select>
                        @error('satuan_benang')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Warna Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                <select class="custom-select" name="warna_benang" autofocus>
                    <option value="" >---Pilih Warna Benang---</option>
                    {{-- @foreach ($warnaBenang as $item)
                        @if (old('warna_benang') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->warna_benang }}</option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->warna_benang }}</option>
                    @endforeach --}}
                </select>
                @error('warna_benang')
                    <small class="text-danger ml-3" >{{$message}}</small>
                @enderror
            </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
