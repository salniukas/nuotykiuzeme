@extends('layouts.app', ['activePage' => 'Paslaugos-Kurimas', 'titlePage' => __('Paslaugos Kurimas')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-8">
          <form method="post" action="{{ route('service-store') }}" autocomplete="off" class="form-horizontal" id="prof">
            @csrf
            @method('POST')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Paslaugos Kurimas') }}</h4>
                <p class="card-category">Čia galite sukurti paslaugą</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-8">
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
                  <label class="col-sm-4 col-form-label">{{ __('Paslaugos pavadinimas:') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="name" id="name" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-4 col-form-label">{{ __('Paslaugos uždėjimo komanda, Naudokite [nick] žaidėjo vardui: ') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="cmd" id="cmd" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-4 col-form-label">{{ __('Paslaugos kaina centais (1€ = 100): ') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group">
                    	<input class="form-control" name="cost" id="cost" type="text" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="card-footer ml-auto mr-auto d-flex justify-content-center">
                  <button type="submit"  class="btn btn-primary ">{{ __('Sukurti') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection