@extends('layouts.app', ['activePage' => 'Atranka', 'titlePage' => __('Atranka')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('atrankaS') }}" autocomplete="off" class="form-horizontal" id="atraz">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Pildyti Anketą') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Jūsų Vardas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="name" id="input-name" type="text" placeholder="{{ __('Petraitis') }}" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('El. paštas') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="email" id="input-email" type="email" placeholder="" value="{{ Auth::user()->email }}" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="age">{{ __(' Amžius') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" input type="number" name="age" id="age" placeholder="{{ __('18') }}" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="discord_id">{{ __('Discord id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="discord_id" id="discord_id" type="text" placeholder="" value="{{Auth::user()->discord_id}}" required readonly />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="kapl">{{ __('Ką planuojate serveryje veikti?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="kapl" id="kapl" type="text" placeholder="Įkurti didžiausia miestą, bei atidaryti savo redstone parduotuve" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="kokia">{{ __('Kokią vertę sukursite kitiems serverio žaidėjams?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="kokia" id="kokia" type="text" placeholder="Manau, tokią. jog visados būsiu serveryje, visad galėsiu padėti kai jiems reikės pagalbos, niekad nepaliksiu bėdoj." value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="kodel">{{ __('Kodėl norite žaisti serveryje?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="kodel" id="kodel" type="text" placeholder="Norėčiau tesiog praleisti gerai laiką su kitais serverio žaidėjais." value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="kaip">{{ __('Kaip sužinojote apie šį projektą?') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="kaip" id="kaip" type="text" placeholder="Šalna pasiulė prisijungti" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="mic">{{ __('Ar turite galimybę kalbėti per kompiuterį? (ar turite mikrofoną?)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="mic" id="mic" type="text" placeholder="Taip" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="darbai">{{ __('Jūsų Minecraft darbų albumas ("imgur" svetainės nuoroda) PRIVALOMA') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="darbai" id="darbai" type="text" placeholder="https://imgur.com/gallery/UeSYJ" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="serv">{{ __('Ar esate žaidę kituose privačiuose serveriuose? Jei taip, parašykite kur') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="serv" id="serv" type="text" placeholder="StoneAge, Alerado Žemė, Lazuritas" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="content">{{ __('Ar esate turinio kūrėjas? Jei taip, parašykite kanalo pavadinimą') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="content" id="content" type="text" placeholder="https://www.youtube.com/user/thesalniukas" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="subs">{{ __('Sekėjų / prenumeratorių skaičius') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="subs" id="subs" type="number" placeholder="10 000" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="username">{{ __('Jūsų minecraft paskyros vardas:') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="username" id="username" type="text" placeholder="SaLnIuKaS" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary" value="Submit" form="atraz">{{ __('Siųsti') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection