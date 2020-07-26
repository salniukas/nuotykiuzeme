@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
      @endif
      @if(Auth::user()->isAdmin || Auth::user()->isSupport || Auth::user()->isAleradas)
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Nepatikrintos Anketos</p>
              <h3 class="card-title">{{$forms}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="anketos">Tikrinti</a>
              </div>
            </div>
          </div>
        </div>
        @endif
        @if(Auth::user()->isAdmin || Auth::user()->isSupport)
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Surinkta Paramos</p>
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
        @if(Auth::user()->isAdmin || Auth::user()->isSupport || Auth::user()->isAleradas)
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Žaidėjų Whiteliste</p>
              <h3 class="card-title">{{$play}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i><a href="table-list">Žaidėjų sąrašas</a>
              </div>
            </div>
          </div>
        </div>
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
                @if(!Auth::user()->isAdded && Auth::user()->isAleradas || Auth::user()->isDonator)
                        Užregistruokite savo Minecraft Paskyrą
                        <a href="http://nuotykiuzeme.lt/zaidejai/add">Registracija</a>
                @else
                Šia savaite
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @if($playwc)
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
        @endif
        @endif
        <div class="col-lg-6 col-md-12 float-right">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Mano Anketos</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Vardas</th>
                  <th>Username</th>
                  <th>Discord ID</th>
                  <th>Statusas</th>
                </thead>
                <tbody>
                @foreach ($mano as $man)
                  <tr>
                    <td>{{ $man->id }}</td>
                    <td>{{ $man->name }}</td>
                    <td>{{ $man->username }}</td>
                    <td>{{ $man->discord_id }}</td>
                    <td>
                      @if($man->accepted == 0 && $man->rejected == 0)
                        <b style="color: black;">Neperžiurėta</b>
                      @elseif($man->accepted)
                        <b style="color: green;">Priimta</b>
                      @elseif($man->rejected)
                       <b style="color: red;"> Atmesta</b>
                      @endif
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 float-right">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Mano Prenumeratos</h4>
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
@endpush