@extends('layouts.layout')

@section('title',Lang::get('titles.mainTitle'))
@section('content')
    <section id="slider">
    <div class="slider">
        <div class="slider-content-text">
            <h2>можно придумать какой-нибудь заголовок</h2>
        </div>
    </div>
</section>

<section id="title_section">
    <div class="title_section">
        <div class="container title_section-text">
            <p>Часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице
                начала XVI века. В то время некий безымянный печатник </p>
        </div>
    </div>
</section>

<section id="about">
    <div class="container about_section">
        <div class="head_block_about">
            <div class="text_block_about">
                <h2>О нас</h2>
                <p>Часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице
                    начала XVI века.
                    В то время некий безымянный печатник Часто используемый в печати и вэб-дизайне. Lorem Ipsum является.</p>
                <p>Часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице
                    начала XVI века.
                    В то время некий безымянный печатник Часто используемый в печати и вэб-дизайне. Lorem Ipsum является.</p>

            </div>
            <div class="img_block_about">
                <img src="/img/photo_2021-03-01_12-42-51.png" alt="about">
            </div>

        </div>
        <div class="foot_block_about">
            <div class="img_block_about">
                <img src="/img/photo_2021-03-01_12-42-43(2).png" alt="about">
            </div>
            <div class="text_block_about">
                <h2>О нас</h2>
                <p>Часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице
                    начала XVI века.
                    В то время некий безымянный печатник Часто используемый в печати и вэб-дизайне. Lorem Ipsum является.</p>
                <p>Часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице
                    начала XVI века.
                    В то время некий безымянный печатник Часто используемый в печати и вэб-дизайне. Lorem Ipsum является.</p>

            </div>

        </div>

    </div>
</section>

<section id="catalog">
    <div class="container catalog">
        <div class="text-block-catalog">
            <h2>БОЛЬШЕ ТОВАРОВ В НАШЕМ КАТАЛОГЕ</h2>
            <p>Часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице
                начала XVI века. В то время некий безымянный печатник Часто используемый в печати и вэб-дизайне. Lorem Ipsum
                является.</p>
            <a class="slider-button button" href="{{ route('catalog') }}">Узнать больше</a>
        </div>
        <div class="img-block-catalog">
            <img src="/img/elean62862.png" alt="about">
        </div>

    </div>
</section>

<section id="collection">
    <div class="container collection">
        <h2>КОЛЛЕКЦИИ</h2>
        <div class="carousel shadow">
            <div class="carousel-button-left"><a href="#"></a></div>
            <div class="carousel-button-right"><a href="#"></a></div>
            <div class="carousel-wrapper">
                <div class="carousel-items">
                    @foreach($products as $product)
                        @php
                            $image = '';
                            if(count($product['images']) > 0){
                                $image =$product['images'][0]['img'];
                            } else {
                                $image = 'img/no_image.png';
                            }
                        @endphp
                        <div class="carousel-block collection-item">
                            <img src="{{$image}}" alt="" />
                            <h3>{{$product['title']}}</h3>
                            <p class="price-collection">{{$product['price']}}<sub class="currency-collection">руб.</sub></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{--<div class="collection-list">
            <div class="collection-item">
                <img src="/img/colItem.png" alt="item">
                <h3>Свитер махровый</h3>
                <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
            </div>
            <div class="collection-item">
                <img src="/img/colItem.png" alt="item">
                <h3>Свитер махровый</h3>
                <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
            </div>
            <div class="collection-item">
                <img src="/img/colItem.png" alt="item">
                <h3>Свитер махровый</h3>
                <p class="price-collection">2550,00<sub class="currency-collection">руб.</sub></p>
            </div>

        </div>--}}
    </div>
</section>

@endsection
