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
        <title>MCCSto.Tomas</title>
        <link rel="shortcut icon" href="img/brand/favicon.png" type="image/png">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <style>
            html {
                /* background: url(../img/brand/background.jpg) no-repeat center center fixed;                 -webkit-background-size: cover; */
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            
            body {
                /* color: #636b6f; */
                font-family: 'Raleway', sans-serif;
                margin: 0;
                /* background-color:transparent !important; */
            }
            .table {
            margin: 0px;
            padding: 0px;
            text-align: center;
            width:100%;
            }
            td {
            vertical-align: middle;
            text-align: center;
            }
            tbody th{
                font-weight: normal;
                font-size: 13px;
            }
            .admin_user{
                font-weight: normal;
                font-size: 13px;
            }

            thead th{
                font-weight: bold;
                font-size: 13px;
            }
                
          
        </style>
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
       <p class="admin_user" >Admin User: {{ Auth::user()->name }}<p>
          <table class="table table-bordered">
        <thead >
                <tr>
                    <th scope="col">Name
                    </th>
                    <th scope="col">Number
                    </th>
                    <th scope="col">Email
                    </th>
                    <th scope="col">Request
                    </th>
                    <th scope="col">Quantity
                    </th>
                    <th scope="col">Location
                    </th>
                    <th scope="col">Status
                    </th>
                    <th scope="col">Note
                    </th>
                    <th scope="col">Date
                    </th>
                </tr>
            </thead>
            <tbody id="tbody" width="100%" >
                @forelse($records as $record)
                    <tr>
                        <th scope="col">{{ $record->name }}</th>
                        <th scope="col">{{ $record->number }}</th>
                        <th scope="col">{{ $record->email }}</th>
                        <th scope="col">{{ $record->title }}</th>
                        <th scope="col">{{ $record->quantity }}</th>
                        <th scope="col">{{ $record->latitude.', '.$record->longitude }}</th>
                        @if($record->responded === 2)
                        <th scope="col">Closed</th>
                        @elseif($record->responded === 1)
                        <th scope="col">Responded</th>
                        @else
                        <th scope="col">Unresponded</th>
                        @endif
                        <th scope="col" style="max-width:300px;" >{{ $record->admin_note }}</th>
                        <th scope="col">{{ $record->created_at }}</th>
                        </tr>
                 @empty
	            @endforelse
            </tbody>
        </table>
        <!-- CoreUI and necessary plugins-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       <script>
       (function() {
        // your page initialization code here
        // the DOM will be available 
       window.print();

        })();
             
        </script>

    </body>

    </html>