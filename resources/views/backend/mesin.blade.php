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
                <h6 class="m-0 font-weight-bold text-primary">Data Mesin</h6>
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
                                <th>Kode Mesin</th>
                                <th>Nomor Mesin</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_mesin }}</td>
                                    <td>{{ $item->nomor_mesin }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('HH:mm  D-MM-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:mm  D-MM-Y') }}</td>
                                    <td class="text-center" style="width:10%">
                                        <button  data-toggle="modal" data-target="#editModal" id="editMesin" data-id="{{$item->id }}" data-kode_mesin="{{$item->kode_mesin }}" data-nomor_mesin="{{$item->nomor_mesin }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/mesin/$item->id") }}" method="post" class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Anda yakin kode mesin {{ $item->kode_mesin }} akan dihapus.?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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
              <h5 class="modal-title">Edit Mesin <text id="modalKet"></text> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form  action="{{ route('mesin.update' ,"update") }}" method="post">
                  @csrf
                  @method('put')

                  <input type="hidden" id="id" name="id" value="{{old('id')}}">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Kode Mesin<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="text" class="form-control" name="kode_mesin" id="kode_mesin" placeholder="M-0021" value="{{old('kode_mesin')}}" autofocus>
                      @error('kode_mesin')
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
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Mesin<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="number" class="form-control" name="nomor_mesin" id="nomor_mesin" placeholder="01" value="{{old('nomor_mesin')}}" autofocus>
                      @error('nomor_mesin')
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
                  <h5 class="modal-title" id="staticBackdropLabel">Mesin</h5>
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

                  <form action="{{ route('mesin.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                          <label for="exampleInputEmail1">Kode Mesin<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="text" class="form-control" name="kode_mesin" placeholder="M-0021" value="{{ old('kode_mesin') }}" autofocus>
                          @error('kode_mesin')
                              <small class="text-danger ml-3" >{{$message}}</small>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nomor Mesin<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="number" class="form-control" name="nomor_mesin" placeholder="01" value="{{ old('nomor_mesin') }}" autofocus>
                          @error('nomor_mesin')
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
      $(document).on('click','#editMesin' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var kodeMesin=$(this).data('kode_mesin')
        var nomorMesin=$(this).data('nomor_mesin')
        var modal=$(this)


        document.getElementById('modalKet').innerHTML=kodeMesin;
        document.getElementById('id').value=id;
        document.getElementById('kode_mesin').value=kodeMesin;
        document.getElementById('nomor_mesin').value=nomorMesin;

    })

</script>

@endsection
