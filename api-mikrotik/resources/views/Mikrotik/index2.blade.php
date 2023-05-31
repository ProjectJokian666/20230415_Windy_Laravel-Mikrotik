@extends('Layouts.app')

@section('title','DASHBOARD')

@push('csss')

@endpush

@section('content')
<div class="content-fluid card">
	<div class="content-header">
		<div class="content-fluid text-center">
			<h3>Dashboard</h3>
		</div>
		<div class="row">

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clock"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Uptime</span>
						<span class="info-box-number" id="show_data_uptime">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">CPU</span>
						<span class="info-box-number" id="show_data_cpu">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">CPU Load</span>
						<span class="info-box-number" id="show_data_cpu_load">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hdd"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total HDD</span>
						<span class="info-box-number" id="show_data_total_hdd">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-hdd"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Free HDD</span>
						<span class="info-box-number" id="show_data_free_hdd">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-memory"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Memory</span>
						<span class="info-box-number" id="show_data_total_memory">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-memory"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Free Memory</span>
						<span class="info-box-number" id="show_data_free_memory">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-primary elevation-1"><i class="fas fa-clipboard"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Board Name</span>
						<span class="info-box-number" id="show_data_board">0</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6 p-3">
				<select name="interface" id="interface" style="width:100%;">
					@foreach($data['interface'] as $key => $value)
					<option value="{{$value['name']}}">{{$value['name']}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-6 p-3">
				Traffic Tx : <span id="traffic_tx">0</span>, Traffic Rx : <span id="traffic_rx">0</span>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">
							<i class="far fa-chart-bar"></i>
							Interactive Area Chart
						</h3>

						<div class="card-tools">
							Real time
							<div class="btn-group" id="realtime" data-toggle="btn-toggle">
								<button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
								<button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div id="interactive" style="height: 300px;"></div>
					</div>
					<!-- /.card-body-->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script src="{{asset('template')}}/plugins/flot/jquery.flot.js"></script>
<script>
// realtime data uptime
	setInterval(()=>{
		showdatauptime();
		showdatacpu();
		showdatacpu_load();
		showdatacpu_loadtotal_hdd();
		showdatafree_hdd();
		showdatatotal_memory();
		showdatafree_memory();
		showdataboard();
		showtraffictx();
		showtrafficrx();
	},5000);
	function showdatauptime() {
		$('#show_data_uptime').load('{{route('realtime.uptime')}}');
	}
	function showdatacpu() {
		$('#show_data_cpu').load('{{route('realtime.cpu')}}');
	}
	function showdatacpu_load() {
		$('#show_data_cpu_load').load('{{route('realtime.cpu_load')}}');
	}
	function showdatacpu_loadtotal_hdd() {
		$('#show_data_total_hdd').load('{{route('realtime.free_hdd')}}');
	}
	function showdatafree_hdd() {
		$('#show_data_free_hdd').load('{{route('realtime.total_hdd')}}');
	}
	function showdatatotal_memory() {
		$('#show_data_total_memory').load('{{route('realtime.total_memory')}}');
	}
	function showdatafree_memory() {
		$('#show_data_free_memory').load('{{route('realtime.free_memory')}}');
	}
	function showdataboard() {
		$('#show_data_board').load('{{route('realtime.board')}}');
	}
	function showtraffictx() {
		let data_interface = $('#interface').val();
		let join_data = "";
		if (data_interface!=null) {
			let split_data = data_interface.split(" ");
			join_data = split_data.join('%20');
		}
		else{
			join_data = "";
		}

		var url = "{{route('realtime.tx','isi')}}";

		// $.ajax({
		// 	url:url.replace('isi',join_data),
		// 	type:"GET",
		// 	success:function(data){
		// 		$('#traffic_tx').text(data);
		// 		$('#traffic_rx').text(data);
		// 		// console.log(data);
		// 	},
		// 	error:function(data){
		// 		// console.log(data);
		// 	}
		// });

		$('#traffic_tx').load(url.replace('isi',join_data));
		// var data_rx="";
		// data_rx.load(url.replace('isi',join_data);
		// $('#traffic_tx').text("a");
		// $('#traffic_rx').text("a");
	}
	function showtrafficrx() {
		let data_interface = $('#interface').val();
		let join_data = "";
		if (data_interface!=null) {
			let split_data = data_interface.split(" ");
			join_data = split_data.join('%20');
		}
		else{
			join_data = "";
		}

		var url = "{{route('realtime.rx','isi')}}";

		$('#traffic_rx').load(url.replace('isi',join_data));
	}
</script>
@endpush