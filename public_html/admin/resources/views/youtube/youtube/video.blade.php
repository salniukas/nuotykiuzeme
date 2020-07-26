@extends('layouts.app')

@section('content')
	<div class="container">
			<div class="row">
        @foreach($video as $vid)
          		<div class="col-md-8">
            		<h3>{{ $vid->title }}</h3>
            		<iframe width="480" height="390" src="https://www.youtube.com/embed/{{ $vid->yt }}" frameborder="0" allowfullscreen></iframe>
            		<p>{{ $vid->desc }}</p>
          		</div>
        	</div>
        @endforeach
      </div>
@endsection