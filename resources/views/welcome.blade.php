
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="verify-paysera" content="7259267a334e396271f23375cae41d40">
        <title>Nuotykių Žemė</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/aos.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url(/img/fonas.gif);
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
                        <a href="{{ url('/home') }}">Meniu</a>
                    @else
                        <a href="{{ route('login') }}">Prisijungti</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img data-aos="fade-left" class="textas" src="img/text.png">
                </div>

                <div class="links">
                    <a href="/icons" >Parama</a>
                    <a href="/atranka">Atranka</a>
                    @auth
                        <a href="/home">Meniu</a>
                    @endauth
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
						var wtpQualitySign_projectId  = 153102;
						var wtpQualitySign_language   = "lt";
						</script><script src="https://bank.paysera.com/new/js/project/wtpQualitySigns.js" type="text/javascript" charset="utf-8">
						
		</script>
							<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
					<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
					<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
					<script src="js/firefly.js" type="text/javascript"></script>
					<script>
						AOS.init({
						});
					</script>
					
    </body>
</html>
