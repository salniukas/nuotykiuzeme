@extends('layouts.app', ['activePage' => 'juodasis', 'titlePage' => __('Juodasis Sąrašas')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Juodasis Sąrašas</h4>
            <p class="card-category">Čia galite matyti visus vartotojus kurie nepateks į serverį.</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Vardas
                  </th>
                  <th>
                    DiscordID
                  </th>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>
                      {{ $user->username }}
                    </td>
                    <td>
                      {{ $user->discord_id }}
                    </td>
                  </tr>
                  @endforeach
                  {{ $users->links() }}
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