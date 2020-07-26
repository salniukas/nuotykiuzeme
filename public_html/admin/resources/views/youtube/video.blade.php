@extends('layouts.app')

@section('content')
<center><h1>Nuotykių Žemės Video</h1></center>
	<div class="container">
			<div class="row">
        @foreach($video as $vid)
          		<div class="col-md-4">
            		<h5>{{ $vid->title }}</h5>
            		<iframe width="375px" height="200px" src="https://www.youtube.com/embed/{{ $vid->yt }}" frameborder="0"></iframe>
            		<p>{{ $vid->desc }}</p>
          		</div>
        @endforeach
      </div>
  </div>
@endsection