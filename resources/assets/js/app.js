import jquery from 'jquery';

window.$ = window.jQuery = jquery;
require('bootstrap');
require('slick-carousel');
require('jquery-nice-select');
require('jquery-ui/ui/widgets/slider');
require('owl.carousel');
require('jssor-slider');
import mediumZoom from "medium-zoom";


$(document).ready(function () {

    // owl carousel
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        nav: true,
        navText: ["<span></span>", "<span></span>"],
        margin: 50,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            425: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            768: {
                items: 3,
                nav: false
            },
            1024: {
                items: 3,
                nav: true
            },
            1440: {
                items: 4,
                nav: true,
                loop: false
            },
            2560: {
                items: 5,
                nav: true,
                loop: false
            }
        }
    });


    $('.thumb-link').on('click', function (e) {
        e.preventDefault();
        let href = $(this).attr('href');
        $('#main-pic').attr('src', href);
        $('.active-thumb').removeClass();
        $(this).parent().parent().addClass('active-thumb');
    });

    $('select').niceSelect();
    $(function () {
        let minInput = $('#min_price');
        let maxInput = $('#max_price');
        let min = Number(Math.floor(Number(minInput.data('min')) / 10) * 10 + '.00');
        let max = Number(Math.ceil(Number(maxInput.data('max')) / 10) * 10 + '.00');
        let start = Number(minInput.data('value') + '.00');
        let finish = Number(maxInput.data('value') + '.00');
        $('#priceSlider').slider({
            range: true,
            orientation: "horizontal",
            min: min,
            max: max,
            values: [start, finish],
            step: 10.00,

            slide: function (event, ui) {
                if (ui.values[0] === ui.values[1]) {
                    return false;
                }
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            }
        });
    });


    function submitForm() {
        let inputs = $('.getFilter');
        inputs.each(function (index) {
            if (!$(this).val().trim().length) {
                $(this).remove()
            }
        });
        $('#filterForm').submit();
    }


    $('a.metalIcon').on('click', function () {
        let val = $(this).data('name');
        $('#metalColor').val(val);
        submitForm();
    });

    $('#selectCarat').on('change', function () {
        let val = $(this).val();
        $('#metalCarat').val(val);
        submitForm();
    });

    $('#selectGender').on('change', function () {
        let val = $(this).val();
        $('#metalSex').val(val);
        submitForm();
    });

    $('#selectSort').on('change', function () {
        let val = $(this).val();
        $('#sortItems').val(val);
        submitForm();
    });

    $('.ui-slider-handle').mouseup(function () {
        $('#metalPriceFrom').val($('#min_price').val());
        $('#metalPriceTo').val($('#max_price').val());
        submitForm();
    });

    $(function () {
        mediumZoom(document.querySelector('#main-pic'))
    });

    $(function () {
        $('.filter-button').on('click', function () {
            $('.filter-tab').toggleClass('active-filter-tab');
        });
        $('.close-filter-tab').on('click', function () {
            $('.active-filter-tab').removeClass('active-filter-tab');
        })
    });

});