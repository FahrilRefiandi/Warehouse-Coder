@extends('backend.components.main')

@section('title', 'Pindahkan Ke Warehouse 2')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}


        {{-- <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Sarung jadi</button>
        </nav> --}}


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Sarung</h6>
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
                    <th>Kode Produksi</th>
                    <th>Warna Sarung</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot style="background-color: #6D70C6" class="text-light">
                <tr class="text-center" >
                    <th>No</th>
                    <th>Kode Produksi</th>
                    <th>Warna Sarung</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @php
                    $bg=['btn-success','btn-primary'];
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_sarung }}</td>
                        <td>{{ $item->warna_sarung  }}</td>
                        {{-- <td>{{ $item->motif_sarung}}</td> --}}
                        {{-- <td>{{ $item->stok_sarung .' '. $item->satuan}}</td> --}}
                        @if ($item->status == 'tersedia')
                            <td class="text-center" >
                                <button type="button" class="btn {{ $bg[1] }} btn-sm rounded-pill" data-toggle="tooltip" data-placement="top" title="Barang Tersedia Di Warehouse 1 (Belum Dikirim Ke Warehouse 2).">{{ ucfirst($item->status) }}</button>
                            </td>
                        @else
                            <td class="text-center" >
                                <button type="button"  class="btn {{ $bg[0] }} btn-sm rounded-pill" data-toggle="tooltip" data-placement="top" title="Barang Telah Dikirim Ke Warehouse 2.">{{ ucfirst($item->status) }}</button>
                            </td>
                        @endif

                        <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:mm  DD-MM-Y') }}</td>

                        <td class="text-center" style="width:10%" >

                            <form action="{{ url("/pindahkan-sarung/2/$item->id") }}" method="post" class="d-inline" >
                                @csrf
                                <button type="submit" onclick="return confirm('Anda yakin sarung {{ $item->kode_sarung .' '. $item->jumlah_benang .' '. $item->singkatan }} akan dikirim ke warehouse 2.?')" class="btn btn-outline-primary" @if ($item->status == 'terkirim') disabled @else data-toggle="tooltip" data-placement="top" title="Kirimkan Sarung Ke Warehouse 2." @endif ><i class="fas fa-truck-loading"></i></button>
                            </form>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#showDataSarung"
                            id="showModalDetailSarung" data-id="{{$item->id }}" data-kode_produksi="{{$item->kode_sarung }}" data-warna_sarung="{{$item->warna_sarung }}" data-motif_sarung="{{ $item->motif_sarung }}" data-stok_sarung="{{ $item->stok_sarung .' '.$item->satuan }}" data-satuan="{{ $item->satuan }}" data-status="{{ ucfirst($item->status) }}" data-tgl="{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:mm  DD-MM-Y') }}"
                            ><i class="fas fa-info-circle"></i></button>
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
    <div class="modal fade" id="showDataSarung" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> <text id="modalKet"></text> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <table class="table mt-2 ">
                        <tbody>
                          <tr>
                            <td><b>Kode Produksi</b></td>
                            <td><b id="kodeSarung"></b></td>
                          </tr>
                          <tr>
                            <td><b>Warna Sarung</b></td>
                            <td><b id="warnaSarung"></b></td>
                          </tr>
                          <tr>
                            <td><b>Motif Sarung</b></td>
                            <td><b id="motifSarung"></b></td>
                          </tr>
                          <tr>
                            <td><b>Stok Sarung</b></td>
                            <td><b id="stokSarung"></b></td>
                          </tr>
                          <tr>
                            <td><b>Status</b></td>
                            <td><b id="status"></b></td>
                          </tr>
                          <tr>
                            <td><b>Dibuat Pada </b></td>
                            <td><b id="tgl"></b></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
@endsection


@section('datatableStyle')
    <link href="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('datatableScript')

    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset/sb-admin') }}/js/demo/datatables-demo.js"></script>
    <script>
        $(document).ready(function() {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        });
    </script>
@endsection



@section('scriptCustom')

<script>
      $(document).on('click','#showModalDetailSarung' , function(event){
        var kodeProduksi=$(this).data('kode_produksi')



        document.getElementById('modalKet').innerHTML=kodeProduksi;
        document.getElementById('kodeSarung').innerHTML=kodeProduksi;
        document.getElementById('warnaSarung').innerHTML=$(this).data('warna_sarung');
        document.getElementById('motifSarung').innerHTML=$(this).data('motif_sarung');
        document.getElementById('stokSarung').innerHTML=$(this).data('stok_sarung');
        document.getElementById('status').innerHTML=$(this).data('status');
        document.getElementById('tgl').innerHTML=$(this).data('tgl');



        // document.getElementById('modalKet').innerHTML=$(this).data('kode_produksi');
        // document.getElementById('warnaSarung').innerHTML=$(this).data('warna_sarung');

    })

</script>

@endsection
