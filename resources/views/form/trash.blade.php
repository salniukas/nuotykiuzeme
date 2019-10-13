@extends('layouts.app')

@section('content')
@section('nav')
	<li><a href="{{ route('show') }}">Anketos</a></li>
	<li><a href="{{ route('forms.etapas') }}">II Etapas</a></li>
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
				<div class="panel-heading"><h3>Iš viso atmestų anketų: {{ $count }}</span></h3></div>
				<table>
					<tr></tr>
				<table class="table">
					<tr>
						<td style="width:1%">Id</td>
						<td>Vardas</td>
						<td>Amžius</td>
						<td>Discord</td>
						<td>Minecraft nick</td>
						<td>Balsai</td>
						<td style="width: 1%">Statusas</td>
					</tr> 
					  @foreach ($forms as $form)
					 <tr>
					 	<td>{{ $form->id }}</td>
					 	<td>{{ $form->name }}</td>
					 	<td>{{ $form->age }}</td>
					 	<td>{{ $form->discord_id }}</td>
					 	<td>{{ $form->username }}</td>
					 	@php
					 		$balsai = App\Forms_vote::where('voted_for', $form->id)->count();
					 	@endphp
					 	<td>{{ $balsai}}</td>
					 	@if(Auth::user()->isSupport() || Auth::user()->isAdmin() || Auth::user()->isAleradas())
						<td><a href="/anketos/{{ $form->id }}"><button class="btn btn-xs btn-info pull-right clearfix">Peržiurėti</button></a></td>
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