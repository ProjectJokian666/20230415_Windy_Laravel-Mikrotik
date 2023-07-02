Highcharts.chart('container1', {
	chart: {
		type: 'line'
	},
	title: {
		text: 'Traffic Interface'
	},
		// subtitle: {
		// 	text: 'Source: ' +
		// 	'<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
		// 	'target="_blank">Wikipedia.com</a>'
		// },
	xAxis: {
		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	},
	yAxis: {
		title: {
			text: 'Traffic Interface'
		}
	},
	plotOptions: {
		line: {
			dataLabels: {
				enabled: true
			},
			enableMouseTracking: false
		}
	},
	series: [
	{
		name: 'Reggane',
		data: [160, 18.2, 23.1, 27.9, 32.2, 36.4, 39.8, 38.4, 35.5, 29.2,22.0, 17.8]
	}, {
		name: 'Tallinn',
		data: [-2.9, -3.6, -0.6, 4.8, 10.2, 14.5, 17.6, 16.5, 12.0, 6.5,2.0, -0.9]
	}
	]
});