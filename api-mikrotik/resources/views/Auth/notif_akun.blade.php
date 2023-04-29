@extends('Layouts.auth')

@section('title','Log in Akun')

@section('content')
<div class="card p-3 login-box" style="width:1000px">

	<div class="d-flex justify-content-center">
		<div class="mb-3">
			<div class="login-logo">
				<a href="{{url('login')}}"><b>LIST AKUN</b>NOTIFIKASI</a>
			</div>
			<p class="login-box-msg">List Untuk Mengirimkan Notifikasi Monitoring Router Mikrotik</p>

			<div class="row">
				<div class="col-6">
				</div>
			</div>

		</div>

	</div>

	<table class="table table-sm table-bordered text-center">
		<thead>
			<tr>
				<th>WHATSAPP</th>
				<th>TELEGRAM</th>
				<th>EMAIL</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td contenteditable=true id="wa">{{$data['notif']->wa}}</td>
				<td contenteditable=true id="tele">{{$data['notif']->telegram}}</td>
				<td contenteditable=true id="email">{{$data['notif']->email}}</td>
				<td>
					<button class="btn-sm btn-success" id="simpan">SIMPAN</button>
				</td>
			</tr>
		</tbody>
	</table>
	<a href="{{url('choice')}}" class="btn btn-danger btn-block">Kembali</a>
</div>

<!-- /.login-box -->
@endsection

@push('jss')
<script>
	$(document).on('click','#simpan',function(){
		let wa = $('#wa').text();
		let tele = $('#tele').text();
		let email = $('#email').text();
		$.ajax({
			url:"{{route('choice.simpan_notif_akun')}}",
			type:"POST",
			data:{
				"wa":wa,
				"tele":tele,
				"email":email,
				"_token":"{{csrf_token()}}",
			},
			success:function(data){
				// if (data.sukses=="ok") {

				// }
				// console.log("sukses",data.sukses)
			},
			error:function(data) {
				// console.log("eror",data)
			}

		});
		// console.log();
	});
</script>
@endpush