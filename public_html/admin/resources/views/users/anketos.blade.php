@extends('layouts.app', ['activePage' => 'Užsakymai', 'titlePage' => __('Užsakymai')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Užsakymai') }}</h4>
                <p class="card-category"> {{ __('Čia galite peržiurėti Užsakymus') }}</p>
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
                        {{ __('Kaina') }}
                      </th>
                      <th>
                        {{ __('El.pastas') }}
                      </th>
                      <th>
                        {{ __('Username') }}
                      </th>
                      <th>
                        {{ __('Paslauga') }}
                      </th>
                      <th>
                        {{ __('Statusas') }}
                      </th>
                      <th>
                        {{ __('Data') }}
                      </th>
                      <th>
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($orders as $order)
                        <tr>
                          <td>
                            {{ $order->id }}
                          </td>
                          <td>
                            @php
                              $kaina = $order->amount /100
                            @endphp
                            {{ $kaina }} €
                          </td>
                          <td>
                            {{ $order->email }}
                          </td>
                          <td>
                            {{ $order->username }}
                          </td>
                          <td>
                            {{ $order->service_name }}
                          </td>
                          <td>
                            {{ $order->approved }}
                          </td>
                          <td>
                            {{ $order->created_at }}
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
                  {{ $orders->links() }}
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection