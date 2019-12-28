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
    			{{Form::text('discord_id', $discord, array('class' => 'form-control','readonly'))}}

    			{{Form::label('email', 'Jūsų El.Paštas:')}}
    			{{Form::email('email', $mail, array('class' => 'form-control'))}}

                {{Form::label('kapl', 'Ką planuojate serveryje veikti?')}}
                {{Form::text('kapl', null, array('class' => 'form-control'))}}

                {{Form::label('kokia', 'Kokią vertę sukursite kitiems serverio žaidėjams? (Max 1000 Simbolių)')}}
                {{Form::text('kokia', null, array('class' => 'form-control', 'maxlength' => 1000 ))}}

    			{{Form::label('kodel', 'Kodėl norite žaisti serveryje? (Max 1000 Simbolių)')}}
    			{{Form::text('kodel', null, array('class' => 'form-control', 'maxlength' => 1000  ))}}

                {{Form::label('kaip', 'Kaip sužinojote apie šį projektą? Jei Jums Šį rekomendavo žmogus, parašykite jo žaidėjo vardą.')}}
                {{Form::text('kaip', null, array('class' => 'form-control' ))}}

                {{Form::label('mic', 'Ar turite galimybę kalbėti per kompiuterį? (ar turite mikrofoną?)')}}
                {{Form::text('mic', null, array('class' => 'form-control' ))}}

                {{Form::label('darbai', 'Jūsų Minecraft darbų albumas ("imgur" svetainės nuoroda)')}}
                {{Form::text('darbai', null, array('class' => 'form-control' ))}}

                {{Form::label('serv', 'Ar esate žaidę kituose privačiuose serveriuose? Jei taip, parašyk kur')}}
                {{Form::text('serv', null, array('class' => 'form-control' ))}}

                {{Form::label('content', 'Ar esate turinio kūrėjas? Jei taip, parašykite kanalo pavadinimą')}}
                {{Form::text('content', null, array('class' => 'form-control' ))}}

                {{Form::label('subs', 'Sekėjų / prenumeratorių skaičius')}}
                {{Form::number('subs', null, array('class' => 'form-control' ))}}
                
                {{Form::label('username', 'Jūsų minecraft paskyros vardas:')}}
                {{Form::text('username', null, array('class' => 'form-control' ))}}

    			{{Form::submit('Pateikti'), array('class' => 'btn btn-success' )}}

			{!! Form::close() !!}
            @include('layouts.errors')
		</div>
	</div>
@endsection
