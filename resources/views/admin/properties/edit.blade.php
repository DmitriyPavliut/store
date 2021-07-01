@extends('layouts.admin_layout')

@section('title', 'Редактирование категории')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование категории: {{ $property['name'] }}</h1>
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
    {{--{{dd($property)}}--}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('properties.update', $property['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$property['id']}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" value="{{ $property['name'] }}" name="title" class="form-control"
                                           id="exampleInputEmail1" placeholder="Введите название категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Значения свойства</label>
                                    <input type="hidden" name="value" id="value_properties" value="{{$property['valueList']}}">
                                    <div class="row" id="propertyBlock">
                                    @foreach ($property['values'] as $value)
                                            <div class="col-3">
                                                <input type="text" class="form-control elem_properties" value="{{$value['value']}}">
                                            </div>
                                    @endforeach
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
                                        <option @if (!isset($property['categories'])) selected @endif disabled value="NULL">Категория не выбрана</option>
                                        @foreach ($categories as $category)
                                            <option @if (in_array($category['id'],$property['categories'])) selected @endif value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
