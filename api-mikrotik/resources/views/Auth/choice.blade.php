@extends('Layouts.auth')

@section('title','Choice')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{url('login')}}"><b>PUSKOM</b>POLINEMA</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">PILIH AKSI</p>

			<form action="{{url('post_login')}}" method="post">
				<div class="row mb-3">
					<!-- /.col -->
					<div class="col-6">
						<a href="{{url('choice/list_akun')}}" class="btn btn-primary btn-block">LIST AKUN MIKROTIK</a>
					</div>
					<div class="col-6">
						<a href="{{url('choice/login_akun')}}" class="btn btn-success btn-block">LOGIN AKUN MIKROTIK</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<a href="{{url('logout')}}" class="btn btn-danger btn-block">LOGOUT</a>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.col -->
			</div>
		</form>

		<!-- /.social-auth-links -->


		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->
@endsection