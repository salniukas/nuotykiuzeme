@extends('layouts.app')

@section('head')
	<link rel="stylesheet" type="text/css" href="./css/playerlist.css">
	<style type="text/css">
		body{
			background-image: url(/img/players_bg.png) no-repeat;
            background-size:cover;
            background-position: center;
            color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            margin: 0;
		}
	</style>
@endsection

@section('content')

<div class="container">
	<center>
		@foreach($players as $player)
		    <a href="#" id="{{ $player->id }}"><img src="https://minotar.net/avatar/{{ $player->username }}/80" @if($player->suspended == 1) style="opacity: 0.3" @endif></a>
		@endforeach
	</center>
</div>
@foreach($players as $player)
<div class="modal fade" id="{{ $player->username }}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
      @if($player->suspended == 1)
    	<center><h3 style="color: red">Žaidėjas Suspenduotas iki {{$player->banned_until}}</h3></center>
      @endif
      @if(Auth::check() && Auth::user()->isSupport)
		<table class="table">
				<tbody>
					<tr>
						<td>ID</td>
						<td>{{ $player->id }}</td>
					</tr>
					<tr>
						<td>Vardas</td>
						<td>{{ $player->name }}</td>
					</tr>
					<tr>
						<td>Vardas Žaidime</td>
						<td>{{ $player->username }}</td>
					</tr>
					<tr>
						<td>Baudos Taškai</td>
						<td>{{ $player->kiekis }}</td>
					</tr>
					<tr>
						<td>El.Paštas</td>
						<td>{{ $player->email }}</td>
					</tr>
					<tr>
						<td>Discord</td>
						<td>{{ $player->discord }}</td>
					</tr>
					<tr>
						<td>Amžius</td>
						<td>{{ $player->age }}</td>
					</tr>
					<tr>
						<td>Veikla</td>
						<td>{{ $player->veikla }}</td>
					</tr>
					<tr>
						<td>Rase</td>
						<td>{{ $player->rase }}</td>
					</tr>
					<tr>
						<td>Youtube</td>
						@if ($player->youtube == "-")
						<td>{{$player->youtube}}</td>
						@else
						<td><a href= "{{ $player->youtube }}">Link</a></td>
						@endif
					</tr>
					<tr>
						<td>Twitch</td>
						@if ($player->twitch == "-")
						<td>{{ $player->twitch }}</td>
						@else
						<td><a href="{{ $player->twitch }}">Link</a></td>
						@endif
					</tr>
				</tbody>
			</table>
		@elseif(Auth::guest() || Auth::user())
			<table class="table">
				<tbody>
					<tr>
						<td>Vardas</td>
						<td>{{ $player->name }}</td>
					</tr>
					<tr>
						<td>Vardas Žaidime</td>
						<td>{{ $player->username }}</td>
					</tr>
					<tr>
						<td>Baudos Taškai</td>
						<td>{{ $player->kiekis }}</td>
					</tr>
					<tr>
						<td>Discord</td>
						<td>{{ $player->discord }}</td>
					</tr>
					<tr>
						<td>Rase</td>
						<td>{{ $player->rase }}</td>
					</tr>
					<tr>
						<td>Youtube</td>
						@if ($player->youtube == "-")
						<td>{{$player->youtube}}</td>
						@else
						<td><a href= "{{ $player->youtube }}">Link</a></td>
						@endif
					</tr>
					<tr>
						<td>Twitch</td>
						@if ($player->twitch == "-")
						<td>{{ $player->twitch }}</td>
						@else
						<td><a href="{{ $player->twitch }}">Link</a></td>
						@endif
					</tr>
				</tbody>
			</table>
		@endif
        <div class="modal-footer">
	        @if(Auth::check() && Auth::user()->isSupport)
				@if ($player->suspended > 0)
					<button class="btn btn-default"><a href="zaidejas/unsuspend/{{ $player->id }}" style="text-decoration: none; color: black;">Atspenduoti</a></button>
				@else
					<button class="btn btn-default"><a href="zaidejas/suspend/{{ $player->id }}">Suspenduoti</a></button>
					<button class="btn btn-default"><a href="zaidejas/add/penality/{{ $player->id }}">Bauda +1</a></button>
				@endif
			@endif
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endforeach

<script
  src="https://code.jquery.com/jquery-3.3.0.min.js"
  integrity="sha256-RTQy8VOmNlT6b2PIRur37p6JEBZUE7o8wPgMvu18MC4="
  crossorigin="anonymous">
</script>

@foreach($players as $player)
<script type="text/javascript">
	$(document).ready(function(){
    $("#{{ $player->id }}").click(function(evt){
        $("#{{ $player->username }}").modal({keyboard: true});
        evt.preventDefault();
    });
});
</script>
@endforeach

<script type="text/javascript">
	$(function(){  // $(document).ready shorthand
	  $('.avatar').hide().fadeIn('slow');
	});
</script>

@endsection