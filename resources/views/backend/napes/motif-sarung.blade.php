@extends('backend.components.main')

@section('title', 'Motif Sarung')
@section('content')


    <div class="container-fluid">

        <nav class="navbar mb-1" style="margin-top: -20px">
            <a class="navbar-brand"></a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</button>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Motif Sarung</h6>
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
                                <th>Kode Motif</th>
                                <th>Motif Sarung</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_motif }}</td>
                                    <td>{{ $item->motif_sarung }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('DD/MM/YYYY') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY') }}</td>
                                    <td class="text-center" style="width:10%" >
                                        <button  data-toggle="modal" data-target="#editModal" id="editMotifSarung" data-id="{{$item->id }}" data-motif_sarung="{{$item->motif_sarung }}" data-kode_motif="{{$item->kode_motif }}" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                                        <form action="{{ url("/motif-sarung/$item->id") }}" method="post" class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Anda yakin data {{ $item->motif_sarung }} akan dihapus.?')" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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
              <h5 class="modal-title">Edit Motif <text id="modalKet"></text> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form  action="{{ route('motif-sarung.update' ,"update") }}" method="post">
                  @csrf
                  @method('put')

                  <input type="hidden" id="id" name="id" value="{{old('id')}}">

                  <div class="form-group">
                      <label for="exampleInputEmail1">Kode Motif<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="text" class="form-control" name="edit_kode_motif" id="kode_motif" placeholder="M-0211" value="{{old('edit_kode_motif')}}" autofocus>
                      @error('edit_kode_motif')
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
                      <label for="exampleInputEmail1">Motif Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                      <input type="text" class="form-control" name="edit_motif_sarung" id="motif_sarung" placeholder="Bunga" value="{{old('edit_motif_sarung')}}" autofocus>
                      @error('edit_motif_sarung')
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

                  <form action="{{ route('motif-sarung.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                          <label for="exampleInputEmail1">Kode Motif<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="text" class="form-control" name="kode_motif" placeholder="M-0211" value="{{ old('kode_motif') }}" autofocus>
                          @error('kode_motif')
                              <small class="text-danger ml-3" >{{$message}}</small>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Motif Sarung<small class="text-danger" style="font-size: 18px">*</small></label>
                          <input type="text" class="form-control" name="motif_sarung" placeholder="Bunga" value="{{ old('motif_sarung') }}" autofocus>
                          @error('motif_sarung')
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

@push('scriptCustom')

<script>
      $(document).on('click','#editMotifSarung' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var motifSarung=$(this).data('motif_sarung')
        var kodeMotif=$(this).data('kode_motif')
        var modal=$(this)


        document.getElementById('modalKet').innerHTML=motifSarung;
        document.getElementById('id').value=id;
        document.getElementById('motif_sarung').value=motifSarung;
        document.getElementById('kode_motif').value=kodeMotif;
        // document.getElementById('modalKet').value=jabatan;

    })

</script>

@endpush
