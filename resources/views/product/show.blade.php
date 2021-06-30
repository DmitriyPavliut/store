@extends('layouts.layout')

@section('title',$item['title'])
@section('content')
    <section id="product_item">
        <div class="product_item_section">
            <div class="product_item">
                <h2>{{$item['title']}}</h2>
                <p class="price-collection">{{$item['price']}}<sub class="currency-collection"> руб.</sub></p>

                <p class="description">{!!html_entity_decode(htmlentities($item['description']))!!}</p>
                <div class="button_basket_block">
                    <button type="submit" class="button button_basket" id="button_basket" data-productId="{{$item['id']}}">
                        {{ Lang::get('formsFields.in_basket') }}
                    </button>
                    <div class="count-block" data-countProductId="{{$item['id']}}">
                        <div class="minus" id="prod_minus"><span>&#8722;</span></div>
                        <input class="count-itemcart" id="prod_count" type="number" min="1" value="1">
                        <div class="plus" id="prod_plus"><span>&#43;</span></div>
                    </div>
                </div>
            </div>
            <div class="product_img">
                @php
                    $image = '';
                    if(count($item['images']) > 0){
                        $image =$item['images'][0]['img'];
                    } else {
                        $image = 'img/no_image.png';
                    }
                @endphp
                <img src="/{{$image}}" alt="about">
            </div>
        </div>
    </section>

@endsection
