@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Anketos Informacija ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Anketos Informacija') }}</h4>
                <p class="card-category">{{ $forms->username }}</p>
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
                  <label class="col-sm-2 col-form-label">{{ __('ID') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      {{$forms->id}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Vardas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->name}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Amžius') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->age}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Discord_id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->discord_id}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->email}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ką planuojate serveryje veikti?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->kapl}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Kokią vertę sukursite kitiems serverio žaidėjams?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->kokia}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Kodėl norite žaisti serveryje?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->kodel}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Kaip sužinojote apie šį projektą?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->kaip}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ar turite galimybę kalbėti per kompiuterį? (ar turite mikrofoną?)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->mic}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Jūsų Minecraft darbų albumas ("imgur" svetainės nuoroda)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->darbai}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ar esate žaidę kituose privačiuose serveriuose? Jei taip, parašyk kur') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->serv}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ar esate turinio kūrėjas? Jei taip, parašykite kanalo pavadinimą') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->content}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Sekėjų / prenumeratorių skaičius') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      {{$forms->subs}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Jūsų minecraft paskyros vardas:') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <img src="https://minotar.net/avatar/{{ $forms->username }}/16"> {{ $forms->username }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Patvirtinti') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('Atmesti') }}</button>
                @if($forms->accepted && !$forms->aleradas)
                  <button type="submit" class="btn btn-primary">{{ __('Pridėti į Serverį') }}</button>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection