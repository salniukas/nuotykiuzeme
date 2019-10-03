@extends('layouts.app')
@php
	$discord = Auth::user()->discord_id;
	$mail = Auth::user()->email;
@endphp
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Pildyti Anketą</h1>
			<hr>
			
			{!! Form::open(['route' => 'atrankaS']) !!}

    			{{Form::label('name', 'Jūsų vardas:')}}
    			{{Form::text('name', null, array('class' => 'form-control'))}}

    			{{Form::label('age', 'Kiek jums metų?:')}}
    			{{Form::number('age', null, array('class' => 'form-control'))}}

    			{{Form::label('discord_id', 'Discord ID:')}}
    			@if($discord != null)
    				{{Form::text('discord_id', $discord, array('class' => 'form-control'))}}
    			@elseif($discord == null)
    				{{Form::text('discord_id', null, array('class' => 'form-control'))}}
    			@endif
    			{{Form::label('email', 'Jūsų El.Paštas:')}}
    			{{Form::email('email', $mail, array('class' => 'form-control'))}}

    			{{Form::label('roleplay', 'Ar žinote ką reiškia "Rolių Žaidimas" ')}}
    			{{Form::text('roleplay', null, array('class' => 'form-control'))}}

                {{Form::label('rases', 'Išvardinkite visas egzistuojančias rases Alerado Žemėje.')}}
                {{Form::text('rases', null, array('class' => 'form-control'))}}

                {{Form::label('kokios', 'Kokios rasės atstovu norėtumėte būti ir kodėl? (Max 500 Simbolių)')}}
                {{Form::text('kokios', null, array('class' => 'form-control'))}}

    			{{Form::label('kodel', 'Kodėl norite dalyvauti Alerado Žemės projekte? (Max 500 Simbolių)')}}
    			{{Form::text('kodel', null, array('class' => 'form-control' ))}}

                {{Form::label('kaip', 'Kaip sužinojote apie šį projektą? Jei Jums Šį rekomendavo žmogus, parašykite jo žaidėjo vardą.')}}
                {{Form::text('kaip', null, array('class' => 'form-control' ))}}

                {{Form::label('username', 'Jūsų minecraft paskyros vardas:')}}
                {{Form::text('username', null, array('class' => 'form-control' ))}}

    			{{Form::submit('Pateikti'), array('class' => 'btn btn-success' )}}

			{!! Form::close() !!}
            @include('layouts.errors')
		</div>
	</div>
@endsection
