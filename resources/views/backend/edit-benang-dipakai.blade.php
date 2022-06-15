@extends('backend.components.main')


@section('title', "Edit Benang Dipakai")
@section('content')

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Benang Dipakai {{ $data->jenis_benang .' '. \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd DD-MM-Y') }}</h6>
            </div>
            <div class="card-body">

                @if (session('kurang'))
                <div class="alert alert-danger mb-4 alert-dismissible fade show" role="alert">
                    <strong>Gagal.</strong> {{session('kurang')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif


                <form action="{{ url("/produksi-lembaran/$data->id") }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="jumlah_pakai_sebelum" value="{{ $data->jumlah_pakai }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Benang Dipakai </label>
                        <input type="text" class="form-control" name="benang" min="0"  value="{{ $data->jenis_benang .' | '. $data->warna_benang .' | '.  $data->jumlah_pakai.' '.$data->satuan.' | Stok '.$sisa->jumlah_benang.' '.$data->satuan .' | '. \Carbon\Carbon::parse( $data->created_at)->isoFormat('DD-MM-Y') }}" disabled autofocus>
                    </div>

                    <div class="input-group">
                        <input type="number" class="form-control" name="jumlah_pakai" min="0" placeholder="100" value="{{ $data->jumlah_pakai }}" autofocus>
                        <div class="input-group-append">
                          <button type="button" class="btn btn-info" disabled id="button-addon2">{{ $data->satuan }}</button>
                        </div>
                      </div>
                      @error('jumlah_pakai')
                      <small class="text-danger ml-3" >{{$message}}</small>
                  @enderror


                    <div class="text-center mt-5">
                        <hr>
                        <a href="{{ url('/produksi-lembaran') }}" class="btn btn-danger mr-2"> Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>

            </div>
        </div>



    </div>



@endsection
