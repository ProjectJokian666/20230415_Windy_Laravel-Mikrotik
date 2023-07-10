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
						<a href="{{url('choice/notif_akun/notif_email/add_email')}}" class="btn bg-gradient-info mt-4 mb-0">TAMBAH NOTIF EMAIL</a>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">

							<table class="table text-center align-items-center justify-content-center mb-0"  id="example3">
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
												<button type="button" class="btn bg-gradient-info mt-4 mb-0" onclick="test_notif_email(<?= $value->id ?>)">TEST</button>
												<!-- <a href="{{url('choice/notif_akun/notif_email/'.$value->id.'/email/test')}}" class="btn bg-gradient-info mt-4 mb-0">TEST</a> -->
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
		$("#example3").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	});
	function test_notif_email(id){
		console.log(id);
		$.ajax({
			url:"{{route('choice.notif_akun.notif_email.test_sinyal')}}",
			data:{
				data:id
			},
			success:function(data){
					console.log(data)
			},
			error:function(data){
					console.log(data)
			}
		});
	}
</script>
@endpush