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
    <link rel="shortcut icon" href="/img/brand/favicon.png" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register </title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
            html{               
              background: url(../img/brand/background.gif?) no-repeat center center fixed;                 -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }

            body {
                color: #ffffff;
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
              /* background:#5c9a21;
              opacity: .6; */
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #f7eded;
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
    <div class="top-right links">
      <a href="{{ url('/main') }}">Dashboard</a>
    </div>
    <div id="app" class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
          <div class="card-body p-4">
              <h1>Register</h1>
              <p class="text-muted">Create your account</p>
              <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        
                @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
                <div class="input-group mb-3{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon-user"></i>
                    </span>
                    </div>
                    <input id="name" type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    
                </div>

                @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </span>
                @endif
                <div class="input-group mb-3{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                    </div>
                    <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required>
                    
                </div>

                 @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('password') }}</strong>
                        </span>
                @endif   
                <div class="input-group mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-lock"></i>
                        </span>
                    </div>
                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
                </div>
                
                    

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon-lock"></i>
                    </span>
                    </div>
                    <input id="password-confirm" placeholder="Repeat password" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button class="btn btn-block btn-success" type="submit">Create Account</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
  </body>
</html>