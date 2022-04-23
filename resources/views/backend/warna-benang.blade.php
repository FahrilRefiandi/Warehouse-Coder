@extends('backend.components.main')

@section('title', 'Warna Benang')
@section('content')


    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</button>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Warna Benang</h6>
            </div>
            <div class="card-body">

                {{-- alert --}}
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
                {{-- alert --}}

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #6D70C6" class="text-light">
                            <tr class="text-center" >
                                <th style="width:5%">No</th>
                                <th>Warna Benang</th>
                                {{-- <th>Nama Barang</th> --}}
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->warna_benang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td class="text-center" style="width:10%" >
                                        <button  data-toggle="modal" data-target="#editModal" id="editWarnaBenang" data-id="{{$item->id }}" data-warna_benang="{{$item->warna_benang }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/warna-benang/$item->id") }}" method="post" class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Anda yakin data {{ $item->warna_benang }} akan dihapus.?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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



  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edit Warna <text id="modalKet"></text> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form  action="{{ route('warna-benang.update' ,"update") }}" method="post">
                  @csrf
                  @method('put')

                  <input type="hidden" id="id" name="id" value="{{old('id')}}">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Warna Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="text" class="form-control" name="edit_warna_benang" id="warna_benang" placeholder="Merah" value="{{old('edit_warna_benang')}}" autofocus>
                      @error('edit_warna_benang')
                          <small class="text-danger ml-3" >{{$message}}</small>
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
                  <h5 class="modal-title" id="staticBackdropLabel">Warna Benang</h5>
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

                  <form action="{{ route('warna-benang.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                          <label for="exampleInputEmail1">Warna Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="text" class="form-control" name="warna_benang" placeholder="Merah" value="{{ old('warna_benang') }}" autofocus>
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

@section('scriptCustom')

<script>
      $(document).on('click','#editWarnaBenang' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var warnaBenang=$(this).data('warna_benang')
        var modal=$(this)


        document.getElementById('modalKet').innerHTML=warnaBenang;
        document.getElementById('id').value=id;
        document.getElementById('warna_benang').value=warnaBenang;
        // document.getElementById('modalKet').value=jabatan;

    })

</script>

@endsection
