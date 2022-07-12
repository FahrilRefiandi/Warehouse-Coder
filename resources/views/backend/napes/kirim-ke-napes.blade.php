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
                    <th>Jenis Benang</th>
                    <th>Warna Benang</th>
                    <th>Status</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot style="background-color: #6D70C6" class="text-light">
                <tr class="text-center" >
                    <th>No</th>
                    <th>Jenis Benang</th>
                    <th>Warna Benang</th>
                    <th>Status</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @php
                    $bg=['btn-success','btn-primary'];
                @endphp
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
                        @if ($item->status_pengiriman == 'Belum Dikirim')
                            <td class="text-center" >
                                <button type="button" class="btn {{ $bg[1] }} btn-sm rounded-pill" data-toggle="tooltip" data-placement="top" title="Barang Tersedia Di Warehouse 1 (Belum Dikirim Ke Warehouse 2).">{{ ucfirst($item->status_pengiriman) }}</button>
                            </td>
                        @else
                            <td class="text-center" >
                                <button type="button"  class="btn {{ $bg[0] }} btn-sm rounded-pill" data-toggle="tooltip" data-placement="top" title="Barang Telah Dikirim Ke Warehouse 2.">{{ ucfirst($item->status_pengiriman) }}</button>
                            </td>
                        @endif

                        @if ($item->tanggal_pengiriman == null)
                            <td class="text-center" >-</td>
                            @else
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pengiriman)->isoFormat('DD/MM/YYYY') }}</td>
                        @endif

                        <td class="text-center" style="width:10%" >

                            <form action="{{ url("/kirim-barang/napes/$item->id") }}" method="post" class="d-inline" >
                                @csrf
                                <button type="submit" onclick="return confirm('Anda yakin dikirim ke napes.?')" class="btn btn-outline-primary" @if ($item->status_pengiriman == 'Terkirim') disabled @else data-toggle="tooltip" data-placement="top" title="Kirimkan Napes." @endif ><i class="fas fa-truck-loading"></i></button>
                            </form>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#showDataSarung"
                            id="showModalDetailSarung" data-id="{{$item->id }}" data-benang_dasar="{{$benang[0]->jenis_benang }}"
                            @php
                            echo("data-varian_benang='");
                            for ($i=1; $i < count($idBenang); $i++) {

                                $benang[$i]=App\Models\BenangDatang::where('id',$idBenang[$i])->first();
                                echo($benang[$i]->jenis_benang.':'.$item->jumlah_pakai[$i] .' KG'.',');
                            }
                            echo("'");
                             @endphp data-jumlah_benang_dasar="{{$item->jumlah_pakai[0] .' KG' }}" data-warna_benang_dasar="{{$warnaBenang[0]->warna_benang }}"  data-status="{{ ucfirst($item->status_pengiriman) }}" data-tgl="{{ \Carbon\Carbon::parse($item->tanggal_produksi)->isoFormat('DD/MM/YYYY') }}"
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
                            <td><b>Benang Dasar</b></td>
                            <td><b id="benangDasar"></b></td>
                          </tr>
                          <tr>
                            <td><b>Jumlah Pakai Benang Dasar</b></td>
                            <td><b id="jumlahPakaiDasar"></b></td>
                          </tr>
                          <tr>
                            <td><b>Warna Dasar</b></td>
                            <td><b id="warnaDasar"></b></td>
                          </tr>
                          <tr>
                            <td><b>Varian Benang</b></td>
                            <td><b id="varianBenang"></b></td>
                          </tr>
                          <tr>
                            <td><b>Status</b></td>
                            <td><b id="status"></b></td>
                          </tr>
                          <tr>
                            <td><b>Tanggal Produksi </b></td>
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
        var benangDasar=$(this).data('benang_dasar')



        document.getElementById('modalKet').innerHTML=benangDasar;
        document.getElementById('benangDasar').innerHTML=benangDasar;
        document.getElementById('jumlahPakaiDasar').innerHTML=$(this).data('jumlah_benang_dasar');
        document.getElementById('warnaDasar').innerHTML=$(this).data('warna_benang_dasar');
        document.getElementById('varianBenang').innerHTML=$(this).data('varian_benang');
        document.getElementById('status').innerHTML=$(this).data('status');
        document.getElementById('tgl').innerHTML=$(this).data('tgl');



        // document.getElementById('modalKet').innerHTML=$(this).data('kode_produksi');
        // document.getElementById('warnaSarung').innerHTML=$(this).data('warna_sarung');

    })

</script>

@endsection
