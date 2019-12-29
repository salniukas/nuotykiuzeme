@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Anketos Informacija ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal" id="prof">
            @csrf
            @method('PUT')


            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Anketos Informacija') }}</h4>
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
                  <label class="col-sm-2 col-form-label">{{ __('Unikalus Id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      {{$player->id}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Vardas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="name" id="name" type="text" value="{{$player->name}}" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Minecraft Vartotojo Vardas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="username" id="username" type="text" value="{{$player->username}}" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Amžius') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="age" id="age" type="number" value="{{$player->age}}" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Discord_id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      {{$player->discord_id}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="email" id="email" type="text" value="{{$player->email}}"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Discord @') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="discord" id="discord" type="text" value="{{$player->discord}}" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Youtube Kanalas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="youtube" id="youtube" type="text" value="{{$player->youtube}}"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Twitch Kanalas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="twitch" id="twitch" type="text" value="{{$player->twitch}}"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Baudos Taškai') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      {{$player->kiekis}} / 5
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Prisijungė prie serverio') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      {{date('Y-m-d', strtotime($player->created_at))}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Užblokuotas iki') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      @if($player->suspended)
                        {{date('Y-m-d', strtotime($player->banned_until))}}
                      @else
                      Neužblokuotas
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <a href="#"><button  class="btn btn-primary">{{ __('Išsaugoti') }}</button></a>
                
              </div>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection