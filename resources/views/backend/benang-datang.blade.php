@extends('backend.components.main')

@section('title', 'Benang Datang')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}


        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Benang
                Datang</button>
        </nav>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Benang Datang</h6>
            </div>
            <div class="card-body">

                @if (session('tambah'))
                <div class="alert alert-primary mb-4 alert-dismissible fade show" role="alert">
                    <strong>Sukses.</strong> {{session('tambah')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                @if (session('hapus'))
                <div class="alert alert-warning mb-4 alert-dismissible fade show" role="alert">
                    <strong>Sukses.</strong> {{session('hapus')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #6D70C6" class="text-light">
                            <tr class="text-center" >
                                <th style="width:5%">No</th>
                                <th>Kategori Benang</th>
                                {{-- <th>Nama Barang</th> --}}
                                <th>Jumlah Benang</th>
                                <th>Warna Benang</th>
                                <th>Benang Datang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot style="background-color: #6D70C6" class="text-light">
                            <tr class="text-center" >
                                <th>No</th>
                                <th>Kategori Benang</th>
                                {{-- <th>Nama Benang</th> --}}
                                <th>Jumlah Benang</th>
                                <th>Warna Benang</th>
                                <th>Benang Datang</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis_benang }}</td>
                                    <td>{{ $item->jumlah_benang .' '. $item->singkatan }}</td>
                                    <td>{{ $item->warna_benang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td class="text-center" style="width:10%" >
                                        <a href="{{ url("/benang-datang/$item->id") }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ url("/benang-datang/$item->id") }}" method="post" class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Anda yakin data {{ $item->jenis_benang .' '. $item->jumlah_benang .' '. $item->singkatan }} akan dihapus.?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    {{-- modal --}}
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Benang Datang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                            <label for="exampleInputEmail1">Kategori Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                            <select class="custom-select" name="jenis_benang" autofocus>
                                <option value="">---Pilih Kategori---</option>
                                @foreach ($kategoriBenang as $item)
                                    @if (old('jenis_benang') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->jenis_benang }}</option>
                                    @endif
                                    <option value="{{ $item->id }}">{{ $item->jenis_benang }}</option>
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
                                        @foreach ($satuanBenang as $item)
                                            @if (old('satuan_benang') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->satuan }}</option>
                                            @endif
                                            <option value="{{ $item->id }}">{{ $item->satuan }}</option>
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
                                <option value="" >---Pilih Warna Benang---</option>
                                @foreach ($warnaBenang as $item)
                                    @if (old('warna_benang') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->warna_benang }}</option>
                                    @endif
                                    <option value="{{ $item->id }}">{{ $item->warna_benang }}</option>
                                @endforeach
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
        </div>
    </div>
    {{-- modal --}}
@endsection


@section('datatableStyle')
    <link href="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    @livewireStyles
@endsection

@section('datatableScript')
    @livewireScripts
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/js/demo/datatables-demo.js"></script>
@endsection