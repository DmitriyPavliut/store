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

                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>
                    <div class="catalog-item">
                        <div class="image_catalog-item">
                            <a href=""><img src="/img/no_image.png" alt="item"></a>
                        </div>
                        <h3><a href=""> Свитер махровый</a></h3>
                        <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
