@extends('backend.components.main')


@section('title', 'Edit Benang Datang')
@section('content')

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Benang Datang
                    {{ $data->jenis_benang . ' ' . \Carbon\Carbon::parse($data->tgl_benang_datang)->isoFormat('dddd DD-MM-Y') }}
                </h6>
            </div>
            <div class="card-body">

                <form action="{{ url("/benang-datang/$data->id") }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori Benang<small class="text-danger"
                                style="font-size: 18px">*</small> </label>
                        <input type="text" class="form-control" value="{{ $data->jenis_benang }}" readonly disabled>


                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1">Jumlah Benang<small class="text-danger"
                                    style="font-size: 18px">*</small></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="jumlah_benang" placeholder="100"
                                    value="{{ $data->jumlah_benang }}" step="any" autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">KG</span>
                                </div>
                            </div>
                            @error('jumlah_benang')
                                <small class="text-danger ml-3">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Warna Benang<small class="text-danger"
                                        style="font-size: 18px">*</small></label>
                                <select class="custom-select" name="warna_benang" autofocus>
                                    <option value="">---Pilih Warna Benang---</option>
                                    @foreach ($warnaBenang as $item)
                                        <option @if ($data->warna_benang == $item->warna_benang) selected @endif
                                            value="{{ $item->warna_benang }}">{{ $item->warna_benang }}</option>
                                    @endforeach
                                </select>
                                @error('warna_benang')
                                    <small class="text-danger ml-3">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Dibuat pada</label>
                        <input type="datetime-local" class="form-control" name="created_at" value="{{ \Carbon\Carbon::parse($data->tgl_benang_datang)->isoFormat('YYYY-MM-DDTHH:mm') }}" >
                            @if ($errors->has('created_at'))
                            <small class="text-danger ml-3" >{{$message}}</small>
                            @else
                            <small class="text-muted ml-3" >Kosongi untuk waktu sekarang.</small>
                            @endif
                      </div>

                      {{-- {{ old('created_at') }} --}}
                      {{-- {{ \Carbon\Carbon::parse($data->tgl_benang_datang)->isoFormat('YYYY-MM-DDTHH:mm') }} --}}

                    <div class="text-center mt-5">
                        <hr>
                        <a href="{{ url('/benang-datang') }}" class="btn btn-danger mr-2"> Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>



    </div>



@endsection
