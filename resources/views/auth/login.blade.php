@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default">
            @if(Request::session()->has('message'))
                <div class="alert alert-danger">
                    {{ Request::session()->get('message', 'default') }}
                </div>
            @endif
   <div class="panel-heading">Prisijungti</div>
                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ route('auth.discord') }}">Prisijungti Su Discord</a><br><br>
                    <a href="../private">Prisijungdami sutinkate su mūsų privatumo politiką</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
