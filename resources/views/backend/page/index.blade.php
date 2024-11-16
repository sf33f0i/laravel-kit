@extends('layouts.admin')

@section('title', 'Страницы')

@section('content_header')
    Страницы
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active">Страницы</li>
    </ol>
@endsection

@section('buttons')
    <a class="btn btn-success btn-sm float-sm-right" href="{{route('backend.page.create')}}">Создать страницу</a>
@endsection

@section('content')
    @if (session('alert'))
        <div class="alert alert-danger alert-dismissible" style="margin-bottom: 20px">
            {{ session('alert') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Псевдоним</th>
                        <th>Опубликовано</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{route('backend.page.edit', $item->id)}}">{{ $item->title }}</a></td>
                            <td>{{ $item->alias }}</td>
                            <td>{{ $item->active ? 'Да' : 'Нет' }}</td>
                            <td class="action-buttons">
                                <a href="{{route('backend.page.edit', $item->id)}}" class="btn btn-primary btn-sm"
                                   title="Отредактировать страницу">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <form method="POST" action="{{ url('page' . '/' . $item->id)}}" accept-charset="UTF-8"
                                      style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Удалить страницу"
                                            onclick="return confirm('Удалить страницу?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $pages->onEachSide(10)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
