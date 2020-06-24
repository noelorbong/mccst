<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.0.0
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
            html{               
              background: url(../img/brand/background.gif?) no-repeat center center fixed;                 -webkit-background-size: cover;
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
                background-color:transparent !important;
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


            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
    </style>
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card-group">
            <div class="card p-">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Sign In to your account</p>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif       
                    <div class="input-group mb-3{{ $errors->has('email') ? ' has-error' : '' }}" >
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            @
                            </span>
                        </div>
                        <input id="email" placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>             
                    </div>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('password') }}</strong>
                        </span>
                     @endif
                    <div class="input-group mb-4{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                    </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
 
  </body>
</html>