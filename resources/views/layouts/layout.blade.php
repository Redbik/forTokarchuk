<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    {{--<link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">--}}

    {{--<!-- Custom styles for this template -->--}}
    {{--<link href="jumbotron.css" rel="stylesheet">--}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>



@section('nav')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">New'sBlog</a>
            </div>
            <ul class="nav navbar-nav">
                @auth
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Выход
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                        @auth
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                        <a href="{{ route('admin') }}">Админка</a>
                        </li>
                            @elseif(Auth::user()->role == 'user')
                            <li class="nav-item">
                            <a href="{{ route('usernew.create') }}">Добавить новость</a>
                            </li>
                        @endif


                        {{--@if(Auth::user()->role == 'user')--}}
                        {{--<li class="nav-item">--}}
                        {{--<a href="{{ route('news.create') }}">Добавить новость</a>--}}
                        {{--</li>--}}

                        {{--@endif--}}
                        @endauth
                    </ul>
                </li>
                @endauth
            </ul>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    @else
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>
                            <li><a data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Вход</a></li>

                            {{--<li><a data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>--}}
                            {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Войт</button>--}}

                            {{--<div class="modal fade" id="myModal" role="dialog">--}}
                                {{--<div class="modal-dialog">--}}

                                    <!-- Modal content-->
                                    {{--<div class="modal-content">--}}
                                        {{--<div class="modal-header">--}}
                                            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                            {{--<h4 class="modal-title">Войти</h4>--}}
                                        {{--</div>--}}
                                        {{--<div class="modal-body">--}}
                                            {{--<form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                                                {{--{{ csrf_field() }}--}}

                                                {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="name" class="col-md-4 control-label">Имя</label>--}}

                                                    {{--<div class="col-md-6">--}}
                                                        {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                                        {{--@if ($errors->has('name'))--}}
                                                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="email" class="col-md-4 control-label">E-Mail</label>--}}

                                                    {{--<div class="col-md-6">--}}
                                                        {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                                        {{--@if ($errors->has('email'))--}}
                                                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="password" class="col-md-4 control-label">Паролт</label>--}}

                                                    {{--<div class="col-md-6">--}}
                                                        {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                                        {{--@if ($errors->has('password'))--}}
                                                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group">--}}
                                                    {{--<label for="password-confirm" class="col-md-4 control-label">Повторите пароль</label>--}}

                                                    {{--<div class="col-md-6">--}}
                                                        {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group">--}}
                                                    {{--<div class="col-md-6 col-md-offset-4">--}}
                                                        {{--<button type="submit" class="btn btn-primary">--}}
                                                            {{--Зарегистрировать--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                        {{--<div class="modal-footer">--}}
                                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Войти</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                                {{ csrf_field() }}

                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label for="password" class="col-md-4 control-label">Пароль</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control" name="password" required>

                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-8 col-md-offset-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            Войти
                                                        </button>

                                                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                                            {{--Забыли свой пароль?--}}
                                                        {{--</a>--}}
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </ul>
                        @endauth
                </div>
            @endif

        </div>
    </nav>
@show

@section('main')
    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        {{--<div class="jumbotron">--}}
            {{--<div class="container">--}}
                {{--<h1 class="display-3">Hello, world!</h1>--}}
                {{--<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>--}}
                {{--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>--}}
            {{--</div>--}}
        {{--</div>--}}

        @yield('content')
    </main>
@show


<footer class="container">
    @yield('links')
    <p>&copy; Company 2017</p>
</footer>



</body>
</html>
