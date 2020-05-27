/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/init.js":
/*!*************************************!*\
  !*** ./resources/assets/js/init.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

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
      selectedContent.addClass('selected').siblings('li').removeClass('selected'); //animate tabContentWrapper height when content changes

      tabContentWrapper.animate({
        'height': slectedContentHeight
      }, 200);
    }
  }); //hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)

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
  } // cart


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
      success: function success(result) {
        if (result.success) {
          refreshTotal();
          $('.cart-header').fadeOut('slow', function () {
            $(this).remove();
          });
          $.notify({
            message: Lang.get('cart.empty_now')
          }, {
            type: 'success',
            delay: 1000
          });
        }
      }
    });
  }); // $("form#addToCart").ajaxForm({
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
      success: function success(result) {
        if (result.success) {
          $button.parent().fadeOut('slow', function () {
            $button.parent().remove();
          });
          refreshTotal();
          $.notify({
            message: Lang.get('cart.removed_from_cart')
          }, {
            type: 'success',
            delay: 1000
          });
        } else {
          refreshTotal();
          $.notify({
            message: 'Something went wrong'
          }, {
            type: 'danger',
            delay: 1000
          });
        }
      },
      error: function error() {
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
    success: function success(result) {
      $('.totalCart').show();
      $('.totalCart').text('(' + result.total + 'USD)');

      if (!result.total) {
        $('.totalCart').fadeOut('slow', function () {
          $('.totalCart').remove();
        });
      } // var no_item = document.createElement('p');
      // no_item.classList.add('noItems ta-center');
      // no_item.innerHTML = '<i class="fas fa-exclamation-triangle"></i> @lang(\'cart.no-items\')';
      // $('div.cart-items').append('<p class="noItems ta-center"><i class="fas fa-exclamation-triangle"></i> @lang(\'cart.no-items\')</p>');

    },
    error: function error() {
      return null;
    }
  });
}

$('content');
$('.img-icons').on('click', function () {
  var body = $("html, body");
  body.stop().animate({
    scrollTop: 0
  }, 500, 'swing'); // document.body.scrollTop = 0;
  // document.documentElement.scrollTop = 0;
});

window.onload = function () {
  setTimeout(function () {
    $('#preloader').fadeOut('slow', function () {});
  }, 1000);
};

/***/ }),

/***/ 1:
/*!*******************************************!*\
  !*** multi ./resources/assets/js/init.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\OpenServer\OSPanel\domains\media.loc\resources\assets\js\init.js */"./resources/assets/js/init.js");


/***/ })

/******/ });