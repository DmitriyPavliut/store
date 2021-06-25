@extends('layouts.layout')

@section('title',$item->title)
@section('content')
    <section id="product_item">
        <div class="product_item_section">
            <div class="product_item">
                <h2>{{$item['title']}}</h2>
                <p class="price-collection">{{$item['price']}}<sub class="currency-collection"> руб.</sub></p>

                <p class="description">{{$item['description']}}</p>

                <button type="submit" class="button button_basket">
                    {{ Lang::get('formsFields.in_basket') }}
                </button>
            </div>
            <div class="product_img">
                @php
                    $image = '';
                    if(count($item->images) > 0){
                        $image = $item->images[0]['img'];
                    } else {
                        $image = 'img/no_image.png';
                    }
                @endphp
                <img src="/{{$image}}" alt="about">
            </div>
        </div>
    </section>
{{--{{dd($item)}}--}}

@endsection
