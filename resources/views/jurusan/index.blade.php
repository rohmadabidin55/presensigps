@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->

                <h2 class="page-title">
                  Data Jurusan
                </h2>
              </div>
            </div>
          </div>
        </div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @If(Session::get('success'))
                                <div class="alert alert-success" role="alert"> 
                                    {{Session::get('success')}}
                                @endif
                                @If(Session::get('warning'))
                                <div class="alert alert-warning" role="alert">
                                    {{Session::get('warning')}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahjurusan">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form  action="/jurusan" method="get">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input name="nama_jurusan" id="nama_jurusan" class="form-control" placeholder="Jurusan" value="{{request('nama_jurusan')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-2">
                                        <div class="form-group">
                                             <button type="submit" class="btn btn-primary">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                             Cari</button>
                                        </div>
    
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Jurusan</th>
                                        <th>Nama Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurusan as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                             <td>{{$d->kode_jurusan}}</td>
                                             <td>{{$d->nama_jurusan}}</td>
                                             <td>
                                            <div class="btn-group">
                                                <a href="#" class="edit btn btn-info btn-sm" kode_jurusan="{{$d->kode_jurusan}}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                                            <form action="/jurusan/{{$d->kode_jurusan}}/delete" method="POST" style="margin-left:5px">
                                                @csrf
                                                <a class="btn btn-danger btn-sm delete-confirm" >
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" /></svg>
                                                </a>
                                            </form>
                                            </div>
                                             </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                
                            </div>
                        </div>

                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>

<div class="modal modal-blur fade" id="modal-inputjurusan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Jurusan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/jurusan/store" method="POST" id="frmJurusan" >
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                                </span>
                                <input type="text" id="kode_jurusan" name="kode_jurusan" value="" class="form-control" placeholder="Kode Jurusan">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                <input type="text" value="" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Nama Jurusan">
                              </div>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                            Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="modal modal-blur fade" id="modal-editjurusan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Jurusan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">
            
          </div>
        </div>
      </div>
    </div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#btnTambahjurusan").click(function(){
            $("#modal-inputjurusan").modal("show");
        });

        $(".edit").click(function(){
            var kode_jurusan=$(this).attr('kode_jurusan');
            $.ajax({
               type:'POST',
               url:'/jurusan/edit',
              cache:false,
              data:{
                  _token:"{{csrf_token();}}",
                   kode_jurusan:kode_jurusan
              },
              success:function(respond){
                       $("#loadeditform").html(respond);
              }
            });
            $("#modal-editjurusan").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form=$(this).closest('form');
            e.preventDefault();
            Swal.fire({
            title: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
            text: "Jika Iya Data Akan Terhapus Permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                title: "Terhapus!",
                text: "Datamu Berhasil Dihapus.",
                icon: "success"
                });
            }
            });
        });

        $("#frmJurusan").submit(function(){
            var nis=$("#kode_jurusan").val();
            var nama_lengkap=$("#nama_jurusan").val();
            if(kode_jurusan==""){
                //alert("NIS harus diisi!");
                Swal.fire({
                title: 'Warning!',
                text: 'Kode harus diisi!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#kode_jurusan").focus();                   
                });
                return false;
            }else if (nama_Jurusan==""){
                //alert("Nama Jurusan harus diisi!");
                Swal.fire({
                title: 'Warning!',
                text: 'Nama Jurusan harus diisi!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#nama_jurusan").focus();                   
                });
                return false;
            }
        });
    });
</script>
@endpush