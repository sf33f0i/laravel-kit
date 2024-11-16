@extends('layouts.admin')

@section('title', 'Административная панель')

@section('content_header')
    <h1>Административная панель</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$diskTotalSpace}}</h3>
                    <p>Объем диска</p>
                </div>
                <div class="icon">
                    <i class="ion ion-disc"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$diskFreeSpace}}</h3>
                    <p>Свободное место на диске</p>
                </div>
                <div class="icon">
                    <i class="ion ion-disc"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$countUser}}</h3>
                    <p>Пользователей</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('backend.user.index')}}" class="small-box-footer">Подробней <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>OPcache</h3>
                    <p>{{$opcacheStatus}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-arrow-graph-up-left"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box btn-primary">
                <div class="inner">
                    <h3>{{$memTotal}}</h3>
                    <p>Оперативная память</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cloud"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box badge-secondary">
                <div class="inner">
                    <h3>{{$memAvailable}}</h3>
                    <p>Доступно оперативной памяти</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cloud"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box" style="background: rgb(245, 105, 84); color:white;">
                <div class="inner">
                    <h3>{{$time}}</h3>
                    <p>Системное время</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box" style="background: #adb5bd; color:white;">
                <div class="inner">
                    <h3>
                        @foreach($loadAverage as $item)
                            {{round($item, 2)}}
                        @endforeach
                    </h3>
                    <p>Средняя нагрузка</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <span class="small-box-footer"><i class="fas fa-info"></i></span>
            </div>
        </div>
    </div>

@stop


