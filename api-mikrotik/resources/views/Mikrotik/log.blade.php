@extends('Layouts.app')

@push('csss')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="content-fluid card">
	<div class="content-header">
		<div class="content-fluid text-center">
			<h3>Log</h3>
		</div>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12">
				<table class="table table-bordered table-sm text-center" id="dataTable">
					<thead>
						<tr>
							<th>No</th>
							<th>Times</th>
							<th>Topics</th>
							<th>Messages</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$a=1100;
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
					</tbody>
				</table>
			</div>
		</div>
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