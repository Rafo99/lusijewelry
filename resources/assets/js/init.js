// let lng = document.head.querySelector('meta[name="lang"]');
// console.log(lng.content);
// let Lang = new Lang();
// Lang.setLocale(lng.content);
// Lang.setFallback('hy');

addEventListener("load", function () {
    setTimeout(hideURLbar, 0);
}, false);

function hideURLbar() {
    window.scrollTo(0, 1);
}


jQuery(document).ready(function ($) {
    var tabItems = $('.cd-tabs-navigation a'),
        tabContentWrapper = $('.cd-tabs-content');

    tabItems.on('click', function (event) {
        event.preventDefault();
        var selectedItem = $(this);
        if (!selectedItem.hasClass('selected')) {
            var selectedTab = selectedItem.data('content'),
                selectedContent = tabContentWrapper.find('li[data-content="' + selectedTab + '"]'),
                slectedContentHeight = selectedContent.innerHeight();

            tabItems.removeClass('selected');
            selectedItem.addClass('selected');
            selectedContent.addClass('selected').siblings('li').removeClass('selected');
            //animate tabContentWrapper height when content changes
            tabContentWrapper.animate({
                'height': slectedContentHeight
            }, 200);
        }
    });

    //hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
    checkScrolling($('.cd-tabs nav'));
    $(window).on('resize', function () {
        checkScrolling($('.cd-tabs nav'));
        tabContentWrapper.css('height', 'auto');
    });
    $('.cd-tabs nav').on('scroll', function () {
        checkScrolling($(this));
    });

    function checkScrolling(tabs) {
        var totalTabWidth = parseInt(tabs.children('.cd-tabs-navigation').width()),
            tabsViewport = parseInt(tabs.width());
        if (tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
            tabs.parent('.cd-tabs').addClass('is-ended');
        } else {
            tabs.parent('.cd-tabs').removeClass('is-ended');
        }
    }


    // cart

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".category_modal").on('click', function (e) {
        e.preventDefault();
        alert('asasa');
    });

    $(".simpleCart_empty").on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/cart/empty',
            success: function (result) {
                if (result.success) {
                    refreshTotal();
                    $('.cart-header').fadeOut('slow', function () {
                        $(this).remove();
                    });
                    $.notify({
                        message: Lang.get('cart.empty_now')
                    }, {
                        type: 'success',
                        delay: 1000,
                    });
                }
            },
        });
    });

    // $("form#addToCart").ajaxForm({
    //     type: 'put',
    //     success: function (result) {
    //         if (result.success) {
    //             $.notify({
    //                 message: Lang.get('cart.added_to_cart')
    //             }, {
    //                 type: 'success',
    //                 delay: 1000,
    //             });
    //             refreshTotal();
    //         } else {
    //             $.notify({
    //                 message: 'Something went wrong'
    //             }, {
    //                 type: 'danger',
    //                 delay: 1000,
    //             });
    //             refreshTotal()
    //         }
    //     }
    // });


    $('.close1').on('click', function () {
        var $button = $(this);
        $.ajax({
            url: '/cart/' + $button.parent().attr('id'),
            type: 'DELETE',
            success: function (result) {
                if (result.success) {
                    $button.parent().fadeOut('slow', function () {
                        $button.parent().remove();
                    });
                    refreshTotal();
                    $.notify({
                        message: Lang.get('cart.removed_from_cart')
                    }, {
                        type: 'success',
                        delay: 1000,
                    });
                }
                else {
                    refreshTotal();
                    $.notify({
                        message: 'Something went wrong'
                    }, {
                        type: 'danger',
                        delay: 1000,
                    });
                }
            },
            error: function () {
                alert('Request Error');
            }
        });


    });

    var text = $('.totalCart').text();
    if (text === '(0USD)') {
        $('.totalCart').hide();
    }


});

function refreshTotal() {
    $.ajax({
        dataType: "json",
        url: '/cart/total',
        success: function (result) {
            $('.totalCart').show();
            $('.totalCart').text('('+result.total+'USD)');
            if (!result.total) {
                $('.totalCart').fadeOut('slow', function () {
                    $('.totalCart').remove()
                });
            }


            // var no_item = document.createElement('p');
            // no_item.classList.add('noItems ta-center');
            // no_item.innerHTML = '<i class="fas fa-exclamation-triangle"></i> @lang(\'cart.no-items\')';
            // $('div.cart-items').append('<p class="noItems ta-center"><i class="fas fa-exclamation-triangle"></i> @lang(\'cart.no-items\')</p>');
        },
        error: function () {
            return null;
        }
    });
}
$('content');





$('.img-icons').on('click', function () {
    var body = $("html, body");
    body.stop().animate({scrollTop: 0}, 500, 'swing');
    // document.body.scrollTop = 0;
    // document.documentElement.scrollTop = 0;
});

window.onload = function() {
    setTimeout(function() {
        $('#preloader').fadeOut('slow', function() {});
    }, 1000);
};