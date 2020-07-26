@extends('layouts.app')

@section('content')
@section('lnav')
@if(Auth::user()->isAdmin)
	<li><a href="{{ Route('anketosMail') }}">Siūsti Email</a></li>
@endif
@if(Auth::user()->isSupport)
	<li><a href="{{ Route('anketosApprove') }}">Visos Anketos</a></li>
@endif
@if(Auth::user()->isSupport || Auth::user()->isAleradas)
	<li><a href="{{ Route('anketosEtapas') }}">Patvirtintos Anketos</a></li>
@endif
@endsection
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		    @if(Request::session()->has('message'))
                <div class="alert alert-danger">
                    {{ Request::session()->get('message', 'default') }}
                </div>
            @endif
			<div class="panel panel-default">
				<table>
					<tr>Anketos į Nuotykių Žeme</tr>
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
					 		$balsaiu = App\Forms_vote::where('voted_for', $form->id)->where('reason', 'Už')->count();
					 		$balsaip = App\Forms_vote::where('voted_for', $form->id)->where('reason', 'Prieš')->count();         
					 	@endphp
					 	<td>{{ $balsaiu}}/-{{ $balsaip }}</td>
					 	@if($form->rejected == 1)
					 		<td style="background-color: red;"></td>
					 	@elseif($form->aleradas == 1)
					 		<td style="background-color: purple;"></td>
					 	@elseif($form->accepted == 1)
					 		<td style="background-color: green;"></td>
					 	@elseif($form->accepted == 0 && $form->rejected == 0)
					 		<td style="background-color: yellow;"></td>
					 	@endif
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