@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Naujienos</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Sekmingai prisijungėte
                    @if(Auth::user()->isAleradas && !Auth::user()->isAdded)
                    <br><br>
                        Užregistruokite savo Minecraft Paskyrą
                        <a href="http://nuotykiuzeme.lt/zaidejai/add">Minecraft Registracija</a>
                    @endif
                    @if(Auth::user()->isAleradas)
                    <br>
                    <br>
                        Naudingi dalykai:<br>
                        <a href="http://nuotykiuzeme.lt/zaidejai">Žaidejai</a><br>
                        <a href="http://nuotykiuzeme.lt/anketos">Anketos</a><br>
                        <a href="http://nuotykiuzeme.lt/zaidejai/edit">Redaguoti savo Žaidėją</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
