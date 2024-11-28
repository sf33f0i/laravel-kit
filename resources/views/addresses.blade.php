<?php

use Illuminate\Database\Eloquent\Collection;
use App\Helpers\PointHelper;

/**
 * @var Collection $addresses
 */
?>
@extends('layouts.main')

@section('title')
    Geocoder
@endsection

@section('content')
    <div class="content col-10">
        <form action="{{route('address.store')}}" method="POST">
            @csrf
            <div class="form-item form-group">
                <label for="address" class="form-label">Адрес</label>
                <input
                    value="{{ old('address') }}"
                    class="form-control"
                    name="address"
                    id="address"
                />
            </div>
            <x-flash-message></x-flash-message>
            <button class="btn btn-primary" type="submit">
                Отправить
            </button>
        </form>
        @if($addresses->count() !== 0)
            <div class="table-container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Адрес</th>
                        <th scope="col">Координаты</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($addresses as $address)
                        <tr>
                            <th scope="row">{{$address->id}}</th>
                            <td>{{$address->address}}</td>
                            <td>{{ PointHelper::geometryToPoint($address->position) }}</td>
                            <td>
                                <form method="POST" action="{{route('address.delete', $address->id)}}"
                                      accept-charset="UTF-8">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" title="Удалить"
                                            onclick="return confirm('Подтвердить удаление?')">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
