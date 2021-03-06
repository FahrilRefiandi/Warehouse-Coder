@extends('backend.components.main')

@section('title', 'Shift Kerja')
@section('content')


    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambahkan Shift Kerja</button>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Shift Kerja</h6>
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
                                <th>Shift</th>
                                <th>Mulai Bekerja</th>
                                <th>Akhir Bekerja</th>
                                <th>Durasi Kerja</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->shift }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->mulai_kerja)->isoFormat('HH:mm') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->akhir_kerja)->isoFormat('HH:mm') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->akhir_kerja)->diffInHours($item->mulai_kerja) }} Jam </td>
                                    {{-- <td>{{ \Carbon\Carbon::parse(10 - 5)->diffForHuman() }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('DD/MM/YYYY') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY') }}</td>
                                    <td class="text-center" style="width:10%" >
                                        <button  data-toggle="modal" data-target="#editModal" id="editShiftKerja" data-id="{{$item->id }}" data-shift="{{$item->shift }}" data-mulai_kerja="{{ $item->mulai_kerja }}" data-akhir_kerja="{{ $item->akhir_kerja }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/shift-kerja/$item->id") }}" method="post" class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Anda yakin data {{ $item->shift }} akan dihapus.?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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

              <form  action="{{ route('shift-kerja.update' ,"update") }}" method="post">
                  @csrf
                  @method('put')

                  <input type="hidden" id="id" name="id" value="{{old('id')}}">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Shift Kerja<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="text" class="form-control" name="shift" id="shift" placeholder="Shift Pertama" value="{{old('shift')}}" autofocus>
                      @error('shift')
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

                  <div class="row">
                    <div class="col">
                         <div class="form-group">
                        <label for="exampleInputEmail1">Mulai Bekerja<small class="text-danger" style="font-size: 18px">*</small></label>
                        <input type="time" class="form-control" name="mulai_kerja" id="mulai_kerja" placeholder="07:00" value="{{old('mulai_kerja')}}" autofocus>
                        @error('mulai_kerja')
                            <small class="text-danger ml-3" >{{$message}}</small>
                            @section('modalErrorValidation')
                            <script type="text/javascript">
                                    $(window).on('load', function() {
                                        $('#editModal').modal('show');
                                    });
                                    </script>
                                @endsection
                        @enderror
                    </div></div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Akhir Bekerja<small class="text-danger" style="font-size: 18px">*</small></label>
                            <input type="time" class="form-control" name="akhir_kerja" id="akhir_kerja" placeholder="12:00" value="{{old('akhir_kerja')}}" autofocus>
                            @error('akhir_kerja')
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
                  <h5 class="modal-title" id="staticBackdropLabel">Shift Kerja</h5>
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

                  <form action="{{ route('shift-kerja.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                          <label for="exampleInputEmail1">Shift Kerja<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="text" class="form-control" name="shift" placeholder="Shift Pertama" value="{{ old('shift') }}" autofocus>
                          @error('shift')
                              <small class="text-danger ml-3" >{{$message}}</small>
                          @enderror
                      </div>

                      <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mulai Bekerja<small class="text-danger" style="font-size: 18px">*</small></label>
                                <input type="time" class="form-control" name="mulai_kerja" placeholder="Rayon" value="{{ old('mulai_kerja') }}" autofocus>
                                @error('mulai_kerja')
                                    <small class="text-danger ml-3" >{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Akhir Bekerja<small class="text-danger" style="font-size: 18px">*</small></label>
                                <input type="time" class="form-control" name="akhir_kerja" placeholder="Rayon" value="{{ old('akhir_kerja') }}" autofocus>
                                @error('akhir_kerja')
                                    <small class="text-danger ml-3" >{{$message}}</small>
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

@endsection

@push('scriptCustom')

<script>
      $(document).on('click','#editShiftKerja' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var shift=$(this).data('shift')
        var mulaiKerja=$(this).data('mulai_kerja')
        var akhirKerja=$(this).data('akhir_kerja')
        var modal=$(this)


        document.getElementById('modalKet').innerHTML=shift;
        document.getElementById('id').value=id;
        document.getElementById('shift').value=shift;
        document.getElementById('mulai_kerja').value=mulaiKerja;
        document.getElementById('akhir_kerja').value=akhirKerja;
        // document.getElementById('modalKet').value=jabatan;

    })

</script>

@endpush
