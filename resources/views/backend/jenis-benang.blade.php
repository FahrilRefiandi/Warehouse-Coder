@extends('backend.components.main')

@section('title', 'Jenis Benang')
@section('content')


    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</button>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Jenis Benang</h6>
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
                                <th>Kategori Benang</th>
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
                                    <td>{{ $item->jenis_benang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td class="text-center" style="width:10%" >
                                        <button  data-toggle="modal" data-target="#editModal" id="editJenisBenang" data-id="{{$item->id }}" data-jenis_benang="{{$item->jenis_benang }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/jenis-benang/$item->id") }}" method="post" class="d-inline" >
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



  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edit Data <text id="modalKet"></text> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form  action="{{ route('jenis-benang.update' ,"update") }}" method="post">
                  @csrf
                  @method('put')

                  <input type="hidden" id="id" name="id" value="{{old('id')}}">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="text" class="form-control" name="edit_jenis_benang" id="jenis_benang" placeholder="Rayon" value="{{old('edit_jenis_benang')}}" autofocus>
                      @error('edit_jenis_benang')
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
                  <h5 class="modal-title" id="staticBackdropLabel">Jenis Benang</h5>
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

                  <form action="{{ route('jenis-benang.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                          <label for="exampleInputEmail1">Jenis Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="text" class="form-control" name="jenis_benang" placeholder="Rayon" value="{{ old('jenis_benang') }}" autofocus>
                          @error('jenis_benang')
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
      $(document).on('click','#editJenisBenang' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var jenisBenang=$(this).data('jenis_benang')
        var modal=$(this)


        document.getElementById('modalKet').innerHTML=jenisBenang;
        document.getElementById('id').value=id;
        document.getElementById('jenis_benang').value=jenisBenang;
        // document.getElementById('modalKet').value=jabatan;

    })

</script>

@endsection
