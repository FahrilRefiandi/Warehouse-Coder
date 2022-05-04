@extends('backend.components.main')

@section('title', 'Satuan Benang')
@section('content')


    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</button>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Satuan.</h6>
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
                                <th>Satuan</th>
                                <th>Singkatan</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->singkatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('HH:m  D-MM-Y') }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="text-center" style="width:10%" >
                                        <button  data-toggle="modal" data-target="#editModal" id="editSatuanBenang" data-id="{{$item->id }}" data-singkatan_benang="{{$item->singkatan }}" data-satuan_benang="{{$item->satuan }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/satuan/$item->id") }}" method="post" class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Anda yakin data {{ $item->satuan }} akan dihapus.?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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

              <form  action="{{ route('satuan.update' ,"update") }}" method="post">
                  @csrf
                  @method('put')

                  <input type="hidden" id="id" name="id" value="{{old('id')}}">
                 <div class="row">
                     <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Satuan<small class="text-danger" style="font-size: 18px">*</small></label>
                            <input type="text" class="form-control" name="edit_satuan_benang" id="edit_satuan_benang" placeholder="Meter" value="{{old('edit_satuan_benang')}}" autofocus>
                            @error('edit_satuan_benang')
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

                     <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Singkatan<small class="text-danger" style="font-size: 18px">*</small></label>
                            <input type="text" class="form-control" name="edit_singkatan" id="edit_singkatan" placeholder="Merah" value="{{old('edit_singkatan')}}" autofocus>
                            @error('edit_singkatan')
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
                  <h5 class="modal-title" id="staticBackdropLabel">Satuan</h5>
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

                  <form action="{{ route('satuan.store') }}" method="post">
                      @csrf

                      <div class="row">
                          <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Satuan Benang<small class="text-danger" style="font-size: 18px">*</small></label>
                                <input type="text" class="form-control" name="satuan_benang" placeholder="Meter" value="{{ old('satuan_benang') }}" autofocus>
                                @error('satuan_benang')
                                    <small class="text-danger ml-3" >{{$message}}</small>
                                @enderror
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Singkatan<small class="text-danger" style="font-size: 18px">*</small></label>
                                <input type="text" class="form-control" name="singkatan" placeholder="M" value="{{ old('singkatan') }}" autofocus>
                                @error('singkatan')
                                    <small class="text-danger ml-3" >{{$message}}</small>
                                @enderror
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Status<small class="text-danger" style="font-size: 18px">*</small></label>
                        <select class="custom-select" name="satuan" autofocus>
                            <option value="{{ old('satuan') }}" selected>{{ old('satuan',"-----Pilih Satuan-----") }}</option>
                            <option value="panjang">Panjang</option>
                            <option value="jumlah">Jumlah</option>
                        </select>
                        @error('satuan')
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
      $(document).on('click','#editSatuanBenang' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var satuanBenang=$(this).data('satuan_benang')
        var singkatan=$(this).data('singkatan_benang')
        var modal=$(this)


        document.getElementById('modalKet').innerHTML=satuanBenang;
        document.getElementById('id').value=id;
        document.getElementById('edit_satuan_benang').value=satuanBenang;
        document.getElementById('edit_singkatan').value=singkatan;
        // document.getElementById('modalKet').value=jabatan;

    })

</script>

@endsection
