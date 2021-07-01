@extends('layouts.layout')

@section('title',Lang::get('titles.cartTitle'))
@section('content')
    <section id="cart">
        <div class="cart">
            <h2>{{Lang::get('titles.cartTitle')}}</h2>
            <div class="cart-form">
                <h3>Адрес доставки</h3>
                <div class="cart-form_up">
                    <input type="text" name="name" id="name" placeholder="Имя">
                    <input type="text" name="second-name" id="second-name" placeholder="Фамилия">
                </div>
                <div class="cart-form_foot">
                    <input type="text" name="street" id="street" placeholder="Улица доставки">
                    <input type="text" name="home" id="home" placeholder="Дом">
                    <input type="text" name="flat" id="flat" placeholder="Квартира">
                </div>
            </div>
            <div class="cart-items" id="cart-items">
                <h3>Ваши товары</h3>
                @if(isset($cartList))
                    @foreach($cartList as $itemCart)
                        <div class="cart-item" data-productId="{{$itemCart['id']}}">
                            <div class="main-cart-item">
                                <div class="img-cart">
                                    <a href="{{$itemCart['attributes']['url']}}"><img src="{{$itemCart['attributes']['img']}}" alt="product"></a>
                                </div>
                                <div class="text-cart">
                                    <h3><a href="{{$itemCart['attributes']['url']}}">{{$itemCart['name']}}</a></h3>
                                    <div class="prop_blocks">
                                        @foreach($itemCart['attributes']['properties'] as $key=>$value)
                                            <div class="prop_block">
                                            <h5>{{$key}}:</h5>
                                            <p>{{$value}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="count-block" data-countProductId="{{$itemCart['id']}}">
                                        <div class="minus" id="cart_minus"><span>&#8722;</span></div>
                                        <input class="count-itemcart" id="count_itemcart" type="number" min="1" value="{{$itemCart['quantity']}}">
                                        <div class="plus" id="cart_plus"><span>&#43;</span></div>
                                    </div>
                                    <p>{{$itemCart['price']}} <sub>руб.</sub></p>
                                </div>
                            </div>
                            <div class="del-cart">
                                <img src="/img/delCart.png" alt="del">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="send-form">
            <h2>Ваш заказ</h2>
            <div class="count-prod">
                <p>
                    Товары(<span id="count-prod">{{$cartQuantity}}</span>)
                </p>
                <p>
                    <span class="sup-price">{{$supPrice}}</span>
                    <sub>руб.</sub>
                </p>
            </div>
            <div class="res-price">
                <p>Итого</p>
                <p>
                    <span class="sup-price">{{$supPrice}}</span>
                    <sub>руб.</sub>
                </p>
            </div>

            <button type="submit" class="button button_cart" id="button_cart">
                {{ Lang::get('formsFields.order') }}
            </button>

        </div>
    </section>
@endsection
