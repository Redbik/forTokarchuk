@extends('layouts.admin')

@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{ route('category.store') }}" method="post">
            {{ csrf_field() }}


            <div class="col-xs-3">
                <label for="name">Наименование категории</label>
                <input type="text" class="form-control" id="ex2" name="name" value="{{ old('name') }}" placeholder="Наименование категории" required>
                <input class="btn btn-primary" type="submit" value="Добавить">
            </div>
            @forelse($errors->all() as $error)
                <ul class="list-group">
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                </ul>
            @empty
            @endforelse

        </form>
    </div>
@endsection
