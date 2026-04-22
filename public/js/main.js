// Dynamic Cars Page Rendering (runs early so it works even if other scripts fail)
(function () {
  function run() {
    try {
      var path = window.location.pathname || "";
      if (!/^\/cars\/?$/.test(path)) return;

      var row = document.querySelector(".ftco-section.bg-light .container .row");
      if (!row) return;

      row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">Loading cars...</div>';

      fetch("/api/cars", { headers: { "Accept": "application/json" } })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (!data || !Array.isArray(data.cars)) {
            row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">Unable to load cars.</div>';
            return;
          }
          if (data.cars.length === 0) {
            row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">No cars added yet. Please add cars from Admin Panel.</div>';
            return;
          }

          function esc(s) {
            return String(s == null ? "" : s)
              .replace(/&/g, "&amp;")
              .replace(/</g, "&lt;")
              .replace(/>/g, "&gt;")
              .replace(/"/g, "&quot;")
              .replace(/'/g, "&#039;");
          }

          function card(car) {
            var name = car.name || "";
            var brand = car.brand || "";
            var price = car.price_per_day != null ? car.price_per_day : 0;
            var seats = car.seats != null ? car.seats : 0;
            var img = car.image_url || "/images/car-1.jpg";

            var total = car.total_units || 0;
            var avail = car.available_units || 0;
            var stockReady = total > 0;
            var isAvailable = !stockReady || avail > 0;

            var bookingHref =
              "/booking?car_id=" + encodeURIComponent(car.id) +
              "&car=" + encodeURIComponent(name) +
              "&price=" + encodeURIComponent(price) +
              "&seats=" + encodeURIComponent(seats);

            var detailsHref = "/car/" + encodeURIComponent(car.id);

            var priceHtml = price ? ('<p class="price ml-auto">₹' + esc(price) + ' <span>/day</span></p>') : "";
            var availHtml = "";
            if (stockReady) {
              availHtml = '<div style="margin-top:6px;font-size:12px;color:#01d28e;font-weight:600;">Available: ' + esc(avail) + " / " + esc(total) + "</div>";
            }

            var bookBtn = isAvailable
              ? ('<a href="' + esc(bookingHref) + '" class="btn btn-primary py-2 mr-1">Book Now</a>')
              : ('<a href="#" class="btn btn-primary py-2 mr-1 disabled" style="pointer-events:none;opacity:.6;">Not Available</a>');

            return (
              '<div class="col-md-4">' +
                '<div class="car-wrap rounded">' +
                  '<div class="img rounded d-flex align-items-end" style="background-image: url(\'' + esc(img) + '\');"></div>' +
                  '<div class="text">' +
                    '<h2 class="mb-0"><a href="' + esc(detailsHref) + '">' + esc(name) + '</a></h2>' +
                    '<div class="d-flex mb-3">' +
                      '<span class="cat">' + esc(brand) + '</span>' +
                      priceHtml +
                    '</div>' +
                    availHtml +
                    '<p class="d-flex mb-0 d-block">' +
                      bookBtn +
                      '<a href="' + esc(detailsHref) + '" class="btn btn-secondary py-2 ml-1">Details</a>' +
                    '</p>' +
                  "</div>" +
                "</div>" +
              "</div>"
            );
          }

          row.innerHTML = data.cars.map(card).join("");
        })
        .catch(function () {
          row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">Unable to load cars.</div>';
        });
    } catch (e) { /* ignore */ }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", run);
  } else {
    run();
  }
})();

 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

(function($) {

	"use strict";

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
   $.Scrollax();

	var carousel = function() {
		$('.carousel-car').owlCarousel({
			center: true,
			loop: true,
			autoplay: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var counter = function() {
		
		$('#section-counter, .hero-wrap, .ftco-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();


	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function() {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function(e) {
		 	e.preventDefault();

		 	var hash = this.hash,
		 			navToggler = $('.navbar-toggler');
		 	$('html, body').animate({
		    scrollTop: $(hash).offset().top
		  }, 700, 'easeInOutExpo', function(){
		    window.location.hash = hash;
		  });


		  if ( navToggler.is(':visible') ) {
		  	navToggler.click();
		  }
		});
		$('body').on('activate.bs.scrollspy', function () {
		  console.log('nice');
		})
	};
	OnePageNav();


	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });


	$('#book_pick_date,#book_off_date').datepicker({
	  'format': 'm/d/yyyy',
	  'autoclose': true
	});
	$('#time_pick').timepicker();



})(jQuery);

// Dynamic Cars Page Rendering (keeps cars.blade.php unchanged)
(function () {
  try {
    var path = window.location.pathname || "";
    if (!/^\/cars\/?$/.test(path)) return;

    var row = document.querySelector(".ftco-section.bg-light .container .row");
    if (!row) return;

    // Always remove hardcoded cards. The page should show only admin-added cars.
    row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">Loading cars...</div>';

    fetch("/api/cars", { headers: { "Accept": "application/json" } })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (!data || !Array.isArray(data.cars)) {
          row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">Unable to load cars.</div>';
          return;
        }

        if (data.cars.length === 0) {
          row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">No cars added yet. Please add cars from Admin Panel.</div>';
          return;
        }

        function esc(s) {
          return String(s == null ? "" : s)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
        }

        function card(car) {
          var name = car.name || "";
          var brand = car.brand || "";
          var price = car.price_per_day != null ? car.price_per_day : 0;
          var seats = car.seats != null ? car.seats : 0;
          var img = car.image_url || "/images/car-1.jpg";

          var total = car.total_units || 0;
          var avail = car.available_units || 0;
          var stockReady = total > 0;
          var isAvailable = !stockReady || avail > 0; // allow booking until stock is configured

          var bookingHref =
            "/booking?car_id=" + encodeURIComponent(car.id) +
            "&car=" + encodeURIComponent(name) +
            "&price=" + encodeURIComponent(price) +
            "&seats=" + encodeURIComponent(seats);

          var detailsHref = "/car/" + encodeURIComponent(car.id);

          var priceHtml = price ? ('<p class="price ml-auto">₹' + esc(price) + ' <span>/day</span></p>') : "";
          var availHtml = "";
          if (stockReady) {
            availHtml = '<div style="margin-top:6px;font-size:12px;color:#01d28e;font-weight:600;">Available: ' + esc(avail) + " / " + esc(total) + "</div>";
          }

          var bookBtn = isAvailable
            ? ('<a href="' + esc(bookingHref) + '" class="btn btn-primary py-2 mr-1">Book Now</a>')
            : ('<a href="#" class="btn btn-primary py-2 mr-1 disabled" style="pointer-events:none;opacity:.6;">Not Available</a>');

          return (
            '<div class="col-md-4">' +
              '<div class="car-wrap rounded">' +
                '<div class="img rounded d-flex align-items-end" style="background-image: url(\'' + esc(img) + '\');"></div>' +
                '<div class="text">' +
                  '<h2 class="mb-0"><a href="' + esc(detailsHref) + '">' + esc(name) + '</a></h2>' +
                  '<div class="d-flex mb-3">' +
                    '<span class="cat">' + esc(brand) + '</span>' +
                    priceHtml +
                  '</div>' +
                  availHtml +
                  '<p class="d-flex mb-0 d-block">' +
                    bookBtn +
                    '<a href="' + esc(detailsHref) + '" class="btn btn-secondary py-2 ml-1">Details</a>' +
                  '</p>' +
                "</div>" +
              "</div>" +
            "</div>"
          );
        }

        row.innerHTML = data.cars.map(card).join("");
      })
      .catch(function () {
        row.innerHTML = '<div class="col-12" style="padding:18px 0;text-align:center;color:#777;">Unable to load cars.</div>';
      });
  } catch (e) {
    /* ignore */
  }
})();
