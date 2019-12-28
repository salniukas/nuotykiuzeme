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
						<td><b>Ką planuojate serveryje veikti?</b></td>
						<td>{{ $forms->kapl }}</td>
					</tr>
					<tr>
						<td><b>Kokią vertę sukursite kitiems serverio žaidėjams?</b></td>
						<td>{{ $forms->kokia }}</td>
					</tr>
					<tr>
						<td><b>Kodel nori į serverį</b></td>
						<td>{{ $forms->kodel }}</td>
					</tr>
					<tr>
						<td><b>Kaip suzinojo apie Serverį arba Kas pakviete:</b></td>
						<td>{{ $forms->kaip }}</td>
					<tr>
					<tr>
						<td><b>Ar turi mikrafoną?</b></td>
						<td>{{ $forms->mic }}</td>
					<tr>
					<tr>
						<td><b>Jūsų Minecraft darbų albumas</b></td>
						<td>{{ $forms->darbai }}</td>
					<tr>
					<tr>
						<td><b>Ar esate žaidę kituose privačiuose serveriuose?</b></td>
						<td>{{ $forms->serv }}</td>
					<tr>
					<tr>
						<td><b>Ar esate turinio kūrėjas? Jei taip, parašykite kanalo pavadinimą</b></td>
						<td>{{ $forms->content }}</td>
					<tr>
					<tr>
						<td><b>Sekėjų / prenumeratorių skaičius</b></td>
						<td>{{ $forms->subs }}</td>
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
						<td>{{ $balsaiu }}/-{{ $balsaip }}</td>
					</tr>
					<tr>
					<td>						
						@if(Auth::user()->isAdmin || Auth::user()->isSupport)
					 		<a href="/atranka/trash/{{ $forms->id }}"><button class="btn btn-s btn-info pull-left clearfix" style="background-color: red; border-color: none;  margin-right: 15px;">Šlamštas</button></a>
					 		<a href="/atranka/approve/{{ $forms->id }}"><button class="btn btn-s btn-info pull-left clearfix" style="background-color: green; border-color: none;">II Etapas</button></a>
					 	@if($forms->accepted)
					 		<a href="/atranka/aleradas/{{ $forms->id }}"><button class="btn btn-s btn-info pull-left clearfix">Jau Alerade</button></a>
					 	@endif
					 	@endif
					 <td>
					 	@if(Auth::user()->isAleradas)
					 		@php
								$discord = Auth::user()->discord_id;
					  		@endphp
					</tr>
					<tr>
					  	<td>
					 		@if(is_null($voted))
					 			<a href="/anketos/vote/{{ $forms->id }}"><button class="btn btn-s btn-info pull-left clearfix" style="background-color: green; margin-right: 15px; border-color: none;">Už</button></a>
					 			<a href="/anketos/vote2/{{ $forms->id }}"><button class="btn btn-s btn-info pull-left clearfix" style="background-color: red; border-color: none;">Prieš</button></a>
					 		@else
					 			Jau balsavote
					 		@endif
					 @endif
						<td>
					</tr>
				</tbody>
				</table>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection