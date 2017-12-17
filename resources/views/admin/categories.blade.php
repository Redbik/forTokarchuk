@extends('layouts.admin')

@section('content')





        <div class="container">
            {{--<a class="btn btn-warning btn-lg" href="{{ route('category.create')}}">Создать категорию</a>--}}

            <button type="button" class="button" data-toggle="modal" data-target="#myModal">Создать категорию</button>
            <br><br>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Создание категории</h4>
                        </div>
                        <form class="form-horizontal" action="{{ route('category.store') }}" method="post">
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <label for="name">Наименование категории</label>
                                <input type="text" class="form-control" id="ex2" name="name" value="{{ old('name') }}" placeholder="Наименование категории" required>
                                {{--<input class="btn btn-primary" type="submit" value="Добавить новость">--}}

                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-primary" type="submit" value="Добавить категорию">
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

            <table class="table">
                <thead>
                <tr>
                    @forelse($categories as $cat)
                    <th>{{ $cat->id }}</th>
                    <th>{{ $cat->name }}</th>

                        <th><a class="btn btn-success" href="{{ route('category.edit', $cat) }}">Изменить</a></th>
                    {{--<th><a href="{{ route('category.edit', ['id' => $categorie->id]) }}">Изменить</a></th>--}}
                        <th>
                            {{--<a class="btn btn-danger" href="{{ route('category.destroy', ['id' => $category->id]) }}">Удалить</a>--}}
                            <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}" method="post" action="{{ route('category.destroy', $cat) }}">
                                <input type="hidden" name="_method" value="delete">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </th>
                </tr>
                     @empty
                    <tr>
                        <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                    </tr>
                @endforelse
                </thead>
            </table>
        </div>



@endsection


@section('links')
    <tr>
        <td colspan="3">
            <ul class="pagination">
               {{ $categories->links() }}
            </ul>
        </td>
    </tr>

@endsection