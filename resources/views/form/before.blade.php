@extends('layouts.app')
@section('head')

  <style type="text/css">
    body{
      background-image: url(/img/anketos.png);
      color: #fff;
      font-family: 'Raleway', sans-serif;
      font-weight: 100;
      margin: 0;
      /* Full height */
      /* Center and scale the image nicely */
      background-repeat: no-repeat;
      background-size: cover;
    }
    .section{
      margin-left: 13%;
    }
    .migtuk {
      background-color:#a1a1a1;
      border-radius:10px;
      display:inline-block;
      cursor:pointer;
      color:#ffffff;
      font-family:Courier New;
      font-size:21px;
      padding:16px 59px;
      text-decoration:none;
      /*text-shadow:0px 1px 0px #d1f5cc;*/
    }
    .migtuk:hover {
      background-color:#a1a1a1;
    }
    .migtuk:active {
      position:relative;
      top:1px;
    }

  </style>
@endsection
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
        <center><a href="{{ route('pildyti') }}"><button type="button" class="migtuk">PILDYTI</button></a></center>
      </div>
    </div>
@endsection