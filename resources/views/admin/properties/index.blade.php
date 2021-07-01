@extends('layouts.admin_layout')

@section('title', 'Все свойства')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Свойства товара</h1>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('properties.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название свойства</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                           placeholder="Введите название свойства" required>
                                </div>

                                <!-- /.card-body -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Значения свойства</label>
                                    <input type="hidden" name="value" id="value_properties" value="">
                                    <div class="row" id="propertyBlock">
                                        <div class="col-3">
                                            <input type="text" class="form-control elem_properties">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control elem_properties">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control elem_properties">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="btn-group" style="width: 15%" id="addPropertyBlock">
                      <span class="btn btn-success col fileinput-button dz-clickable">
                        <i class="fas fa-plus"></i>
                        <span>Добавить значение</span>
                      </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Категории свойства</label>
                                    <select class="custom-select rounded-0" multiple="multiple" id="exampleSelectRounded0" name="category_id[]">
                                        <option selected disabled value="NULL">Категория не выбрана</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все свойства</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
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
                            <th style="width: 5%">
                                ID
                            </th>
                            <th>
                                Название
                            </th>
                            <th>
                                Изменено
                            </th>
                            <th>
                                Относится к категории
                            </th>
                            <th>
                                Значения
                            </th>
                            <th style="width: 30%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($properties as $property)
                            <tr>
                                <td>
                                    {{ $property['id'] }}
                                </td>
                                <td>
                                    {{ $property['name'] }}
                                </td>
                                <td>
                                    {{ $property['updated_at'] }}
                                </td>
                                <td>
                                    @foreach($property['categories'] as $propCategory)
                                    {{$propCategory['title']}}
                                    </br>
                                    @endforeach

                                </td>
                                <td>
                                    @foreach($property['values'] as $value)
                                    {{$value['value']}},
                                    @endforeach

                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="properties/edite/{{$property['id']}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <a class="btn btn-danger btn-sm delete-btn" href="properties/delete/{{$property['id']}}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Удалить
                                    </a>
{{--                                    <form action="{{ route('properties.destroy', $property['id']) }}" method="POST"--}}
{{--                                          style="display: inline-block">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">--}}
{{--                                            <i class="fas fa-trash">--}}
{{--                                            </i>--}}
{{--                                            Удалить--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
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
@endsection
