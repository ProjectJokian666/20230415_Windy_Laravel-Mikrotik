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
					<form action="{{url('choice/notif_akun/notif_wa')}}" method="POST">
						@csrf
						<div class="card-body">
							<label>No. Whatsapp</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="+628" aria-label="No Wa" name="no_wa">
							</div>
							<label>No. Twilio</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Wa Twilio" aria-label="No Wa" name="no_twilio">
							</div>
							<label>Account SID</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="SID" aria-label="No Wa" name="account_sid">
							</div>
							<label>Auth Token</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="TOKEN" aria-label="No Wa" name="auth_token">
							</div>
							<label>Jam</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="JAM" aria-label="No Wa" name="jam" value="1">
							</div>
							<label>Menit</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="MENIT" aria-label="No Wa" name="menit" value="00">
							</div>
							<label>Detik</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="DETIK" aria-label="No Wa" name="detik" value="00">
							</div>
							<div class="text-center">
								<button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">TAMBAH</button>
							</div>
						</div>
					</form>
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
										<th class="text-center">DETIK</th>
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
										<td>{{$value['detik']}}</td>
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