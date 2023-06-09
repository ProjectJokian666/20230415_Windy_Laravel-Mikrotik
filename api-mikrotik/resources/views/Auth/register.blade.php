@extends('Layouts.auth')

@section('title','Register')

@push('csss')
@endpush

@section('content')
<section>
	<div class="page-header min-vh-75">
		<div class="container">
			<div class="row">
				<div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
					<div class="card card-plain mt-6">
						<div class="card-header pb-0 text-right bg-transparent">
							<h3 class="font-weight-bolder text-info text-gradient">Selamat Datang di Monitoring Jaringan Puskom Polinema</h3>
							<p class="mb-0">Registrasi Admin</p>
						</div>
						<div class="card-body">
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
							<form action="{{url('post_register')}}" method="post">
								@csrf
								<label>Username</label>
								<div class="mb-3">
									<input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="username-addon">
								</div>
								<label>Password</label>
								<div class="mb-3">
									<input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
								</div>
								<div class="text-center">
									<button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Create</button>
								</div>
							</form>
						</div>
						<div class="card-footer text-center pt-0 px-lg-2 px-1">
							<p class="mb-4 text-sm mx-auto">
								Already have an Account?
								<a href="{{url('login')}}" class="text-info text-gradient font-weight-bold">Sign In</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
						<div class="oblique-image bg-cover position-absolute fixed-top me-auto h-100 z-index-0 ms-n6" style="background-image:url({{asset('soft-ui-dashboard-main')}}/assets/img/curved-images/curved9.jpg)"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.login-box -->
@endsection

@push('jss')
<script type="text/javascript">
	$(".alert-dismissible").fadeIn().delay(3000).fadeOut();
</script>
@endpush