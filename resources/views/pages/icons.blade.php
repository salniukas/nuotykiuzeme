@extends('layouts.app', ['activePage' => 'icons', 'titlePage' => __('Icons')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card-body float-right">
              {!! Form::open(['route' => 'paysera-redirect']) !!}
                  {{Form::label('username', 'Jūsų vartotojo Vardas:')}}
                  {{Form::text('username', null, array('class' => 'form-control', 'style' => 'width: 150px;'))}}

                  {{Form::label('email', 'Jūsų El.Paštas:')}}
                  {{Form::text('email', Auth::user()->email, array('class' => 'form-control', 'style' => 'width: 200px;'))}}

                  {{Form::label('amount', 'Prenumeratos Laikotarpis')}}<br>
                  {{Form::select('amount', array('500' => 'Vienas mėnesis(5€)', '1000' => 'Du mėnesiai(10€)', '1500' => 'Trys mėnesiai(15€)'))}}

                  <br><br>{{Form::submit('Paremti'), array('class' => 'btn btn-success btn-link' )}}

              {!! Form::close() !!}
                @include('layouts.errors')
             </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection