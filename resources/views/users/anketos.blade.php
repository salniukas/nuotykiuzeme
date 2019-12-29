@extends('layouts.app', ['activePage' => 'Anketos', 'titlePage' => __('Anketos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Anketos') }}</h4>
                <p class="card-category"> {{ __('Čia galite tikrinti anketas') }}</p>
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
                          {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Age') }}
                      </th>
                      <th>
                        {{ __('Username') }}
                      </th>
                      <th>
                        {{ __('Discord ID') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th>
                        {{ __('Už/Prieš') }}
                      </th>
                      <th>
                        {{ __('Statusas') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($forms as $form)
                        <tr>
                          <td>
                            {{ $form->name }}
                          </td>
                          <td>
                            {{ $form->age }}
                          </td>
                          <td>
                            {{ $form->username }}
                          </td>
                          <td>
                            {{ $form->discord_id }}
                          </td>
                          <td>
                            {{ $form->email }}
                          </td>
                          <td>
                            @php
                              $balsaiu = App\Forms_vote::where('voted_for', $form->id)->where('reason', 'Už')->count();
                              $balsaip = App\Forms_vote::where('voted_for', $form->id)->where('reason', 'Prieš')->count();         
                            @endphp
                            {{  $balsaiu }} / -{{ $balsaip }}
                          </td>
                          <td>
                            @if($form->accepted == 0 && $form->rejected == 0)
                              <b style="color: black;">Neperžiurėta</b>
                            @elseif($form->accepted)
                              <b style="color: green;">Priimta</b>
                            @elseif($form->rejected)
                             <b style="color: red;"> Atmesta</b>
                            @endif
                          </td>
                          <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-success btn-link" href="anketos/show/{{ $form->id }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
                  {{ $forms->links() }}
                  @if(Auth::user()->isAdmin)
                    <div class="col-12 text-right">
                      <a href="anketos/email" class="btn btn-primary">{{ __('Išsiųsti Email') }}</a>
                    </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection