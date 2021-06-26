@extends('layouts.layout')

@section('title',Lang::get('titles.catalogTitle'))
@section('content')
    {{dd($catarr)}}

    <section id="catalog_list">
        <div class="container catalog_list">
            <h2>{{Lang::get('titles.catalogTitle')}}</h2>
            <div class="catalog_block">
                <div class="filter-list">
                    <div class="sorting">
                        <div class="item_sorting">
                            <label for="sortingSelect">Сортировать по:</label>
                            <select class="" id="sortingSelect" name="sorting">
                                <option class="product_sorting_btn" value="default">По умолчанию</option>
                                <option class="product_sorting_btn" value="price-low-high">Цена: &#8593;</option>
                                <option class="product_sorting_btn" value="price-high-low">Цена: &#8595;</option>
                                <option class="product_sorting_btn" value="name-a-z">Название: А-Я</option>
                                <option class="product_sorting_btn" value="name-z-a">Название: Я-А</option>
                            </select>

                        </div>
                    </div>
                    <h3>Бренд одежды</h3>
                    <label class="filter_checkbox">
                        <input class="" type="checkbox" name="remember" id="remember">
                        <span></span>
                        {{ Lang::get('formsFields.remember') }}
                    </label>
                    <label class="filter_checkbox">
                        <input class="" type="checkbox" name="remember" id="remember">
                        <span></span>
                        {{ Lang::get('formsFields.remember') }}
                    </label>
                    <label class="filter_checkbox">
                        <input class="" type="checkbox" name="remember" id="remember" }>
                        <span></span>
                        {{ Lang::get('formsFields.remember') }}
                    </label>
                    <label class="filter_checkbox">
                        <input class="" type="checkbox" name="remember" id="remember">
                        <span></span>
                        {{ Lang::get('formsFields.remember') }}
                    </label>

                </div>
                <div class="catalog_wrap">
                    <div class="catalog" id="catalog" @if(isset($cat)) data-category="{{$cat->titleID}}" @endif>

                        @foreach ($products as $product)
                            @php
                                $image = '';
                                if(count($product->images) > 0){
                                    $image = $product->images[0]['img'];
                                } else {
                                    $image = 'img/no_image.png';
                                }
                            @endphp


                            <div class="catalog-item">
                                <div class="image_catalog-item">
                                    <a href="/catalog/{{$product->category['titleID']}}/{{$product['titleID']}}_{{$product['id']}}"><img src="/{{$image}}" alt="item"></a>
                                </div>
                                <h3>
                                    <a href="/catalog/{{$product['titleID']}}_{{$product['id']}}">{{$product['title']}}</a>
                                </h3>
                                <p class="price-collection">{{$product['price']}}
                                    <sub class="currency-collection">руб.</sub></p>
                            </div>

                        @endforeach
                    </div>
                    {{$products->appends(request()->query())->links('pagination.index')}}
                </div>
            </div>
        </div>
    </section>
@endsection

