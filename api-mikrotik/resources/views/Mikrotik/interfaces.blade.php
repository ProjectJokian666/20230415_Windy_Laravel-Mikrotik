@extends('Layouts.app')

@push('csss')
<link href="{{asset('matrix-admin-bt5-master')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">INTERFACES</h4> <h5>( Update data Tx dan Rx setiap 3 detik )</h5>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered table-striped table-sm" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Type</th>
								<th>Mac-Address</th>
								<th>Tx</th>
								<th>Rx</th>
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
								<td id="tx_{{$value['key']}}">{{$value['tx']}}</td>
								<td id="rx_{{$value['key']}}">{{$value['rx']}}</td>
								<td>{{$value['running']}}</td>
								<td>{{$value['disabled']}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script src="{{asset('matrix-admin-bt5-master')}}/assets/extra-libs/DataTables/datatables.min.js"></script>
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
	setInterval(()=>{
		update_tx_rx()
	},3000);

	function update_tx_rx(){
		$.ajax({
			url:"{{route('update_tx_rx')}}",
			success:function(data){
				data.interface.forEach(function(isi_data){
					var isi_tx = document.getElementById('tx_'+isi_data['key']);
					isi_tx.textContent = isi_data['tx'];
					var isi_rx = document.getElementById('rx_'+isi_data['key']);
					isi_rx.textContent = isi_data['rx'];
				})
			},
			error:function(data){
				console.log(data)
			}
		})
	}
</script>
@endpush