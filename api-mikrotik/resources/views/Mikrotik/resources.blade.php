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
	setInterval("uptime();",1000);
	function uptime() {
		$.ajax({
			url:"{{route('realtime_uptime')}}",
			type:"GET",
			success:function(data){
				$('#show_data_uptime').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_uptime').text('0');
			}
		})
	}

	setInterval("free_memory();",1000);
	function free_memory() {
		$.ajax({
			url:"{{route('realtime_free_memory')}}",
			type:"GET",
			success:function(data){
				$('#show_data_free_memory').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_free_memory').text('0');
			}
		})
	}

	setInterval("total_memory();",1000);
	function total_memory() {
		$.ajax({
			url:"{{route('realtime_total_memory')}}",
			type:"GET",
			success:function(data){
				$('#show_data_total_memory').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_total_memory').text('0');
			}
		})
	}

	setInterval("cpu();",1000);
	function cpu(){
		$.ajax({
			url:"{{route('realtime_cpu')}}",
			type:"GET",
			success:function(data){
				$("#show_data_cpu").text(data);
			},
			error:function(data){
				$("#show_data_cpu").text('0')
			}
		})
	}
	
	setInterval("cpu_count();",1000);
	function cpu_count() {
		$.ajax({
			url:"{{route('realtime_cpu_count')}}",
			type:"GET",
			success:function(data){
				$("#show_data_cpu_count").text(data);
			},
			error:function(data){
				$("#show_data_cpu_count").text('0')
			}
		})
	}
	
	setInterval("cpu_frequency();",1000);
	function cpu_frequency() {
		$.ajax({
			url:"{{route('realtime_cpu_frequency')}}",
			type:"GET",
			success:function(data){
				$("#show_data_cpu_frequency").text(data);
			},
			error:function(data){
				$("#show_data_cpu_frequency").text('0')
			}
		})
	}
	
	setInterval("cpu_load();",1000);
	function cpu_load() {
		$.ajax({
			url:"{{route('realtime_cpu_load')}}",
			type:"GET",
			success:function(data){
				$("#show_data_cpu_load").text(data);
			},
			error:function(data){
				$("#show_data_cpu_load").text('0')
			}
		})
	}
	
	setInterval("free_hdd();",1000);
	function free_hdd() {
		$.ajax({
			url:"{{route('realtime_free_hdd')}}",
			type:"GET",
			success:function(data){
				$("#show_data_free_hdd").text(data);
			},
			error:function(data){
				$("#show_data_free_hdd").text('0')
			}
		})
	}
	
	setInterval("total_hdd();",1000);
	function total_hdd() {
		$.ajax({
			url:"{{route('realtime_total_hdd')}}",
			type:"GET",
			success:function(data){
				$("#show_data_total_hdd").text(data);
			},
			error:function(data){
				$("#show_data_total_hdd").text('0')
			}
		})
	}
	
	setInterval("since_reboot();",1000);
	function since_reboot() {
		$.ajax({
			url:"{{route('realtime_since_reboot')}}",
			type:"GET",
			success:function(data){
				$("#show_data_since_reboot").text(data);
			},
			error:function(data){
				$("#show_data_since_reboot").text('0')
			}
		})
	}
	
	setInterval("total();",1000);
	function total() {
		$.ajax({
			url:"{{route('realtime_total')}}",
			type:"GET",
			success:function(data){
				$("#show_data_total").text(data);
			},
			error:function(data){
				$("#show_data_total").text('0')
			}
		})
	}
	
	setInterval("architecture();",1000);
	function architecture(){
		$.ajax({
			url:"{{route('realtime_architecture')}}",
			type:"GET",
			success:function(data){
				$("#show_data_architecture").text(data);
			},
			error:function(data){
				$("#show_data_architecture").text('0')
			}
		})
	}
	
	setInterval("board();",1000);
	function board(){
		$.ajax({
			url:"{{route('realtime_board')}}",
			type:"GET",
			success:function(data){
				$("#show_data_board").text(data);
			},
			error:function(data){
				$("#show_data_board").text('0')
			}
		})
	}
	
	setInterval("version();",1000);
	function version(){
		$.ajax({
			url:"{{route('realtime_version')}}",
			type:"GET",
			success:function(data){
				$("#show_data_version").text(data);
			},
			error:function(data){
				$("#show_data_version").text('0')
			}
		})
	}
	
	setInterval("build_time();",1000);
	function build_time(){
		$.ajax({
			url:"{{route('realtime_build_time')}}",
			type:"GET",
			success:function(data){
				$("#show_data_build_time").text(data);
			},
			error:function(data){
				$("#show_data_build_time").text('0')
			}
		})
	}
	
	setInterval("factory_software();",1000);
	function factory_software(){
		$.ajax({
			url:"{{route('realtime_factory_software')}}",
			type:"GET",
			success:function(data){
				$("#show_data_factory_software").text(data);
			},
			error:function(data){
				$("#show_data_factory_software").text('0')
			}
		})
	}

</script>
@endpush