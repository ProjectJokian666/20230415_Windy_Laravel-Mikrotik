@extends('Layouts.auth')

@section('title','Edit Notif Email')

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
					<form action="{{url('choice/notif_akun/notif_email/'.$data['data']->id.'/email/edit')}}" method="POST">
						@csrf
						@method('patch')
						<div class="card-body">
							<label>Akun Email</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Akun Email" aria-label="Akun Email" name="akun_email" value="{{$data['data']->akun_email}}">
							</div>
							<p class="text-sm mt-3 mb-0">PERIODIK DALAM PENGIRIMAN DATA MONITORING</p>
							<label>Jam</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="JAM" aria-label="No sms" name="jam" value="{{$data['data']->jam}}">
							</div>
							<label>Menit</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="MENIT" aria-label="No sms" name="menit" value="{{$data['data']->menit}}">
							</div>
							<div class="text-center justify-content-between">
								<button type="submit" class="btn bg-gradient-info w-25 mt-4 mb-0">UBAH</button>
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