@extends('Layouts.auth')

@section('title','List Notif')

@push('csss')
<!-- <link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}"> -->
<!-- <link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> -->
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
						<div class="table-responsive p-0">

							<table class="table align-items-center justify-content-center mb-0"  id="example1">
								<thead>
									<tr>
										<th class="text-center">NO</th>
										<th class="text-center">WHATSAPP</th>
										<th class="text-center">NUMBER TWILIO</th>
										<th class="text-center">ACCOUNT SID</th>
										<th class="text-center">AUTH TOKEN</th>
										<th class="text-center">Button</th>
									</tr>
								</thead>
							</thead>
							<tbody>
								
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
<!-- <script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script> -->
<!-- <script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script> -->
<script type="text/javascript">
	$(".alert-dismissible").fadeIn().delay(3000).fadeOut();

	// $(function () {
	// 	$("#example1").DataTable({
	// 		"paging": true,
	// 		"lengthChange": true,
	// 		"searching": true,
	// 		"ordering": true,
	// 		"info": false,
	// 		"autoWidth": false,
	// 		"responsive": true,
	// 	});
	// });
</script>
@endpush