@extends('layouts.app')

@section('content')
@section('nav')
@endsection
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<table>
					<tr></tr>
				<table class="table">
					<tr>
						<td style="width:1%">Id</td>
						<td>Vardas</td>
						<td>Amžius</td>
						<td>Žaidėjo vardas žaidime</td>
						<td style="width: 1%">Statusas</td>
					</tr> 
					  @foreach ($forms as $form)
					 <tr>
					 	<td>{{ $form->id }}</td>
					 	<td>{{ $form->name }}</td>
					 	<td>{{ $form->age }}</td>
					 	<td>{{ $form->username }}</td>
					 	@if($form->rejected == 1)
					 		<td style="background-color: red;"></td>
					 	@elseif($form->accepted == 1)
					 		<td style="background-color: green;"></td>
					 	@elseif($form->accepted == 0 && $form->rejected == 0)
					 		<td style="background-color: yellow;"></td>
					 	@endif
						<td><a href="/manoanketos/{{ $form->id }}"><button class="btn btn-xs btn-info pull-right clearfix">Peržiurėti</button></a></td>
					 	@endforeach
					 </tr>
				</table>
				</table>
				
			</div>
		</div>
	</div>
</div>
@endsection