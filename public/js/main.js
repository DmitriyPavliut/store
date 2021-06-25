$(document).ready(function () {
    $('.menu-burger__header').click(function () {
        $('.menu-burger__header').toggleClass('open-menu');
        $('.header__nav').toggleClass('open-menu');
    });


    $('#sortingSelect').change(function () {
        $.ajax({
            url: "/sort",
            type: "GET",
            data: {
                orderBy: $(this).val(),
                category:$('#catalog').attr('data-category'),
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
});
