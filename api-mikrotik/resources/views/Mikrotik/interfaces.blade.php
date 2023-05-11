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
					<th>No</th>
					<th>Name</th>
					<th>Type</th>
					<th>Mac-Address</th>
					<th>Running</th>
					<th>Disabled</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data['interface'] as $key => $value)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$value['name']}}</td>
					<td>{{$value['type']}}</td>
					<td>{{$value['mac_address']}}</td>
					<td>{{$value['running']}}</td>
					<td>{{$value['disabled']}}</td>
				</tr>
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