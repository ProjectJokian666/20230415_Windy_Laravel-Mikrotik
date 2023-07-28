@extends('Layouts.auth')

@section('title','Edit Notif Wa')

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
					<form action="{{url('choice/notif_akun/notif_wa/'.$data['data']->id.'/wa/edit')}}" method="POST">
						@csrf
						@method('patch')
						<div class="card-body">
							<label>No. Whatsapp</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="+628" aria-label="No Wa" name="no_wa" value="{{$data['data']->no_wa}}">
							</div>
							<label>No. Twilio</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="sms Twilio" aria-label="No sms" name="no_twilio" value="{{$data['data']->no_twilio}}">
							</div>
							<label>Account SID</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="SID" aria-label="No sms" name="account_sid" value="{{$data['data']->account_sid}}">
							</div>
							<label>Auth Token</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="TOKEN" aria-label="No sms" name="auth_token" value="{{$data['data']->auth_token}}">
							</div>
							<p class="text-sm mt-3 mb-0">PERIODIK DALAM PENGIRIMAN DATA MONITORING</p>
							<label>Jam Mulai</label>
							<div class="mb-3">
								<input type="time" class="form-control" placeholder="JAM" aria-label="No sms" name="jam_mulai" value="{{$data['data']->mulai}}">
							</div>
							<label>Jam Berakhir</label>
							<div class="mb-3">
								<input type="time" class="form-control" placeholder="MENIT" aria-label="No sms" name="jam_berakhir" value="{{$data['data']->berakhir}}">
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