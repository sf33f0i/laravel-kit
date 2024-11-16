@extends('layouts.admin')

@section('title', 'Изменить пользователя #{{ $user->name }}')

@section('content_header')
    <h1>Изменить пользователя: {{ $user->name }}</h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active"><a href="{{route('backend.user.index')}}">Пользователи</a></li>
        <li class="breadcrumb-item active">Редактировать</li>
    </ol>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('backend.user.index') }}" title="Назад">
                <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                </button>
            </a>
            <br/>
            <br/>

            <form method="POST" action="{{ route('backend.user.update', ['user' => $user->id]) }}"
                  accept-charset="UTF-8" class="form-horizontal">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                @include ('backend.user.form')

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Обновить">
                </div>
            </form>

        </div>
    </div>
@endsection
