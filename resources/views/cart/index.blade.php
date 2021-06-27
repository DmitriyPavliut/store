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
                @if(isset($_COOKIE['cart_id']))
                    @foreach(\Cart::session($_COOKIE['cart_id'])->getContent()->toArray() as $itemCart)
                        <div class="cart-item" data-productId="{{$itemCart['id']}}">
                            <div class="main-cart-item">
                                <div class="img-cart">
                                    <img src="{{$itemCart['attributes']['img']}}" alt="product">
                                </div>
                                <div class="text-cart">
                                    <h3>{{$itemCart['name']}}</h3>
                                    <div class="count-block" data-countProductId="{{$itemCart['id']}}">
                                        <div class="minus"><span>&#8722;</span></div>
                                        <input class="count-itemcart" type="number" min="1" value="{{$itemCart['quantity']}}">
                                        <div class="plus"><span>&#43;</span></div>
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
                    Товары(<span id="count-prod">{{isset($_COOKIE['cart_id']) ? \Cart::session($_COOKIE['cart_id'])->getTotalQuantity() : '0'}}</span>)
                </p>
                <p><span class="sup-price">{{isset($_COOKIE['cart_id']) ?\Cart::session($_COOKIE['cart_id'])->getSubTotal():"0"}}</span> <sub>руб.</sub>
                </p>
            </div>
            <div class="res-price">
                <p>Итого</p>
                <p><span class="sup-price">{{isset($_COOKIE['cart_id']) ?\Cart::session($_COOKIE['cart_id'])->getSubTotal():'0'}}</span> <sub>руб.</sub>
                </p>
            </div>

            <button type="submit" class="button button_cart" id="button_cart">
                {{ Lang::get('formsFields.order') }}
            </button>

        </div>
    </section>
@endsection
