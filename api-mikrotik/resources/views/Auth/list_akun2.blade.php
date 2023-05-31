@extends('Layouts.auth')

@section('title','List Akun')

@push('css')
<link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="card p-3 login-box" style="width:1000px">

  <div class="d-flex justify-content-center">
    <div class="mb-3">
      <div class="login-logo">
        <a href="{{url('login')}}"><b>LIST AKUN</b>MIKROTIK</a>
      </div>
      <p class="login-box-msg">Pilih salah satu akun dengan klik tombol SIGN IN atau pilih aksi dibawah ini</p>

      <div class="row">
        <div class="col-6">
          <a href="{{url('choice/login_akun')}}" class="btn btn-primary btn-block">Form Sign In Mikrotik</a>
        </div>
        <div class="col-6">
          <a href="{{url('choice')}}" class="btn btn-danger btn-block">Cancel</a>
        </div>
      </div>

    </div>
    
  </div>

  <table class="table table-bordered table-sm text-center" id="example1">
    <thead>
      <tr>
        <th>No</th>
        <th>Address</th>
        <th>Username</th>
        <th>Password</th>
        <th>Button</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data['list_akun'] as $key => $value)
      <tr>
        <td  id="no">{{$loop->iteration}}</td>
        <td  id="ip">{{$value->ip}}</td>
        <td  id="username">{{$value->username}}</td>
        <td  id="password">{{$value->password}}</td>
        <td>
          <a href="{{url('choice/list_akun',$value->id)}}" class="btn btn-primary btn-sm">Sign In</a>
          <a href="{{url('choice/list_akun',$value->id)}}/delete" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@push('jss')
<script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });

</script>
@endpush