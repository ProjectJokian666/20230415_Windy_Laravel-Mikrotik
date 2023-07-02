@extends('Layouts.app')

@push('csss')
@endpush

@section('content')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">RESOURCES</h4>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered table-sm">
						<tr>
							<td>Uptime</td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_uptime">0</td>
						</tr>
						<!-- Memory -->
						<tr>
							<td rowspan="2">Memory</td><td class="text-center">:</td><td>Free</td><td style="text-align:right;" id="show_data_free_memory">0</td>
						</tr>
						<tr>
							<td class="text-center">:</td><td>Total</td><td style="text-align:right;" id="show_data_total_memory">0</td>
						</tr>
						<!-- CPU -->
						<tr>
							<td rowspan="4"><p>CPU</p></td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_cpu">0</td>
						</tr>
						<tr>
							<td class="text-center">:</td><td>Count</td><td style="text-align:right;"id="show_data_cpu_count">0</td>
						</tr>
						<tr>
							<td class="text-center">:</td><td>Frequency</td><td style="text-align:right;" id="show_data_cpu_frequency">0</td>
						</tr>
						<tr>
							<td class="text-center">:</td><td>Load</td><td style="text-align:right;" id="show_data_cpu_load">0</td>
						</tr>
						<!-- HHD -->
						<tr>
							<td rowspan="2">HDD</td><td class="text-center">:</td><td>Free</td><td style="text-align:right;" id="show_data_free_hdd">0</td>
						</tr>
						<tr>
							<td class="text-center">:</td><td>Total</td><td style="text-align:right;" id="show_data_total_hdd">0</td>
						</tr>
						<!-- Sector -->
						<tr>
							<td rowspan="2">Sector Writes</td><td class="text-center">:</td><td>Since Reboot</td><td style="text-align:right;" id="show_data_since_reboot">0</td>
						</tr>
						<tr>
							<td class="text-center">:</td><td>Total</td><td style="text-align:right;" id="show_data_total" id="show_data_total">0</td>
						</tr>
						<tr>
							<td>Architecture</td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_architecture">0</td>
						</tr>
						<tr>
							<td>Board</td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_board">0</td>
						</tr>
						<tr>
							<td>Version</td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_version">0</td>
						</tr>
						<tr>
							<td>Build-time</td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_build_time">0</td>
						</tr>
						<tr>
							<td>Factory Software</td><td class="text-center">:</td><td colspan="2" style="text-align:right;" id="show_data_factory_software">0</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script type="text/javascript">
	setInterval(()=>{
		// uptime();
		// free_memory();
		// total_memory();
		// cpu();
		// cpu_count();
		// cpu_frequency();
		// cpu_load();
		// free_hdd();
		// total_hdd();
		// since_reboot();
		// total();
		// architecture();
		// board();
		// version();
		// build_time();
		// factory_software();
		resources()
	},5000);

	function resources(){
		// console.log('aa');
		$.ajax({
			url:'{{route('realtime.resources')}}',
			success:function(data){
				$('#show_data_uptime').html(data.uptime)
				$('#show_data_free_memory').html(data.free_memory)
				$('#show_data_total_memory').html(data.total_memory)
				$('#show_data_cpu').html(data.cpu)
				$('#show_data_cpu_count').html(data.cpu_count)
				$('#show_data_cpu_frequency').html(data.cpu_frequency)
				$('#show_data_cpu_load').html(data.cpu_load)
				$('#show_data_free_hdd').html(data.free_hdd)
				$('#show_data_total_hdd').html(data.total_hdd)
				$('#show_data_since_reboot').html(data.since_reboot)
				$('#show_data_total').html(data.total)
				$('#show_data_architecture').html(data.architecture)
				$('#show_data_board').html(data.board)
				$('#show_data_version').html(data.version)
				$('#show_data_build_time').html(data.build_time)
				$('#show_data_factory_software').html(data.factory_software)
				// console.log('aaa',data)
				// if (data.status=='sukses') {
					// load_grafk_tx(data)
				// }
			},
			error:function(data){
				console.log("error",data)
			}
		})
	}
</script>
@endpush