@extends('Layouts.app')

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
			<div class="col-12 p-3">
				<select name="interface" id="interface">
					<option value="">Ether1</option>
					<option value="">Ether1</option>
					<option value="">Ether1</option>
					<option value="">Ether1</option>
					<option value="">Ether1</option>
				</select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-12">
				<!-- interactive chart -->
				<div id="interactive" style="height: 250px;"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('jss')
<script src="{{asset('template')}}/plugins/flot/jquery.flot.js"></script>
<script>
// realtime data uptime
	setInterval("showdatauptime();",1000);
	function showdatauptime() {
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

	setInterval("showdatacpu();",1000);
	function showdatacpu() {
		$.ajax({
			url:"{{route('realtime_cpu')}}",
			type:"GET",
			success:function(data){
				$('#show_data_cpu').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_cpu').text('0');
			}
		})
	}

	setInterval("showdatacpu_load();",1000);
	function showdatacpu_load() {
		$.ajax({
			url:"{{route('realtime_cpu_load')}}",
			type:"GET",
			success:function(data){
				$('#show_data_cpu_load').text(data+" %");
				// console.log(data)
			},
			error:function(data){
				$('#show_data_cpu_load').text('0 %');
			}
		})
	}

	setInterval("showdatacpu_loadtotal_hdd();",1000);
	function showdatacpu_loadtotal_hdd() {
		$.ajax({
			url:"{{route('realtime_total_hdd')}}",
			type:"GET",
			success:function(data){
				$('#show_data_total_hdd').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_total_hdd').text('0');
			}
		})
	}

	setInterval("showdatafree_hdd();",1000);
	function showdatafree_hdd() {
		$.ajax({
			url:"{{route('realtime_free_hdd')}}",
			type:"GET",
			success:function(data){
				$('#show_data_free_hdd').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_free_hdd').text('0');
			}
		})
	}

	setInterval("showdatatotal_memory();",1000);
	function showdatatotal_memory() {
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

	setInterval("showdatafree_memory();",1000);
	function showdatafree_memory() {
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

	setInterval("showdataboard();",1000);
	function showdataboard() {
		$.ajax({
			url:"{{route('realtime_board')}}",
			type:"GET",
			success:function(data){
				$('#show_data_board').text(data);
				// console.log(data)
			},
			error:function(data){
				$('#show_data_board').text('0');
			}
		})
	}

	$(function(){
		/*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
		var data        = [],
		totalPoints = 100

		function getRandomData() {

			if (data.length > 0) {
				data = data.slice(1)
			}

      // Do a random walk
			while (data.length < totalPoints) {

				var prev = data.length > 0 ? data[data.length - 1] : 50,
				y    = prev + Math.random() * 10 - 5

				if (y < 0) {
					y = 0
				} else if (y > 100) {
					y = 100
				}

				data.push(y)
			}

      // Zip the generated y values with the x values
			var res = []
			for (var i = 0; i < data.length; ++i) {
				res.push([i, data[i]])
			}

			return res
		}

		var interactive_plot = $.plot('#interactive', [
		{
			data: getRandomData(),
		}
		],
		{
			grid: {
				borderColor: '#f3f3f3',
				borderWidth: 1,
				tickColor: '#f3f3f3'
			},
			series: {
				color: '#3c8dbc',
				lines: {
					lineWidth: 2,
					show: true,
					fill: true,
				},
			},
			yaxis: {
				min: 0,
				max: 100,
				show: true,
				fontcolor: '#ffffff',
			},
			xaxis: {
				show: true
			}
		}
		)

    var updateInterval = 1000 //Fetch data ever x milliseconds
    var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

    	interactive_plot.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
    	interactive_plot.draw()
    	if (realtime === 'on') {
    		setTimeout(update, updateInterval)
    	}
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
    	update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function () {
    	if ($(this).data('toggle') === 'on') {
    		realtime = 'on'
    	}
    	else {
    		realtime = 'off'
    	}
    	update()
    })
    /*
     * END INTERACTIVE CHART
     */
  })
</script>
@endpush