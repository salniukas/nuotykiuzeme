@extends('layouts.app')

@section('content')
@php
	$discord = Auth::user()->discord_id;
@endphp
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
						<td><b>Slapyvardis</b></td>
						<td><img src="https://minotar.net/avatar/{{ $forms->username }}/16"> {{ $forms->username }}</td>
					</tr>
					<tr>
						<td><b>DiscordID</b></td>
						<td>{{ $forms->discord_id }}</td>
					</tr>
					<tr>
						<td><b>El. pašto adresas</b></td>
						<td><a href="mailto:{{ $forms->email }}">{{ $forms->email }}</a></td>
					</tr>
					<tr>
						<td><b>Ar Žino kas yra roleplay?</b></td>
						<td>{{ $forms->roleplay }}</td>
					</tr>
					<tr>
						<td><b>Kokios rases yra Alerade?</b></td>
						<td>{{ $forms->rases }}</td>
					</tr>
					<tr>
						<td><b>Kokios rases atstovas noretu būti ir kodėl?</b></td>
						<td>{{ $forms->kokios }}</td>
					</tr>
					<tr>
						<td><b>Kodel nori į aleradą</b></td>
						<td>{{ $forms->kodel }}</td>
					</tr>
					<tr>
						<td><b>Kaip suzinojo apie Alerada arba Kas pakviete:</b></td>
						<td>{{ $forms->kaip }}</td>
					<tr>
						<td><b>Pateikimo Data</b></td>
						<td>{{ $forms->created_at }}</td>
					</tr>
					<tr>
						<td><b>Tikrines Operatorius</b></td>
						<td>{{ $forms->operator }}</td>
					</tr>
					<tr>
						<td><b>Balsų Kiekis</b></td>
						<td>{{ $balsai }}</td>
					</tr>
				</tbody>
					 </tr>
					 @if(Auth::user()->isAdmin || Auth::user()->isSupport)
					 <tr>
					 	<button class="btn btn-xs btn-info pull-right clearfix"><a href="/atranka/trash/{{ $forms->id }}">Šlamštas</a></button>
					 	<button class="btn btn-xs btn-info pull-right clearfix"><a href="/atranka/approve/{{ $forms->id }}">II Etapas</a></button>
					 	<button class="btn btn-xs btn-info pull-right clearfix"><a href="/atranka/aleradas/{{ $forms->id }}">Jau Alerade</a></button>
					 @endif
					 @if(Auth::user()->isAleradas)
					 	@if($fafa['voter_discord'] != $discord)
					 		<button class="btn btn-xs btn-info pull-right clearfix"><a href="/anketos/vote/{{ $forms->id }}">+1</a></button>
					 	@endif
					 @endif
					 </tr>
				</table>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection