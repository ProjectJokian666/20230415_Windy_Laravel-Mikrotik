@extends('Layouts.auth')

@section('title','Add Notif Sms')

@push('csss')
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
					<form action="{{url('choice/notif_akun/notif_sms')}}" method="POST">
						@csrf
						<div class="card-body">
							<label>No. Sms</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="+628" aria-label="No sms" name="no_sms">
							</div>
							<label>No. Twilio</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="sms Twilio" aria-label="No sms" name="no_twilio">
							</div>
							<label>Account SID</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="SID" aria-label="No sms" name="account_sid">
							</div>
							<label>Auth Token</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="TOKEN" aria-label="No sms" name="auth_token">
							</div>
							<label>Jam</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="JAM" aria-label="No sms" name="jam" value="1">
							</div>
							<label>Menit</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="MENIT" aria-label="No sms" name="menit" value="00">
							</div>
							<label>Detik</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="DETIK" aria-label="No sms" name="detik" value="00">
							</div>
							<div class="text-center justify-content-between">
								<button type="submit" class="btn bg-gradient-info w-25 mt-4 mb-0">TAMBAH</button>
								<a href="{{url('choice/notif_akun')}}" class="btn bg-gradient-info w-25 mt-4 mb-0">BATAL</a>
							</div>
						</div>
					</form>
				</div>
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