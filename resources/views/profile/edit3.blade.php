@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Žaidėjo registracija')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('storez') }}" autocomplete="off" class="form-horizontal" id="prof">
            @csrf
            @method('POST')


            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Žaidėjo registracija') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Vardas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="name" id="name" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Minecraft Vartotojo Vardas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="username" id="username" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Amžius') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="age" id="age" type="number" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Discord_id') }}</label>
                <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="discord_id" id="discord_id" type="text" value="{{ Auth::user()->discord_id }}"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="email" id="email" type="text" value=""/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Discord@Tag') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="discord" id="discord" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Youtube Kanalas(jei neturite rasykite -)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="youtube" id="youtube" type="text" value=""/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Twitch Kanalas(jei neturite rasykite -)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="twitch" id="twitch" type="text" value=""/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <a href="#"><button  class="btn btn-primary">{{ __('Registruotis') }}</button></a>
                
              </div>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection