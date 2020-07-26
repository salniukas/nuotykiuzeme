@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Pridėti Video</h1>
			<hr>
			
			{!! Form::open(['route' => 'videoStore']) !!}
    			{{Form::label('title', 'Video Pavadinimas:')}}
    			{{Form::text('title', null, array('class' => 'form-control'))}}

    			{{Form::label('desc', 'Video aprašymas:')}}
    			{{Form::text('desc', null, array('class' => 'form-control'))}}

    			{{Form::label('author', 'Autorius')}}
    			{{Form::text('author', null, array('class' => 'form-control', 'value' => 'Auth::user()->username'))}}

    			{{Form::label('yt', 'Video kodas(?v=MTsUnGkIhBg)')}}
    			{{Form::text('yt', null, array('class' => 'form-control', 'placeholder' => 'MTsUnGkIhBg'))}}

    			{{Form::submit('Prideti'), array('class' => 'btn btn-success' )}}

			{!! Form::close() !!}
            @include('layouts.errors')
		</div>
	</div>
@endsection
