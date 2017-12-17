@extends('layouts.admin')

@section('content')
    {{--<div class="container">--}}
        {{--<a class="btn btn-warning btn-lg" href="{{ route('news.create')}}">Создать новость</a>--}}

    <button type="button" class="button" data-toggle="modal" data-target="#myModal">Создать новость</button>
    <br><br>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Создание новости</h4>
                </div>
                <form class="form-horizontal" @if(Auth::user()->role == 'admin')action="{{ route('news.store') }}"@else action="{{ route('usernew.store') }}"@endif method="post" enctype="multipart/form-data">
                <div class="modal-body">

                        {{ csrf_field() }}
                        <label for="namenew">Заголовок новоти</label>
                        <input type="text" class="form-control" id="ex2" name="namenew" value="{{ old('name') }}" placeholder="Заголовок новоти" required>
                        <select class="col-xs-20" name="categoris_id" required>
                            @forelse($categorii as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @empty
                                <p>Нет категорий</p>
                            @endforelse
                        </select>
                        <textarea class="form-control" rows="5" cols="50"  id="comment" name="shorttext" placeholder="Краткий текст" required></textarea>
                        <textarea class="form-control" rows="10" id="comment" name="fultext" placeholder="Полный текст" required></textarea>

                        <input type="file" name="file" required>
                        {{--<input class="btn btn-primary" type="submit" value="Добавить новость">--}}

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Добавить новость">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
                    @forelse($errors->all() as $error)
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        </ul>
                    @empty
                    @endforelse
                </form>
            </div>

        </div>
    </div>
    {{--</div>--}}

    {{--</br>--}}
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Опубликованные</a></li>
        <li><a data-toggle="tab" href="#menu1">Неопубликованные</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            @forelse($news as $novosti)
                @if($novosti->published == '1')
                <div class="panel panel-primary">
                    <div class="panel-heading">{{ $novosti->namenew }}</div>
                    <div class="panel-body">{{ $novosti->shorttext }}</div>



                    <form onsubmit="if(confirm('Удалить ?')){ return true}else{return false}" method="post" action="{{ route('news.destroy', $novosti) }}">
                        <input type="hidden" name="_method" value="delete">
                        <a class="btn btn-warning" href="{{ route('news.edit', $novosti) }}">Изменить</a>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>


                    {{--<button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" href="{{ route('news.edit', $novosti) }}">Изменить</button>--}}

                    <!-- Modal -->
                </div>
                @endif
                @empty
                <div class="panel panel-danger">
                    Новостей нет !!!
                </div>
            @endforelse

        </div>
        <div id="menu1" class="tab-pane fade">
                @forelse($news as $nov)
                @if($nov->published == '0')
                    <div class="panel panel-danger">
                        <div class="panel-heading">{{ $nov->namenew }}</div>
                        <div class="panel-body">{{ $nov->shorttext }}</div>
                        <form method="post" action="{{ route('news.update', ['id'=>$nov->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <button type="submit" class="btn btn-success" name="published">Опубликовать</button>
                        </form>

                        <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}" method="post" action="{{ route('news.destroy', ['id'=>$nov->id]) }}">
                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>

                    </div>
                @endif
                @empty
                <div class="panel panel-danger">
                    Новостей нет !!!
                </div>
                @endforelse
                    <!-- Modal -->


            {{--@forelse($publishe0 as $pub)--}}
                {{--<p>{{ $pub->namenew }}</p>--}}
            {{--@empty--}}
                {{--<p>Новостей нет !!!</p>--}}
            {{--@endforelse--}}
        </div>
    </div>

@endsection