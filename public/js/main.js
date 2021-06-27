$(document).ready(function () {
    $('.menu-burger__header').click(function () {
        $('.menu-burger__header').toggleClass('open-menu');
        $('.header__nav').toggleClass('open-menu');
    });


    $('#sortingSelect').change(function () {
        $.ajax({
            url: "/sort",
            type: "POST",
            data: {
                orderBy: $(this).val(),
                category: $('#catalog').attr('data-category'),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $('#catalog').html('');
                $('#catalog').html(data);
            }

        });
    });

    $('#button_basket').click(function (event) {

        event.preventDefault();

        $.ajax({
            url: "/addToCart",
            type: "POST",
            data: {
                id: $('#button_basket').attr('data-productId'),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {

                $('#cart-qty').text(parseInt($('#cart-qty').text()) + 1)
                throw_message('Товар добавлен в корзину', '#34b690')
            }

        });
    });

    $('.del-cart').click(function () {

        $.ajax({
            url: "/delFromCart",
            type: "POST",
            data: {
                id: $(this).parent().attr('data-productId'),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $(this).parent().remove();
                $('#cart-qty').text(data['count']);
                $('#count-prod').text(data['count']);
                $('.sup-price').text(data['allPrice']);
                throw_message('Товар успешно удален', '#34b690')
            }

        });
    });

    $('.count-itemcart').change(function () {
        if (this.value > 0) {
            $.ajax({
                url: "/editCart",
                type: "POST",
                data: {
                    id: $(this).parent().attr('data-countProductId'),
                    count: this.value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('#cart-qty').text(data['count']);
                    $('#count-prod').text(data['count']);
                    $('.sup-price').text(data['allPrice']);
                    throw_message('Количество товара изменено', '#34b690')
                }

            });
        } else {
            $.ajax({
                url: "/delFromCart",
                type: "POST",
                data: {
                    id: $(this).parent().attr('data-countProductId'),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.cart-item[data-productId="' + $(this).parent().attr('data-countProductId') + '"]').remove();
                    $('#cart-qty').text(data['count']);
                    $('#count-prod').text(data['count']);
                    $('.sup-price').text(data['allPrice']);
                    throw_message('Товар успешно удален', '#34b690')
                }

            });
        }
    });

    $('.minus').click(function () {
        if (parseInt($(this).next().val() - 1) > 0) {
            $.ajax({
                url: "/editCartButton",
                type: "POST",
                data: {
                    id: $(this).parent().attr('data-countProductId'),
                    count: -1
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $(this).next().val(parseInt($(this).next().val()) - 1);
                    $('#cart-qty').text(data['count']);
                    $('#count-prod').text(data['count']);
                    $('.sup-price').text(data['allPrice']);
                    throw_message('Количество товара изменено', '#34b690')
                }

            });
        } else {
            $.ajax({
                url: "/delFromCart",
                type: "POST",
                data: {
                    id: $(this).parent().attr('data-countProductId'),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.cart-item[data-productId="' + $(this).parent().attr('data-countProductId') + '"]').remove();
                    $('#cart-qty').text(data['count']);
                    $('#count-prod').text(data['count']);
                    $('.sup-price').text(data['allPrice']);
                    throw_message('Товар успешно удален', '#34b690')
                }

            });
        }

    });

    $('.plus').click(function () {
        $.ajax({
            url: "/editCartButton",
            type: "POST",
            data: {
                id: $(this).parent().attr('data-countProductId'),
                count: 1
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $(this).prev().val(parseInt($(this).prev().val()) + 1);
                $('#cart-qty').text(data['count']);
                $('#count-prod').text(data['count']);
                $('.sup-price').text(data['allPrice']);
                throw_message('Количество товара изменено', '#34b690')
            }

        });
    });

    $('#button_cart').click(function () {

        event.preventDefault();

        let alert = false;
        $('#name').val().length == 0 ? ($('#name').addClass('alertInput'), alert = true) : $('#name').removeClass('alertInput');
        $('#second-name').val().length == 0 ? ($('#second-name').addClass('alertInput'), alert = true) : $('#second-name').removeClass('alertInput');
        $('#street').val().length == 0 ? ($('#street').addClass('alertInput'), alert = true) : $('#street').removeClass('alertInput');
        $('#home').val().length == 0 ? ($('#home').addClass('alertInput'), alert = true) : $('#home').removeClass('alertInput');
        $('#flat').val().length == 0 ? ($('#flat').addClass('alertInput'), alert = true) : $('#flat').removeClass('alertInput');

        if (alert === true) throw_message('Введены неверные данные', 'red');
        if (alert === false && $('.sup-price').text() == 0) throw_message('Вы не выбрали товар', 'red');

        if (alert === false && $('.sup-price').text() != 0) {
            $.ajax({
                url: "/sendOrder",
                type: "POST",
                data: {
                    name: $('#name').val(),
                    secondName: $('#second-name').val(),
                    street: $('#street').val(),
                    home: $('#home').val(),
                    flat: $('#flat').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.cart-item').remove();
                    $('#cart-qty').text(0);
                    $('#count-prod').text(0);
                    $('.sup-price').text(0);
                    $('input').val('');
                    throw_message('Ваш заказ успешно оформлен', '#34b690')
                }

            });
        }
    });


    function throw_message(str, color = '#f9e5e6') {
        $('#error_message').html(str);
        $("#error_box").css("background", color);
        $("#error_box").fadeIn(500).delay(5000).fadeOut(500);
    }

})
;
