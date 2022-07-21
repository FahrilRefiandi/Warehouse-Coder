@extends('backend.components.main')

@section('title', 'Benang Dipakai')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}


        <nav class="navbar mb-1" style="margin-top: -20px">
            <form class="form-inline" method="POST" action="{{ url('/sort/produksi-lembaran') }}">
                @csrf
                <input class="form-control mr-sm-2" type="date" placeholder="Search" @if($value) value="{{$value}}" @else value="{{\Carbon\Carbon::parse(now())->isoFormat('YYYY-MM-DD')}}" @endif name="tgl" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
              </form>
              @if ($value)
              <a href="{{ url('/produksi-lembaran') }}" class="btn btn-primary">Produksi
                Lembaran</a>
              @else
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Produksi
                Lembaran</button>
              @endif
        </nav>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Produksi Lembaran</h6>
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
                @if (session('error'))
                    <div class="alert alert-danger mb-4 alert-dismissible fade show" role="alert">
                        <strong>Error.</strong> {{ session('error') }}.
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
                                <th>Warna Benang</th>
                                <th>Jumlah Pakai</th>
                                <th>Grand Total</th>
                                <th>Tanggal Produksi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot style="background-color: #6D70C6" class="text-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kategori Benang</th>
                                <th>Warna Benang</th>
                                <th>Jumlah Pakai</th>
                                <th>Grand Total</th>
                                <th>Tanggal Produksi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td colspan="6"></td>
                                <td colspan="2" >Jumlah Pakai : {{ $jumlahPakai}} KG</td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $item)
                                @php
                                    $item->jumlah_pakai = explode(',', $item->jumlah_pakai);
                                    $idBenang = explode(',', $item->benang_datang_id);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @php
                                        for ($i=0; $i < count($idBenang); $i++) {
                                            // echo $idBenang[$i].'<br>';
                                            $benang[$i]=App\Models\BenangDatang::where('id',$idBenang[$i])->first();
                                            echo($benang[$i]->jenis_benang.',');
                                        }
                                        @endphp

                                    </td>
                                    <td>
                                        @php
                                        for ($i=0; $i < count($idBenang); $i++) {
                                            // echo $idBenang[$i].'<br>';
                                            $warnaBenang[$i]=App\Models\BenangDatang::where('id',$idBenang[$i])->first();
                                            echo($warnaBenang[$i]->warna_benang.',');
                                        }
                                        @endphp
                                    </td>
                                    <td>
                                        @foreach ($item->jumlah_pakai as $jumlahPakai)
                                            {{ $jumlahPakai . ' ' . $item->satuan .','}}
                                        @endforeach
                                    </td>
                                    <td>{{ $item->grand_total }} KG</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/Y') }}</td>
                                    <td>{{ $item->status_pengiriman }}</td>
                                    <td class="text-center" style="width:10%">
                                        <a @if ($item->status_pengiriman == 'Belum Dikirim')
                                            href="{{ url("/produksi-lembaran/$item->id") }}"
                                            class="btn btn-outline-primary"
                                            @else
                                            class="btn btn-outline-primary disabled"
                                        @endif><i class="fas fa-pencil-alt"></i>

                                        </a>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Produksi Lembaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @livewire('form-benang-dipakai')
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

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endpush
