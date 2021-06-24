@extends('layouts.layout')

@section('title',Lang::get('titles.catalogTitle'))
@section('content')
    <section id="catalog_list">
        <div class="container catalog_list">
            <h2>{{Lang::get('titles.catalogTitle')}}</h2>
            <div class="catalog_block">
                <div class="filter-list">
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

                <div class="catalog">
                    @foreach ($products as $product)

                        <div class="catalog-item">
                            <div class="image_catalog-item">
                                <a href="/catalog/{{$product['titleID']}}_{{$product['id']}}"><img src="/{{$product->images[0]['img']}}" alt="item"></a>
                            </div>
                            <h3><a href="/catalog/{{$product['titleID']}}_{{$product['id']}}">{{$product['title']}}</a></h3>
                            <p class="price-collection">{{$product['price']}}<sub class="currency-collection">руб.</sub></p>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
