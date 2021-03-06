@extends('backend.components.main')

@section('title', 'Benang Datang')
@section('content')

    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            {{-- <a class="navbar-brand"> </a> --}}
            <form class="form-inline" method="POST" action="{{ url('/sort/benang-datang') }}">
                @csrf
                <input class="form-control mr-sm-2" type="date" placeholder="Search" @if($value) value="{{$value}}" @else value="{{\Carbon\Carbon::parse(now())->isoFormat('YYYY-MM-DD')}}" @endif name="tgl" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
              </form>
              @if ($value)
              <a href="{{ url('/benang-datang') }}" class="btn btn-primary">Benang
                Datang</a>
              @else
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Benang
                Datang</button>
              @endif
        </nav>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Benang Datang</h6>
            </div>
            <div class="card-body">

                @if (session('tambah'))
                    <div class="alert alert-primary mb-4 alert-dismissible fade show" role="alert">
                        <strong>Sukses.</strong> {{ session('tambah') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('hapus'))
                    <div class="alert alert-warning mb-4 alert-dismissible fade show" role="alert">
                        <strong>Sukses.</strong> {{ session('hapus') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #6D70C6" class="text-light">
                            <tr class="text-center">
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
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kategori Benang</th>
                                {{-- <th>Nama Benang</th> --}}
                                <th>Jumlah Benang</th>
                                <th>Warna Benang</th>
                                <th>Benang Datang</th>
                                <th>Action</th>
                            </tr>
                            <tr class="">
                                <td colspan="3"></td>
                                <td> JUMLAH : {{ number_format($rayon+$tr,0,',','.')}} KG</td>
                                <td> RAYON : {{ number_format($rayon,0,',','.')}} KG</td>
                                <td> TR : {{ number_format($tr,0,',','.')}} KG</td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis_benang }}</td>
                                    <td>{{ $item->jumlah_benang . ' ' . $item->satuan }}</td>
                                    <td>{{ $item->warna_benang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('DD/MM/YYYY') }}
                                    </td>
                                    <td class="text-center" style="width:10%">
                                        <a href="{{ url("/benang-datang/$item->id") }}" class="btn btn-outline-primary"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ url("/benang-datang/$item->id") }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                onclick="return confirm('Anda yakin data {{ $item->jenis_benang . ' ' . $item->jumlah_benang . ' ' . $item->singkatan }} akan dihapus.?')"
                                                class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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
                @livewire('form-benang-datang')
            </div>
        </div>
    </div>
    {{-- modal --}}
@endsection


@push('styleCustom')
    <link href="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    @livewireStyles
@endpush

@push('scriptCustom')
    @livewireScripts
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endpush
