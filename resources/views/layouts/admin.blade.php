<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

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

                        @endif
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
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Вход</a></li>
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
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Панель администратора, {{ Auth::user()->name }}</h1>
                <p>Админка или панель администратора – потайная дверь на сайт, черный ход, показывающий вам его с другой стороны. Не так, как видят его люди, обычно – упрощеннее, например, в админке все страницы обычно выводятся одним или несколькими длиннющими списками. Короче, место, где можно править тексты, создавать страницы, размещать картинки и прочие медиа.</p>
                {{--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>--}}
            </div>
        </div>

        @if(Auth::user()->role == 'admin')
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-6 col-md-2 sidebar-offcanvas" id="sidebar">
                <div class="list-group">
                    <a href="{{ route('news.index') }}" class="list-group-item">Новости<span class="badge"></span></a>
                    <a href="{{ route('category.index') }}" class="list-group-item">Категории<span class="badge"></span></a>
                    <a href="{{ route('users.index') }}" class="list-group-item">Пользователи<span class="badge"></span></a>
                </div>
            </div><!--/span-->
            @endif
            <div class="col-12 col-md-9">
                <p class="float-right d-md-none">
                    {{--<button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>--}}
                </p>

                <div class="row">
                    <div class="input-group">
                        @yield('content')

                    </div>
                </div><!--/row-->
            </div><!--/span-->


        </div><!--/row-->
    </main>
@show



<footer class="container">
    @yield('links')
    <p>&copy; Company 2017</p>
</footer>



</body>
</html>
