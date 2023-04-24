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
						<td>Uptime</td><td class="text-center">:</td><td colspan="2" class="text-right">7d 16:12:37</td>
					</tr>
					<!-- Memory -->
					<tr>
						<td rowspan="2">Memory</td><td class="text-center">:</td><td>Free</td><td class="text-right">194.2 MiB</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Total</td><td class="text-right">256.0 MiB</td>
					</tr>
					<!-- CPU -->
					<tr>
						<td rowspan="4"><p>CPU</p></td><td class="text-center">:</td><td colspan="2" class="text-right">MIPS 1004Kc V2.15</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Count</td><td class="text-right">4</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Frequency</td><td class="text-right">800 Mhz</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Load</td><td class="text-right">0 %</td>
					</tr>
					<!-- HHD -->
					<tr>
						<td rowspan="2">HDD</td><td class="text-center">:</td><td>Free</td><td class="text-right">0808</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Total</td><td class="text-right">878</td>
					</tr>
					<!-- Sector -->
					<tr>
						<td rowspan="2">Sector Writes</td><td class="text-center">:</td><td>Since Reboot</td><td class="text-right">79798</td>
					</tr>
					<tr>
						<td class="text-center">:</td><td>Total</td><td class="text-right">79798</td>
					</tr>
					<tr>
						<td>Architecture</td><td class="text-center">:</td><td colspan="2" class="text-right">hshsh</td>
					</tr>
					<tr>
						<td>Board</td><td class="text-center">:</td><td colspan="2" class="text-right">hshsh</td>
					</tr>
					<tr>
						<td>Version</td><td class="text-center">:</td><td colspan="2" class="text-right">hshsh</td>
					</tr>
					<tr>
						<td>Build-time</td><td class="text-center">:</td><td colspan="2" class="text-right">hshsh</td>
					</tr>
					<tr>
						<td>Factory Software</td><td class="text-center">:</td><td colspan="2" class="text-right">hshsh</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script type="text/javascript">
	
</script>
@endpush