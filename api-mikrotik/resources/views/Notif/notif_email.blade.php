@component('mail::message')
# {{ $data['title'] }}

Akun {{Auth()->User()->email}} Masuk Kedalam Mikrotik
<table width="100%">
	<tr>
		<td colspan="3" style="text-align: center;">DATA AKUN PERIODIK</td>
	</tr>
	<tr>
		<td>IP</td><td>:</td><td>{{ $data['ip'] }}</td>
	</tr>
	<tr>
		<td>USERNAME</td><td>:</td><td>{{ $data['user'] }}</td>
	</tr>
	<tr>
		<td>PASSWORD</td><td>:</td><td>{{ $data['password'] }}</td>
	</tr>
	<tr>
		<td>UPTIME</td><td>:</td><td>{{ $data['data']['uptime'] }}</td>
	</tr>
	<tr>
		<td>FREE MEMORY</td><td>:</td><td>{{ $data['data']['free_memory'] }}</td>
	</tr>
	<tr>
		<td>CPU</td><td>:</td><td>{{ $data['data']['cpu'] }}</td>
	</tr>
	<tr>
		<td>CPU COUNT</td><td>:</td><td>{{ $data['data']['cpu_count'] }}</td>
	</tr>
	<tr>
		<td>CPU FREQUENCY</td><td>:</td><td>{{ $data['data']['cpu_frequency'] }}</td>
	</tr>
	<tr>
		<td>CPU LOAD</td><td>:</td><td>{{ $data['data']['cpu_frequency'] }}</td>
	</tr>
	<tr>
		<td>FREE HDD</td><td>:</td><td>{{ $data['data']['free_hdd'] }}</td>
	</tr>
	<tr>
		<td>TOTAL HDD</td><td>:</td><td>{{ $data['data']['total_hdd'] }}</td>
	</tr>
	<tr>
		<td>ARCHITECTURE</td><td>:</td><td>{{ $data['data']['architecture'] }}</td>
	</tr>
	<tr>
		<td>BOARD</td><td>:</td><td>{{ $data['data']['board'] }}</td>
	</tr>
	<tr>
		<td>VERSION</td><td>:</td><td>{{ $data['data']['version'] }}</td>
	</tr>
	<tr>
		<td>BUILD-TIME</td><td>:</td><td>{{ $data['data']['build_time'] }}</td>
	</tr>
	<tr>
		<td>FACTORY SOFTWARE</td><td>:</td><td>{{ $data['data']['factory_software'] }}</td>
	</tr>
	@foreach($data['data']['array_interface'] as $key => $value)
	<tr>
		<td rowspan="2">{{$value['name']}}</td><td>:</td><td>Tx &nbsp; {{$value['tx']}}</td>
	</tr>
	<tr>
		<td>:</td><td>Rx &nbsp; {{$value['rx']}}</td>
	</tr>
	@endforeach
</table>


@endcomponent