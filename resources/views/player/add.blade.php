@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Pabaigti patekimą</h1>
			<hr>
			
			{!! Form::open(['route' => 'storez']) !!}
    			{{Form::label('name', 'Jūsų vardas:')}}
    			{{Form::text('name', null, array('class' => 'form-control'))}}

    			{{Form::label('username', 'Jūsų vardas žaidime:')}}
    			{{Form::text('username', null, array('class' => 'form-control'))}}

    			{{Form::label('email', 'Jūsų El.Paštas:')}}
    			{{Form::text('email', null, array('class' => 'form-control'))}}

    			{{Form::label('discord', 'Jūsų discord:')}}
    			{{Form::text('discord', null, array('class' => 'form-control', 'placeholder'=>'Šalna#7007'))}}

                {{Form::hidden('discord_id', Auth::user()->discord_id, array('class' => 'form-control'))}}

    			{{Form::label('age', 'Jūsų amžius:')}}
    			{{Form::text('age', null, array('class' => 'form-control'))}}

                {{Form::label('veikla', 'Jūsų Veikla:')}}
                {{Form::text('veikla', null, array('class' => 'form-control', 'placeholder'=>'Twitch/Youtube/Dizainas ir t.t'))}}

                {{Form::label('rase', 'Jūsų Rasė:')}}
                {{Form::text('rase', null, array('class' => 'form-control', 'placeholder'=>'Laazaras,Unelajus,Haeras,Glao' ))}}

                {{Form::label('youtube', 'Jūsų Youtube Kanalas:')}}
                {{Form::text('youtube', null, array('class' => 'form-control', 'placeholder'=>'https://www.youtube.com/user/thesalniukas' ))}}

                {{Form::label('twitch', 'Jūsų Twitch Kanalas:')}}
                {{Form::text('twitch', null, array('class' => 'form-control', 'placeholder'=>'https://www.twitch.tv/salnius' ))}}

    			{{Form::submit('Prideti'), array('class' => 'btn btn-success' )}}

			{!! Form::close() !!}
            @include('layouts.errors')
		</div>
	</div>
@endsection
