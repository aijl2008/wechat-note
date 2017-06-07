<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$setting->name}}</title>

    <!-- Custom Bootstrap CSS file -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <style>

        html, body {
            color: #525252;
            -webkit-font-smoothing: antialiased;
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 15px;
            line-height: 1.428571429;
        }

        footer {
            margin: 10px 0;
        }

        .social-buttons button {
            margin-top: 5px;
        }

        /* Media Queries */
        @media (min-width: 768px) {
            .group2 {
                text-align: right;
            }
        }

        .post-meta {
            color: #999;
            font-size: 13px;
            margin-top: -6px;
        }

        #header {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 40px;
        }

        #header img {
            margin-top: 40px;
            margin-bottom: 5px;
            margin-right: auto;
            margin-left: auto;
            border: 1px solid #ebebeb;
            width: 80px;
            height: 80px;
            display: block;
            border-radius: 6px;
        }

        #header .name {
            letter-spacing: 2px;
            margin: 3px 0 20px;
            color: gray !important;
            font-size: 16px;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
        }
    </style>

    <!-- Jquery and Bootstrap Script files -->
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

<!-- Body -->
<div class="container">

    <div style="float: right; margin-top: 5px">
        @if (Route::currentRouteName() != 'login')
            @if (!Auth::check())
                <a href="{{ url('login') }}"><span
                            class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
            @else
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span
                            class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
                <a href="{{ route('settings.setting.edit') }}"><span
                            class="glyphicon glyphicon-cog" aria-hidden="true"></span></a>
                <a href="{{ route('notes.note.create') }}"><span
                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
            @endif
        @endif
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <div id="header">{!! $setting->logosrc !!}
        <div class="name">{{$setting->name}}</div>
    </div>

    @yield('content')
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <hr/>
        <p class="text-center">Copyright &copy; {{$_SERVER["SERVER_NAME"]}} {{date('Y')}}. All rights reserved.</p>
    </div>
</footer>
</body>
</html>






