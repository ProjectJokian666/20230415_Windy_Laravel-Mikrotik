@component('mail::message')
# {{ $data['title'] }}

Akun {{Auth()->User()->email}} Masuk Kedalam Mikrotik
<table>
	<tr>
		<td colspan="3">DATA AKUN</td>
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
</table>


@endcomponent