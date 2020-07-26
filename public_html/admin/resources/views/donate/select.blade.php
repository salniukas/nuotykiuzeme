<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#000000">
    <meta name="verify-paysera" content="6e5488a4bce566e633c8e744d2682a59">

    <link rel="manifest" href="./manifest.json">

    <link rel="stylesheet" href="//bapserveris.lt/styles/font.css">
    <link rel="stylesheet" href="//bapserveris.lt/styles/main.css">
    <link rel="stylesheet" href="//bapserveris.lt/styles/header.css">
    <link rel="stylesheet" href="//bapserveris.lt/styles/body.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/3cecc6dcb5.js" crossorigin="anonymous"></script>
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

    <!-- Import FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <title>BAP! Puslapis</title>
</head>
<body>
    <div class="container">
        <h1 style="color: red; margin-bottom: 50px;">TESTINIAI MOKĖJIMAI</h1>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
    			{!! Form::open(['route' => 'paysera-redirect']) !!}
        			{{Form::label('username', 'Jūsų vartotojo Vardas Žaidime:')}}
        			{{Form::text('username', null, array('class' => 'form-control', 'style' => 'width: 150px;'))}}

        			{{Form::label('email', 'Jūsų El.Paštas:')}}
        			{{Form::text('email', null, array('class' => 'form-control', 'style' => 'width: 200px;'))}}

        			{{Form::label('amount', 'Pasirinkite Paslauga')}}<br>
        			{{Form::select('amount', array('145' => 'Baronas (1.45€)', '380' => 'KARALIUS  (3.80€)', '560' => 'VALDOVAS  (5.60€)'))}}

        			<br><br>{{Form::submit('Apmokėti'), array('class' => 'btn btn-success btn-link' )}}

    			{!! Form::close() !!}
                @include('layouts.errors')
            </div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
        var wtpQualitySign_projectId  = 159230;
        var wtpQualitySign_language   = "lt";
    </script>
    <script src="https://bank.paysera.com/new/js/project/wtpQualitySigns.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>