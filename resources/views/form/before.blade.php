@extends('layouts.app')

@section('content')
<div class="section">
      <div class="container">
        <div class="row">
        <div class="panel-heading"><h3>Ką reikia žinoti prieš pildant anketą</h3></div>
          <div class="col-md-12">
            <h3>Ar reikia būti youtuberiu/streameriu, kad patekti į serverį?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Ne nereikia, bet tai padidina šansus.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Kaip prisijungti prie jūsų Discord serverio?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Paspausdami <a href="https://discord.gg/vnvpZz3">šia</a> nuoroda</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Ar reikia turėti Legalią "Minecraft" paskyrą?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Taip! Legali minecraft paskyra yra privaloma norint patekti į serverį!</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Kas kiek laiko tikrinat anketas?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Reguliariai.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Ar galima pasikeisti frakciją?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Taip galima</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Kur rasti Discord ID?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Discord id tinklapis parašys už jus jei registravotės su Discord, Kitu atveju Betkuriame serverije į pokalbi rašykite: \@Jūsų tag.&nbsp;<br>
              Šiuo atveju tai būtu "\@Šalna#7007"<br> ir mano id: 138295894238953472.
              <br>
              <br>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Kiekvienas kandidatas privalo:</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p class="text-left">1. Turėti legalią „Minecraft“ paskyrą.&nbsp;
              <br>
              <br>2.&nbsp;Suprantamai rašyti lietuvių kalba.&nbsp;
              <br>
              <br>3.&nbsp;Nenaudoti keiksmažodžių.&nbsp;
              <br>
              <br>4.&nbsp;Turėti „Discord” programą.&nbsp;
              <br>
              <br>5.&nbsp;Turėti&nbsp;mikrofoną.&nbsp;
              <br>
              <br>6.&nbsp;Suprasti "Rolių žaidimų" reikšmę.</p>
              <br>
              <p>Jei manai, kad esi pasiruošės, tada.. lėk pildyti Anketos!</p>
          </div>
        </div>
        <center><a href="{{ route('pildyti') }}"><button type="button" class="btn btn-lg btn-success">Pildyti!</button></a></center>
      </div>
    </div>
@endsection