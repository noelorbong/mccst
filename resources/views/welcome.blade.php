<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/img/brand/favicon.png" type="image/png">
        <title>MCCSto.Tomas</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html{
                
                background: url(../img/brand/background.gif) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover;
            }

            body {
                
                
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            body::before
            {
              content: "";
              display: block;
              position: absolute;
              z-index: -1;
              width: 100%;
              height: 100%;
              /* background:#2b2d35;
              opacity: .6; */
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
                width:100%;
            }

            .title {
                width: 100%;
                /* font-weight: 500; */
                /* color: #636b6f; */
                -webkit-text-stroke: 2px #ffffff;
                background-color: rgba(191, 165, 165, 0.5);
            }

             .title::before
            {
              content: "";
              display: block;
              position: absolute;
              z-index: -2;
              
              height: 12vw;
              background:#494d4e;
              opacity: .5;
            }

            .links > a {
                color: #cfdce2;
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
                    @if (Auth::check())
                        <a href="{{ url('/main') }}">Dashboard</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <!-- MCC Sto.Tomas -->
                    <img style="width:20vw" src="../img/brand/banner.png" title="MCC Sto.Tomas" Alt="MCC Sto.Tomas"/>
                </div>
            </div>
        </div>
    </body>
</html>
