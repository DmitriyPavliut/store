<header class="header">
    <div class="header__container">
        <div class="menu_burger">
            <div class="menu-burger__header">
                <span></span>
                <p class="menu-burger_text">Меню</p>
            </div>

            <nav class="header__nav">
                <ul class="menu header__menu">
                    <li><a href="{{ route('main') }}" class="menu__item">Главная</a></li>
                    <li><a href="/catalog/muzskoe" class="menu__item">Мужское</a></li>
                    <li><a href="/catalog/zenskoe" class="menu__item">Женское</a></li>
                </ul>
            </nav>
        </div>
        <div class="header__content">
            <div class="header__content_nav">
                <a href="/catalog/muzskoe" class="content-menu__item">Мужское</a>
                <a href="/catalog/zenskoe" class="content-menu__item">Женское</a>
            </div>
            <div class="logo">
                <a href="{{ route('main') }}"><img src="/img/logo.png" alt="logo"></a>
            </div>
            <div class="header_cart_container">
                <div class="header_cart">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/admin') }}" class="menu-link cart"><img src="/img/user.png" alt="cart-icon"><span class="menu-link_name">{{ Auth::user()->name }}</span></a>
                        @else
                            <a href="{{ route('login') }}" class="menu-link cart"><img src="/img/user.png" alt="cart-icon"></a>
                        @endauth
                    @endif
                </div>
               {{-- <div class="header_cart">
                    <a href="{{ route('cart') }}" class="menu-link basket_head cart"><img src="/img/basket.png" alt="cart-icon"><span id="cart-qty">{{isset($cartQuantity)?$cartQuantity:'0'}}</span></a>
                </div>--}}
            </div>
        </div>
    </div>
</header>
<div id='error_box'>
    <p id='error_message'></p>
</div>

