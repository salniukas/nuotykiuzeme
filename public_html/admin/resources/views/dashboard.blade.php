@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
      <div class="container-fluid">
        <div class="content">
        @if($minecraft === '-')
        <div class="modal show" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Žaidėjo Registracija</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                {!! Form::open(['route' => 'homeReg']) !!}
                  {{Form::label('minecraft', 'Jūsų minecraft vartotojo vardas:')}}
                  {{Form::text('minecraft', null, array('class' => 'form-control', 'placeholder' => 'Pavardenis'))}}
                  
              </div>
              <div class="modal-footer">
               {{Form::submit('Užsiregistruoti'), array('class' => 'btn btn-success' )}}
              </div>
              {!! Form::close() !!}
            </div>
            
          </div>
        </div>
      @endif
      @if(Auth::user()->isAdmin || Auth::user()->isSupport || Auth::user()->isAleradas)
      <div class="row">
{{--         <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Nepatikrintos Anketos</p>
              <h3 class="card-title">
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="anketos">Tikrinti</a>
              </div>
            </div>
          </div>
        </div> --}}
        @endif
        @if(Auth::user()->isAdmin || Auth::user()->isSupport)
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Surinkta Pajamų</p>
              <h3 class="card-title">{{$amount}}€</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Per Paskutinę savaitę
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Žaidėjų Sąraše</p>
              <h3 class="card-title">{{$play}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i><a href="table-list">Žaidėjų sąrašas</a>
              </div>
            </div>
          </div>
        </div>
        @if(Auth::user()->isAdmin || Auth::user()->isSupport)
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-id-card" aria-hidden="true"></i>
              </div>
              <p class="card-category">Naujų Žaidėjų</p>
              <h3 class="card-title">{{$playwc}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i>
                Šia savaite
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
{{--       @if($playwc)
        <div class="col-lg-6 col-md-12 float-left">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Naujai pridėti žaidėjai</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Vardas</th>
                  <th>Username</th>
                  <th>Discord ID</th>
                </thead>
                <tbody>
                @foreach ($playw as $player)
                  <tr>
                    <td>{{ $player->id }}</td>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->username }}</td>
                    <td>{{ $player->discord_id }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif --}}
        <div class="col-lg-6 col-md-12 float-left">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Mano Paslaugos</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>NR.</th>
                  <th>Pirkta</th>
                  <th>Vartotojas</th>
                  <th>Kaina</th>
                  <th>Liko Laiko</th>
                  <th>Veiksmai</th>
                  </th>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->username }}</td>
                    <td>{{ $order->amount/100 }}€</td>
                    <td>
                      @if (Carbon\Carbon::parse($order->until)->diffInDays(null, false) > 0)
                      Galiojimas baigėsi
                      @else
                      {{ Carbon\Carbon::parse(now())->diffInDays($order->until, false) }} d.
                      @endif
                    </td>
                    <td>
                      @if (Carbon\Carbon::parse($order->until)->diffInDays(null, false) > 0)
                      
                      @elseif(!Auth::user()->isAdded && Auth::user()->isDonator)
                      <a rel="tooltip" class="btn btn-success btn-link" href="http://nuotykiuzeme.lt/zaidejai/add" data-original-title="" title="">
                                <i class="material-icons">contactless</i>
                                <div class="ripple-container"></div>
                              </a>
                      @else
                      Paskyra Užregistruota
                      @endif
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
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
  <script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
@endpush
