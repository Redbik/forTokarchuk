@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
        @forelse($news as $new)
            <div class="col-sm-12">
            <div class="panel panel-info">

                <div class="panel-heading">
                    <p><strong>Название новости: </strong>{{ $new->namenew }} </p>
                    <strong>Категория новости: </strong>{{$new->categories->name}}
                    <span id="sp" class="label label-info">Дата публикации: {{ $new->updated_at }}</span>
                </div>
                <div class="panel-body">

                    <div class="col-sm-9">
                        <img src="{{ asset('image/'.$new->foto) }}" align="left" alt="{{ $new->namenew }}" width="30%" >

                        <div >{{ $new->shorttext }}</div>

                    </div>
                    <h3>Добавил: <span class="label label-default">{{ $new->AddUser }}</span></h3>
                    <hr>
                    <a class="button" href="{{ route('novosti.show', $new) }}"><span>Подробнее</span></a>
                </div>

            </div>
            </div>
        @empty
        @endforelse
        </div>
    </div>


@endsection

@section('links')
    <tr>
        <td colspan="3">
            <ul class="pagination">
                {{ $news->links() }}
            </ul>
        </td>
    </tr>

@endsection
