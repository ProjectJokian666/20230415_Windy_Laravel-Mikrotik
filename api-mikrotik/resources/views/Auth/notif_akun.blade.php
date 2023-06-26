@extends('Layouts.auth')

@section('title','List Notif')

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
						<h6>List Untuk Mengirimkan Notifikasi Monitoring Router Mikrotik</h6>
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
						<a href="{{url('choice/notif_akun/notif_wa/add_wa')}}" class="btn bg-gradient-info mt-4 mb-0">TAMBAH NOTIF WA</a>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">

							<table class="table text-center align-items-center justify-content-center mb-0"  id="example1">
								<thead>
									<tr>
										<th class="text-center">NO</th>
										<th class="text-center">WHATSAPP</th>
										<th class="text-center">NUMBER TWILIO</th>
										<th class="text-center">ACCOUNT SID</th>
										<th class="text-center">AUTH TOKEN</th>
										<th class="text-center">JAM</th>
										<th class="text-center">MENIT</th>
										<th class="text-center">AKSI</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data['notifwa'] as $key => $value)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$value['no_wa']}}</td>
										<td>{{$value['no_twilio']}}</td>
										<td>{{substr($value['account_sid'],0,10)}}</td>
										<td>{{substr($value['auth_token'],0,10)}}</td>
										<td>{{$value['jam']}}</td>
										<td>{{$value['menit']}}</td>
										<td>
											<form action="{{url('choice/notif_akun/notif_wa/'.$value->id.'/wa/hapus')}}" method="POST">
												@csrf
												@method('delete')
												<a href="{{url('choice/notif_akun/notif_wa/'.$value->id.'/wa/edit')}}" class="btn bg-gradient-info mt-4 mb-0">EDIT</a>
												<button type="submit" class="btn bg-gradient-info mt-4 mb-0">HAPUS</button>
												<a href="{{url('choice/notif_akun/notif_wa/'.$value->id.'/wa/test')}}" class="btn bg-gradient-info mt-4 mb-0">TEST</a>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>

						</div>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<a href="{{url('choice/notif_akun/notif_sms/add_sms')}}" class="btn bg-gradient-info mt-4 mb-0">TAMBAH NOTIF SMS</a>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">

							<table class="table text-center align-items-center justify-content-center mb-0"  id="example2">
								<thead>
									<tr>
										<th class="text-center">NO</th>
										<th class="text-center">SMS</th>
										<th class="text-center">NUMBER TWILIO</th>
										<th class="text-center">ACCOUNT SID</th>
										<th class="text-center">AUTH TOKEN</th>
										<th class="text-center">JAM</th>
										<th class="text-center">MENIT</th>
										<th class="text-center">AKSI</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data['notifsms'] as $key => $value)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$value['no_sms']}}</td>
										<td>{{$value['no_twilio']}}</td>
										<td>{{substr($value['account_sid'],0,10)}}</td>
										<td>{{substr($value['auth_token'],0,10)}}</td>
										<td>{{$value['jam']}}</td>
										<td>{{$value['menit']}}</td>
										<td>
											<form action="{{url('choice/notif_akun/notif_sms/'.$value->id.'/sms/hapus')}}" method="POST">
												@csrf
												@method('delete')
												<a href="{{url('choice/notif_akun/notif_sms/'.$value->id.'/sms/edit')}}" class="btn bg-gradient-info mt-4 mb-0">EDIT</a>
												<button type="submit" class="btn bg-gradient-info mt-4 mb-0">HAPUS</button>
												<a href="{{url('choice/notif_akun/notif_sms/'.$value->id.'/sms/test')}}" class="btn bg-gradient-info mt-4 mb-0">TEST</a>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>

						</div>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<a href="{{url('choice/notif_akun/notif_email/add_email')}}" class="btn bg-gradient-info mt-4 mb-0">TAMBAH NOTIF EMAIL</a>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">

							<table class="table text-center align-items-center justify-content-center mb-0"  id="example2">
								<thead>
									<tr>
										<th class="text-center">NO</th>
										<th class="text-center">AKUN EMAIL</th>
										<th class="text-center">JAM</th>
										<th class="text-center">MENIT</th>
										<th class="text-center">AKSI</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data['notifemail'] as $key => $value)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$value['akun_email']}}</td>
										<td>{{$value['jam']}}</td>
										<td>{{$value['menit']}}</td>
										<td>
											<form action="{{url('choice/notif_akun/notif_email/'.$value->id.'/email/hapus')}}" method="POST">
												@csrf
												@method('delete')
												<a href="{{url('choice/notif_akun/notif_email/'.$value->id.'/email/edit')}}" class="btn bg-gradient-info mt-4 mb-0">EDIT</a>
												<button type="submit" class="btn bg-gradient-info mt-4 mb-0">HAPUS</button>
												<a href="{{url('choice/notif_akun/notif_email/'.$value->id.'/email/test')}}" class="btn bg-gradient-info mt-4 mb-0">TEST</a>
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
	$(function () {
		$("#example2").DataTable({
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