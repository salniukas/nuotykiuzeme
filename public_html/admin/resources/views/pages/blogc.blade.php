@extends('layouts.app', ['activePage' => 'Wblog', 'titlePage' => __('Pranešimo Rašymas')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-8">
          <form method="post" action="{{ route('blog-store') }}" autocomplete="off" class="form-horizontal" id="prof">
            @csrf
            @method('POST')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Pranešimo Rašymas') }}</h4>
                <p class="card-category">Čia galite rašyti pranešimą</p>
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
                  <label class="col-sm-4 col-form-label">{{ __('Pranešimo pavadinimas:') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control" name="title" id="title" type="text" value="" placeholder="Kada Adminas?" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-4 col-form-label">{{ __('Pranešimas') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <textarea class="form-control" rows="10" name="content" id="content" type="text" value="" placeholder="Pranešimas" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="card-footer ml-auto mr-auto d-flex justify-content-center">
                  <button type="submit"  class="btn btn-primary ">{{ __('Publikuoti') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection