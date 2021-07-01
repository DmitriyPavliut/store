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

        let error=false;
        $('.properties_block_values').map(function () {
            if($(this).attr('data-value')==null){
                error=true;
            }
        });

        if(error==false) {
            let arrayProperties = Array.from($('.properties_block_values').map(function () {
                return $(this).attr('data-value')
            }));
            $.ajax({
                url: "/addToCart",
                type: "POST",
                data: {
                    id: $('#button_basket').attr('data-productId'),
                    count: $('#prod_count').val(),
                    properties: arrayProperties,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {

                    $('#cart-qty').text(parseInt($('#cart-qty').text()) + parseInt($('#prod_count').val()));
                    $('#prod_count').val(1);
                    $('.item_value_active').css({'background-color': '', 'color': 'black'});

                    throw_message('Товар добавлен в корзину', '#34b690');
                }

            });
        }
        else {
            throw_message('Выберите свойства товара', 'red');
        }
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

        let value = this.value > 0 ? this.value : 1;
        $.ajax({
            url: "/editCart",
            type: "POST",
            data: {
                id: $(this).parent().attr('data-countProductId'),
                count: value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $('#cart-qty').text(data['count']);
                $('#count-prod').text(data['count']);
                $('#count_itemcart').val(value);
                $('.sup-price').text(data['allPrice']);
                throw_message('Количество товара изменено', '#34b690')
            }

        });
    });

    $('.cart_minus').click(function () {
        let value = parseInt($(this).next().val() - 1) > 0 ? -1 : 0;
        if (value != 0) {
            $.ajax({
                url: "/editCartButton",
                type: "POST",
                data: {
                    id: $(this).parent().attr('data-countProductId'),
                    count: value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $(this).next().val(parseInt($(this).next().val()) + value);
                    $('#cart-qty').text(data['count']);
                    $('#count-prod').text(data['count']);
                    $('.sup-price').text(data['allPrice']);
                    throw_message('Количество товара изменено', '#34b690')
                }

            });
        } else {
            $(this).next().val(parseInt($(this).next().val()) + value);
        }
    });

    $('.cart_plus').click(function () {
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
        if (alert === false && $('.sup-price').text() == 0) {
            throw_message('Вы не выбрали товар', 'red');
        }

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

    $('#prod_minus').click(function () {
        if (parseInt($('#prod_count').val()) - 1 > 0) {
            $('#prod_count').val(parseInt($('#prod_count').val()) - 1);
        } else {
            $('#prod_count').val(1);
        }

    });

    $('#prod_plus').click(function () {
        $('#prod_count').val(parseInt($('#prod_count').val()) + 1);
    });

    $('#prod_count').change(function () {
        if (parseInt($('#prod_count').val()) < 1) {
            $('#prod_count').val(1);
        }
    });

    $('.item_value_active').click(function () {
        $(this).parent().children().css({'background-color': '', 'color': 'black'});
        $(this).css({'background-color': '#FF8A00', 'color': 'white'});
        $(this).parent().attr('data-value', $(this).attr('data-id'));
    });


    function throw_message(str, color = '#f9e5e6') {
        $('#error_message').html(str);
        $("#error_box").css("background", color);
        $("#error_box").fadeIn(500).delay(4000).fadeOut(500);
    }

    $().UItoTop({easingType: 'easeOutQuart'});

});

//Обработка клика на стрелку вправо
$(document).on('click', ".carousel-button-right",function(){
    var carusel = $(this).parents('.carousel');
    right_carusel(carusel);
    return false;
});
//Обработка клика на стрелку влево
$(document).on('click',".carousel-button-left",function(){
    var carusel = $(this).parents('.carousel');
    left_carusel(carusel);
    return false;
});
function left_carusel(carusel){
    var block_width = $(carusel).find('.carousel-block').outerWidth();
    $(carusel).find(".carousel-items .carousel-block").eq(-1).clone().prependTo($(carusel).find(".carousel-items"));
    $(carusel).find(".carousel-items").css({"left":"-"+block_width+"px"});
    $(carusel).find(".carousel-items .carousel-block").eq(-1).remove();
    $(carusel).find(".carousel-items").animate({left: "0px"}, 200);

}
function right_carusel(carusel){
    var block_width = $(carusel).find('.carousel-block').outerWidth();
    $(carusel).find(".carousel-items").animate({left: "-"+ block_width +"px"}, 200, function(){
        $(carusel).find(".carousel-items .carousel-block").eq(0).clone().appendTo($(carusel).find(".carousel-items"));
        $(carusel).find(".carousel-items .carousel-block").eq(0).remove();
        $(carusel).find(".carousel-items").css({"left":"0px"});
    });
}

$(function() {
//Раскомментируйте строку ниже, чтобы включить автоматическую прокрутку карусели
    //auto_right('.carousel:first');
})

// Автоматическая прокрутка
function auto_right(carusel){
    setInterval(function(){
        if (!$(carusel).is('.hover'))
            right_carusel(carusel);
    }, 3000)
}
// Навели курсор на карусель
$(document).on('mouseenter', '.carousel', function(){$(this).addClass('hover')})
//Убрали курсор с карусели
$(document).on('mouseleave', '.carousel', function(){$(this).removeClass('hover')})
