@extends('layouts.admin_layout')

@section('title', 'Редактировать товар')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать товар: {{ $product['title'] }}</h1>
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
                        <form action="{{ route('product.update', $product['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" value="{{ $product['title'] }}" name="title" class="form-control"
                                           id="exampleInputEmail1" placeholder="Введите название статьи" required>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите категорию</label>
                                        <select name="cat_id" class="form-control" required id="category_product">
                                            <option selected disabled value="NULL">Категория не выбрана</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}" @if ($category['id'] == $product['category_id']) selected
                                                    @endif>{{ $category['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="properties_grop">
                                    <div><label>Свойства товара:</label></div>
                                    @foreach($properties as $property)
                                        <div class="item_prop"><label>{{$property['name']}}</label>
                                            <select name="property_{{$property['id']}}[]'" class="form-control" required multiple>
                                                <option selected disabled value="NULL">Свойство не выбрано</option>

                                                @foreach($property['values'] as $value) {
                                                <option @if(in_array($value['id'], $product['properties'])) selected @endif value='{{$value['id']}}'>{{$value['value']}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <textarea id="textarea" name="description" placeholder="Введите описание товара">{{ $product['description'] }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Цена</label>
                                    <input type="number" step="0.01" name="price" class="form-control" id="exampleInputEmail1"
                                           placeholder="Введите Цену товара" required value="{{ $product['price'] }}">
                                </div>


                                <div class="form-group">
                                    <label for="feature_image">Изображение статьи</label>
                                    @php
                                        $image = '';
                                        if(count($product['images']) > 0){
                                            $image =$product['images'][0]['img'];
                                        }
                                    @endphp
                                    <img src="/{{ $image }}" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <input type="text" value="{{ $image}}" name="img" class="form-control"
                                           id="feature_image" name="feature_image" value="" readonly>
                                    <a href="" class="popup_selector" data-inputid="feature_image">Выбрать
                                        изображение</a>
                                </div>
                                <div class="form-group">
                                    <label>Товар активен</label>
                                    <select name="active" class="form-control" required>
                                        <option @if ($product['status'] == 1) selected
                                                @endif value="1">Активен
                                        </option>
                                        <option @if ($product['status'] != 1) selected
                                                @endif value="">Не активен
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
