@extends('Layouts.app')

@push('csss')
@endpush

@section('content')
<div class="content-header">
	<div class="content-fluid text-center">
		<h3>Resources</h3>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-bordered table-sm">
					<tr>
						<td>Uptime</td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_uptime">0</td>
					</tr>
					<!-- Memory -->
					<tr>
						<td rowspan="2">Memory</td><td class="text-center">:</td><td>Free</td><td class="text-right" id="show_data_free_memory">0</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Total</td><td class="text-right" id="show_data_total_memory">0</td>
					</tr>
					<!-- CPU -->
					<tr>
						<td rowspan="4"><p>CPU</p></td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_cpu">0</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Count</td><td class="text-right"id="show_data_cpu_count">0</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Frequency</td><td class="text-right" id="show_data_cpu_frequency">0</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Load</td><td class="text-right" id="show_data_cpu_load">0</td>
					</tr>
					<!-- HHD -->
					<tr>
						<td rowspan="2">HDD</td><td class="text-center">:</td><td>Free</td><td class="text-right" id="show_data_free_hdd">0</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Total</td><td class="text-right" id="show_data_total_hdd">0</td>
					</tr>
					<!-- Sector -->
					<tr>
						<td rowspan="2">Sector Writes</td><td class="text-center">:</td><td>Since Reboot</td><td class="text-right" id="show_data_since_reboot">0</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Total</td><td class="text-right" id="show_data_total" id="show_data_total">0</td>
					</tr>
					<tr>
						<td>Architecture</td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_architecture">0</td>
					</tr>
					<tr>
						<td>Board</td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_board">0</td>
					</tr>
					<tr>
						<td>Version</td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_version">0</td>
					</tr>
					<tr>
						<td>Build-time</td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_build_time">0</td>
					</tr>
					<tr>
						<td>Factory Software</td><td class="text-center">:</td><td colspan="2" class="text-right" id="show_data_factory_software">0</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script type="text/javascript">
	setInterval(()=>{
		uptime();
		free_memory();
		total_memory();
		cpu();
		cpu_count();
		cpu_frequency();
		cpu_load();
		free_hdd();
		total_hdd();
		since_reboot();
		total();
		architecture();
		board();
		version();
		build_time();
		factory_software();
	},5000);

	function uptime() {
		$('#show_data_uptime').load('{{route('realtime.uptime')}}');
	}
	function free_memory() {
		$('#show_data_free_memory').load('{{route('realtime.free_memory')}}');
	}
	function total_memory() {
		$('#show_data_total_memory').load('{{route('realtime.total_memory')}}');
	}
	function cpu(){
		$("#show_data_cpu").load('{{route('realtime.cpu')}}');
	}
	function cpu_count() {
		$("#show_data_cpu_count").load('{{route('realtime.cpu_count')}}');
	}
	function cpu_frequency() {
		$("#show_data_cpu_frequency").load('{{route('realtime.cpu_frequency')}}');
	}
	function cpu_load() {
		$("#show_data_cpu_load").load('{{route('realtime.cpu_load')}}');
	}
	function free_hdd() {
		$("#show_data_free_hdd").load('{{route('realtime.free_hdd')}}');
	}
	function total_hdd() {
		$("#show_data_total_hdd").load('{{route('realtime.total_hdd')}}');
	}
	function since_reboot() {
		$("#show_data_since_reboot").load('{{route('realtime.since_reboot')}}');
	}
	function total() {
		$("#show_data_total").load('{{route('realtime.total_hdd')}}');
	}
	function architecture(){
		$("#show_data_architecture").load('{{route('realtime.architecture')}}');
	}
	function board(){
		$("#show_data_board").load('{{route('realtime.board')}}');
	}
	function version(){
		$("#show_data_version").load('{{route('realtime.version')}}');
	}
	function build_time(){
		$("#show_data_build_time").load('{{route('realtime.build_time')}}');
	}
	function factory_software(){
		$("#show_data_factory_software").load('{{route('realtime.factory_software')}}');
	}

</script>
@endpush