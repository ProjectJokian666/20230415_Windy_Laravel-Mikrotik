@extends('Layouts.auth')

@section('title','Log in')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{url('login')}}"><b>PUSKOM</b>POLINEMA</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Login Untuk Masuk Aplikasi Monitoring</p>

			<form action="{{url('post_login')}}" method="post">
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
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
				</center>
				<p class="mb-1">
					<a href="{{url('register')}}" class="text-center">Create an Account!</a>
				</p>
				<!-- /.col -->
			</form>
		</div>

		<!-- /.social-auth-links -->


		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->
@endsection