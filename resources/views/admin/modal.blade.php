@extends('layouts.admin')

@section('content')
    <form class="form-horizontal" action="{{ route('news.update',['id'=>$news]) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <label for="namenew">Заголовок новоти</label>
        <input type="text" class="form-control" id="ex2" name="namenew" value="{{ $news->namenew }}" placeholder="Заголовок новоти" required>
        <select class="col-xs-20" name="categoris_id" required>
            @forelse($categorii as $cat)
                @if(($news->categoris_id != null) and ($news->categories->name == $cat->name))
                    <option value="{{ $cat->id }}"  selected >{{ $cat->name }} (Выбранная категория)</option>
                @else
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endif
            @empty
                <p>Нет категорий</p>
            @endforelse
        </select>
        <textarea class="form-control" rows="5" cols="50"  id="comment" name="shorttext" placeholder="Краткий текст" required>{{ $news->shorttext }}</textarea>
        <textarea class="form-control" rows="10" id="comment" name="fultext" placeholder="Полный текст" required>{{ $news->fultext }}</textarea>
        <div class="panel-body"><img src="{{ asset('image/'.$news->foto) }}" class="img-responsive" style="width:100%" alt="Image"></div>
        <input type="file" name="file" value="{{ asset('image/'.$news->foto) }}" >
        <input class="btn btn-primary" type="submit" value="Изменить новость">
    </form>


    @forelse($errors->all() as $error)
        <ul class="list-group">
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
        </ul>
    @empty
    @endforelse



@endsection