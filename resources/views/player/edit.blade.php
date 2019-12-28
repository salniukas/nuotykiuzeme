@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Pabaigti patekimą</h1>
			<hr>
			
			{!! Form::open(['route' => 'Zupdate']) !!}
    			{{Form::label('name', 'Jūsų vardas:')}}
    			{{Form::text('name', $player->name, array('class' => 'form-control'))}}

    			{{Form::label('username', 'Jūsų vardas žaidime:')}}
    			{{Form::text('username', $player->username, array('class' => 'form-control'))}}

    			{{Form::label('email', 'Jūsų El.Paštas:')}}
    			{{Form::text('email', $player->email, array('class' => 'form-control'))}}

    			{{Form::label('discord', 'Jūsų discord:')}}
    			{{Form::text('discord', $player->discord, array('class' => 'form-control', 'placeholder'=>'Šalna#7007'))}}

                {{Form::hidden('discord_id', Auth::user()->discord_id, array('class' => 'form-control'))}}
                {{Form::hidden('id', $player->id, array('class' => 'form-control'))}}

    			{{Form::label('age', 'Jūsų amžius:')}}
    			{{Form::text('age', $player->age, array('class' => 'form-control'))}}

                {{Form::label('veikla', 'Jūsų Veikla:')}}
                {{Form::text('veikla', $player->veikla, array('class' => 'form-control', 'placeholder'=>'Twitch/Youtube/Dizainas ir t.t'))}}

                {{Form::label('youtube', 'Jūsų Youtube Kanalas(Jei neturit palikti tuščia):')}}
                {{Form::text('youtube', $player->youtube, array('class' => 'form-control', 'placeholder'=>'https://www.youtube.com/user/thesalniukas' ))}}

                {{Form::label('twitch', 'Jūsų Twitch Kanalas(Jei neturit palikti tuščia):')}}
                {{Form::text('twitch', $player->twitch, array('class' => 'form-control', 'placeholder'=>'https://www.twitch.tv/salnius' ))}}<br>

    			{{Form::submit('Atnaujinti'), array('class' => 'btn btn-success' )}}

			{!! Form::close() !!}
            @include('layouts.errors')
		</div>
	</div>
@endsection
