@extends('layouts.admin_layout')

@section('title','Главная')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Главная</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$productsCount}}</h3>

                            <p>Товары</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <a href="{{ route('product.index') }}" class="small-box-footer">More info
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$usersCount}}</h3>

                            <p>Пользователи</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"> </i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">More info
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Список заказов</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>
                                ID заказа
                            </th>
                            <th>
                                ФИО покупателя
                            </th>
                            <th>
                                Адрес
                            </th>
                            <th>
                                Дата заказа
                            </th>
                            <th>
                                Товары
                            </th>
                            <th>
                                Сумма заказа
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($carts as $cart)

                            <tr>
                                <td>
                                    {{ $cart['id'] }}
                                </td>
                                <td>
                                    {{ $cart['secondName'].' '.$cart['name'] }}
                                </td>
                                <td>
                                    {{ $cart['street'].', дом'.$cart['home'].', кв.'.$cart['flat'] }}
                                </td>
                                <td>
                                    {{ $cart['created_at'] }}
                                </td>

                                <td>
                                    <table>
                                        <tr>
                                            @foreach($cart['orders'] as $item)
                                                <td>{{$item['prod']['title']}}</td>
                                                <td> {{$item['properties']}}</td>
                                                <td>{{$item['count']}}шт.</td>
                                                </br>
                                        </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td>
                                    {{ $cart['fullPrice'] }}руб.
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
@endsection
