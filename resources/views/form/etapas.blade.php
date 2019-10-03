@extends('layouts.app')

@section('content')
@section('nav')
	<li><a href="{{ route('show') }}">Anketos</a></li>
	<li><a href="{{ route('forms.trash') }}">Šlamšas</a></li>
@endsection
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				@if(session()->has('message'))
    				<div class="alert alert-dismissable alert-success">
        			{{ session()->get('message') }}
    				</div>
				@endif
				<div class="panel-heading"><h3>Iš viso II etapo anketų: {{ $count }}</span></h3></div>
				<table>
					<tr></tr>
				<table class="table">
					<tr>
						<td style="width:1%">Id</td>
						<td>Vardas</td>
						<td>Amžius</td>
						<td>Kodel jis</td>
						<td>Rase</td>
						<td>Minecraft Sugebejimai</td>
					</tr> 
					  @foreach ($anketos_forms as $form)
					 <tr>
					 	<td>{{ $form->id }}</td>
					 	<td>{{ $form->name }}</td>
					 	<td>{{ $form->age }}</td>
					 	<td>{{ $form->why }}</td>
					 	<td>{{ $form->rase }}</td>
					 	<td>{{ $form->mability }}</td>
					 	@if(Auth::user()->isAleradas)
						<td><button class="btn btn-xs btn-info pull-right clearfix"><a href="/atranka/show/{{ $form->id }}">Peržiurėti</a></button></td>
						@endif
					 	@endforeach
					 </tr>
				</table>
				</table>
				
			</div>
		</div>
	</div>
</div>
@endsection