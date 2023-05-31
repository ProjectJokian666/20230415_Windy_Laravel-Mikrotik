@extends('Layouts.app')

@push('csss')
<link rel="stylesheet" type="text/css" href="{{asset('matrix-admin-bt5-master')}}/dist/css/jquery.timepicker.min.css"/>
<link href="{{asset('matrix-admin-bt5-master')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">LOG</h4>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-4">
			<div class="card">
				<div class="input-group">
					<input type="text" class="form-control mytimepicker" placeholder="H:mm:ss" id="time1">
					<div class="input-group-append">
						<span class="input-group-text h-100"><i class="mdi mdi-calendar"></i></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
				<div class="input-group">
					<input type="text" class="form-control mytimepicker" placeholder="H:mm:ss" id="time2">
					<div class="input-group-append">
						<span class="input-group-text h-100"><i class="mdi mdi-calendar"></i></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
				<button type="button" class="btn btn-sm btn-info" id="cek_log">CEK</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered table-sm text-center" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Times</th>
								<th>Topics</th>
								<th>Messages</th>
							</tr>
						</thead>
						<!-- <tbody>
							<?php
							$a=110;
							$da[]=array();
							for ($i=1; $i < $a; $i++) { 
								array_push($da,$i);
							} 
							?>
							@foreach($da as $key => $value)
							<form action="{{url('choice/list_akun',$key)}}" method="post">
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>Times</td>
									<td>Topics</td>
									<td>Messages</td>
								</tr>
							</form>
							@endforeach
						</tbody> -->
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script src="{{asset('matrix-admin-bt5-master')}}/dist/js/jquery.timepicker.min.js"></script>
<script src="{{asset('matrix-admin-bt5-master')}}/assets/extra-libs/DataTables/datatables.min.js"></script>
<script type="text/javascript">
	$(".mytimepicker").timepicker({
				timeFormat: 'HH:mm:ss',
				interval: 60,
				minTime: '01',
				maxHour: '24',
				defaultTime: '1',
				startTime: '10:00',
				dynamic: false,
				dropdown: true,
				scrollbar: true
		// change:function(time){
			// var timepicker = element.timepicker({	
			// })
		// }
	});
	$('#cek_log').on('click',function(){
		console.log('okk',$('#time1').val(),$('#time2').val())
	});
	show_data_log();
	function show_data_log(){
		$("#dataTable").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
			ajax:{
				url:"{{route('get_log')}}",
				type:"get",
				contentType: 'application/json',
			},
			columns:[
			{
				data:null,
				render:function(data,type,row,meta){
					return meta.row + meta.settings._iDisplayStart+1
				}
			},
			{data:"time"},
			{data:"topic"},
			{data:"message"},
			]
		});
	}
</script>
@endpush