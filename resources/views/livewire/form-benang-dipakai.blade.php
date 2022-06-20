<div>
    <div class="modal-body">

        @if (session('kurang'))
            <div class="alert alert-danger mb-4 alert-dismissible fade show" role="alert">
                <strong>Gagal.</strong> {{ session('kurang') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @section('modalErrorValidation')
                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#staticBackdrop').modal('show');
                    });
                </script>
            @endsection
        @endif

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

        <form action="{{ route('produksi-lembaran.store') }}" method="post">

            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Shift Kerja<small class="text-danger"
                        style="font-size: 18px">*</small></label>
                <select class="custom-select" name="shift" autofocus>
                    <option value="">---Pilih Shift Kerja---</option>
                    @foreach ($shift as $item)
                        @if (old('shift') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->shift }}</option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->shift }}</option>
                    @endforeach
                </select>
                @error('shift')
                    <small class="text-danger ml-3">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mesin<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="mesin" autofocus>
                            <option value="">---Pilih Mesin---</option>
                            @foreach ($mesin as $item)
                                @if (old('mesin') == $item->id)
                                    <option value="{{ $item->id }}" selected>
                                        {{ $item->kode_mesin . ' No : ' . $item->nomor_mesin }}</option>
                                @endif
                                <option value="{{ $item->id }}">
                                    {{ $item->kode_mesin . ' No : ' . $item->nomor_mesin }}</option>
                            @endforeach
                        </select>
                        @error('mesin')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Motif<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="motif" autofocus>
                            <option value="">---Pilih Motif---</option>
                            @foreach ($motif as $item)
                                @if (old('motif') == $item->motif_sarung)
                                    <option value="{{ $item->motif_sarung }}" selected>{{ $item->motif_sarung }}
                                    </option>
                                @endif
                                <option value="{{ $item->motif_sarung }}">{{ $item->motif_sarung }}</option>
                            @endforeach
                        </select>
                        @error('motif')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>



            <h6>Warna dasar</h6>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Benang<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <select class="form-control selectpicker" name="pilih_benang" {{-- wire:model="pilihBenang.0" --}} autofocus
                            required data-live-search="true">
                            <option value="0">---Pilih Benang---</option>
                            @foreach ($benangNoFilter as $item)
                                <option value="{{ $item->id }}" @if (old('pilih_benang') == $item->id) selected @endif>
                                    {{ $item->jenis_benang . ' | ' . $item->warna_benang . ' | ' . $item->jumlah_benang . ' ' . $item->satuan . ' | ' . \Carbon\Carbon::parse($item->created_at)->isoFormat('DD-MM-Y') }}
                                </option>
                            @endforeach
                        </select>

                        @error('pilih_benang')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Pakai<small class="text-danger"
                                style="font-size: 18px">*</small></label>
                        <input type="number" step="any" class="form-control" name="jumlah_pakai" min="0"
                            placeholder="100" value="{{ old('jumlah_pakai') }}" autofocus>
                        @error('jumlah_pakai')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>

            {{ 'Id Selected : ' }}
            @foreach ($pilihBenang as $item)
                {{ $item . ',' }}
            @endforeach

            {{-- <br>
            @foreach ($filterBenang as $item)
            {{$item}}
            @endforeach --}}


            <h6 class="mt-4">Varian Warna</h6>



            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Pilih Benang</th>
                        <th scope="col">Jumlah Pakai</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < $jumlahInput; $i++)
                        <tr>
                            <td>
                                <div class="form-group">

                                    <select class="form-control selectpicker" name="varian_benang[{{$i}}]" {{-- wire:model="pilihBenang.0" --}}
                                        autofocus required data-live-search="true">
                                        <option value="0">---Pilih Benang---</option>
                                        @foreach ($benangNoFilter as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->jenis_benang . ' | ' . $item->warna_benang . ' | ' . $item->jumlah_benang . ' ' . $item->satuan . ' | ' . \Carbon\Carbon::parse($item->created_at)->isoFormat('DD-MM-Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("varian_benang[$i]")
                                        <small class="text-danger ml-3">{{ $message }}</small>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" step="any" class="form-control"
                                        name="jumlah_pakai_varian[{{$i}}]" min="0" placeholder="100"
                                        value="{{ old("jumlah_pakai_varian[$i]") }}" autofocus>
                                    @error("jumlah_pakai_varian[$i]")
                                        <small class="text-danger ml-3">{{ $message }}</small>
                                    @enderror
                                </div>
                            </td>

                            <td><button class="btn btn-danger" wire:click="deleteInput({{ $i }})"
                                    type="button">Hapus</button>
                            </td>
                        </tr>
                    @endfor

                    <tr>
                        <td colspan="3">
                            @if ($hiddenAdd == false)
                                <button class="btn btn-primary btn-sm" type="button" wire:click="tambahInput">Tambahkan
                                    Varian</button>
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>

            {{--  --}}
            <hr>

            <div class="form-group">
                <label for="exampleInputPassword1">Tanggal Produksi<small class="text-danger"
                        style="font-size: 18px">*</small></label>
                <input type="date" class="form-control" name="tanggal_produksi"
                    value="{{ old('tanggal_produksi') }}" autofocus>
                @error('tanggal_produksi')
                    <small class="text-danger ml-3">{{ $message }}</small>
                @enderror
            </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    {{-- @php
    dd($pilihBenang);
@endphp --}}


</div>
