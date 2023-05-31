@extends('Layouts.app')

@section('title','DASHBOARD')

@push('csss')
<link href="{{asset('matrix-admin-bt5-master')}}/assets/libs/flot/css/float-chart.css" rel="stylesheet" />
@endpush

@section('content')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">DASHBOARD</h4>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-cyan text-center">
					<h1 class="font-light text-white">
						<i class="mdi mdi-alarm"></i>
					</h1>
					<h6 class="text-white">UPTIME</h6>
					<h6 class="text-white" id="show_data_uptime">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-success text-center">
					<h1 class="font-light text-white">
						<i class="mdi mdi-chart-areaspline"></i>
					</h1>
					<h6 class="text-white">CPU</h6>
					<h6 class="text-white" id="show_data_cpu">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-warning text-center">
					<h1 class="font-light text-white">
						<i class="mdi mdi-chart-areaspline"></i>
					</h1>
					<h6 class="text-white">CPU LOAD</h6>
					<h6 class="text-white" id="show_data_cpu_load">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-danger text-center">
					<h1 class="font-light text-white">
						<i class="fas fa-database"></i>
					</h1>
					<h6 class="text-white">TOTAL HDD</h6>
					<h6 class="text-white" id="show_data_total_hdd">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-info text-center">
					<h1 class="font-light text-white">
						<i class="fas fa-database"></i>
					</h1>
					<h6 class="text-white">FREE HDD</h6>
					<h6 class="text-white" id="show_data_free_hdd">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-danger text-center">
					<h1 class="font-light text-white">
						<i class="mdi mdi-memory"></i>
					</h1>
					<h6 class="text-white">TOTAL MEMORY</h6>
					<h6 class="text-white" id="show_data_total_memory">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-info text-center">
					<h1 class="font-light text-white">
						<i class="mdi mdi-memory"></i>
					</h1>
					<h6 class="text-white">FREE MEMORY</h6>
					<h6 class="text-white" id="show_data_free_memory">0</h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3">
			<div class="card card-hover">
				<div class="box bg-cyan text-center">
					<h1 class="font-light text-white">
						<i class="mdi mdi-clipboard"></i>
					</h1>
					<h6 class="text-white">BOARD NAME</h6>
					<h6 class="text-white" id="show_data_board">0</h6>
				</div>
			</div>
		</div>
	</div>
	<div class="row pb-3">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">INTERFACES</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group row">
						<div class="col-6">
							<select name="interface" id="interface" style="width:100%;">
								@foreach($data['interface'] as $key => $value)
								<option value="{{$value['name']}}">{{$value['name']}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-6">
							Traffic Tx : <span id="traffic_tx">0</span>, Traffic Rx : <span id="traffic_rx">0</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Real Time Interfaces</h5>
					<div id="real-time" style="height: 400px; width:100%"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/flot/jquery.flot.js"></script>
<script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>

<script src="{{asset('matrix-admin-bt5-master')}}/dist/js/pages/chart/chart-page-init.js"></script>
<script type="text/javascript">
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
		$('#traffic_tx').load(url.replace('isi',join_data));
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