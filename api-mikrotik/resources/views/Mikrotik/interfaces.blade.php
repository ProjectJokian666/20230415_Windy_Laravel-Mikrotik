@extends('Layouts.app')

@push('csss')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="content-fluid card">
	<div class="content-header">
		<div class="content-fluid text-center">
			<h3>Interfaces</h3>
		</div>
		<table class="table table-bordered table-sm text-center" id="dataTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Mac-Address</th>
					<th>Rx-Byte</th>
					<th>Tx-Byte</th>
					<th>Dynamic</th>
					<th>Running</th>
					<th>Disabled</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$a=100;
				$da[]=array();
				for ($i=1; $i < $a; $i++) { 
					array_push($da,$i);
				} 
				?>
				@foreach($da as $key => $value)
				<form action="{{url('choice/list_akun',$key)}}" method="post">
					<tr>
						<td>Name</td>
						<td>Type</td>
						<td>Mac-Address</td>
						<td>Rx-Byte</td>
						<td>Tx-Byte</td>
						<td>Dynamic</td>
						<td>Running</td>
						<td>Disabled</td>
					</tr>
				</form>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@push('jss')
<script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
	$(function () {
		$("#dataTable").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
@endpush