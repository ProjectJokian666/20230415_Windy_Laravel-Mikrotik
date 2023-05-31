@extends('Layouts.auth')

@section('title','List Akun')

@push('csss')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
<section>
  <div class="container">

    <div class="row">

      <div class="col-12 d-flex flex-column mx-auto">
        <div class="card card-plain mt-6">

          <div class="card-header pb-0">
            <h6>List Akun</h6>
            @if(session('gagal'))
            <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
              <span class="alert-text"><strong>Danger! </strong>{{session('gagal')}}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
              <span class="alert-text"><strong>Success! </strong>{{session('sukses')}}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">

              <table class="table align-items-center justify-content-center mb-0"  id="example1">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Button</th>
                  </tr>
                </thead>
              </thead>
              <tbody>
                @foreach($data['list_akun'] as $key => $value)
                <tr>
                  <td class="text-center" id="no">{{$loop->iteration}}</td>
                  <td class="text-center" id="ip">{{$value->ip}}</td>
                  <td class="text-center" id="username">{{$value->username}}</td>
                  <td class="text-center" id="password">{{$value->password}}</td>
                  <td class="text-center">
                    <a href="{{url('choice/list_akun',$value->id)}}" class="btn btn-primary btn-sm">Sign In</a>
                    <a href="{{url('choice/list_akun',$value->id)}}/delete" class="btn btn-danger btn-sm">Delete</a>
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
</section>
@endsection

@push('jss')
<script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  $(".alert-dismissible").fadeIn().delay(3000).fadeOut();

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