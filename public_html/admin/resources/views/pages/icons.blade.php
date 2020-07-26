@extends('layouts.app', ['activePage' => 'icons', 'titlePage' => __('Icons')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <form method="post" action="{{ route('paysera-redirect') }}" autocomplete="off" class="form-horizontal" id="prof">
            @csrf
            @method('POST')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Paskyros Pirkimas') }}</h4>
                <p class="card-category">Čia galite įsigyti minecraft paskyras per Paysera platfomą</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-6">
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
                  <label class="col-sm-2 col-form-label">{{ __('Jūsų El.Paštas:') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="email" id="email" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="card-footer ml-auto mr-auto d-flex justify-content-center">
                  <button type="submit"  class="btn btn-primary ">{{ __('Apmokėti') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection