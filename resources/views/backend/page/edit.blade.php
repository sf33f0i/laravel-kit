@extends('layouts.admin')

@section('title')
    Изменить страницу {{ $page->title }}
@endsection

@section('content_header')
    <h1>Изменить страницу {{ $page->title }}</h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active"><a href="{{route('backend.page.index')}}">Страницы</a></li>
        <li class="breadcrumb-item active">Редактировать</li>
    </ol>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('backend.page.update', $page) }}"
                  accept-charset="UTF-8" class="form-horizontal">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                @include ('backend.page.form')

                <div class="form-group">
                    <a href="{{ route('backend.page.index') }}" title="Отмена" class="btn btn-warning">
                        Отмена
                    </a>
                    <input class="btn btn-success" type="submit" value="Обновить">
                </div>
            </form>

        </div>
    </div>
@endsection
