(function($){
  "use strict";

  jQuery(document).ready(function(e) {
      var img=$('.bg_img');
      img.css('background-image', function () {
        var bg = ('url(' + $(this).data('background') + ')');
        return bg;
      });
  });

  //menu options custom affix
  var fixed_top = $(".header-section");
  $(window).on("scroll", function(){
      if( $(window).scrollTop() > 50){  
          fixed_top.addClass("animated fadeInDown menu-fixed");
      }
      else{
          fixed_top.removeClass("animated fadeInDown menu-fixed");
      }
  });

  $(window).on('load', function(){

      //preloader
      $(".preloader").delay(300).animate({
        "opacity" : "0"
        }, 500, function() {
        $(".preloader").css("display","none");
    });

     // run test on initial page load
    //  checkSize();
     // run test on resize of the window
     $(window).resize(checkSize);

    //menu options custom affix
    var fixed_top = $(".header-section");
    $(window).on("scroll", function(){
      
      if( $(this).scrollTop() > 50 ){  
        fixed_top.addClass("header-close");
      }
      else{
        fixed_top.removeClass("header-close");
      }
    });
  });

  //Function to the css rule
  function checkSize(){
    if (window.matchMedia('(max-width: 1199px)').matches) {
      // js code for responsive drop-down-menu-item with swing effect
      $(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
        var element = $(this).parent("li");
        if (element.hasClass("open")) {
          element.removeClass("open");
          element.find("li").removeClass("open");
          element.find("ul").slideUp(500,"linear");
        }
        else {
          element.addClass("open");
          element.children("ul").slideDown();
          element.siblings("li").children("ul").slideUp();
          element.siblings("li").removeClass("open");
          element.siblings("li").find("li").removeClass("open");
          element.siblings("li").find("ul").slideUp();
        }
      });
    }
  };

  $('.item-view-btn.list-view').on('click', function(){
    $(this).addClass('active');
    $('.investment-item-area').addClass('list-view');
    // $('.investment-item').addClass('col-lg-12 col-md-12 col-12');
    $('.grid-view').removeClass('active');
  });

  $('.item-view-btn.grid-view').on('click', function(){
    $(this).addClass('active');
    $('.investment-item-area').removeClass('list-view');
    // $('.investment-item').removeClass('col-lg-12 col-md-12 col-12');
    $('.list-view').removeClass('active');
  });

  $('.choose-us-slider').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    nav: true,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
          items:2,
          nav:true,
        },
        1200:{
          items:3,
          nav:true,
          loop:false
        },
        1550:{
          items:4,
          nav:true,
          loop:false
        },
        1850:{
            items:5,
            nav:true,
            loop:false
        }
    }
  });

  $('.choose-us-slider__two').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    center: true,
    nav: true,
    items: 3,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:2,
            center: false,
        },
        1000:{
            items:3,
            nav:true,
            loop:true
        }
    }
  });

  $('.choose-us-slider__three').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    nav: true,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:2,
            nav:false
        },
        1715:{
            items:3,
            nav:true,
            loop:false
        }
    }
  });

  //choose-us-slider-four js
  $('.choose-us-slider__four').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    nav: true,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        576:{
          items:2,
          nav:true
        },
        768:{
          items:3,
          nav:true
        },
        992:{
          items:3,
          nav:true
        },
        1200:{
            items:2,
            nav:true
        },
        1450:{
            items:3,
            nav:true
        }
    }
  });

  //choose-us-slider-five js
  $('.choose-us-slider__five').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    nav: true,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
          items:2,
          nav:true
        },
        1200:{
            items:2,
            nav:true
        },
        1750:{
            items:3,
            nav:true
        }
    }
  });

  $('.offer-slider').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    center: true,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:2,
            nav:false,
            center: false,
        },
        992:{
            items:2,
            nav:true,
            center: false,
        },
        1200:{
          items:3,
          nav:true,
        }
    }
  });

  $('.investor-slider').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass:true,
    dots: false,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:2,
            nav:false
        },
        992:{
            items:3,
            nav:true,
            loop:false
        }
    }
  });

  //contest-winner-slider
  $('.contest-winner-slider').owlCarousel({
    loop: true,
    margin: 0,
    // autoplay: true,
    responsiveClass:true,
    center: false,
    responsive:{
        0:{
            items:1
        },
        1000:{
            items:1
        }
    }
  });

  // team-slider jquery
  $('.team-slider').owlCarousel({
    loop: true,
    margin: 30,
    dots: false,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsiveClass:true,
    responsive:{
        0:{
          items:1,
          nav:true
        },
        576:{
          items:2,
          nav:true
        },
        768:{
            items:2,
            nav:true
        },
        992:{
            items:3
        },
        1200:{
            items:4,
            nav:true
        }
    }
  });

  // testimonial-slider jquery
  $('.testimonial-slider').owlCarousel({
    items:1,
    nav:true,
    loop: true,
    margin: 0,
    dots: false,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsiveClass:true,
    responsive:{
        0:{
          items:1,
          nav:false,
          autoplay: true
        },
        992:{
            items:1,
            nav:true
        }
    }
  });

  // payment-method-slider
  $('.payment-method-slider').owlCarousel({
    items:7,
    nav:true,
    margin: 30,
    dots: false,
    navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    responsiveClass:true,
    responsive:{
        0:{
          items:2,
          nav:false,
          autoplay: true
        },
        576:{
          items:4,
          nav:true
        },
        768:{
          items:5,
          nav:true
        },
        992:{
            items:7,
            nav:true
        }
      }
    });

  // affiliate-bonus-slider 
  $('.affiliate-bonus-slider').owlCarousel({
    loop: true,
    autoplay: true,
    items: 1,
    nav: false,
    dots: false,
    autoplaySpeed: 300,
    smartSpeed: 150,
    autoplayHoverPause: true,
    animateOut: 'slideOutUp',
    animateIn: 'slideInUp'
  });

  $( function() {
    $( "#slider-range-min-one" ).slider({
      range: "min",
      value: 25000,
      min: 50,
      max: 50000,
      slide: function( event, ui ) {
        $( "#basic-amount" ).val( "$" + number_format(ui.value , 2, ".", ","));
        $("#daily_fee").text("$" + number_format(ui.value / 30 / 4, 2, ".", ","));
        $("#monthly_fee").text("$" + number_format(ui.value / 4, 2, ".", ","));
      }
    });
    $( "#basic-amount" ).val( "$" + number_format($( "#slider-range-min-one" ).slider( "value" ) , 2, ".", ","));
        $("#daily_fee").text("$" + number_format($( "#slider-range-min-one" ).slider( "value" ) / 30, 2, ".", ","));
        $("#monthly_fee").text("$" + number_format($( "#slider-range-min-one" ).slider( "value" ) / 30 * 4, 2, ".", ","));
  } );

  function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }

  $( function() {
    $( "#slider-range-min-two" ).slider({
      range: "min",
      value: 19000,
      min: 1,
      max: 50000,
      slide: function( event, ui ) {
        $( "#satandard-amount" ).val( "$" + ui.value );
      }
    });
    $( "#satandard-amount" ).val( "$" + $( "#slider-range-min-two" ).slider( "value" ) );
  } );

  $( function() {
    $( "#slider-range-min-three" ).slider({
      range: "min",
      value: 19000,
      min: 1,
      max: 50000,
      slide: function( event, ui ) {
        $( "#premium-amount" ).val( "$" + ui.value );
      }
    });
    $( "#premium-amount" ).val( "$" + $( "#slider-range-min-three" ).slider( "value" ) );
  } );

  $( function() {
    $( "#profit-slider-range" ).slider({
      range: "min",
      value: 35000,
      min: 1,
      max: 100000,
      slide: function( event, ui ) {
        $( "#profit-amount" ).val( "$" + ui.value );
      }
    });
    $( "#profit-amount" ).val( "$" + $( "#profit-slider-range" ).slider( "value" ) );
  } );


  $( function() {
    $( "#profit-slider-range-month" ).slider({
      range: "min",
      value: 10,
      min: 1,
      max: 24,
      slide: function( event, ui ) {
        $( "#month-amount" ).val( ui.value + "Months" );
      }
    });
    $( "#month-amount" ).val( $( "#profit-slider-range-month" ).slider( "value" ) + " Months");
  } );

  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa fa-angle-left"></i></div><div class="quantity-button quantity-down"><i class="fa fa-angle-right"></i></div></div>').insertAfter('.share-count input');
      jQuery('.share-count').each(function () {
          var spinner = jQuery(this),
              input = spinner.find('input[type="number"]'),
              btnUp = spinner.find('.quantity-down'),
              btnDown = spinner.find('.quantity-up'),
              min = input.attr('min'),
              max = input.attr('max');

          btnUp.on('click',function () {
              var oldValue = parseFloat(input.val());
              if (oldValue >= max) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue + 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
          });

          btnDown.on('click',function () {
              var oldValue = parseFloat(input.val());
              if (oldValue <= min) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue - 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
          });

      });

  //js code for mobile menu 
  $(".menu-toggle").on("click", function() {
      $(this).toggleClass("is-active");
  });

  $('.new-client-header > .toggle-btn').on('click',function(e) {
  	e.preventDefault();
  
    var $this = $(this);
  
    if ($this.parent().next().hasClass('show')) {
        $this.parent().next().removeClass('show');
        $this.parent().next().slideUp(350);
        $this.removeClass('open');
    } else {
        $this.parent().next().toggleClass('show');
        $this.parent().next().slideToggle(350);
        $this.addClass('open');
    }
});

$('.faq-header').on('click',function(e) {
  e.preventDefault();

  var $this = $(this);

  if ($this.next().hasClass('show')) {
      $this.next().removeClass('show');
      $this.next().slideUp(350);
      $this.removeClass('open');
  } else {
      $this.next().toggleClass('show');
      $this.next().slideToggle(350);
      $this.addClass('open');
  }
});
  

  // lightcase plugin init
  $('a[data-rel^=lightcase]').lightcase();

  $(".play-card-body .number-list li").on('click', function(){
    $(this).toggleClass("active");
  });

  new WOW().init();

  // counter 
  $('.counter').countUp({
    'time': 1500,
    'delay': 10
  });

  $("[data-paroller-factor]").paroller();

  // Show or hide the sticky footer button
  $(window).on("scroll", function() {
    if ($(this).scrollTop() > 200) {
        $(".scroll-to-top").fadeIn(200);
    } else {
        $(".scroll-to-top").fadeOut(200);
    }
  });
  // Animate the scroll to top
  $(".scroll-to-top").on("click", function(event) {
    event.preventDefault();
    $("html, body").animate({scrollTop: 0}, 800);
  });

  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa fa-chevron-right"></i></div><div class="quantity-button quantity-down"><i class="fa fa-chevron-left"></i></div></div>').insertAfter('.quantity input');
      jQuery('.quantity').each(function () {
          var spinner = jQuery(this),
              input = spinner.find('input[type="number"]'),
              btnUp = spinner.find('.quantity-up'),
              btnDown = spinner.find('.quantity-down'),
              min = input.attr('min'),
              max = input.attr('max');

          btnUp.on('click', function () {
              var oldValue = parseFloat(input.val());
              if (oldValue >= max) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue + 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
          });

          btnDown.on('click', function () {
              var oldValue = parseFloat(input.val());
              if (oldValue <= min) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue - 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
          });

      });

    $(".testimonial-single").mouseenter(function() {
      return $(this).addClass("active").siblings().removeClass("active");
    });


})(jQuery);
