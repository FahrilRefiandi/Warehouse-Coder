@extends('backend.components.main')

@section('title', 'Kardus')
@section('content')


    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data
                Kardus</button>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kardus</h6>
            </div>
            <div class="card-body">

                {{-- alert --}}
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
                {{-- alert --}}

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #6D70C6" class="text-light">
                            <tr class="text-center">
                                <th style="width:5%">No</th>
                                <th>Jenis Kardus</th>
                                <th>Jumlah Kardus</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis_kardus }}</td>
                                    <td>{{ $item->jumlah_kardus }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('DD/MM/YYYY') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY') }}</td>
                                    <td class="text-center" style="width:10%">
                                        <button data-toggle="modal" data-target="#editModal" id="editKardus"
                                            data-id="{{ $item->id }}" data-jenis_kardus="{{ $item->jenis_kardus }}"
                                            data-jumlah_kardus="{{ $item->jumlah_kardus }}"
                                            class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/kardus/$item->id") }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                onclick="return confirm('Anda yakin data {{ $item->jenis_kardus }} akan dihapus.?')"
                                                class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="container-fuild mt-4">
                    <v class="row">
                        <div class="col">
                            <canvas id="pieKardus"></canvas>
                        </div>
                        <div class="col"></div>
                </div>


            </div>
        </div>
    </div>



    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Motif <text id="modalKet"></text> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('kardus.update', 'update') }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" id="id" name="id" value="{{ old('id') }}">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori Kardus<small class="text-danger"
                                    style="font-size: 18px">*</small></label>
                            <select class="custom-select" id="jenis_kardus" name="jenis_kardus" autofocus>
                                <option value="">---Pilih Kategori Kardus---</option>
                                <option value="5 kodi">5 Kodi</option>
                                <option value="10 potong">10 Potong</option>
                                <option value="satuan">Satuan</option>
                            </select>
                            @error('jenis_kardus')
                                <small class="text-danger ml-3">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Kardus<small class="text-danger"
                                    style="font-size: 18px">*</small></label>
                            <input type="text" class="form-control" name="jumlah_kardus" id="jumlah_kardus"
                                placeholder="Bunga" value="{{ old('jumlah_kardus') }}" autofocus>
                            @error('jumlah_kardus')
                                <small class="text-danger ml-3">{{ $message }}</small>
                                @section('modalErrorValidation')
                                    <script type="text/javascript">
                                        $(window).on('load', function() {
                                            $('#editModal').modal('show');
                                        });
                                    </script>
                                @endsection
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


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Motif Sarung</h5>
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

                    <form action="{{ route('kardus.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori Kardus<small class="text-danger"
                                    style="font-size: 18px">*</small></label>
                            <select class="custom-select" name="jenis_kardus" autofocus>
                                @if (old('jenis_kardus'))
                                    <option value="{{ old('jenis_kardus') }}" selected>{{ old('jenis_kardus') }}</option>
                                @endif
                                <option value="">---Pilih Kategori Kardus---</option>
                                <option value="5 kodi">5 Kodi</option>
                                <option value="10 potong">10 Potong</option>
                                <option value="satuan">Satuan</option>
                            </select>
                            @error('jenis_kardus')
                                <small class="text-danger ml-3">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Kardus<small class="text-danger"
                                    style="font-size: 18px">*</small></label>
                            <input type="number" class="form-control" name="jumlah_kardus" placeholder="100"
                                value="{{ old('jumlah_kardus') }}" autofocus>
                            @error('jumlah_kardus')
                                <small class="text-danger ml-3">{{ $message }}</small>
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

@section('scriptCustom')

    <script>
        $(document).on('click', '#editKardus', function(event) {
            var buttonEdit = $(event.relatedTarget)
            var id = $(this).data('id')
            var jenis_kardus = $(this).data('jenis_kardus')
            var jumlah_kardus = $(this).data('jumlah_kardus')
            var modal = $(this)


            document.getElementById('modalKet').innerHTML = jenis_kardus;
            document.getElementById('id').value = id;
            document.getElementById('jenis_kardus').value = jenis_kardus;
            document.getElementById('jumlah_kardus').value = jumlah_kardus;
            // document.getElementById('modalKet').value=jabatan;

        })
    </script>

    <script>
        var ctx = document.getElementById("pieKardus").getContext("2d");
        // tampilan chart
        var piechart = new Chart(ctx, {
            type: 'pie',
            data: {
                // label nama setiap Value
                labels: [
                    '5 Kodi',
                    '10 Potong',
                    'Satuan',
                ],
                datasets: [{
                    // Jumlah Value yang ditampilkan
                    data: [{{ $limaKodi }}, {{ $sepuluhPotong }}, {{ $satuan }}],

                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                    ],
                }],
            }
        });
    </script>

@endsection

@push('styleCustom')
    <link href="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('scriptCustom')
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/js/demo/datatables-demo.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script> --}}
@endpush
