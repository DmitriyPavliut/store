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
            }

        });
    });

    $('.count-itemcart').change(function () {
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
            }

        });
    });

    $('.minus').click(function () {
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
            }

        });
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
            }

        });
    });

    $('#button_cart').click(function () {

        event.preventDefault();

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
            }

        });
    });

});
