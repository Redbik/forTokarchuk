@extends('layouts.layout')

@section('content')
    {{--@forelse($novos as $novosti)--}}

        {{--<p>{{ $nov->id }}</p>--}}
    {{--@empty--}}
    {{--@endforelse--}}
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">{{ $novos->namenew }}  <span class="label label-default">Дата публикации: {{ $novos->updated_at }}</span></div>
            <div class="panel-body">
                <img src="{{ asset('image/'.$novos->foto) }}" class="img-responsive" width="30%" alt="Image">
                <br>
                {{ $novos->shorttext }}
                <br><br>
                {{ $novos->fultext }}
            </div>
        </div>
    </div>
@endsection