<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="verify-paysera" content="7259267a334e396271f23375cae41d40">
        <title>Nuotykių Žemė</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url(/img/Pagrindinis.png);
                background-size:cover;
                background-position: center;
                color: #fff;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Serveris</a>
                    @else
                        <a href="{{ route('login') }}">Prisijungti</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Nuotykių Žemė
                </div>

                <div class="links">
                    <a href="/donate/select">Žalioji Zona</a>
                    <a href="/atranka">Atranka</a>
                    <a href="/video">Video</a>
                    @auth
                        <a href="/home">Serverio Info</a>
                    @endauth
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
						var wtpQualitySign_projectId  = 153102;
						var wtpQualitySign_language   = "lt";
						</script><script src="https://bank.paysera.com/new/js/project/wtpQualitySigns.js" type="text/javascript" charset="utf-8"></script>
					
    </body>
</html>
