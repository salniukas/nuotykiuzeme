@extends('layouts.app', ['activePage' => 'Paslaugos', 'titlePage' => __('Paslaugos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Paslaugų Sąrašas') }}</h4>
                <p class="card-category"> {{ __('Čia galite peržiurėti serverio paslaugas') }}</p>
              </div>
              <div class="card-body">
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
                  <div class="col-12 text-right">
                    
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Id') }}
                      </th>
                      <th>
                        {{ __('Pavadinimas') }}
                      </th>
                      <th>
                        {{ __('Komanda') }}
                      </th>
                      <th>
                        {{ __('Kaina') }}
                      </th>
                      <th>
                        {{ __('Veiksmai') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($services as $service)
                        <tr>
                          <td>
                            {{ $service->id }}
                          </td>
                          <td>
                            {{ $service->name }}
                          </td>
                          <td>
                            {{ $service->cmd }}
                          </td>
                          <td>
                            @php
                              $kaina = $service->cost /100
                            @endphp
                            {{ $kaina }} €
                          </td>
                          <td class="td-actions">
                              <a rel="tooltip" class="btn btn-success btn-link" href="/service/delete/{{ $service->id }}" data-original-title="" title="">
                                <i class="material-icons">delete_forever</i>
                                <div class="ripple-container"></div>
                              </a>
                              <a rel="tooltip" class="btn btn-success btn-link" href="/service/edit/{{ $service->id }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection