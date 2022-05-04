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

        <form action="{{ route('sarung.store') }}" method="post">
            @csrf

            {{-- <div class="form-group">
                <label for="exampleInputEmail1">Kode Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                <input type="text" class="form-control" name="kode_sarung" placeholder="100" value="" autofocus>
                @error('kode_sarung')
                    <small class="text-danger ml-3" >{{$message}}</small>
                @enderror
            </div> --}}

            <label for="exampleInputEmail1">Kode Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
            <div class="input-group">
                <input type="text" class="form-control" value="{{ old('kode_sarung',"$kode_sarung") }}" name="kode_sarung" required readonly>
                {{-- placeholder="{{$kode_sarung}}" --}}
                {{-- value="{{ old('kode_sarung',"$kode_sarung") }}" --}}
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="button" wire:click="generateCode">Generate</button>
                </div>
              </div>
              @error('kode_sarung')
                    <small class="text-danger ml-3" >{{$message}}</small>
                @enderror

                <hr>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Motif Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="motif_sarung" autofocus>
                            <option value="" >---Pilih Motif Sarung---</option>
                            
                            @foreach ($motifSarung as $item)
                                <option value="{{ $item->motif_sarung }}">{{ $item->motif_sarung }}</option>
                            @endforeach
                        </select>
                        @error('motif_sarung')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Warna Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="warna_sarung" autofocus>
                            <option value="" >---Pilih Warna Sarung---</option>
                            @foreach ($warnaSarung as $item)
                                
                                <option value="{{ $item->warna_benang }}">{{ $item->warna_benang }}</option>
                            @endforeach
                        </select>
                        @error('warna_sarung')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Stok Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                        <input type="number" class="form-control" name="stok_sarung" min="1" placeholder="100" value="{{ old('stok_sarung') }}" autofocus>
                        @error('stok_sarung')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Satuan<small class="text-danger" style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="satuan" autofocus>
                            <option value="" >---Pilih Satuan---</option>
                            @foreach ($satuan as $item)
                                
                                <option value="{{ $item->singkatan }}">{{ $item->singkatan }}</option>
                            @endforeach
                        </select>
                        @error('satuan')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
                </div>
              </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
