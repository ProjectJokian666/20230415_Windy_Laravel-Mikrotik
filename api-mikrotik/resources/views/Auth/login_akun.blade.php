@extends('Layouts.auth')

@section('title','Log in Akun')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{url('login')}}"><b>PUSKOM</b>POLINEMA</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Login Untuk Masuk Pada Monitoring Router Mikrotik</p>

			<form action="{{url('choice/post_login')}}" method="post">
				<div class="input-group mb-3">
					<input type="text" name="ip" class="form-control" placeholder="IP Address">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-globe"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="text" name="user" class="form-control" placeholder="User">
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
				<div class="row">
					<div class="col-6">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
					<div class="col-6">
						<a href="{{url('choice')}}" class="btn btn-danger btn-block">Cancel</a>
					</div>
				</div>
				<!-- /.col -->
			</form>
		</div>
	</div>
</div>
<!-- /.login-box -->
@endsection