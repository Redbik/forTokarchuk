@extends('layouts.admin')

@section('content')
    {{--<div class="container">--}}
    <div class="container-fluid">
        <form class="form-horizontal" @if(Auth::user()->role == 'admin')action="{{ route('news.store') }}"@else action="{{ route('usernew.store') }}"@endif method="post" enctype="multipart/form-data">
            {{ csrf_field() }}


            {{--<div class="col-xs-4">--}}
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
                <input class="btn btn-primary" type="submit" value="Добавить новость">
            {{--</div>--}}
        </form>
    </div>
        {{--</div>--}}


            @forelse($errors->all() as $error)
                <ul class="list-group">
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                </ul>
            @empty
            @endforelse



@endsection