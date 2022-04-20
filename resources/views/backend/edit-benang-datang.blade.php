@extends('backend.components.main')


@section('title', "Edit Benang Datang")
@section('content')

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Benang Datang {{ $data->jenisBenang->jenis_benang .' '. \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd DD-MM-Y') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{ url("/benang-datang/$data->id") }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori Benang<small class="text-danger" style="font-size: 18px">*</small> </label>
                        <select class="custom-select" name="jenis_benang" autofocus>
                            <option value="" selected>---Pilih Jenis Benang---</option>
                            @foreach ($kategoriBenang as $item)
                            <option @if ($data->jenis_benang_id == $item->id) selected @endif value="{{ $item->id }}" >{{ $item->jenis_benang }}</option>
                            @endforeach
                        </select>
                        @error('jenis_benang')
                        <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jumlah Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                                <input type="number" class="form-control" name="jumlah_benang" placeholder="100" value="{{ $data->jumlah_benang }}" autofocus>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Satuan Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                                <select class="custom-select" name="satuan_benang" autofocus>
                                    <option value="" selected>---Pilih Satuan---</option>
                                    @foreach ($satuanBenang as $item)
                                    <option @if ($data->satuan_id == $item->id) selected @endif value="{{ $item->id }}" >{{ $item->satuan }}</option>
                                    @endforeach
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
                            <option value="" selected>---Pilih Warna Benang---</option>
                            @foreach ($warnaBenang as $item)
                                <option @if ($data->warna_benang_id == $item->id) selected @endif value="{{ $item->id }}" >{{ $item->warna_benang }}</option>
                            @endforeach
                        </select>
                        @error('warna_benang')
                            <small class="text-danger ml-3" >{{$message}}</small>
                        @enderror
                    </div>
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
