@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->

                <h2 class="page-title">
                  Data Siswa
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
                                <a href="#" class="btn btn-primary" id="btnTambahsiswa">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form  action="/siswa" method="get">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input name="nama_siswa" id="nama_siswa" class="form-control" placeholder="Nama Siswa" value="{{request('nama_siswa')}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                             <select name="kode_jurusan" id="kode_jurusan" class="form-select" aria-label="Jurusan">
                                                 <option selected disabled>Pilih Jurusan</option>
                                                 @foreach($jurusan as $j)
                                                 <option {{request('kode_jurusan')==$j->kode_jurusan ? 'selected':''}} value="{{$j->kode_jurusan}}">{{$j->nama_jurusan}}</option>
                                                 @endforeach
                                             </select>
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
                                        <th>Nis</th>
                                        <th>Nama</th>
                                        <th>kelas</th>
                                        <th>No HP Ortu</th>
                                        <th>Foto</th>
                                        <th>Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswa as $d)
                                    @php
                                    $path=Storage::url('uploads/siswa/'.$d->foto);
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration+$siswa->firstItem()-1}}</td>
                                        <td>{{$d->nis}}</td>
                                        <td>{{$d->nama_lengkap}}</td>
                                        <td>{{$d->kelas}}</td>
                                        <td>{{$d->no_hp}}</td>
                                        <td>
                                        @if(empty($d->foto))
                                        <img src="{{asset('assets/img/noimage.png')}}" class="avatar" alt="">
                                        @else
                                        <img src="{{url($path)}}" class="avatar" alt="">
                                        @endif
                                            
                                        </td>
                                        <td>{{$d->nama_jurusan}}</td>
                                        <td> 
                                            <div class="btn-group">
                                                <a href="#" class="edit btn btn-info btn-sm" nis="{{$d->nis}}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                                            <form action="/siswa/{{$d->nis}}/delete" method="POST" style="margin-left:5px">
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
                                {{$siswa->links('vendor.pagination.bootstrap-5')}}
                            </div>
                        </div>

                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>

<div class="modal modal-blur fade" id="modal-inputsiswa" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Siswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/siswa/store" method="POST" id="frmSiswa" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                                </span>
                                <input type="text" id="nis" name="nis" value="" class="form-control" placeholder="Nis">
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
                                <input type="text" value="" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
                                </span>
                                <input type="text" value="" id="kelas" class="form-control" name="kelas" placeholder="Kelas">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone-call"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>
                                </span>
                                <input type="text" value="" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP Orang Tua">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                            <div class="form-label">Pilih Foto</div>
                            <input type="file" id="foto" name="foto" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <select name="kode_jurusan" id="kode_jurusan" class="form-select" aria-label="Jurusan">
                                                 <option selected disabled>Pilih Jurusan</option>
                                                 @foreach($jurusan as $j)
                                                 <option {{request('kode_jurusan')==$j->kode_jurusan ? 'selected':''}} value="{{$j->kode_jurusan}}">{{$j->nama_jurusan}}</option>
                                                 @endforeach
                                             </select>
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


    <div class="modal modal-blur fade" id="modal-editsiswa" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Siswa</h5>
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
        $("#btnTambahsiswa").click(function(){
            $("#modal-inputsiswa").modal("show");
        });

        $(".edit").click(function(){
            var nis=$(this).attr('nis');
            $.ajax({
               type:'POST',
               url:'/siswa/edit',
              cache:false,
              data:{
                  _token:"{{csrf_token();}}",
                   nis:nis
              },
              success:function(respond){
                       $("#loadeditform").html(respond);
              }
            });
            $("#modal-editsiswa").modal("show");
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

        $("#frmSiswa").submit(function(){
            var nis=$("#nis").val();
            var nama_lengkap=$("#nama_lengkap").val();
            var kelas=$("#kelas").val();
            var no_hp=$("#no_hp").val();
            var kode_jurusan=$("frmSiswa").find("#kode_jurusan").val();
            if(nis==""){
                //alert("NIS harus diisi!");
                Swal.fire({
                title: 'Warning!',
                text: 'NIS harus diisi!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#nis").focus();                   
                });
                return false;
            }else if (nama_lengkap==""){
                //alert("Nama Lengkap harus diisi!");
                Swal.fire({
                title: 'Warning!',
                text: 'Nama Lengkap harus diisi!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#nama_lengkap").focus();                   
                });
                return false;
            }else if(kelas==""){
                //alert("Kelas harus dipilih!");
                Swal.fire({
                title: 'Warning!',
                text: 'Kelas harus diisi!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#kelas").focus();                   
                });
                return false;
            }else if(no_hp==""){
                //alert("Kelas harus dipilih!");
                Swal.fire({
                title: 'Warning!',
                text: 'Nomor HP harus diisi!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#no_hp").focus();                   
                });
                return false;
            }else if(kode_jurusan==""){
                //alert("Kelas harus dipilih!");
                Swal.fire({
                title: 'Warning!',
                text: 'Jurusan harus dipilih!',
                icon: 'warning',
                confirmButtonText: 'Ok'
                }).then((result)=>{
                    $("#kode_jurusan").focus();                   
                });
                return false;
            }
        });
    });
</script>
@endpush