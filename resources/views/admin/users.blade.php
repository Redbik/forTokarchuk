@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                @forelse($users as $user)
                    <th>{{ $user->id }}</th>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>
                        <form onsubmit="if(confirm('Изменить?')){ return true}else{return false}" method="post" action="{{ route('users.update', ['id'=>$user->id]) }}">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}
                            <p><input type="radio" name="{{ $user->id }}" value="{{  $user->role  }}" checked >{{  $user->role  }}</p>
                            @if($user->role == 'admin')
                                <p><input type="radio" name="{{ $user->id }}" value="user">user</p>
                            @else
                                <p><input type="radio" name="{{ $user->id }}" value="admin">admin</p>
                            @endif
                    <th> <button type="submit" class="btn btn-success">Изменить</button></th>
                        </form>
                    </th>

                    <th>
                        <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}" method="post" action="{{ route('users.destroy', $user) }}">
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
                {{ $users->links() }}
            </ul>
        </td>
    </tr>

@endsection