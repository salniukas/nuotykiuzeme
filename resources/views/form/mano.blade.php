@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><center><h3>Žaidėjas - {{ $forms->username }}</h3></center></div>
				<table>
				<table class="table">
				<tbody>
					<tr>
						<td style="width:15%;"><b>Id</b></td>
						<td>{{ $forms->id }}</td>
					</tr>
					<tr>
						<td style="width:25%;"><b>Vardas</b></td> 
						<td>{{ $forms->name }}</td>
					</tr>
					<tr>
						<td><b>Amžius</b></td>
						<td>{{ $forms->age }}</td>
					</tr>
					<tr>
						<td><b>Jūsų minecraft paskyros vardas:</b></td>
						<td><img src="https://minotar.net/avatar/{{ $forms->username }}/16"> {{ $forms->username }}</td>
					</tr>
					<tr>
						<td><b>Discord ID</b></td>
						<td>{{ $forms->discord_id }}</td>
					</tr>
					<tr>
						<td><b>El. pašto adresas:</b></td>
						<td><a href="mailto:{{ $forms->email }}">{{ $forms->email }}</a></td>
					</tr>
					<tr>
						<td><b>Ar žinote ką reiškia "Rolių Žaidimas"?</b></td>
						<td>{{ $forms->roleplay }}</td>
					</tr>
					<tr>
						<td><b>Išvardinkite visas egzistuojančias rases alerado Žemėje:</b></td>
						<td>{{ $forms->rases }}</td>
					</tr>
					<tr>
						<td><b>Kokios rasės atstovu norėtumėte būti ir kodėl?</b></td>
						<td>{{ $forms->kokios }}</td>
					</tr>
					<tr>
						<td><b>Kodėl norite dalyvauti Alerado Žemės projekte?</b></td>
						<td>{{ $forms->kodel }}</td>
					</tr>
					<tr>
						<td><b>Kaip sužinojote apie šį projektą? Jei Jums Šį rekomendavo žmogus, parašykite jo žaidėjo vardą:</b></td>
						<td>{{ $forms->kaip }}</td>
					<tr>
						<td><b>Pateikimo Data</b></td>
						<td>{{ $forms->created_at }}</td>
					</tr>
				</tbody>
				</table>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection