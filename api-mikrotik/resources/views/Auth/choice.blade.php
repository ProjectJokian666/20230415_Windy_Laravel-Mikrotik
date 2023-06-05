@extends('Layouts.auth')

@section('title','Choice')

@section('content')
<section>
	<div class="page-header min-vh-75">
		<div class="container">
			<div class="row">

				@if(session('sukses'))
				<div class="col-xl-12 d-flex flex-column mx-auto">
					<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
						<span class="alert-text"><strong>Success! </strong>{{session('sukses')}}</span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
				@endif
				
				<a href="{{url('choice/login_akun')}}" class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto mb-5">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold"></p>
										<h5 class="font-weight-bolder mb-0">
											LOGIN AKUN MIKROTIK
											<span class="text-success text-sm font-weight-bolder">
											</span>
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fas fa-sign-in-alt text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>

				<a href="{{url('choice/list_akun')}}" class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto mb-5">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold"></p>
										<h5 class="font-weight-bolder mb-0">
											LIST AKUN MIKROTIK
											<span class="text-success text-sm font-weight-bolder"></span>
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fas fa-file-alt text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>

				<a href="{{url('choice/notif_akun')}}" class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto mb-5">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold"></p>
										<h5 class="font-weight-bolder mb-0">
											NOTIFIKASI AKUN
											<span class="text-danger text-sm font-weight-bolder"></span>
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fab fa-whatsapp text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
				
			</div>
		</div>
	</div>
</section>
@endsection

@push('jss')
<script type="text/javascript">
	$(".alert-dismissible").fadeIn().delay(3000).fadeOut();
</script>
@endpush