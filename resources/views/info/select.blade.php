@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
            <div class="panel-heading">Paysera</div>
            <div class="panel-body">
    			{!! Form::open(['route' => 'dstore']) !!}
        			{{Form::label('username', 'Jūsų Vardas:')}}
        			{{Form::text('username', null, array('class' => 'form-control'))}}

        			{{Form::label('email', 'Jūsų El.Paštas:')}}
        			{{Form::text('email', null, array('class' => 'form-control'))}}

        			{{Form::label('amount', 'Paramos Lygis:')}}<br>
        			{{Form::select('amount', array('100' => 'Pirmas Lygis(1€)', '500' => 'Antras Lygis(5€)', '1000' => 'Trečias Lygis(10€)', '1500' => 'Ketvirtas Lygis(15€)'))}}

 {{--                {{Form::label('type', 'Mokejimo būdas:')}}
                    {{Form::select('type', array('paypal' => 'PayPal', 'paysera' => 'PaySera'))}} --}}


        			<br>{{Form::submit('Paremti'), array('class' => 'btn btn-success' )}}

    			{!! Form::close() !!}
                @include('layouts.errors')
            </div>
		</div>
	</div>
	<hr style="height: 20px; color: black;">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-heading">PayPal</div>
            <div class="panel-body">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="KW3CDQ55WZCSY">
                    <table>
                    <tr><td><input type="hidden" name="on0" value="Donation Lygis">Donation Lygis</td></tr><tr><td><select name="os0">
                        <option value="Pirmas Lygis">Pirmas Lygis €1.00 EUR</option>
                        <option value="Antras Lygis">Antras Lygis €5.00 EUR</option>
                        <option value="Tre&#269;ias Lygis">Tre&#269;ias Lygis €10.00 EUR</option>
                        <option value="Ketvirtas Lygis">Ketvirtas Lygis €15.00 EUR</option>
                    </select> </td></tr>
                    <tr><td><input type="hidden" name="on1" value="J&#363;s&#371; El.Paštas">J&#363;s&#371; El.Paštas</td></tr><tr><td><input type="text" name="os1" maxlength="200"></td></tr>
                    <tr><td><input type="hidden" name="on2" value="J&#363;s&#371; Discord ID">J&#363;s&#371; Discord ID</td></tr><tr><td><input type="text" name="os2" maxlength="200"></td></tr>
                    </table>
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
                @include('layouts.errors')
            </div>
        </div>
    </div>
@endsection