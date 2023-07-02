@extends('Layouts.app')

@section('title','DASHBOARD')

@push('csss')
<link href="{{asset('matrix-admin-bt5-master')}}/assets/libs/flot/css/float-chart.css" rel="stylesheet" />
<style type="text/css">
	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 150px;
		max-width: 100%;
		margin: 1em auto;
	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #ebebeb;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 500px;
	}

	.highcharts-data-table caption {
		padding: 1em 0;
		font-size: 1.2em;
		color: #555;
	}

	.highcharts-data-table th {
		font-weight: 600;
		padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
		padding: 0.5em;
	}

	.highcharts-data-table thead tr,
	.highcharts-data-table tr:nth-child(even) {
		background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
		background: #f1f7ff;
	}
</style>
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
							Traffic Tx : <span id="traffic_tx">0</span> , Traffic Rx : <span id="traffic_rx">0</span>
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
					<figure class="highcharts-figure">
						<div id="tx"></div>
					</figure>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<figure class="highcharts-figure">
						<div id="rx"></div>
					</figure>
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

<script src="{{asset('highcharts')}}/highcharts.js"></script>
<!-- <script src="{{asset('highcharts')}}/container1.js"></script> -->
<!-- <script src="{{asset('highcharts')}}/container2.js"></script> -->
<!-- <script src="{{asset('highcharts')}}/container3.js"></script> -->
<!-- <script src="{{asset('highcharts')}}/container4.js"></script> -->

<script type="text/javascript">
	setInterval(()=>{
		traffic()
	},3000);
	function traffic() {
		// console.log(data_interface);
		let data_interface = $('#interface').val();
		let join_data = "";
		if (data_interface!=null) {
			let split_data = data_interface.split(" ");
			join_data = split_data.join('%20');
		}
		else{
			join_data = ""
		}
		var url = "{{route('realtime.traffic','isi')}}";
		
		$.ajax({
			url:url.replace('isi',join_data),
			data:{
				ether:data_interface
			},
			success:function(data){
				if (data.status=='sukses') {
					load_grafk_tx(data)
				}
			},
			error:function(data){
				console.log("error",data)
			}
		})
	}


	function load_grafk_tx(data) {
		
		for(var i=0; i<elevationData_tx.length-1;i++){
			elevationData_tx[i][1]=elevationData_tx[i+1][1]
		}
		elevationData_tx[elevationData_tx.length-1][1]=parseInt(data.tx)

		for(var i=0; i<elevationData_rx.length-1;i++){
			elevationData_rx[i][1]=elevationData_rx[i+1][1]
		}
		elevationData_rx[elevationData_rx.length-1][1]=parseInt(data.rx)

		// console.log(data,data.angka_rx,data.uptime)
		console.log(data.uptime)

		// data dashboard
		$('#show_data_uptime').html(data.uptime)
		$('#show_data_cpu').html(data.cpu)
		$('#show_data_cpu_load').html(data.cpu_load)
		$('#show_data_total_hdd').html(data.total_hdd)
		$('#show_data_free_hdd').html(data.free_hdd)
		$('#show_data_total_memory').html(data.total_memory)
		$('#show_data_free_memory').html(data.free_memory)
		$('#show_data_board').html(data.board)


		$('#traffic_tx').html(data.angka_tx)
		$('#traffic_rx').html(data.angka_rx)
		
		// replace data grafik
		Highcharts.chart('tx', {
			chart: {
				type: 'area',
				zoomType: 'x',
				panning: true,
				panKey: 'shift',
				scrollablePlotArea: {
					minWidth: 600
				}
			},

			caption: {
				text: 'Data Grafik Traffic TX'
			},

			title: {
				text: 'Data Traffic Tx '+$('#interface').val(),
				align: 'left'
			},

			accessibility: {
				description: 'Data Traffic',
				landmarkVerbosity: 'one'
			},

			lang: {
				accessibility: {
					screenReaderSection: {
						annotations: {
							descriptionNoPoints: '{annotationText}, at distance {annotation.options.point.x}km, elevation {annotation.options.point.y} meters.'
						}
					}
				}
			},

			credits: {
				enabled: false
			},

			annotations: [{
				draggable: '',
				labelOptions: {
					backgroundColor: 'rgba(255,255,255,0.5)',
					verticalAlign: 'top',
					y: 15
				},
				labels: [{
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 27.98,
						y: 255
					},
					text: 'Arbois'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 45.5,
						y: 611
					},
					text: 'Montrond'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 63,
						y: 651
					},
					text: 'Mont-sur-Monnet'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 84,
						y: 789
					},
					x: -10,
					text: 'Bonlieu'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 129.5,
						y: 382
					},
					text: 'Chassal'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 159,
						y: 443
					},
					text: 'Saint-Claude'
				}]
			}, {
				draggable: '',
				labels: [{
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 101.44,
						y: 1026
					},
					x: -30,
					text: 'Col de la Joux'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 138.5,
						y: 748
					},
					text: 'Côte de Viry'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 176.4,
						y: 1202
					},
					text: 'Montée de la Combe <br>de Laisia Les Molunes'
				}]
			}, {
				draggable: '',
				labelOptions: {
					shape: 'connector',
					align: 'right',
					justify: false,
					crop: true,
					style: {
						fontSize: '10px',
						textOutline: '1px white'
					}
				},
				labels: [{
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 96.2,
						y: 783
					},
					text: '6.1 km climb <br>4.6% on avg.'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 134.5,
						y: 540
					},
					text: '7.6 km climb <br>5.2% on avg.'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 172.2,
						y: 925
					},
					text: '11.7 km climb <br>6.4% on avg.'
				}]
			}],

			xAxis: {
				labels: {
					format: '{value}'
				},
				minRange: 5,
				title: {
					text: 'Jumlah Data Terecord'
				},
				accessibility: {
					rangeDescription: 'Range: 0 to 187.8km.'
				}
			},

			yAxis: {
				startOnTick: true,
				endOnTick: false,
				maxPadding: 0.35,
				title: {
					text: 'Traffic'
				},
				labels: {
					format: '{value} kb'
				},
				accessibility: {
					description: 'Elevation',
					rangeDescription: 'Range: 0 to 1,553 meters'
				}
			},

			tooltip: {
				headerFormat: 'Traffic Tx ',
				pointFormat: '{point.y} kb',
				shared: true
			},

			legend: {
				enabled: false
			},

			series: [{
				data: elevationData_tx,
				lineColor: Highcharts.getOptions().colors[1],
				color: Highcharts.getOptions().colors[2],
				fillOpacity: 0.5,
				name: 'Elevation',
				marker: {
					enabled: false
				},
				threshold: null
			}]
		});
		Highcharts.chart('rx', {
			chart: {
				type: 'area',
				zoomType: 'x',
				panning: true,
				panKey: 'shift',
				scrollablePlotArea: {
					minWidth: 600
				}
			},

			caption: {
				text: 'Data Grafik Traffic TX'
			},

			title: {
				text: 'Data Traffic Rx '+$('#interface').val(),
				align: 'left'
			},

			accessibility: {
				description: 'Data Traffic',
				landmarkVerbosity: 'one'
			},

			lang: {
				accessibility: {
					screenReaderSection: {
						annotations: {
							descriptionNoPoints: '{annotationText}, at distance {annotation.options.point.x}km, elevation {annotation.options.point.y} meters.'
						}
					}
				}
			},

			credits: {
				enabled: false
			},

			annotations: [{
				draggable: '',
				labelOptions: {
					backgroundColor: 'rgba(255,255,255,0.5)',
					verticalAlign: 'top',
					y: 15
				},
				labels: [{
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 27.98,
						y: 255
					},
					text: 'Arbois'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 45.5,
						y: 611
					},
					text: 'Montrond'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 63,
						y: 651
					},
					text: 'Mont-sur-Monnet'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 84,
						y: 789
					},
					x: -10,
					text: 'Bonlieu'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 129.5,
						y: 382
					},
					text: 'Chassal'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 159,
						y: 443
					},
					text: 'Saint-Claude'
				}]
			}, {
				draggable: '',
				labels: [{
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 101.44,
						y: 1026
					},
					x: -30,
					text: 'Col de la Joux'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 138.5,
						y: 748
					},
					text: 'Côte de Viry'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 176.4,
						y: 1202
					},
					text: 'Montée de la Combe <br>de Laisia Les Molunes'
				}]
			}, {
				draggable: '',
				labelOptions: {
					shape: 'connector',
					align: 'right',
					justify: false,
					crop: true,
					style: {
						fontSize: '10px',
						textOutline: '1px white'
					}
				},
				labels: [{
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 96.2,
						y: 783
					},
					text: '6.1 km climb <br>4.6% on avg.'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 134.5,
						y: 540
					},
					text: '7.6 km climb <br>5.2% on avg.'
				}, {
					point: {
						xAxis: 0,
						yAxis: 0,
						x: 172.2,
						y: 925
					},
					text: '11.7 km climb <br>6.4% on avg.'
				}]
			}],

			xAxis: {
				labels: {
					format: '{value}'
				},
				minRange: 5,
				title: {
					text: 'Jumlah Data Terecord'
				},
				accessibility: {
					rangeDescription: 'Range: 0 to 187.8km.'
				}
			},

			yAxis: {
				startOnTick: true,
				endOnTick: false,
				maxPadding: 0.35,
				title: {
					text: 'Traffic'
				},
				labels: {
					format: '{value} kb'
				},
				accessibility: {
					description: 'Elevation',
					rangeDescription: 'Range: 0 to 1,553 meters'
				}
			},

			tooltip: {
				headerFormat: 'Traffic Tx ',
				pointFormat: '{point.y} kb',
				shared: true
			},

			legend: {
				enabled: false
			},

			series: [{
				data: elevationData_rx,
				lineColor: Highcharts.getOptions().colors[1],
				color: Highcharts.getOptions().colors[2],
				fillOpacity: 0.5,
				name: 'Elevation',
				marker: {
					enabled: false
				},
				threshold: null
			}]
		});
	}

	Highcharts.chart('tx', {

		chart: {
			type: 'area',
			zoomType: 'x',
			panning: true,
			panKey: 'shift',
			scrollablePlotArea: {
				minWidth: 600
			}
		},

		caption: {
			text: 'Data Grafik Traffic'
		},

		title: {
			text: 'Data Traffic '+$('#interface').val(),
			align: 'left'
		},

		accessibility: {
			description: 'Data Traffic',
			landmarkVerbosity: 'one'
		},

		lang: {
			accessibility: {
				screenReaderSection: {
					annotations: {
						descriptionNoPoints: '{annotationText}, at distance {annotation.options.point.x}km, elevation {annotation.options.point.y} meters.'
					}
				}
			}
		},

		credits: {
			enabled: false
		},

		annotations: [{
			draggable: '',
			labelOptions: {
				backgroundColor: 'rgba(255,255,255,0.5)',
				verticalAlign: 'top',
				y: 15
			},
			labels: [{
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 27.98,
					y: 255
				},
				text: 'Arbois'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 45.5,
					y: 611
				},
				text: 'Montrond'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 63,
					y: 651
				},
				text: 'Mont-sur-Monnet'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 84,
					y: 789
				},
				x: -10,
				text: 'Bonlieu'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 129.5,
					y: 382
				},
				text: 'Chassal'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 159,
					y: 443
				},
				text: 'Saint-Claude'
			}]
		}, {
			draggable: '',
			labels: [{
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 101.44,
					y: 1026
				},
				x: -30,
				text: 'Col de la Joux'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 138.5,
					y: 748
				},
				text: 'Côte de Viry'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 176.4,
					y: 1202
				},
				text: 'Montée de la Combe <br>de Laisia Les Molunes'
			}]
		}, {
			draggable: '',
			labelOptions: {
				shape: 'connector',
				align: 'right',
				justify: false,
				crop: true,
				style: {
					fontSize: '10px',
					textOutline: '1px white'
				}
			},
			labels: [{
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 96.2,
					y: 783
				},
				text: '6.1 km climb <br>4.6% on avg.'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 134.5,
					y: 540
				},
				text: '7.6 km climb <br>5.2% on avg.'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 172.2,
					y: 925
				},
				text: '11.7 km climb <br>6.4% on avg.'
			}]
		}],

		xAxis: {
			labels: {
				format: '{value}'
			},
			minRange: 5,
			title: {
				text: 'Jumlah Data'
			},
			accessibility: {
				rangeDescription: 'Range: 0 to 187.8km.'
			}
		},

		yAxis: {
			startOnTick: true,
			endOnTick: false,
			maxPadding: 0.35,
			title: {
				text: null
			},
			labels: {
				format: '{value} kb'
			},
			accessibility: {
				description: 'Elevation',
				rangeDescription: 'Range: 0 to 1,553 meters'
			}
		},

		tooltip: {
			headerFormat: 'Distance: {point.x:.1f} km<br>',
			pointFormat: '{point.y} m a. s. l.',
			shared: true
		},

		legend: {
			enabled: false
		},

		series: [{
			data: elevationData_tx,
			lineColor: Highcharts.getOptions().colors[1],
			color: Highcharts.getOptions().colors[2],
			fillOpacity: 0.5,
			name: 'Elevation',
			marker: {
				enabled: false
			},
			threshold: null
		}]

	});
	Highcharts.chart('rx', {

		chart: {
			type: 'area',
			zoomType: 'x',
			panning: true,
			panKey: 'shift',
			scrollablePlotArea: {
				minWidth: 600
			}
		},

		caption: {
			text: 'Data Grafik Traffic'
		},

		title: {
			text: 'Data Traffic '+$('#interface').val(),
			align: 'left'
		},

		accessibility: {
			description: 'Data Traffic',
			landmarkVerbosity: 'one'
		},

		lang: {
			accessibility: {
				screenReaderSection: {
					annotations: {
						descriptionNoPoints: '{annotationText}, at distance {annotation.options.point.x}km, elevation {annotation.options.point.y} meters.'
					}
				}
			}
		},

		credits: {
			enabled: false
		},

		annotations: [{
			draggable: '',
			labelOptions: {
				backgroundColor: 'rgba(255,255,255,0.5)',
				verticalAlign: 'top',
				y: 15
			},
			labels: [{
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 27.98,
					y: 255
				},
				text: 'Arbois'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 45.5,
					y: 611
				},
				text: 'Montrond'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 63,
					y: 651
				},
				text: 'Mont-sur-Monnet'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 84,
					y: 789
				},
				x: -10,
				text: 'Bonlieu'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 129.5,
					y: 382
				},
				text: 'Chassal'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 159,
					y: 443
				},
				text: 'Saint-Claude'
			}]
		}, {
			draggable: '',
			labels: [{
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 101.44,
					y: 1026
				},
				x: -30,
				text: 'Col de la Joux'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 138.5,
					y: 748
				},
				text: 'Côte de Viry'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 176.4,
					y: 1202
				},
				text: 'Montée de la Combe <br>de Laisia Les Molunes'
			}]
		}, {
			draggable: '',
			labelOptions: {
				shape: 'connector',
				align: 'right',
				justify: false,
				crop: true,
				style: {
					fontSize: '10px',
					textOutline: '1px white'
				}
			},
			labels: [{
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 96.2,
					y: 783
				},
				text: '6.1 km climb <br>4.6% on avg.'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 134.5,
					y: 540
				},
				text: '7.6 km climb <br>5.2% on avg.'
			}, {
				point: {
					xAxis: 0,
					yAxis: 0,
					x: 172.2,
					y: 925
				},
				text: '11.7 km climb <br>6.4% on avg.'
			}]
		}],

		xAxis: {
			labels: {
				format: '{value}'
			},
			minRange: 5,
			title: {
				text: 'Jumlah Data'
			},
			accessibility: {
				rangeDescription: 'Range: 0 to 187.8km.'
			}
		},

		yAxis: {
			startOnTick: true,
			endOnTick: false,
			maxPadding: 0.35,
			title: {
				text: null
			},
			labels: {
				format: '{value} kb'
			},
			accessibility: {
				description: 'Elevation',
				rangeDescription: 'Range: 0 to 1,553 meters'
			}
		},

		tooltip: {
			headerFormat: 'Distance: {point.x:.1f} km<br>',
			pointFormat: '{point.y} m a. s. l.',
			shared: true
		},

		legend: {
			enabled: false
		},

		series: [{
			data: elevationData_rx,
			lineColor: Highcharts.getOptions().colors[1],
			color: Highcharts.getOptions().colors[2],
			fillOpacity: 0.5,
			name: 'Elevation',
			marker: {
				enabled: false
			},
			threshold: null
		}]

	});

	var elevationData_tx = [
		[0.0, 0],
		[0.1, 0],
		[0.2, 0],
		[0.3, 0],
		[0.4, 0],
		[0.5, 0],
		[0.6, 0],
		[0.7, 0],
		[0.8, 0],
		[0.9, 0],
		[1.0, 0],
		[1.1, 0],
		[1.2, 0],
		[1.3, 0],
		[1.4, 0],
		[1.5, 0],
		[1.6, 0],
		[1.7, 0],
		[1.8, 0],
		[1.9, 0],
		[2.0, 0],
		[2.1, 0],
		[2.2, 0],
		[2.3, 0],
		[2.4, 0],
		[2.5, 0],
		[2.6, 0],
		[2.7, 0],
		[2.8, 0],
		[2.9, 0],
		[3.0, 0],
		[3.1, 0],
		[3.2, 0],
		[3.3, 0],
		[3.4, 0],
		[3.5, 0],
		[3.6, 0],
		[3.7, 0],
		[3.8, 0],
		[3.9, 0],
		[4.0, 0],
		[4.1, 0],
		[4.2, 0],
		[4.3, 0],
		[4.4, 0],
		[4.5, 0],
		[4.6, 0],
		[4.7, 0],
		[4.8, 0],
		[4.9, 0],
		[5.0, 0],
		[5.1, 0],
		[5.2, 0],
		[5.3, 0],
		[5.4, 0],
		[5.5, 0],
		[5.6, 0],
		[5.7, 0],
		[5.8, 0],
		[5.9, 0],
		[6.0, 0],
		[6.1, 0],
		[6.2, 0],
		[6.3, 0],
		[6.4, 0],
		[6.5, 0],
		[6.6, 0],
		[6.7, 0],
		[6.8, 0],
		[6.9, 0],
		[7.0, 0],
		[7.1, 0],
		[7.2, 0],
		[7.3, 0],
		[7.4, 0],
		[7.5, 0],
		[7.6, 0],
		[7.7, 0],
		[7.8, 1],
		[7.9, 0],
		[8.0, 0],
		[8.1, 0],
		[8.2, 0],
		[8.3, 0],
		[8.4, 0],
		[8.5, 0],
		[8.6, 0],
		[8.7, 0],
		[8.8, 0],
		[8.9, 0],
		[9.0, 0],
		[9.1, 0],
		[9.2, 0],
		[9.3, 0],
		[9.4, 0],
		[9.5, 0],
		[9.6, 0],
		[9.7, 0],
		[9.8, 0],
		[9.9, 0],
		[10.0, 0],
		];
	var elevationData_rx = [
		[0.0, 0],
		[0.1, 0],
		[0.2, 0],
		[0.3, 0],
		[0.4, 0],
		[0.5, 0],
		[0.6, 0],
		[0.7, 0],
		[0.8, 0],
		[0.9, 0],
		[1.0, 0],
		[1.1, 0],
		[1.2, 0],
		[1.3, 0],
		[1.4, 0],
		[1.5, 0],
		[1.6, 0],
		[1.7, 0],
		[1.8, 0],
		[1.9, 0],
		[2.0, 0],
		[2.1, 0],
		[2.2, 0],
		[2.3, 0],
		[2.4, 0],
		[2.5, 0],
		[2.6, 0],
		[2.7, 0],
		[2.8, 0],
		[2.9, 0],
		[3.0, 0],
		[3.1, 0],
		[3.2, 0],
		[3.3, 0],
		[3.4, 0],
		[3.5, 0],
		[3.6, 0],
		[3.7, 0],
		[3.8, 0],
		[3.9, 0],
		[4.0, 0],
		[4.1, 0],
		[4.2, 0],
		[4.3, 0],
		[4.4, 0],
		[4.5, 0],
		[4.6, 0],
		[4.7, 0],
		[4.8, 0],
		[4.9, 0],
		[5.0, 0],
		[5.1, 0],
		[5.2, 0],
		[5.3, 0],
		[5.4, 0],
		[5.5, 0],
		[5.6, 0],
		[5.7, 0],
		[5.8, 0],
		[5.9, 0],
		[6.0, 0],
		[6.1, 0],
		[6.2, 0],
		[6.3, 0],
		[6.4, 0],
		[6.5, 0],
		[6.6, 0],
		[6.7, 0],
		[6.8, 0],
		[6.9, 0],
		[7.0, 0],
		[7.1, 0],
		[7.2, 0],
		[7.3, 0],
		[7.4, 0],
		[7.5, 0],
		[7.6, 0],
		[7.7, 0],
		[7.8, 1],
		[7.9, 0],
		[8.0, 0],
		[8.1, 0],
		[8.2, 0],
		[8.3, 0],
		[8.4, 0],
		[8.5, 0],
		[8.6, 0],
		[8.7, 0],
		[8.8, 0],
		[8.9, 0],
		[9.0, 0],
		[9.1, 0],
		[9.2, 0],
		[9.3, 0],
		[9.4, 0],
		[9.5, 0],
		[9.6, 0],
		[9.7, 0],
		[9.8, 0],
		[9.9, 0],
		[10.0, 0],
		];
	</script>
	@endpush