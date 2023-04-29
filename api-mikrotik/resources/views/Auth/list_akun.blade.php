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
      <form action="{{url('choice/list_akun',$key)}}" method="post">
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>id-17.hostddns.us:10269</td>
          <td>windy</td>
          <td>admin{{$loop->iteration}}</td>
          <td>
            <button type="submit" class="btn btn-primary btn-block btn-sm">Sign In </button>
          </td>
        </tr>
      </form>
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