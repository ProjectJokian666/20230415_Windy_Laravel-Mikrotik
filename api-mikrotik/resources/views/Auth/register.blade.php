@extends('Layouts.auth')

@section('title','Register')

@push('csss')
<link rel="stylesheet" href="{{asset('template/plugins/toastr/toastr.min.css')}}">
@endpush

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{url('login')}}"><b>PUSKOM</b>POLINEMA</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Registrasi Admin</p>

			<form action="{{url('post_register')}}" method="post">
				@csrf
				<div class="input-group mb-3">
					<input type="text" name="username" class="form-control" placeholder="Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<!-- /.col -->
				<center>
					<div class="col-6">
						<button type="submit" class="btn btn-primary btn-block">Create</button>
					</div>
				</center>
				<p class="mb-1">
					<a href="{{url('login')}}" class="text-center">Already have an Account? Login!</a>
				</p>
				<!-- /.col -->
			</div>
		</form>

		<!-- /.social-auth-links -->


		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->
@endsection

@push('jss')
<script src="{{asset('template/plugins/toastr/toastr.min.js')}}"></script>
<script>
	// console.log({!!json_encode(session('status'))!!});
	if ({!!json_encode(session('gagal'))!!}) {
		$(document).Toasts('create', {
			title: 'Status Login',
			class: 'bg-danger',
			autohide: true,
			delay: 2000,
			body: {!!json_encode(session('gagal'))!!}
		});
	}
	if ({!!json_encode(session('sukses'))!!}) {
		$(document).Toasts('create', {
			title: 'Status Login',
			class: 'bg-success',
			autohide: true,
			delay: 2000,
			body: {!!json_encode(session('sukses'))!!}
		});
	}
</script>
@endpush