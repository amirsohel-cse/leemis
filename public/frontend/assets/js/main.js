/**
 * Wolmart Javascript File
 *
 * @version 1.0
 */
'use strict';

// $(window).on('scroll', function(){
//     var scroll = $(window).scrollTop();

//      //>=, not <=
//     if (scroll >= 0) {
//         //clearHeader, not clearheader - caps H
//         $('.header-bottom').addClass("fixed");
//     }
// })

// $(document).on("ready", function() {
//     $(".lazy-img").unveil();
// });

var $ = jQuery.noConflict();

/* jQuery easing */
$.extend($.easing, {
    def: 'easeOutQuad',
    swing: function (x, t, b, c, d) {
        return $.easing[$.easing.def](x, t, b, c, d);
    },
    easeOutQuad: function (x, t, b, c, d) {
        return -c * (t /= d) * (t - 2) + b;
    },
    easeOutQuint: function (x, t, b, c, d) {
        return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
    }
});

/**
 * Wolmart Object
 */
window.Wolmart = {};

/**
 * Wolmart Base
 */
(function ($) {

    /**
     * jQuery Window Handle
     *
     * @var jQuery jQuery window handle
     */
    Wolmart.$window = $(window);

    /**
     * jQuery Body Handle
     *
     * @var jQuery jQuery body handle
     */
    Wolmart.$body = $(document.body);

    /**
     * Status
     *
     * @var string Status
     */
    Wolmart.status = '';

    /**
     * Check if the browser is internet explorer.
     *
     * @var boolean isIE
     */
    Wolmart.isIE = navigator.userAgent.indexOf('Trident') >= 0;

    /**
     * Check if the browser is internet explorer.
     *
     * @var boolean isIE
     */
    Wolmart.isEdge = navigator.userAgent.indexOf('Edge') >= 0;
    Wolmart.isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    /**
     * Make a macro task
     *
     * @param {function} fn
     * @param {number} delay
     * @return {void}
     */
    Wolmart.call = function (fn, delay) {
        setTimeout(fn, delay);
    }

    /**
     * Parse options string to object
     *
     * @param {string} options
     * @return {object} options
     */
    Wolmart.parseOptions = function (options) {
        return 'string' == typeof options ?
            JSON.parse(options.replace(/'/g, '"').replace(';', '')) :
            {};
    }

    /**
     * Parse html template with variables.
     *
     * @param {string} template
     * @param {object} vars
     * @return {string} parsed template
     */
    Wolmart.parseTemplate = function (template, vars) {
        return template.replace(/\{\{(\w+)\}\}/g, function () {
            return vars[arguments[1]];
        });
    }

    /**
     * Get dom element by id
     *
     * @param {string} id
     * @return {HTMLElement} element
     */
    Wolmart.byId = function (id) {
        return document.getElementById(id);
    }

    /**
     * Get dom elements by tagName
     *
     * @param {string} tagName
     * @param {HTMLElement} element this can be omitted.
     * @return {HTMLCollection}
     */
    Wolmart.byTag = function (tagName, element) {
        return element ?
            element.getElementsByTagName(tagName) :
            document.getElementsByTagName(tagName);
    }

    /**
     * Get dom elements by className
     *
     * @param {string} className
     * @param {HTMLElement} element this can be omitted.
     * @return {HTMLCollection}
     */
    Wolmart.byClass = function (className, element) {
        return element ?
            element.getElementsByClassName(className) :
            document.getElementsByClassName(className);
    }


    /**
     * Set cookie
     *
     * @param {string} name Cookie name
     * @param {string} value Cookie value
     * @param {number} exdays Expire period
     */
    Wolmart.setCookie = function (name, value, exdays) {
        var date = new Date();
        date.setTime(date.getTime() + (exdays * 24 * 60 * 60 * 1000));
        document.cookie = name + "=" + value + ";expires=" + date.toUTCString() + ";path=/";
    }

    /**
     * Get cookie
     *
     * @param {string} name Cookie name
     * @return {string} Cookie value
     */
    Wolmart.getCookie = function (name) {
        var n = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; ++i) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(n) == 0) {
                return c.substring(n.length, c.length);
            }
        }
        return "";
    }

    /**
     * Get jQuery object
     *
     * @param {string|jQuery} selector
     * @return {jQuery|Object} jQuery Object or {each: $.noop}
     */
    Wolmart.$ = function (selector) {
        if (selector instanceof jQuery) {
            return selector;
        }
        return $(selector);
    }

    /**
     * Check if DOM node is on screen
     *
     * @param {HTMLElement} el
     * @return {boolean}
     */
    Wolmart.isOnScreen = function (el) {

        var a = window.pageXOffset,
            b = window.pageYOffset,
            o = el.getBoundingClientRect(),
            x = o.left + a,
            y = o.top + b;

        return y + o.height >= b &&
            y <= b + window.innerHeight &&
            x + o.width >= a &&
            x <= a + window.innerWidth;
    }

    /**
     * Do appear animations.
     *
     * @param {HTMLElement} el
     * @param {function} fn
     * @param {object} options
     * @return {boolean}
     */
    // Wolmart.appear = (function () {
    //     var checks = [],
    //         timerId = false,
    //         one;

    //     var checkAll = function () {
    //         for (var i = checks.length; i--;) {
    //             one = checks[i];

    //             if (Wolmart.isOnScreen(one.el)) {
    //                 one.fn && one.fn.call(one.el);
    //                 checks.splice(i, 1);
    //             }
    //         }
    //     };

    //     window.addEventListener('scroll', checkAll, { passive: true });
    //     window.addEventListener('resize', checkAll, { passive: true });
    //     $(window).on('appear.check', checkAll);

    //     return function (el, fn) {
    //         checks.push({ el: el, fn: fn });
    //         timerId || (timerId = Wolmart.requestTimeout(checkAll, 100));
    //     }
    // })();

    Wolmart.appear = function (el, fn, intObsOptions) {
		var interSectionObserverOptions = {
			rootMargin: '0px 0px 200px 0px',
			threshold: 0,
			alwaysObserve: true
		};

		if (intObsOptions && Object.keys(intObsOptions).length) {
		 $.extend(intersectionObserverOptions, intObsOptions);
		}

		var observer = new IntersectionObserver(function (entries) {
			for (var i = 0; i < entries.length; i++) {
				var entry = entries[i];

				if (entry.intersectionRatio > 0) {
					if (typeof fn === 'string') {
						var func = Function('return ' + functionName)();
					} else {
						var callback = fn;

						callback.call($(entry.target));
					}
				}
			}
		}, interSectionObserverOptions);

		observer.observe(el);

		return this;
	}


    /**
     * Request Timeout
     *
     * @param {function} fn
     * @param {number} delay
     */
    Wolmart.requestTimeout = function (fn, delay) {
        var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
        if (!handler) {
            return setTimeout(fn, delay);
        }

        var start, rt = new Object();

        function loop(timestamp) {
            if (!start) {
                start = timestamp;
            }
            var progress = timestamp - start;
            progress >= delay ? fn() : rt.val = handler(loop);
        };

        rt.val = handler(loop);
        return rt;
    }

    /**
     * Request Interval
     *
     * @param {function} fn
     * @param {number} step
     * @param {number} timeOut
     */
    Wolmart.requestInterval = function (fn, step, timeOut) {
        var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
        if (!handler) {
            if (!timeOut)
                return setTimeout(fn, timeOut);
            else
                return setInterval(fn, step);
        }
        var start, last, rt = new Object();
        function loop(timestamp) {
            if (!start) {
                start = last = timestamp;
            }
            var progress = timestamp - start;
            var delta = timestamp - last;
            if (!timeOut || progress < timeOut) {
                if (delta > step) {
                    fn();
                    rt.val = handler(loop);
                    last = timestamp;
                } else {
                    rt.val = handler(loop);
                }
            } else {
                fn();
            }
        };
        rt.val = handler(loop);
        return rt;
    }

    /**
     * Delete Timeout
     *
     * @param {number} timerId
     */
    Wolmart.deleteTimeout = function (timerId) {
        if (!timerId) {
            return;
        }
        var handler = window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame;
        if (!handler) {
            return clearTimeout(timerId);
        }
        if (timerId.val) {
            return handler(timerId.val);
        }
    }


    /**
     * Register event for tab click
     *
     * @param {string} selector
     */
    Wolmart.setTab = function (selector) {

        function _activeTab(e) {
            var $this = $(this);
            e.preventDefault();

            if (!$this.hasClass("active")) {
                var $panel = $($this.attr('href'));
                $panel.siblings('.active').removeClass('in active');
                $panel.addClass('active in');

                $this.parent().parent().find('.active').removeClass('active');
                $this.addClass('active');
            }
        }

        function _linkToTab(e) {
            var selector = $(e.currentTarget).attr('href'),
                $tab = $(selector),
                $nav = $tab.parent().siblings('.nav');
            e.preventDefault();

            $tab.siblings().removeClass('active in');
            $tab.addClass('active in');
            $nav.find('.nav-link').removeClass('active');
            $nav.find('[href="' + selector + '"]').addClass('active');

            $('html').animate({
                scrollTop: $tab.offset().top - 150
            });
        }

        Wolmart.$body
            .on('click', '.tab .nav-link', _activeTab) // tab nav link
            .on('click', '.link-to-tab', _linkToTab);  // link to tab
    }

    /**
     * productCartAction
     *
     * @param {string} selector
     */
    Wolmart.initCartAction = function (selector) {
        // Cart dropdown is offcanvas type
        Wolmart.$body
            .on('click', selector, function (e) {
                $('.cart-dropdown').addClass('opened');
                e.preventDefault();
            })
            .on('click', '.cart-offcanvas .cart-overlay', function (e) {
                $('.cart-dropdown').removeClass('opened');
                e.preventDefault();
            })
            .on('click', '.cart-offcanvas .cart-header, .cart-close', function (e) {
                $('.cart-dropdown').removeClass('opened');
                e.preventDefault();
            })
    }

    /**
     * initScrollTopButton
     *
     */
    Wolmart.initScrollTopButton = function () {
        // register scroll top button
        var domScrollTop = Wolmart.byId('scroll-top');

        domScrollTop.addEventListener('click', function (e) {
            $('html, body').animate({ scrollTop: 0 }, 600);
            e.preventDefault();
        });

        var refreshScrollTop = function () {
            if (window.pageYOffset > 400) {
                domScrollTop.classList.add('show');
            } else {
                domScrollTop.classList.remove('show');
            }
        }

        Wolmart.call(refreshScrollTop, 500);
        window.addEventListener('scroll', refreshScrollTop, { passive: true });
    }

    /**
     * Sticky Default Options
     */
    Wolmart.stickyDefaultOptions = {
        minWidth: 992,
        maxWidth: 20000,
        top: false,
        hide: false,
        scrollMode:true
    }

    Wolmart.stickyToolboxOptions = {
        minWidth: 0,
        maxWidth: 767,
        top: false,
        scrollMode: true
    }

    Wolmart.stickyProductOptions =  {
        minWidth: 0,
        maxWidth: 20000,
        scrollMode: true,
        top: false,
        hide: false
    }

	/**
	 * Check if window's width is really resized.
	 *
	 * @since 1.0
	 * @param {number} timeStamp
	 * @return {boolean}
	 */
	Wolmart.windowResized = function (timeStamp) {
		if (timeStamp == Wolmart.resizeTimeStamp) {
			return Wolmart.resizeChanged;
		}
		Wolmart.resizeChanged = Wolmart.canvasWidth != window.innerWidth;
		Wolmart.canvasWidth = window.innerWidth;
		Wolmart.resizeTimeStamp = timeStamp;
		return Wolmart.resizeChanged;
    }

    /**
	 * Initialize Sticky Content
	 *
	 * @class StickyContent
	 * @since 1.0
	 * @param {string, Object} selector
	 * @param {Object} options
	 * @return {void}
	 */
	Wolmart.stickyContent = (function () {
		function StickyContent($el, options) {
			return this.init($el, options);
		}

		function refreshAll() {
			Wolmart.$window.trigger('sticky_refresh.wolmart', {
				index: 0,
				offsetTop: 0
			});
		}

		function refreshAllSize(e) {
			if (!e || Wolmart.windowResized(e.timeStamp)) {
				Wolmart.$window.trigger('sticky_refresh_size.wolmart');
				refreshAll();
			}
		}

		StickyContent.prototype.init = function ($el, options) {
			this.$el = $el;
			this.options = $.extend(true, {}, Wolmart.stickyDefaultOptions, options, Wolmart.parseOptions($el.attr('data-sticky-options')));
			Wolmart.$window
				.on('sticky_refresh.wolmart', this.refresh.bind(this))
				.on('sticky_refresh_size.wolmart', this.refreshSize.bind(this));
		}

		StickyContent.prototype.refreshSize = function (e) {
			var beWrap = window.innerWidth >= this.options.minWidth && window.innerWidth <= this.options.maxWidth;
			this.scrollPos = window.pageYOffset;
			if (typeof this.top == 'undefined') {
				this.top = this.options.top;
			}

			if (window.innerWidth >= 768 && this.getTop) {
				this.top = this.getTop();
			} else if (!this.options.top) {
				this.top = this.isWrap ?
					this.$el.parent().offset().top :
					this.$el.offset().top + this.$el[0].offsetHeight;

				// if sticky header has toggle dropdown menu, increase top
				if (this.$el.hasClass('has-dropdown')) {

					this.top += this.$el.find('.category-dropdown .dropdown-box')[0].offsetHeight;
				}
			}

			if (!this.isWrap) {
				beWrap && this.wrap();
			} else {
				beWrap || this.unwrap();
            }

            Wolmart.sticky_top_height = 0;

			e && setTimeout(this.refreshSize.bind(this), 50);
		}

		StickyContent.prototype.wrap = function () {
            this.$el.wrap('<div class="sticky-content-wrapper"></div>');
            this.isWrap = true;
		}

		StickyContent.prototype.unwrap = function () {
			this.$el.unwrap('.sticky-content-wrapper');
			this.isWrap = false;
		}

		StickyContent.prototype.refresh = function (e, data) {
			var pageYOffset = window.pageYOffset + data.offsetTop;
			var $el = this.$el;

			this.refreshSize();

			// Make sticky
			if (pageYOffset > this.top && this.isWrap) {

				// calculate height
				this.height = $el[0].offsetHeight;
				$el.hasClass('fixed') || $el.parent().css('height', this.height + 'px');

				// update sticky order
				if ($el.hasClass('fix-top')) {
					$el.css('margin-top', data.offsetTop + 'px');
					this.zIndex = this.options.max_index - data.index;
				} else if ($el.hasClass('fix-bottom')) {
					$el.css('margin-bottom', data.offsetBottom + 'px');
					this.zIndex = this.options.max_index - data.index;
				} else {
					$el.css({ 'transition': 'opacity .5s', 'z-index': this.zIndex });
				}

				// update sticky status
				if (this.options.scrollMode) {
					if (this.scrollPos >= pageYOffset && $el.hasClass('fix-top') ||
						this.scrollPos <= pageYOffset && $el.hasClass('fix-bottom')) {

						$el.addClass('fixed');
                        this.onFixed && this.onFixed();

                        // for only sticky cart form.
                        $el.hasClass('product-sticky-content') && Wolmart.$body.addClass('addtocart-fixed');
					} else {
						$el.removeClass('fixed').css('margin-top', '').css('margin-bottom', '');
						this.onUnfixed && this.onUnfixed();

                        // for only sticky cart form.
                        $el.hasClass('product-sticky-content') && Wolmart.$body.removeClass('addtocart-fixed');
					}
					this.scrollPos = pageYOffset;
				} else {
					$el.addClass('fixed');
					this.onFixed && this.onFixed();
				}

				// stack offset
				if ($el.is('.fixed.fix-top')) {
                    data.offsetTop += $el[0].offsetHeight;

                    Wolmart.sticky_top_height = data.offsetTop;
				} else if ($el.is('.fixed.fix-bottom')) {
					data.offsetBottom += $el[0].offsetHeight;
				}
			} else {
				$el.parent().css('height', '');
				$el.removeClass('fixed').css({ 'margin-top': '', 'margin-bottom': '', 'z-index': '' });
				this.onUnfixed && this.onUnfixed();

                // for only sticky cart form.
                $el.hasClass('product-sticky-content') && Wolmart.$body.removeClass('addtocart-fixed');
			}
		}

		Wolmart.$window.on('wolmart_complete', function () {
			window.addEventListener('scroll', refreshAll, { passive: true });
			Wolmart.$window.on('resize', refreshAllSize);
            setTimeout(function(){
                refreshAllSize();
            }, 300);
		})

		return function (selector, options) {
			Wolmart.$(selector).each(function () {
				var $this = $(this);
				$this.data('sticky-content') || $this.data('sticky-content', new StickyContent($this, options));
			})
		}
	})()

    /**
     * parallax
     *
     * Set parallax background
     *
     * @requires themePluginParallax
     * @param {string} selector
     */
    Wolmart.parallax = function (selector, options) {
        if ($.fn.themePluginParallax) {
            Wolmart.$(selector).each(function () {
                var $this = $(this);
                $this.themePluginParallax(
                    $.extend(true, Wolmart.parseOptions($this.attr('data-parallax-options')), options)
                );
            });
        }
    }

    Wolmart.skrollrParallax = function() {
        if (Wolmart.isMobile) {
			return;
		}

        if ( typeof skrollr == 'undefined' ) {
			return;
		}

		if ( Wolmart.$('.skrollable').length ) {
			skrollr.init( { forceHeight: false } );
		}
    }

    /**
	 * Initialize floating elements
	 *
	 * @since 1.0
	 * @param {string|jQuery} selector
	 * @return {void}
	 */
	Wolmart.initFloatingParallax = function ( ) {
		if ( $.fn.parallax ) {
			Wolmart.$('.floating-item' ).each( function ( e ) {
				var $this = $( this );
				if ( $this.data( 'parallax' ) ) {
					$this.parallax( 'disable' );
					$this.removeData( 'parallax' );
					$this.removeData( 'options' );
				}
				$this.children().addClass( 'layer' ).attr( 'data-depth', $this.attr( 'data-child-depth' ) );
				$this.parallax( $this.data( 'options' ) );
			} );
		}

	}


    Wolmart.isotopeOptions = {
        itemsSelector: '.grid-item',
        layoutMode: 'masonry',
        percentPosition: true,
        masonry: {
            columnWidth: '.grid-space'
        }
    }
    /**
     * isotopes
     *
     *
     * @requires isotope,imagesLoaded
     * @param {string} selector,
     * @param {object} options
     */
    Wolmart.isotopes = function (selector, options) {
        if (typeof imagesLoaded === 'function' && $.fn.isotope) {
            var self = this;

            Wolmart.$(selector).each(function () {
                var $this = $(this),
                    settings = $.extend(true, {},
                        self.isotopeOptions,
                        Wolmart.parseOptions($this.attr('data-grid-options')),
                        options ? options : {}
                    );
                Wolmart.lazyLoad($this);

                $this.imagesLoaded(function () {
                    settings.customInitHeight && $this.height($this.height());
                    settings.customDelay && Wolmart.call(function () {
                        $this.isotope(settings);
                    }, parseInt(settings.customDelay));

                    $this.isotope(settings);
                });
            });
        }
    }


    /**
     * initNavFilter
     *
     *
     * @requires isotope
     * @param {string} selector
     */
    Wolmart.initNavFilter = function (selector) {
        if ($.fn.isotope) {

            Wolmart.$(selector).on('click', function (e) {
                var $this = $(this),
                    filterValue = $this.attr('data-filter'),
                    filterTarget = $this.parent().parent().attr('data-target');

                (filterTarget ? $(filterTarget) : $('.grid'))
                    .isotope({ filter: filterValue })
                    .isotope('on', 'arrangeComplete', function () {
                        Wolmart.$window.trigger('appear.check');
                    });

                $this.parent().siblings().children().removeClass('active');
                $this.addClass('active');
                e.preventDefault();
            })
        }
    }


    /**
     * ratingTooltip
     *
     *
     * Find all .ratings-full from root, and initialized tooltip.
     * @param {HTMLElement} root
     */
    // Wolmart.ratingTooltip = function (root) {
    //     var els = Wolmart.byClass('ratings-full', root ? root : document.body),
    //         len = els.length;
    //     var ratingHandler = function () {
    //         var res = parseInt( this.firstElementChild.style.width.slice( 0, -1 ) ) / 20;
    //         this.lastElementChild.innerText = res ? res.toFixed(2) : res;
    //     }
    //     for (var i = 0; i < len; ++i) {
    //         els[i].addEventListener('mouseover', ratingHandler);
    //         els[i].addEventListener('touchstart', ratingHandler, { passive: true });
    //     }
    // }


    /**
     * setProgressBar
     *
     *
     * Find all .progress-bar and set its value
     * @param { String } selector
     */
    Wolmart.setProgressBar = function (selector) {
        Wolmart.$(selector).each(function () {
            var $this = $(this),
                sales_count = $this.parent().find('mark')[0].innerHTML,
                percent = '';
            if (-1 != sales_count.indexOf('%')) {
                percent = sales_count;
            } else if (-1 != sales_count.indexOf('/')) {
                percent = parseInt(sales_count.split('/')[0]) / parseInt(sales_count.split('/')[1]) * 100;
                percent = percent.toFixed(2).toString() + '%';
            }

            $this.find('span').css('width', percent);
        });
    }


    /**
     * alert
     *
     * Register events for alert
     *
     * @param {string} selector
     */
    Wolmart.alert = function (selector) {
        Wolmart.$body.on('click', selector + ' .btn-close', function (e) {
            e.preventDefault();
            $(this).closest(selector).fadeOut(function () {
                $(this).remove();
            });
        });
    }


    /**
     * accordion
     *
     * Register events for accordion
     *
     * @param {String} selector
     */
    Wolmart.accordion = function (selector) {
        Wolmart.$body.on('click', selector, function (e) {
            var $this = $(this),
                $body = $this.closest('.card').find($this.attr('href')),
                $parent = $this.closest('.accordion');

            e.preventDefault();

            if (0 === $parent.find(".collapsing").length && 0 === $parent.find(".expanding").length) {
                if ($body.hasClass('expanded')) {
                    if (!$parent.hasClass('radio-type'))
                        toggleSlide($body);
                } else if ($body.hasClass('collapsed')) {
                    if ($parent.find('.expanded').length > 0) {
                        if (Wolmart.isIE) {
                            toggleSlide($parent.find('.expanded'), function () {
                                toggleSlide($body);
                            });

                        } else {
                            toggleSlide($parent.find('.expanded'));
                            toggleSlide($body);
                        }
                    } else {
                        toggleSlide($body);
                    }
                }
            }
        });

        var toggleSlide = function ($wrap, cb) {
            var $header = $wrap.closest('.card').find(selector);
            if ($wrap.hasClass('expanded')) {
                $header.removeClass('collapse').addClass('expand');
                $wrap.addClass('collapsing').slideUp(300, function () {
                    $wrap.removeClass('expanded collapsing').addClass('collapsed');
                    cb && cb();
                });
            } else if ($wrap.hasClass("collapsed")) {
                $header.removeClass("expand").addClass("collapse");
                $wrap.addClass("expanding").slideDown(300, function () {
                    $wrap.removeClass("collapsed expanding").addClass("expanded");
                    cb && cb();
                });
            }
        };
    }


    Wolmart.animationOptions = {
        name: 'fadeIn',
        duration: '1.2s',
        delay: '.2s'
    }

    /**
     * appearAnimate
     *
     *
     * @param {String} selector
     */
    Wolmart.appearAnimate = function (selector) {
        Wolmart.$(selector).each(function () {
            var el = this;

            Wolmart.appear(el, function () {
                if (el.classList.contains('appear-animate')) {
                    var settings = $.extend({}, Wolmart.animationOptions, Wolmart.parseOptions(el.getAttribute('data-animation-options')));

                    setTimeout(function () {
                        el.style['animation-duration'] = settings.duration;
                        el.classList.add(settings.name);
                        el.classList.add('appear-animation-visible');
                    }, settings.delay ? Number(settings.delay.slice(0, -1)) * 1000 : 0 );
                }
            });
        });
    }


    /**
     * countDown
     *
     *
     * @param {String} selector
     */
    Wolmart.countDown = function (selector) {
        if ($.fn.countdown) {
            Wolmart.$(selector).each(function () {
                var $this = $(this),
                    untilDate = $this.data('until'),
                    compact = $this.data('compact'),
                    dateFormat = (!$this.data('format')) ? 'DHMS' : $this.data('format'),
                    newLabels = (!$this.data('labels-short')) ?
                        ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'] :
                        ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Mins', 'Secs'],
                    newLabels1 = (!$this.data('labels-short')) ?
                        ['Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'] :
                        ['Year', 'Month', 'Week', 'Day', 'Hour', 'Min', 'Sec'];

                var newDate;

                // Split and created again for ie and edge
                if (!$this.data('relative')) {
                    var untilDateArr = untilDate.split(", "), // data-until 2019, 10, 8 - yy,mm,dd
                        newDate = new Date(untilDateArr[0], untilDateArr[1] - 1, untilDateArr[2]);
                } else {
                    newDate = untilDate;
                }

                $this.countdown({
                    until: newDate,
                    format: dateFormat,
                    padZeroes: true,
                    compact: compact,
                    compactLabels: [' y', ' m', ' w', ' days, '],
                    timeSeparator: ' : ',
                    labels: newLabels,
                    labels1: newLabels1
                });
            });
            //$('.product-countdown, .countdown').countdown('pause');
        }
    }

    /**
     * priceSlider
     *
     * Create Price Slider
     *
     * @requires noUiSlider
     * @param {string} selector
     * @param {object} option
     */
    Wolmart.priceSlider = function (selector, option) {
        if (typeof noUiSlider === 'object') {
            Wolmart.$(selector).each(function () {
                var self = this;

                noUiSlider.create(self, $.extend(true, {
                    start: [0, 400],
                    connect: true,
                    step: 1,
                    range: {
                        min: 0,
                        max: 635
                    }
                }, option));

                // Update Price Value
                self.noUiSlider.on('update', function (values, handle) {
                    var values = values.map(function (value) {
                        return '$' + parseInt(value);
                    });

                    $(self).parent().find('.filter-price-range').text(values.join(' - '));
                });
            });
        }
    }


    /**
     * Wolmart Stickysidebar Options
     */
    Wolmart.stickySidebarOptions = {
        autoInit: true,
        minWidth: 991,
        containerSelector: '.sticky-sidebar-wrapper',
        autoFit: true,
        activeClass: 'sticky-sidebar-fixed',
        top: 0,
        bottom: 0
    };

    /**
     * stickySidebar
     *
     *
     * @requires themeSticky
     * @param {string} selector
     */
    Wolmart.stickySidebar = function (selector) {
        if ($.fn.themeSticky) {
            var top = 0;
            if ( ! $('.sticky-sidebar > .filter-actions').length && $(window).width() >= 992) {
                $('.sticky-content.fix-top').each(function (e) {
                    if (!$(this).hasClass('sticky-toolbox')) {
                        var $fixed = $(this).hasClass('fixed');
                        top += $(this).addClass('fixed').outerHeight();
                        $fixed || $(this).removeClass('fixed');
                    }
                });
            }

            Wolmart.$(selector).each(function () {
                var $this = $(this);
                $this.themeSticky($.extend({}, Wolmart.stickySidebarOptions, {padding: {top: top}}, Wolmart.parseOptions($this.attr('data-sticky-options'))));
            });

            function recalcSticky() {
                Wolmart.$(selector).trigger('recalc.pin');
                $(window).trigger('appear.check');
            }

            setTimeout(recalcSticky, 300);
            Wolmart.$window.on('click', '.tab .nav-link', function () {
                setTimeout(recalcSticky);
            });
        }
    }

    /**
     * Wolmart Image Zoom Options
     */
    Wolmart.zoomImageOptions = {
        responsive: true,
        borderSize: 0,
        zoomType: 'inner',
        onZoomIn: true,
        magnify: 1.1,
    };
    Wolmart.zoomImageObjects = [];

    /**
     * zoomImageOptions
     *
     *
     * @requires zoom
     * @param {jQuery} $el
     */
    Wolmart.zoomImage = function ($el) {

        if ($.fn.zoom && $el) {
            (('string' === typeof $el) ? $($el) : $el)
                .find('img').each(function () {
                    var $this = $(this);
                    Wolmart.zoomImageOptions.target = $this.parent();
                    Wolmart.zoomImageOptions.url = $this.attr('data-zoom-image');
                    $this.zoom( Wolmart.zoomImageOptions );
                    Wolmart.zoomImageObjects.push($this);
                });
        }
    }

    /**
     * zoomImageOnResize
     *
     */
    Wolmart.zoomImageOnResize = function () {
        Wolmart.zoomImageObjects.forEach(function ($img) {
            $img.each(function () {
                var zoom = $(this).data('zoom');
                zoom && zoom.refresh();
            })
        });
    }


    /**
     * Product sticky
     *
     */



    /**
     * lazyLoad
     *
     *
     * lazyload element
     * @param {string} selector
     * @param {boolean} force
     */
    Wolmart.lazyLoad = function (selector, force) {
        function load() {
            this.setAttribute('src', this.getAttribute('data-src'));
            this.addEventListener('load', function () {
                this.style['padding-top'] = '';
                this.classList.remove('lazy-img');
            });
        }

        // Lazyload Images
        Wolmart.$(selector).find('.lazy-img').each(function () {
            if ('undefined' != typeof force && force) {
                load.call(this);
            } else {
                Wolmart.appear(this, load);
            }
        });
    }


    /**
     * initPopup
     *
     */
    Wolmart.initPopup = function (options, preset) {

        // Newsletter popup
        if (Wolmart.$body.hasClass('') && Wolmart.getCookie('hideNewsletterPopup') !== 'true') {
            setTimeout(function () {
                Wolmart.popup({
                    items: {
                        src: '/frontend/assets/ajax/newsletter.html'
                    },
                    type: 'ajax',
                    tLoading: '',
                    mainClass: 'mfp-newsletter mfp-fadein-popup',
                    callbacks: {
                        beforeClose: function () {
                            // if "do not show" is checked
                            $('#hide-newsletter-popup')[0].checked && Wolmart.setCookie('hideNewsletterPopup', true, 7);
                        }
                    },
                });
            }, 7500);
        }

        // Video popup
        Wolmart.$body.on( 'click', '.btn-iframe', function ( e ) {
            e.preventDefault();
            Wolmart.popup( {
                items: {
                    src: '<video src="' + $( e.currentTarget ).attr( 'href' ) + '" autoplay loop controls>',
                    type: "inline"
                },
                mainClass: "mfp-video-popup"
            }, "video" )
        } );

        // Login popup
        Wolmart.$body
            .on('click', '.sign-in', function(e) {
                e.preventDefault();
                console.log('login')

                Wolmart.popup ( {
                    items: {
                        src: $( e.currentTarget ).attr( 'href' )
                    }
                }, 'login' )
            })

            .on( 'click', '.register', function ( e ) {
                e.preventDefault();
                console.log('reg')

                Wolmart.popup( {
                    items: {
                        src: $( e.currentTarget ).attr( 'href' )
                    },
                    callbacks: {
                        ajaxContentAdded: function () {
                            this.wrap.find( '[href="#sign-up"]' ).click();
                        }
                    }
                }, 'login' )
            } );

    }

    /**
     * initNotificationAlert
     *
     */
    Wolmart.initNotificationAlert = function () {
        if (Wolmart.$body.hasClass('has-notification')) {
            setTimeout(function () {
                Wolmart.$body.addClass('show-notification');
            }, 5000);
        }
    }

    /**
     * countTo
     *
     *
     * @requires jQuery.countTo
     * @param {String} selector
     */
    Wolmart.countTo = function (selector) {
        if ($.fn.countTo) {
            Wolmart.$(selector).each(function () {
                Wolmart.appear(this, function () {
                    var $this = $(this);
                    setTimeout(function () {
                        $this.countTo({
                            onComplete: function () {
                                $this.addClass('complete');
                            }
                        })
                    }, 300);
                })
            });
        }
    }

    Wolmart.minipopupOption = {
        // info
        productClass: '', // ' product-cart', ' product-list-sm'
        imageSrc: '',
        imageLink: '#',
        name: '',
        nameLink: '#', // 'product.html',
        message: '',
        actionTemplate: '',
        isPurchased: false,

        // option
        delay: 4000, // milliseconds
        space: 20,

        // template

        template: '<div class="minipopup-box">' +
                    '<div class="product product-list-sm {{productClass}}">' +
                    '<figure class="product-media">' +
                    '<a href="{{imageLink}}">' +
                    '<img src="{{imageSrc}}" alt="Product" width="80" height="90" />' +
                    '</a></figure>' +
                    '<div class="product-details">' +
                    '<h4 class="product-name"><a href="{{nameLink}}">{{name}}</a></h4>' +
                    '{{message}}</div></div>' +
                    '<div class="product-action">{{actionTemplate}}</div></div>',

    }
    /**
	 * @class MiniPopup
	 */
    Wolmart.Minipopup = (function () {
        // Private Members
        var $area,
            offset = 0,
            boxes = [],
            isPaused = false,
            timers = [],
            timerId = false,
            timerInterval = 200,
            timerClock = function () {
                if (isPaused) {
                    return;
                }
                for (var i = 0; i < timers.length; ++i) {
                    (timers[i] -= timerInterval) <= 0 && this.close(i--);
                }
            }

        // Public Members
        return {
            init: function () {
                // init area
                var self = this;
                var area = document.createElement('div');
                area.className = "minipopup-area";
                Wolmart.byClass('page-wrapper')[0].appendChild(area);
                $area = $(area);

                // bind methods
                this.close = this.close.bind(this);
                timerClock = timerClock.bind(this);
            },

            open: function (options, callback) {
                var self = this,
                    settings = $.extend(true, {}, Wolmart.minipopupOption, options),
                    $box;

                $box = $(Wolmart.parseTemplate(settings.template, settings));
                self.space = settings.space;

                // open
                var $img = $box.appendTo($area).css('top', - offset).find("img");
                $img.length && $img.on('load', function () {
                    offset += $box[0].offsetHeight + self.space;

                    $box.addClass('show');
                    if ($box.offset().top - window.pageYOffset < 0) {
                        self.close();
                        $box.css('top', - offset + $box[0].offsetHeight + self.space);
                    }
                    $box.on('mouseenter', function () { self.pause() })
                        .on('mouseleave', function () { self.resume() })
                        .on('touchstart', function (e) { self.pause(); e.stopPropagation(); })
                        .on('mousedown', function () {
                            $(this).addClass('focus');
                        })
                        .on('mouseup', function () {
                            self.close($(this).index());
                        });
                    Wolmart.$body.on('touchstart', function () {
                        self.resume();
                    });

                    boxes.push($box);

                    if (!timers.length) {
                        timerId = setInterval(timerClock, timerInterval);
                    }
                    timers.push(settings.delay);

                    callback && callback($box);
                });
            },

            close: function (indexToClose) {
                var self = this,
                    index = ('undefined' === typeof indexToClose) ? 0 : indexToClose,
                    $box = boxes.splice(index, 1)[0];


                // remove timer
                timers.splice(index, 1)[0];

                var height = $box[0].offsetHeight;

                // remove box
                offset -= height + self.space;
                $box.removeClass('show');
                setTimeout(function () {
                    $box.remove();
                }, 300);

                // slide down other boxes
                boxes.forEach(function ($box, i) {
                    if (i >= index && $box.hasClass('show')) {
                        $box.stop(true, true).animate({
                            top: parseInt($box.css('top')) + height + 20
                        }, 600, 'easeOutQuint');
                    }
                });

                // clear timer
                boxes.length || clearTimeout(timerId);
            },

            pause: function () {
                isPaused = true;
            },

            resume: function () {
                isPaused = false;
            }
        }
    })();

    /**
     * Sticky footer's header search toggle
     * @function headerSearchToggle
     * @param {String} selector
     */

    Wolmart.headerToggleSearch = function ( selector ) {
        var $search = Wolmart.$( selector );
        $search.find( '.form-control' )
            .on( 'focusin', function ( e ) {
                $search.addClass( 'show' );
            } )
            .on( 'focusout', function ( e ) {
                $search.removeClass( 'show' );
            } );

        // Initialize sticky footer's search toggle.
        Wolmart.$body.on( 'click', '.sticky-footer .search-toggle', function ( e ) {
            $( this ).parent().toggleClass( 'show' );
            e.preventDefault();
        } );
    }
    Wolmart.scrollTo = function (target, duration) {
		var _duration = typeof duration == 'undefined' ? 0 : duration;
		var offset;

		if (typeof target == 'number') {
			offset = target;
		} else {
			var $target = Wolmart.$(target);
			if (!$target.length || $target.css('display') == 'none') {
				return;
			}

			var offset = $target.offset().top;
			var $wpToolbar = $('#wp-toolbar');
			window.innerWidth > 600 && $wpToolbar.length && (offset -= $wpToolbar.parent().outerHeight());
			$('.sticky-content.fix-top.fixed').each(function () {
				offset -= this.offsetHeight;
			})
		}

		$('html,body').stop().animate({ scrollTop: offset }, _duration);
	}
})(jQuery);

(function ($) {
    /**
     * Wolmart Menu Plugins
     */

    // Private members
    var showMobileMenu = function (e) {
        e.preventDefault();
        Wolmart.$body.addClass('mmenu-active');

    };
    var hideMobileMenu = function (e) {
        e.preventDefault();
        Wolmart.$body.removeClass('mmenu-active');
    };

    /**
     * Init Menu
     */
    var Menu = {
        init: function () {
            this.initMenu();
            this.initCategoryMenu();
            this.initMobileMenu();
            this.initFilterMenu();
            this.initCollapsibleWidget();
        },
        initMenu: function () {
            // setup menu
            $('.menu li').each(function () {
                if (this.lastElementChild && (
                    this.lastElementChild.tagName === 'UL' ||
                    this.lastElementChild.classList.contains('megamenu')) &&
                    !$(this).parent().hasClass('megamenu')
                ) {
                    this.classList.add('has-submenu');
                    !this.lastElementChild.classList.contains('megamenu') && this.lastElementChild.classList.add('submenu');
                }
            });

            // calc megamenu position
            Wolmart.$window.on('resize', function () {
                $('.main-nav megamenu').each(function () {
                    var $this = $(this),
                        left = $this.offset().left,
                        outerWidth = $this.outerWidth(),
                        offset = (left + outerWidth) - (window.innerWidth - 20);
                    if (offset > 0 && left > 20) {
                        $this.css('margin-left', -offset);
                    }
                });
            });
        },
        initCategoryMenu: function () {
            // category dropdown menu
            var $menu = $('.category-dropdowns');
            if ($menu.length) {
                var $box = $menu.find('.dropdown-box');

                if ($box.length) {
                    var top = $('.main').offset().top + $box[0].offsetHeight;

                    if (window.pageYOffset <= top || window.innerWidth < 992) {
                        $menu.removeClass('show');
                    }

                    window.addEventListener('scroll', function () {
                        if (window.pageYOffset <= top && window.innerWidth >= 992) {
                            $menu.removeClass('show');
                        }
                    }, { passive: true });

                    $('.category-toggle').on("click", function (e) {
                        e.preventDefault();
                    });

                    $menu.on("mouseover", function (e) {
                        if ($menu.hasClass('menu-fixed') && window.pageYOffset > top && window.innerWidth >= 992) {
                            $menu.addClass('show');
                        } else if (!$menu.hasClass('menu-fixed') && window.innerWidth >= 992) {
                            $menu.addClass('show');
                        }
                    })

                    $menu.on("mouseleave", function (e) {
                        if ($menu.hasClass('menu-fixed') && window.pageYOffset > top && window.innerWidth >= 992) {
                            $menu.removeClass('show');
                        } else if (!$menu.hasClass('menu-fixed') && window.innerWidth >= 992) {
                            $menu.removeClass('show');
                        }
                    })
                }
                if ($menu.hasClass('with-sidebar')) {
                    var sidebar = Wolmart.byClass('sidebar');
                    if (sidebar.length) {
                        $menu.find('.dropdown-box').css('width', sidebar[0].offsetWidth - 20);

                        // set category menu's width same as sidebar.
                        Wolmart.$window.on('resize', function () {
                            $menu.find('.dropdown-box').css('width', (sidebar[0].offsetWidth - 20));
                        });
                    }
                }
            }
        },
        initMobileMenu: function () {
            $('.mobile-menu li, .toggle-menu li').each(function () {
                if (this.lastElementChild && (
                    this.lastElementChild.tagName === 'UL' ||
                    this.lastElementChild.classList.contains('megamenu'))
                ) {
                    var span = document.createElement('span');
                    span.className = "toggle-btn";
                    this.firstElementChild.appendChild(span);
                    // this.firstElementChild.insertAdjacentHTML('beforeend', '<span class="toggle-btn"></span>' );
                }
            });
            $('.mobile-menu-toggle').on('click', showMobileMenu);
            $('.mobile-menu-overlay').on('click', hideMobileMenu);
            $('.mobile-menu-close').on('click', hideMobileMenu);
            Wolmart.$window.on('resize', hideMobileMenu);
        },
        initFilterMenu: function () {
            $('.search-ul li').each(function () {
                if (this.lastElementChild && this.lastElementChild.tagName === 'UL') {
                    var i = document.createElement('i');
                    i.className = "la la-angle-down";
                    this.classList.add('with-ul');
                    this.firstElementChild.appendChild(i);
                }
            });
            $('.with-ul > a i, .toggle-btn').on('click', function (e) {
                $(this).parent().next().slideToggle(300).parent().toggleClass("show");
                e.preventDefault();
            });
        },
        initCollapsibleWidget: function () {
            // Add toggle span
            $('.widget-collapsible .widget-title').each(function () {
                var span = document.createElement('span');
                span.className = 'toggle-btn';
                this.appendChild(span);
            });

            // Slide Toggle
            $('.widget-collapsible .widget-title').on('click', function (e) {
                var $this = $(this),
                    $body = $this.siblings('.widget-body');

                $this.hasClass('collapsed') || $body.css('display', 'block');

                $body.stop().slideToggle(300);
                $this.toggleClass('collapsed');

                // if collapsible widget exists in sticky sidebar
                setTimeout(function () {
                    $('.sticky-sidebar').trigger('recalc.pin');
                }, 300);
            });
        }
    }

    Wolmart.menu = Menu;
})(jQuery);

/**
 * Wolmart Dependent Plugin - Slider
 *
 * @requires OwlCarousel
 * @instance multiple
 */

function Slider($el, options) {
    return this.init($el, options);
}

(function ($) {

    // Private Properties
    var onInitialize = function (e) {
        var cls = this.getAttribute( 'class' );
        var match = cls.match( /row|gutter\-\w\w|cols\-\d|cols\-\w\w-\d/g );
        if ( match ) {
            this.setAttribute( 'class', cls.replace( /row|gutter\-\w\w|cols\-\d|cols\-\w\w-\d/g, '' ).replace( /\s+/, ' ' ) );
        }
        if (this.classList.contains("animation-slider")) {
            var els = this.children,
                len = els.length;
            for (var i = 0; i < len; ++i) {
                els[i].setAttribute('data-index', i + 1);
            }
        }
    }
    var onInitialized = function (e) {
        var els = this.firstElementChild.firstElementChild.children,
            i,
            len = els.length;
        for (i = 0; i < len; ++i) {
            if (!els[i].classList.contains('active')) {
                var animates = Wolmart.byClass('appear-animate', els[i]),
                    j;
                for (j = animates.length - 1; j >= 0; --j) {
                    animates[j].classList.remove('appear-animate');
                }
            }
        }
    }
    var onTranslated = function ( e ) {
        $( window ).trigger( 'appear.check' );

        // Video Play
        var $el = $( e.currentTarget ),
            $activeVideos = $el.find( '.owl-item.active video' );

        $el.find( '.owl-item:not(.active) video' ).each( function () {
            if ( !this.paused ) {
                $el.trigger( 'play.owl.autoplay' );
            }
            this.pause();
            this.currentTime = 0;
        } );

        if ( $activeVideos.length ) {
            if ( true === $el.data( 'owl.carousel' ).options.autoplay ) {
                $el.trigger( 'stop.owl.autoplay' );
            }
            $activeVideos.each( function () {
                this.paused && this.play();
            } );
        }
    }
    var onSliderInitialized = function (e) {
        var self = this,
            $el = $(e.currentTarget);
        // carousel content animation
        $el.find('.owl-item.active .slide-animate').each(function () {
            var $animation_item = $(this),
                settings = $.extend(true, {},
                    Wolmart.animationOptions,
                    Wolmart.parseOptions($animation_item.data('animation-options'))
                ),
                duration = settings.duration,
                delay = settings.delay,
                aniName = settings.name;

            setTimeout(function () {
                $animation_item.css('animation-duration', duration);
                $animation_item.css('animation-delay', delay);
                $animation_item.addClass(aniName);

                if ($animation_item.hasClass('maskLeft')) {
                    $animation_item.css('width', 'fit-content');
                    var width = $animation_item.width();
                    $animation_item.css('width', 0).css(
                        'transition',
                        'width ' + (duration ? duration : '0.75s') + ' linear ' + (delay ? delay : '0s'));
                    $animation_item.css('width', width);
                }
                duration = duration ? duration : '0.75s';
                var temp = Wolmart.requestTimeout(function () {
                    $animation_item.addClass('show-content');
                }, (delay ? Number((delay).slice(0, -1)) * 1000 + 200 : 200));

                self.timers.push(temp);
            }, 300);
        });
    }
    var onSliderResized = function (e) {
        $(e.currentTarget).find('.owl-item.active .slide-animate').each(function () {
            var $animation_item = $(this);
            $animation_item.addClass('show-content');
            $animation_item.attr('style', '');
        });
    }
    var onSliderTranslate = function (e) {
        var self = this,
            $el = $( e.currentTarget );
        self.translateFlag = 1;
        self.prev = self.next;
        $el.find( '.owl-item .slide-animate' ).each( function () {
            var $animation_item = $( this ),
                settings = $.extend( true, {}, Wolmart.animationOptions, Wolmart.parseOptions( $animation_item.data( 'animation-options' ) ) );
            $animation_item.removeClass( settings.name );
        } );
    }
    var onSliderTranslated = function (e) {
        var self = this,
            $el = $( e.currentTarget );
        if ( 1 == self.translateFlag ) {
            self.next = $el.find( '.owl-item' ).eq( e.item.index ).children().attr( 'data-index' );
            $el.find( '.show-content' ).removeClass( 'show-content' );
            if ( self.prev != self.next ) {
                $el.find( '.show-content' ).removeClass( 'show-content' );
                /* clear all animations that are running. */
                if ( $el.hasClass( "animation-slider" ) ) {
                    for ( var i = 0; i < self.timers.length; i++ ) {
                        Wolmart.deleteTimeout( self.timers[ i ] );
                    }
                    self.timers = [];
                }
                $el.find( '.owl-item.active .slide-animate' ).each( function () {
                    var $animation_item = $( this ),
                        settings = $.extend( true, {}, Wolmart.animationOptions, Wolmart.parseOptions( $animation_item.data( 'animation-options' ) ) ),
                        duration = settings.duration,
                        delay = settings.delay,
                        aniName = settings.name;

                    $animation_item.css( 'animation-duration', duration );
                    $animation_item.css( 'animation-delay', delay );
                    $animation_item.css( 'transition-property', 'visibility, opacity' );
                    $animation_item.css( 'transition-delay', delay );
                    $animation_item.css( 'transition-duration', duration );
                    $animation_item.addClass( aniName );

                    duration = duration ? duration : '0.75s';
                    $animation_item.addClass( 'show-content' );
                    var temp = Wolmart.requestTimeout( function () {
                        $animation_item.css( 'transition-property', '' );
                        $animation_item.css( 'transition-delay', '' );
                        $animation_item.css( 'transition-duration', '' );
                        self.timers.splice( self.timers.indexOf( temp ), 1 )
                    }, ( delay ? Number( ( delay ).slice( 0, -1 ) ) * 1000 + Number( ( duration ).slice( 0, -1 ) ) * 500 : Number( ( duration ).slice( 0, -1 ) ) * 500 ) );
                    self.timers.push( temp );
                } );
            } else {
                $el.find( '.owl-item' ).eq( e.item.index ).find( '.slide-animate' ).addClass( 'show-content' );
            }
            self.translateFlag = 0;
        }
    }

    // Public Properties
    Slider.defaults = {
        responsiveClass: true,
        navText: ['<i class="w-icon-angle-left">', '<i class="w-icon-angle-right">'],
        checkVisible: false,
        items: 1,
        smartSpeed: navigator.userAgent.indexOf("Edge") > -1 ? 200 : 700,
        autoplaySpeed: navigator.userAgent.indexOf("Edge") > -1 ? 200 : 1000,
        autoplayTimeout: 5000
    }

    Slider.zoomImage = function () {
        Wolmart.zoomImage(this.$element);
    }

    Slider.zoomImageRefresh = function () {
        this.$element.find('img').each(function () {
            var $this = $(this);

            if ($.fn.zoom) {
                var zoom = $this.data('zoom');
                if (typeof zoom !== 'undefined') {
                    zoom.refresh();
                } else {
                    Wolmart.zoomImageOptions.zoomContainer = $this.parent();
                    $this.zoom(Wolmart.zoomImageOptions);
                }
            }
        });
    }

    Slider.presets = {
        'intro-slider': {
            animateIn: 'fadeIn',
            animateOut: 'fadeOut'
        },
        'product-single-carousel': {
            dots: false,
            nav: true,
            onInitialize: Slider.zoomImage,
            onRefreshed: Slider.zoomImageRefresh
        },
        'product-gallery-carousel': {
            dots: false,
            nav: true,
            margin: 30,
            items: 1,
            responsive: {
                576: {
                    items: 2
                }
            },
            onInitialized: Slider.zoomImage,
            onRefreshed: Slider.zoomImageRefresh
        }
    }

    Slider.prototype.init = function ( $el, options ) {
        this.timers = [];
        this.translateFlag = 0;
        this.prev = 1;
        this.next = 1;

        Wolmart.lazyLoad( $el, true );

        var classes = $el.attr( 'class' ).split( ' ' ),
            settings = $.extend( true, {}, Slider.presets, Slider.defaults );

        // extend preset options
        classes.forEach( function ( className ) {
            var preset = Slider.presets[ className ];
            preset && $.extend( true, settings, preset );
        } );

        var $videos = $el.find( 'video' );
        $videos.each( function () {
            this.loop = false;
        } );

        // extend user options
        $.extend( true, settings, Wolmart.parseOptions( $el.attr( 'data-owl-options' ) ), options );

        onSliderInitialized = onSliderInitialized.bind( this );
        onSliderTranslate = onSliderTranslate.bind( this );
        onSliderTranslated = onSliderTranslated.bind( this );

        // init
        $el.on( 'initialize.owl.carousel', onInitialize )
            .on( 'initialized.owl.carousel', onInitialized )
            .on( 'translated.owl.carousel', onTranslated );

        // if animation slider
        $el.hasClass( 'animation-slider' ) &&
            $el.on( 'initialized.owl.carousel', onSliderInitialized )
                .on( 'resized.owl.carousel', onSliderResized )
                .on( 'translate.owl.carousel', onSliderTranslate )
                .on( 'translated.owl.carousel', onSliderTranslated );

        $el.owlCarousel( settings );

        // if slider has custom dots container
        if ( settings.dotsContainer ) {
            var $dots = $( settings.dotsContainer );
            $dots.find( 'a' ).on( 'click', function ( e ) {
                e.preventDefault();

                var $this = $( this );

                if ( !$this.hasClass( 'active' ) ) {
                    var index = $this.index(),
                        $carousel = $dots.parent().find( '.owl-carousel' );

                    $carousel.trigger( 'to.owl.carousel', [index] );
                    $this.addClass( 'active' ).siblings().removeClass( 'active' );
                }
            } )
        }
    }

    Wolmart.slider = function (selector, options) {
        Wolmart.$(selector).each(function () {
            var $this = $(this);

            Wolmart.call(function () {
                new Slider($this, options);
            });
        });
    }
})(jQuery);

/**
 * Wolmart Plugin - Sidebar
 *
 * @instance multiple
 *
 * sidebar active class will be added to body tag: "sidebar class" + "-active"
 */
function Sidebar(name) {
    return this.init(name);
}

(function ($) {
    'use strict';

    var onResizeNavigationStyle = function () {
        if (window.innerWidth < 992) {
            this.$sidebar.find('.sidebar-content').removeAttr('style');
            this.$sidebar.find('.sidebar-content').attr('style', '');
            this.$sidebar.find('.toolbox').children(':not(:first-child)').removeAttr('style');
        }
    }

    Sidebar.prototype.init = function (name) {
        var self = this;

        self.name = name;
        self.$sidebar = $('.' + name);
        self.isNavigation = false;
        // If sidebar exists
        if (self.$sidebar.length) {

            // check if navigation style
            self.isNavigation = self.$sidebar.hasClass('sidebar-fixed') && self.$sidebar.parent().hasClass('toolbox-wrap');

            if (self.isNavigation) {
                onResizeNavigationStyle = onResizeNavigationStyle.bind(this);
                Wolmart.$window.on('resize', onResizeNavigationStyle);
            }

            Wolmart.$window.on('resize', function () {
                Wolmart.$body.removeClass(name + '-active');
            });

            // Register toggle event
            self.$sidebar.find('.sidebar-toggle, .sidebar-toggle-btn')
                .add(name === 'sidebar' ? '.left-sidebar-toggle' : '.' + name + '-toggle')
                .on('click', function (e) {
                    self.toggle();
                    $(this).blur();
                    e.preventDefault();
                });

            // Register close event
            self.$sidebar.find('.sidebar-overlay, .sidebar-close')
                .on('click', function (e) {
                    Wolmart.$body.removeClass(name + '-active');
                    e.preventDefault();
                });
        }
        return false;
    }

    Sidebar.prototype.toggle = function () {
        var self = this;

        // if fixed sidebar
        if (window.innerWidth >= 992 && self.$sidebar.hasClass('sidebar-fixed')) {

            // is closed ?
            var isClosed = self.$sidebar.hasClass('closed');

            // if navigation style's sidebar
            if (self.isNavigation) {

                isClosed || self.$sidebar.find('.filter-clean').hide();

                self.$sidebar.siblings('.toolbox').children(':not(:first-child)').fadeToggle('fast');

                self.$sidebar
                    .find('.sidebar-content')
                    .stop()
                    .animate(
                        {
                            'height': 'toggle',
                            'margin-bottom': isClosed ? 'toggle' : -6
                        }, function () {
                            $(this).css('margin-bottom', '');
                            isClosed && self.$sidebar.find('.filter-clean').fadeIn('fast');
                        }
                    );
            }

            // If shop sidebar
            if (self.$sidebar.hasClass('shop-sidebar')) {

                // change column
                var $wrapper = $('.main-content .product-wrapper');
                if ($wrapper.length) {
                    if ($wrapper.hasClass('product-lists')) {

                        // if list type, toggle 2 cols or 1 col
                        $wrapper.toggleClass('row cols-xl-2', !isClosed);
                    } else {

                    }
                }
            }
        } else {
            self.$sidebar.find('.sidebar-overlay .sidebar-close').css('margin-left', - (window.innerWidth - document.body.clientWidth));

            // activate sidebar
            Wolmart.$body
                .toggleClass(self.name + '-active')
                .removeClass('closed');
        }

        setTimeout(function () {
            $(window).trigger('appear.check');
        }, 400);
    }

    Wolmart.sidebar = function (name) {
        return new Sidebar().init(name);
    }
})(jQuery);



/**
 * Wolmart Dependent Plugin - Shop
 *
 * @requires
 */
(function ($) {

    var initSelectMenu = function () {

        var selector = '.select-menu';

        // show or hide select menu
        Wolmart.$body.on( 'mousedown', '.select-menu', function ( e ) {
            var $selectMenu = $( e.currentTarget ),
                $target = $( e.target ),
                isOpened = $selectMenu.hasClass( 'opened' );

            // close all select menu
            $( '.select-menu' ).removeClass( 'opened' );

            if ( $selectMenu.is( $target.parent() ) ) { // if select menu toggle is clicked
                !isOpened && $selectMenu.addClass( 'opened' );

                e.stopPropagation();
            } else { // if select menu item is clicked

                $target.parent().toggleClass( 'active' ); // add active class to li tag

                if ( $target.parent().hasClass( 'active' ) ) {

                    // if only clean all button remains
                    if ( $( '.selected-items' ).children().length < 2 ) {
                        // show selected items
                        $( '.selected-items' ).show();
                    }

                    // add selected item
                    $( '<a href="#" class="selected-item">' + $target.text().split( '(' )[0] + '<i class="la la-close"></i></a>' )
                        .insertBefore( '.selected-items .filter-clean' )
                        .hide().fadeIn()  // hide and show item with effect - fadeIn
                        .data( 'link', $target.parent() );
                } else {
                    // remove selected item from selected items
                    $( '.selected-items > .selected-item' ).filter( function ( i, el ) {
                        return el.innerText == $target.text().split( '(' )[0];
                    } ).fadeOut( function () {
                        $( this ).remove();

                        // if only clean all buttpn remains
                        if ( $( '.selected-items' ).children().length < 2 ) {
                            // then hide selected items
                            $( '.selected-items' ).hide();
                        }
                    } )
                }
            }
        } );

        // Clean selected items
        $( '.selected-items .filter-clean' ).on( 'click', function ( e ) {
            var $clean = $( this );
            $clean.siblings().each( function () {
                var $link = $( this ).data( 'link' );
                $link && $link.removeClass( 'active' );
            } );
            $clean.parent().fadeOut( function () {
                $clean.siblings().remove();
            } );
            e.preventDefault();
        } );

        $( '.filter-clean' ).on( 'click', function ( e ) {
            $( '.shop-sidebar .filter-items .active' ).removeClass( 'active' );
            e.preventDefault();
        } );

        Wolmart.$body.on( 'click', '.select-menu a', function ( e ) {
            e.preventDefault();
        } );

        Wolmart.$body.on( 'click', '.selected-item i', function ( e ) {
            $( e.currentTarget ).parent().fadeOut( function () {
                var $this = $( this ),
                    $link = $this.data( 'link' );

                $link && $link.toggleClass( 'active' );
                $this.remove();

                // if only clean all button remains
                if ( $( '.select-items' ).children().length < 2 ) {
                    // then hide select-items
                    $( '.select-items' ).hide();
                }
            } );

            e.preventDefault();
        } );

        // if click outside of select menu, hide select menu
        Wolmart.$body.on( 'mousedown', function ( e ) {
            $( '.select-menu' ).removeClass( 'opened' );
        } );

        Wolmart.$body.on( 'click', '.filter-items a', function ( e ) {
            var $ul = $( this ).closest( '.filter-items' );
            if ( !$ul.hasClass( 'search-ul' ) && !$ul.parent().hasClass( 'select-menu' ) ) {
                $( this ).parent().toggleClass( 'active' );
                e.preventDefault();
            }
        } );
    }

    var initProductCartAction = function () {
        var selector = '.product:not(.product-select) .btn-cart, .product-popup .btn-cart, .home .product-single .btn-cart';
        
        Wolmart.$body.on('click', selector, function (e) {
            console.log('user-id===-------------');
            let stock = $(this).data('stock')
            let order = $('#cart-qty-details').val();
            let userId = $('#userId').val();
          

            e.preventDefault();
            
            if (userId === ''){


                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['error']('You have to login first');
                window.location.href = "/login";
                return false;
            }

            if(stock < order ){
                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['error']('You can not add Product More than Stock');

                return false;
            }

            var $this = $(this),
                $product = $this.closest('.product, .product-popup');

            if ($this.hasClass('disabled')) {
                alert( 'Please select some product options before adding this product to your cart.' );
                return;
            }

            $this.toggleClass('added').addClass('load-more-overlay loading');

            setTimeout(function () {
                $this.removeClass('load-more-overlay loading');

                Wolmart.Minipopup.open({
                    productClass: ' product-cart',
                    name: $product.find('.product-name, .product-title').text(),
                    nameLink: $product.find('.product-name > a, .product-title > a').attr('href'),
                    imageSrc: $product.find('.product-media img, .product-image:first-child img').attr('src'),
                    imageLink: $product.find('.product-name > a').attr('href'),
                    message: '<p>has been added to cart:</p>',
                    actionTemplate: '<a href="/viewcart" class="btn btn-rounded btn-sm">View Cart</a><a href="/checkout" class="btn btn-dark btn-rounded btn-sm">Checkout</a>'
                });
            }, 500);
        });
    }

    var initWishlistAction = function () {
        Wolmart.$body.on('click', '.product:not(.product-single) .btn-wishlist', function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.toggleClass('added').addClass('load-more-overlay loading');

            setTimeout(function () {
                $this.removeClass('load-more-overlay loading');
                $this.toggleClass('w-icon-heart').toggleClass('w-icon-heart-full');
            }, 500);
        });
    }

    var initCompare = function() {
        var products = [],
            $compare = $('.page-wrapper > .compare-popup'),
            productCount, addToProduct, removeProduct, removeAllProduct;

        function initComparePopup() {
            var compareHtml =
                '';

            if ( ! $compare.length && !document.body.classList.contains('docs') ) {
                $('.page-wrapper').append(compareHtml);
                $compare = $('.page-wrapper > .compare-popup');
            }
        }

        function addToCompare(e) {

            var $this = $(this);

            addToProduct = false;

            if ( $this.hasClass( 'added' ) ) {
                returne();
            }
            e.preventDefault();
            $this.toggleClass('added').addClass('load-more-overlay loading');

            setTimeout(function () {
                $this.removeClass('load-more-overlay loading');
                $this.toggleClass('w-icon-compare').toggleClass('w-icon-check-solid');
                $this.attr('href', 'compare.html');

                $compare.addClass('show');
            }, 500);


            var src = $this.closest('.product').find('img').eq(0).attr('src');

            if (products.length >= 4 ) {
                products.shift();
            }
            products.push(src);

            $('.compare-popup li').each(function(i) {
                if (products[i]) {
                    this.innerHTML = '<a href="product-default.html"><figure><img src="' + products[i] + '"/></figure></a>\
                                        <a href="#" class="btn btn-remove"><i class="w-icon-times-solid"></i></a>';
                }
            });

            productCount = products.length;
            compareCount();

        }

        function removeCompare(e) {
            e.preventDefault();
            var $li = $(e.currentTarget).closest('li'),
                $index = $li.index(),
                srcCompare = $li.find('img').attr('src');

            if ( srcCompare ) {
                $('.page-wrapper .product img').each(function() {
                    var srcProduct = this.getAttribute('src');
                    if ( srcProduct == srcCompare) {

                        var $compareButton = $(this).closest('.product').find('.btn-compare');
                        if ($compareButton.length) {
                            $compareButton.removeClass('added').attr('href', '#');
                            $compareButton.toggleClass('w-icon-check-solid').toggleClass('w-icon-compare');
                        }
                    }
                })
            }

            products.splice($index, 1);

            if ( $index == 3) {
                $li.empty();
            }

            $li.nextAll().each(function() {
                $(this).prev().html($(this).html());
            }).last().empty();

            productCount = products.length;
            compareCount();
        }

        function removeAllCompare(e) {
            e.preventDefault();
            removeAllProduct = false;

            $('.page-wrapper .product img').each(function() {
                var $this = $(this);
                var srcProduct = this.getAttribute('src');
                products.forEach(function(srcCompare){
                    if ( srcProduct == srcCompare ) {
                        var $compareButton = $this.closest('.product').find('.btn-compare');
                        if ($compareButton.length) {
                            $compareButton.removeClass('added').attr('href', '#');
                            $compareButton.toggleClass('w-icon-check-solid').toggleClass('w-icon-compare');
                        }
                    }
                });
            })
            products.splice(0, 4);
            productCount = products.length;
            $(this).parent().find('.compare-product-list li').empty();
            compareCount();

        }


        function compareCount () {
            $compare.find('.title').after('<p class="compare-count text-center text-light mb-0">(' + productCount +' Products)</p>');
            if ( $compare.find('.compare-count').length > 1) {
                $compare.find('p:last-child').remove();
            }
        }

        initComparePopup();

        Wolmart.$body
            .on('click', '.product .btn-compare', addToCompare)
            .on('click', '.compare-popup .btn-remove', removeCompare)
            .on('click', '.compare-popup .btn-clean', removeAllCompare)

        Wolmart.$body.on('click', '.compare-popup-overlay', function () {
            $compare.removeClass('show');
        });

    }

    var initProductQuickview = function () {
        var $popup = $('.product-popup');
        if ( !$popup.length) {
            return;
        }
        Wolmart.$body.on('click', '.btn-quickview', function (e) {
            e.preventDefault();
            Wolmart.popup({
                items: {
                    src: $popup[0].outerHTML
                },
                callbacks: {
                    open: function () {
                        // this.wrap.imagesLoaded(function () {
                            Wolmart.productSingle($('.mfp-product .product-single'));
                        // });
                        Popup.defaults.callbacks.open();
                    }
                }
            }, 'quickview');
        });
    }


    // Public Properties
    var Shop = {
        init: function () {
            Wolmart.call(Wolmart.ratingTooltip, 500);
            Wolmart.call(Wolmart.setProgressBar('.progress-bar'), 500);
            this.initProductType('slideup');
            this.initVariation();
            this.initProductsScrollLoad( '.scroll-load' );

            // Functions for shop page
            initSelectMenu();

            initProductCartAction();

            initWishlistAction();
            initProductQuickview();
            initCompare();

            Wolmart.priceSlider('.filter-price-slider');
        },

        initProductType: function (type) {

            // "slideup"
            if (type == 'slideup') {
                // $('.product-slideup-content .product-details').each(function (e) {
                //     var $this = $(this),
                //         elem = $this.find('.product-hidden-details'),
                //         hidden_height = $this.find('.product-hidden-details').outerHeight(true);

                //     $this.height($this.height() - hidden_height);
                // });

                // $(Wolmart.byClass('product-slideup-content'))
                    // .on('mouseenter touchstart', function (e) {
                    //     console.log("Mouse enter");
                    //     var $this = $(this),
                    //         hidden_height = $this.find('.product-hidden-details').outerHeight(true);

                    //     $this.find('.product-details').css('transform', 'translateY(' + (-hidden_height) + 'px)');
                    //     $this.find('.product-hidden-details').css('transform', 'translateY(' + (-hidden_height) + 'px)');
                    // })
                    // .on('mouseleave touchleave', function (e) {
                    //     var $this = $(this);
                    //     console.log("Mouse leave");
                    //         // hidden_height = $this.find('.product-hidden-details').outerHeight(true);

                    //     $this.find('.product-details').css('transform', 'translateY(0)');
                    //     $this.find('.product-hidden-details').css('transform', 'translateY(0)');
                    // });
            }
        },

        initVariation: function (type) {
            $('.product:not(.product-single) .product-variations > a').on('click', function (e) {
                var $this = $(this),
                    $image = $this.closest('.product').find('.product-media img');

                if (!$image.data('image-src'))
                    $image.data('image-src', $image.attr('src'));

                $this.toggleClass('active').siblings().removeClass('active');

                if ($this.hasClass('active')) {
                    $image.attr('src', $this.data('src'));
                } else {
                    $image.attr('src', $image.data('image-src'));
                    $this.blur();
                }
                e.preventDefault();
            })
        },
        initProductsScrollLoad: function ( $obj ) {
            var $wrapper = Wolmart.$( $obj )
                , top;
            var url = $( $obj ).data( 'url' );
            if ( !url ) {
                url = 'assets/ajax/products.html';
            }
            var loadProducts = function ( e ) {
                if ( window.pageYOffset > top + $wrapper.outerHeight() - window.innerHeight - 150 && 'loading' != $wrapper.data( 'load-state' ) ) {
                    $.ajax( {
                        url: url,
                        success: function ( result ) {
                            var $newItems = $( result );
                            $wrapper.data( 'load-state', 'loading' );
                            if ( !$wrapper.next().hasClass( 'load-more-overlay' ) ) {
                                $( '<div class="mt-4 mb-4 load-more-overlay loading"></div>' ).insertAfter( $wrapper );
                            } else {
                                $wrapper.next().addClass( 'loading' );
                            }
                            setTimeout( function () {
                                $wrapper.next().removeClass( 'loading' );
                                $wrapper.append( $newItems );
                                setTimeout( function () {
                                    $wrapper.find( '.product-wrap.fade:not(.in)' ).addClass( 'in' );
                                }, 200 );
                                $wrapper.data( 'load-state', 'loaded' );
                                Wolmart.countDown($newItems.find('.product-countdown'));
                            }, 500 );
                            var loadCount = parseInt( $wrapper.data( 'load-count' ) ? $wrapper.data( 'load-count' ) : 0 );
                            $wrapper.data( 'load-count', ++loadCount );
                            loadCount > 2 && window.removeEventListener( 'scroll', loadProducts, { passive: true } );
                        },
                        failure: function () {
                            $this.text( "Sorry something went wrong." );
                        }
                    } );
                }
            }
            if ( $wrapper.length > 0 ) {
                top = $wrapper.offset().top;
                window.addEventListener( 'scroll', loadProducts, { passive: true } );
            }
        }
    }

    Wolmart.shop = Shop;
})(jQuery);

/**
 * Wolmart Plugin - QuantityInput
 *
 * @instance multiple
 */
function QuantityInput($el) {
    return this.init($el);
}

(function ($) {

    // Public Members
    QuantityInput.min = 1;
    QuantityInput.max = 1000000;
    QuantityInput.value = 1

    QuantityInput.prototype.init = function ($el) {
        var self = this;

        self.$minus = false;
        self.$plus = false;
        self.$value = false;
        self.value = false;

        // Bind Events
        //self.startIncrease = self.startIncrease.bind(self);
        //self.startDecrease = self.startDecrease.bind(self);
        self.stop = self.stop.bind(self);

        // Variables
        self.min = parseInt($el.attr('min'));
        self.max = parseInt($el.attr('max'));

        self.min || ($el.attr('min', self.min = QuantityInput.min));
        self.max || ($el.attr('max', self.max = QuantityInput.max));

        // Add DOM elements and event listeners
        //self.$value = $el.val(self.value = QuantityInput.value);

        // self.$minus = $el.parent().find('.quantity-minus')
        //     .on('mousedown', function (e) {
        //         e.preventDefault();
        //         self.startDecrease();
        //     })
        //     .on('touchstart', function (e) {
        //         if (e.cancelable) {
        //             e.preventDefault();
        //         }
        //         self.startDecrease();
        //     })
        //     .on('mouseup', self.stop);

        // self.$plus = $el.parent().find('.quantity-plus')
        //     .on('mousedown', function (e) {
        //         e.preventDefault();
        //         self.startIncrease();
        //     })
        //     .on('touchstart', function (e) {
        //         if (e.cancelable) {
        //             e.preventDefault();
        //         }
        //         self.startIncrease();
        //     })
        //     .on('mouseup', self.stop);

        Wolmart.$body.on('mouseup', self.stop)
            .on('touchend', self.stop)
            .on('touchcancel', self.stop);
    }

    // QuantityInput.prototype.startIncrease = function (e) {
    //     e && e.preventDefault();

    //     var self = this;
    //     self.value = self.$value.val();

    //     self.value < self.max && self.$value.val(++self.value);
    //     self.increaseTimer = Wolmart.requestTimeout(function () {
    //         self.speed = 1;
    //         self.increaseTimer = Wolmart.requestInterval(function () {
    //             self.$value.val(self.value = Math.min(self.value + Math.floor(self.speed *= 1.05), self.max));
    //         }, 50);
    //     }, 400);
    // }

    // QuantityInput.prototype.startDecrease = function (e) {
    //     e && e.preventDefault();

    //     var self = this;
    //     self.value = self.$value.val();
    //     self.value > self.min && self.$value.val(--self.value);

    //     self.decreaseTimer = Wolmart.requestTimeout(function () {
    //         self.speed = 1;
    //         self.decreaseTimer = Wolmart.requestInterval(function () {
    //             self.$value.val(self.value = Math.max(self.value - Math.floor(self.speed *= 1.05), self.min))
    //         }, 50);
    //     }, 400);
    // }

    QuantityInput.prototype.stop = function (e) {
        Wolmart.deleteTimeout(this.increaseTimer);
        Wolmart.deleteTimeout(this.decreaseTimer);
    }

    Wolmart.initQtyInput = function (selector) {
        Wolmart.$(selector).each(function () {
            var $this = $(this);

            // if not initialized
            $this.data('quantityInput') ||
                $this.data('quantityInput', new QuantityInput($this));
        })
    }
})(jQuery)

/**
 * Wolmart Plugin - Popup
 *
 * @requires magnificPopup
 * @instance multiple
 */
function Popup(options, preset) {
    return this.init(options, preset);
}

(function ($) {
    'use strict';

    Popup.defaults = {
        removalDelay: 300,
        callbacks: {
            open: function () {
                $('html').css('overflow-y', 'hidden');
                $('body').css('overflow-x', 'visible');
                $('.mfp-wrap').css('overflow', 'hidden auto');
                $('.sticky-header.fixed').css('padding-right', window.innerWidth - document.body.clientWidth);
            },
            close: function () {
                $('html').css('overflow-y', '');
                $('body').css('overflow-x', 'hidden');
                $('.mfp-wrap').css('overflow', '');
                $('.sticky-header.fixed').css('padding-right', '');
            }
        }
    }


    Popup.presets = {
        'quickview': {
            type: 'inline',
            mainClass: 'mfp-product mfp-fade',
            tLoading: 'Loading...'
        },
        'video' : {
            type: 'iframe',
            mainClass: "mfp-fade",
            preloader: false,
            closeBtnInside: false
        },
        'login': {
            type: 'ajax',
            mainClass: "mfp-login-popup mfp-fade ",
            tLoading: '',
            preloader: false
        }
    }

    Popup.prototype.init = function (options, preset) {
        var mpIns = $.magnificPopup.instance;

        if (mpIns.isOpen && mpIns.content && !mpIns.content.hasClass('login-popup')) {
            // close current
            mpIns.close();

            // open a new one after a few moment
            setTimeout(function () {
                $.magnificPopup.open(
                    $.extend(true, {},
                        Popup.defaults,
                        preset ? Popup.presets[preset] : {},
                        options
                    )
                )
            }, 500);
        } else {
            $.magnificPopup.open(
                $.extend(true, {},
                    Popup.defaults,
                    preset ? Popup.presets[preset] : {},
                    options
                )
            );
        }
    }

    Wolmart.popup = function (options, preset) {
        return new Popup(options, preset);
    }
})(jQuery);

/**
 * Wolmart Plugin - Product Single
 *
 * @requires OwlCarousel
 * @requires zoom
 * @instance multiple
 */

function ProductSingle($el) {
    return this.init($el);
}

(function ($) {

    // Private Properties
    var thumbsSliderOptions = {
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
    }

    var thumbsInit = function (self) {
        // properties for thumbnails
        self.$thumbs = self.$wrapper.find('.product-thumbs');
        self.$thumbsWrap = self.$thumbs.parent();
        self.$thumbUp = self.$thumbsWrap.find('.thumb-up');
        self.$thumbDown = self.$thumbsWrap.find('.thumb-down');
        self.$thumbsDots = self.$thumbs.children();
        self.thumbsCount = self.$thumbsDots.length;
        self.$productThumb = self.$thumbsDots.eq(0);
        self._isPgVertical = self.$thumbsWrap.parent().hasClass('product-gallery-vertical');
        self.thumbsIsVertical = self._isPgVertical && window.innerWidth >= 992;

        // Register Events
        self.$thumbDown.on('click', function (e) {
            self.thumbsIsVertical && thumbsDown(self);
        });

        self.$thumbUp.on('click', function (e) {
            self.thumbsIsVertical && thumbsUp(self);
        });

        self.$thumbsDots.on('click', function (e) {
            var $this = $(this),
                index = ($this.parent().filter(self.$thumbs).length ? $this : $this.parent()).index();
            var carousel = self.$wrapper.find('.product-single-carousel').data('owl.carousel');
            carousel && carousel.to(index);
        });

        // refresh thumbs
        thumbsRefresh(self);
        Wolmart.$window.on('resize', function () {
            self.thumbsIsVertical = self._isPgVertical && window.innerWidth >= 992;
            thumbsRefresh(self);
        });
    }

    var thumbsDown = function (self) {
        var thumbsWrapBottom = self.$thumbsWrap.offset().top + self.$thumbsWrap[0].offsetHeight,
            curBottom = self.$thumbs.offset().top + self.thumbsHeight;

        if (curBottom >= thumbsWrapBottom + self.$productThumb[0].offsetHeight) {
            self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - self.$productThumb[0].offsetHeight);
            self.$thumbUp.removeClass('disabled');
        } else if (curBottom > thumbsWrapBottom) {
            self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - Math.ceil(curBottom - thumbsWrapBottom));
            self.$thumbUp.removeClass('disabled');
            self.$thumbDown.addClass('disabled');
        } else {
            self.$thumbDown.addClass('disabled');
        }
    }

    var thumbsUp = function (self) {
        var thumbsWrapTop = self.$thumbsWrap.offset().top,
            curTop = self.$thumbs.offset().top;

        if (curTop <= thumbsWrapTop - self.$productThumb[0].offsetHeight) {
            self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) + self.$productThumb[0].offsetHeight);
            self.$thumbDown.removeClass('disabled');
        } else if (curTop < thumbsWrapTop) {
            self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - Math.ceil(curTop - thumbsWrapTop));
            self.$thumbDown.removeClass('disabled');
            self.$thumbUp.addClass('disabled');
        } else {
            self.$thumbUp.addClass('disabled');
        }
    }

    var thumbsRefresh = function (self) {
        if (self.thumbsIsVertical) { // enable vertical product gallery thumbs.
            // disable thumbs carousel
            if (self.$thumbs.hasClass('owl-carousel')) {
                self.$thumbs.data('owl.carousel').destroy();
                self.$thumbs.removeClass('owl-carousel');
            }

            // enable thumbs vertical nav
            self.thumbsHeight = self.$productThumb[0].offsetHeight * self.thumbsCount + parseInt(self.$productThumb.css('margin-bottom')) * (self.thumbsCount - 1);
            self.$thumbUp.addClass('disabled');
            self.$thumbDown.toggleClass('disabled', self.thumbsHeight <= self.$thumbsWrap[0].offsetHeight);
        } else {
            // enable thumbs carousel
            self.$thumbs.removeAttr('style');
            self.$thumbs.hasClass('owl-carousel') || self.$thumbs.addClass('owl-carousel')
            .attr( 'class', self.$thumbs.attr('class').replace( /row|gutter\-\w\w|cols\-\d|cols\-\w\w-\d/g, '' ).replace( /\s+/, ' ' ) )
            .owlCarousel(
                $.extend(
                    true,
                    self.isQuickView ? {
                        onInitialized: recalcDetailsHeight,
                        onResized: recalcDetailsHeight
                    } : {},
                    thumbsSliderOptions
                )
            );
        }
    }

    var variationInit = function (self) {
        self.$selects = self.$wrapper.find( '.product-variations select' );
        self.$items = self.$wrapper.find( '.product-variations' );
        // self.$priceWrap = self.$wrapper.find( '.product-variation-price' );
        self.$clean = self.$wrapper.find( '.product-variation-clean' ),
        // self.$btnCart = self.$wrapper.find( '.btn-cart' );

        // check
        self.variationCheck();
        self.$selects.on( 'change', function ( e ) {
            self.variationCheck();
        } );
        self.$items.children( 'a' ).on( 'click', function ( e ) {
            $( this ).toggleClass( 'active' ).siblings().removeClass( 'active' );
            e.preventDefault();
            self.variationCheck();
            if ( self.$items.parent('.product-image-swatch') ) {
                self.swatchImage();
            }
        } );

        // clean
        self.$clean.on( 'click', function ( e ) {
            e.preventDefault();
            self.variationClean( true );
        } );

    }

    // For only Quickview
    var recalcDetailsHeight = function () {
        var self = this;
        self.$wrapper.find('.product-details').css(
            'height',
            window.innerWidth > 767 ? self.$wrapper.find('.product-gallery')[0].clientHeight : ''
        );
    }

    var wishlistAction = function (e) {
        var $this = $( this );
        if ( $this.hasClass( 'added' ) ) {
            return;
        }
        e.preventDefault();
        $this.addClass( 'load-more-overlay loading' );

        setTimeout( function () {
            $this
                .removeClass( 'load-more-overlay loading' )
                .toggleClass('w-icon-heart').toggleClass('w-icon-heart-full')
                .addClass( 'added' )
                .attr( 'href', 'wishlist.html' );
        }, 500 );
    }

    // var goToReviewPan = function (e) {
    //     //e.preventDefault();
    //     Wolmart.scrollTo($('.product-tabs > .nav a[href="' + this.getAttribute('href') + '"]').trigger('click'));
    // }

    // Public Properties
    ProductSingle.prototype.init = function ($el) {
        var self = this,
            $slider = $el.find('.product-single-carousel');

        // members
        self.$wrapper = $el;
        self.isQuickView = !!$el.closest('.mfp-content').length;
        self._isPgVertical = false;

        // bind
        if (self.isQuickView) {
            recalcDetailsHeight = recalcDetailsHeight.bind(this);
            Wolmart.ratingTooltip();
        }

        // init thumbs
        $slider.on('initialized.owl.carousel', function (e) {
            // if not quickview, make full image toggle
            if(!document.body.classList.contains('home')) {
                self.isQuickView || $slider.append('<a href="#" class="product-gallery-btn product-image-full"><i class="w-icon-zoom"></i></a>');

                if ($slider.parent().hasClass('product-gallery-video')) {
                    self.isQuickView || $slider.append('<a href="#" class="product-gallery-btn product-degree-viewer" title="Product 360 Degree Gallery"><i class="w-icon-rotate-3d"></i></a>');
                    self.isQuickView || $slider.append('<a href="#" class="product-gallery-btn product-video-viewer" title="Product Video Thumbnail"><i class="w-icon-movie"></i></a>');
                }
            }

            // init thumbnails
            thumbsInit(self);
        }).on('translate.owl.carousel', function (e) {
            var currentIndex = (e.item.index - $(e.currentTarget).find('.cloned').length / 2 + e.item.count) % e.item.count;

            self.setThumbsActive(currentIndex);
        });

        //Wishlist button event
        self.$wrapper.on('click', '.btn-wishlist', wishlistAction);

        //Rating reviews evnet
        //self.$wrapper.on('click', '.rating-reviews', goToReviewPan);

        // if this is created after document ready, init plugins
        if ('complete' === Wolmart.status) {
            Wolmart.slider($slider);
            Wolmart.initQtyInput($el.find('.quantity'));
        }

        // init sticky thumbnail

        if (self.$wrapper.find('.product-thumbs-sticky').length) {
            self.isStickyScrolling = false;
            self.$wrapper.on('click', '.product-thumb:not(.active)', self.clickStickyThumbnail.bind(this));
            window.addEventListener('scroll', self.scrollStickyThumbnail.bind(this), { passive: true });
        }

        variationInit(this);
    }

    ProductSingle.prototype.setThumbsActive = function (index) {
        var self = this,
            $curThumb = self.$thumbsDots.eq(index);

        self.$thumbsDots.filter('.active').removeClass('active');
        $curThumb.addClass('active');

        // show current thumb
        if (self.thumbsIsVertical) { // if vertical
            var offset = parseInt(self.$thumbs.css('top')) + index * self.thumbsHeight;

            if (offset < 0) { // if thumb is above ?
                self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - offset);
            } else {
                offset = self.$thumbs.offset().top + self.$thumbs[0].offsetHeight - $curThumb.offset().top - $curThumb[0].offsetHeight;

                if (offset < 0) {
                    // if below
                    self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) + offset);
                }
            }
        } else { // if thumb carousel
            Wolmart.requestTimeout(function() {
                self.$thumbs.data('owl.carousel') && self.$thumbs.data('owl.carousel').to(index);
            }, 100);
        }
    }

    ProductSingle.prototype.variationCheck = function () {
        var self = this,
            isAllSelected = true;

        // check all select variations are selected
        self.$selects.each( function () {
            return this.value || ( isAllSelected = false );
        } );

        // check all item variations are selected
        self.$items.each( function () {
            var $this = $( this );
            if ( $this.children( 'a:not(.size-guide)' ).length ) {
                return $this.children( '.active' ).length || ( isAllSelected = false );
            }
        } );

        isAllSelected ?
            self.variationMatch() :
            self.variationClean();
    }

    ProductSingle.prototype.variationMatch = function () {
        var self = this;
        // self.$priceWrap.slideDown();
        self.$clean.slideDown();
        // self.$btnCart.removeClass( 'disabled' );
    }

    ProductSingle.prototype.variationClean = function ( reset ) {
        reset && this.$selects.val( '' );
        reset && this.$items.children( '.active' ).removeClass( 'active' );
        // this.$priceWrap.slideUp();
        // this.$clean.css( 'display', 'none' );
        // this.$btnCart.addClass( 'disabled');

    }

    ProductSingle.prototype.clickStickyThumbnail = function (e) {
        var self = this;
        var $thumb = $( e.currentTarget );
        var currentIndex = $thumb.parent().children('.active').index();
        var newIndex = $thumb.index() + 1;

        $thumb.addClass('active').siblings('.active').removeClass('active');
        this.isStickyScrolling = true;
        var target = $thumb.closest('.product-thumbs-sticky').find('.product-image-wrapper > :nth-child(' + newIndex + ')');
        if ( target.length ) {
            target = target.offset().top + 10;
            Wolmart.scrollTo(target, 500);
        }

        setTimeout(function () {
            self.isStickyScrolling = false;
        }, 300);
    }

    ProductSingle.prototype.scrollStickyThumbnail = function () {
        var self = this;
        if (!this.isStickyScrolling) {
            self.$wrapper.find('.product-image-wrapper .product-image').each(function () {
                if (Wolmart.isOnScreen(this)) {
                    self.$wrapper.find('.product-thumbs > :nth-child(' + ($(this).index() + 1) + ')')
                        .addClass('active').siblings().removeClass('active');
                    return false;
                }
            });
        }
    }

    ProductSingle.prototype.swatchImage = function () {
        var src = this.$items.find('.active img').attr('src'),
            productImage = this.$wrapper.find('.owl-item:first-child .product-image img'),
            thumbImage = this.$wrapper.find('.owl-item:first-child .product-thumb img');

        productImage.attr('src', src);
        thumbImage.attr('src', src);
    }

    Wolmart.productSingle = function (selector) {
        Wolmart.$(selector).each(function() {
            var $this = $(this);
            if ( ! $this.is('body > *') ) {
                $this.data('product-single', new ProductSingle($this));
            }
        })
        return null;
    }
})(jQuery);

/**
 * Wolmart Plugin - Product Single Page
 *
 * @requires Slider
 * @requires ProductSingle
 * @requires PhotoSwipe
 * @instance single
 */

(function ($) {

    // Open Image Gallery
    function openImageGallery(e) {
        e.preventDefault();

        var $this = $(e.currentTarget),
            $product = $this.closest('.product-single'),
            $images, images;
        if( $this.closest('.review-image').length) {
            $images = $this.closest('.review-image').find('img');
        } else if ($product.find('.product-single-carousel').length) { // single carousel
            $images = $product.find('.product-single-carousel .owl-item:not(.cloned) img:first-child');
        } else if ($product.find('.product-gallery-carousel').length) { // gallery carousel
            $images = $product.find('.product-gallery-carousel .owl-item:not(.cloned) img');
        } else { // simple gallery
            $images = $product.find('.product-image img:first-child');
        }

        if ($images.length) {

            images = $images.map(function () {
                var $this = $(this);

                return {
                    src: $this.attr('data-zoom-image'),
                    w: 800,
                    h: 900,
                    title: $this.attr('alt')
                };
            }).get();

            var carousel = $product.find('.product-single-carousel, .product-gallery-carousel').data('owl.carousel'),
                curIndex = carousel ?
                    // Carousel Type
                    ((carousel.current() - carousel.clones().length / 2 + images.length) % images.length) :
                    // Gallery Type
                    ($product.find('.product-gallery > *').index());

            if (typeof PhotoSwipe !== 'undefined') {
                var pswpElement = $('.pswp')[0];

                var photoSwipe = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, images, {
                    index: curIndex,
                    closeOnScroll: false
                });
                photoSwipe.init();
                Wolmart.photoSwipe = photoSwipe;
            }
        }
    }

    // Open Video
    function openVideo(e) {
        e.preventDefault();
        Wolmart.popup( {
            items: {
                src: '<video src="assets/video/memory-of-a-woman.mp4" autoplay loop controls>',
                type: "inline"
            },
            mainClass: "mfp-video-popup"
        }, "video" )
    }

    // Open 360 Degree
    function open360DegreeView(e) {
		e.preventDefault();
		Wolmart.popup({
			type: 'inline',
			mainClass: "product-popupbox wm-fade product-360-popup",
			preloader: false,
			items: {
				src: '<div class="product-gallery-degree">\
						<div class="w-loading"><i></i></div>\
						<ul class="product-degree-images"></ul>\
					</div>'
			},
			callbacks: {
				open: function () {
					this.container.find('.product-gallery-degree').ThreeSixty({
                        imagePath: 'assets/images/products/video/',
                        filePrefix: '360-',
                        ext: '.jpg',
						totalFrames: 18,
						endFrame: 18,
						currentFrame: 1,
						imgList: this.container.find('.product-degree-images'),
						progress: '.w-loading',
						height: 500,
						width: 830,
                        navigation: true
					});
				},
				beforeClose: function () {
					this.container.empty();
				}
			}
		});
	}

    /**
     * Event handler when rating control is clicked in single product page's review form.
     *
     * @since 1.0
     * @param {object} e
     * @return {void}
     */
    function clickRatingForm(e) {
        var $star = $(this);
        $star.addClass('active').siblings().removeClass('active');
        $star.parent().addClass('selected');
        $star.closest('.rating-form').find('select').val($star.text());
        e.preventDefault();
    }

    function onAddToCartSingle(e) {

        var $this = $(this),
            $alert = $('.main-content > .alert, .container > .alert'),
            productName;

        if ($this.hasClass('disabled')) {
            alert( 'Please select some product options before adding this product to your cart.' );
            return;
        }

        if ($alert.length) {
            $alert.fadeOut(function() {
                $alert.fadeIn();
            })
        } else {
            productName = $this.closest('.product-single').find('.product-title').text();
            var alertHtml = '<div class="alert alert-success alert-cart-product mb-2">\
                            <p class="mb-0 ls-normal">Product successfully added to your cart.</p>\
                            </div>'
            $this.closest('.product-single').before(alertHtml);
        }

        $('.product-sticky-content').trigger('recalc.pin');
    }

    function stickyProduct (selector) {

        var $this = $(selector),
            $product = $this.closest('.product-single'),
            src = $product.find('.product-image img').eq(0).attr('src'),
            name = $product.find('.product-details .product-title').text(),
            newPrice = $product.find('.new-price').text(),
            oldPrice = $product.find('.old-price').text(),
            stickyProductDetailsHtml = '<div class="product product-list-sm mr-auto">\
                                        <figure class="product-media">\
                                        <img src="'+ src +'" alt="Product" width="85" height="85" />\
                                        </figure>\
                                        <div class="product-details pt-0 pl-2 pr-2">\
                                        <h4 class="product-name font-weight-normal mb-1">'+ name +'</h4>\
                                        <div class="product-price mb-0">\
                                        <ins class="new-price">'+ newPrice +'</ins><del class="old-price">'+ oldPrice +'</del></div>\
                                        </div></div>';

            $this.find('.product-qty-form').before(stickyProductDetailsHtml);

        function refreshStickyProduct() {
            if ( $this.hasClass('fix-top') && window.innerWidth > 767 ) {
                $this.removeClass('fix-top').addClass('fix-bottom');
            }

            if ( $this.hasClass('fix-bottom') && window.innerWidth > 767 ) {
                return;
            }

            if ( $this.hasClass('fix-bottom') && window.innerWidth < 768 ) {
                $this.removeClass('fix-bottom').addClass('fix-top');
            }

            if ( $this.hasClass('fix-top') && window.innerWidth < 768 ) {
                return;
            }
        }

        window.addEventListener('resize', refreshStickyProduct, {passive: true});
        refreshStickyProduct();
    }

    Wolmart.initProductSinglePage = function() {
        // Zoom Image for grid type
        Wolmart.zoomImage('.product-gallery .product-image');

        stickyProduct('.product-sticky-content')

        // Register events
        if(!document.body.classList.contains('home')) {
            Wolmart.$body
                .on('click', '.product-image-full', openImageGallery)
                .on('click', '.review-image img', openImageGallery)
                .on('click', '.product-video-viewer', openVideo)
                .on('click', '.product-degree-viewer', function (e) {
                    e.preventDefault(e);
                    if($.fn.ThreeSixty) {
                        open360DegreeView(e);
                    }
                })
                .on('click', '.rating-form .rating-stars > a', clickRatingForm)
                .on('click', '.product-single:not(.product-popup) .btn-cart', onAddToCartSingle);
        }
    }
})(jQuery);

/**
 * Womart Plugin - Calendar
 *
 * @instance multiple
 */

function Calendar(el, options) {
    return this.init(el, options);
}

(function ($) {

    // Private Members
    var updateHeader = function (date) {
        var self = this;
        var mt = self.settings.months[date.getMonth()];
        mt += self.settings.displayYear ? ' ' + date.getFullYear() : '';

        self.element.find('.calendar-title').html(mt);
    }

    // Public Members
    Calendar.defaultOptions = {
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        days: ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
        displayYear: true,      // Display year in header
        fixedStartDay: true,    // Week always begins with Sunday or Monday by setting number 0 or 1. If startDay is false, week always begin with firstday of month
        dayNumber: 0,           // Week always begins with Sunday
        dayExcerpt: 3,          // length of abbreviation of day. If it is equal to 3, the day will be "Sun", "Mon", etc
    }

    Calendar.prototype.init = function ($el, options) {
        var self = this;
        self.element = $el;    // calendar container element
        self.settings = $.extend({}, true,
            Calendar.defaultOptions,
            Wolmart.parseOptions($el.attr('data-calendar-options')),
            options
        ); // extend default options with user defined options
        self.today = new Date();

        // Bind this to update header
        updateHeader = updateHeader.bind(this);

        var $calendar = $('<div class="calendar"></div>'),
            $header = $('<div class="calendar-header">' +
                '<a href="#" class="btn-calendar btn-calendar-prev"><i class="la la-angle-left"></i></a>' +
                '<span class="calendar-title"></span>' +
                '<a href="#" class="btn-calendar btn-calendar-next"><i class="la la-angle-right"></i></a>' +
                '</div>');

        $calendar.append($header);
        $el.append($calendar);

        // update Calendar header
        updateHeader(self.today);

        self.render(self.today, $calendar);

        self.bindEvents();
    }

    /**
     * render
     *
     *
     * Render Calendar
     * @param {Date} fd
     * @param {HTMLElement} $calendar
     */
    Calendar.prototype.render = function (fd, $calendar) {
        var self = this;

        // if calendar table already exists, remove it
        $calendar.find('table') &&
            $calendar.find('table').remove();

        var $table = $('<table></table>'),
            $thead = $('<thead></thead>'),
            $tbody = $('<tbody></tbody'),
            y = fd.getFullYear(),
            m = fd.getMonth();

        var firstDay = new Date(y, m, 1),         // get the first day of the month
            lastDay = new Date(y, m + 1, 0),      // get the last day of the month
            startDayOfWeek = firstDay.getDay();     // get the first day of the week

        if (self.settings.fixedStartDay) {
            startDayOfWeek = self.settings.dayNumber;

            // If the first day of the month is different with start of week, get more days of prev month to fill calendar
            while (firstDay.getDay() != startDayOfWeek) {
                firstDay.setDate(firstDay.getDate() - 1);
            }

            // If the last day of the month is difference with end of week, get more days of next month to be displayed in calendar
            while (lastDay.getDay() != (startDayOfWeek + 7) % 7) {
                lastDay.setDate(lastDay.getDate() + 1);
            }
        }

        // Get days in week
        for (var i = startDayOfWeek; i < startDayOfWeek + 7; i++) {
            var th = $('<th>' + self.settings.days[i % 7].substring(0, self.settings.dayExcerpt) + '</th>');

            i % 7 == 0 && th.addClass('holiday');

            $thead.append(th);
        }

        // Displays days from fristday to lastday in calendar

        for (var day = firstDay; day < lastDay; day.setDate(day.getDate())) {
            var tr = $('<tr></tr>');

            // Make each row of calendar
            for (var i = 0; i < 7; i++) {
                var td = $('<td><span class="day" data-date="' + day.toISOString() + '">' + day.getDate() + '</span></td>');

                // If the day is equal to today
                (day.toDateString() == (new Date).toDateString()) &&
                    td.find('.day').addClass('today');

                // If the day is out of current month
                (day.getMonth() != fd.getMonth()) &&
                    td.find('.day').addClass('disabled');

                tr.append(td);
                day.setDate(day.getDate() + 1);
            }
            $tbody.append(tr);
        };

        $table.append($thead);
        $table.append($tbody);
        $calendar.append($table);
    }

    /**
     * changeMonth
     *
     *
     * Change Month
     * @param {Number} dm - increment of month
     */
    Calendar.prototype.changeMonth = function (dm) {
        this.today.setMonth(this.today.getMonth() + dm, 1);
        this.render(this.today, $(this.element).find('.calendar'));
        updateHeader(this.today);
    }


    /**
     * bindEvents
     *
     *
     * Bind events to prev & next button
     */
    Calendar.prototype.bindEvents = function () {
        var self = this;

        // Register event to prev btn
        $(self.element).find('.btn-calendar-prev').on('click', function (e) {
            self.changeMonth(-1);
            e.preventDefault();
        });

        // Register event to next btn
        $(self.element).find('.btn-calendar-next').on('click', function (e) {
            self.changeMonth(1);
            e.preventDefault();
        });
    }


    Wolmart.calendar = function (selector, options) {
        Wolmart.$(selector).each(function () {
            var $this = $(this);

            Wolmart.call(function () {
                new Calendar($this, options);
            });
        });
    }

    Wolmart.initVendor = function (selector) {
        var $this = $(selector),
            $btnSearchVendor = $this.closest('.page-content').find('.toolbox .vendor-search-toggle'),
            $phone = $this.find('.store-phone');

        $btnSearchVendor.on('click', function (e) {
            var $searchWrapper = $btnSearchVendor.closest('.vendor-toolbox').next('.vendor-search-wrapper');
            if (!$searchWrapper.hasClass('open')) {
                $searchWrapper.addClass('open').slideDown();
            }else {
                $searchWrapper.removeClass('open').slideUp();
            }
            e.preventDefault();
        });

        $phone.on('click', function () {
            alert('Always open these types of links in the associated app');
        });
    }

    Wolmart.slideContent = function (selector) {
        var $this = $(selector),
            $content = $this.next();

        $this.on('click', function(e) {
            e.preventDefault();

            if(!$content.hasClass('open')) {
                $content.addClass('open').slideDown();
                $this.find('.custom-checkbox').addClass('checked');

            }else {
                $content.removeClass('open').slideUp();
                $this.find('.custom-checkbox').removeClass('checked');
            }
        })
    }

    // Login vendor in login page
    Wolmart.initLoginVendor = function (selector) {
        var $this = $(selector),
            $LoginVendorPanel = $this.parent().find('.login-vendor'),
            $checkCustomer = $this.find('.check-customer'),
            $checkVendor = $this.find('.check-seller');

        $checkVendor.on('click', function () {
            $this.find('#check-seller').addClass('active');
            $this.find('#check-customer').removeClass('active');
            $LoginVendorPanel.slideDown();
        });

        $checkCustomer.on('click', function() {
            $this.find('#check-customer').addClass('active');
            $this.find('#check-seller').removeClass('active');
            $LoginVendorPanel.slideUp();
        });
    }
})(jQuery);
/**
 * Wolmart Theme
 */
(function ($) {

    // Initialize Method while document is being loaded
    Wolmart.prepare = function () {
        Wolmart.$body.hasClass('with-flex-container') && window.innerWidth >= 1200 &&
            Wolmart.$body.addClass('sidebar-active');
    };

    // Initialize Method while document is interactive
    Wolmart.initLayout = function () {
        // do something later...
        Wolmart.isotopes('.grid:not(.grid-float)');
        Wolmart.stickySidebar('.sticky-sidebar');
    };

    // Initialize Method after document has been loaded
    Wolmart.init = function () {
        // do something later...
        Wolmart.appearAnimate('.appear-animate');                           // Run appear animation
        Wolmart.slider('.owl-carousel');                                    // Initialize Slider
        Wolmart.setTab('.nav-tabs');                                        // Initialize Tab
        Wolmart.stickyContent('.sticky-header');                            // Initialize Sticky Content
        Wolmart.stickyContent('.sticky-footer', {
            minWidth: 0,
            maxWidth: 767,
            top: 0,
            hide: true,
            max_index: 2100
        });                                                                 // Initialize Sticky Footer
        Wolmart.stickyContent( '.sticky-toolbox', Wolmart.stickyToolboxOptions );
        Wolmart.stickyContent('.product-sticky-content', Wolmart.stickyProductOptions );
        Wolmart.parallax('.parallax');                                      // Initialize Parallax
        Wolmart.skrollrParallax();                                          // Initialize Skrollr Parallax
        Wolmart.initFloatingParallax();                                     // Initialize Floating Parallax
        Wolmart.menu.init();                                                // Initialize Menu
        Wolmart.initScrollTopButton();                                      // Initialize scroll top button
        Wolmart.shop.init();                                                // Initialize Shop
        Wolmart.alert('.alert')                                             // Initialize Alert
        Wolmart.accordion('.card-header > a')                               // Initialize Accordion
        Wolmart.sidebar('sidebar');                                         // Initialize Sidebar
        Wolmart.sidebar('right-sidebar');                                   // Initialize Right Sidebar
        Wolmart.productSingle('.product-single');                           // Initialize all single products
        Wolmart.initProductSinglePage();                                    // Initialize Single Product Page
        Wolmart.initQtyInput('.quantity');                                  // Initialize Quantity Input
        Wolmart.initNavFilter('.nav-filters .nav-filter')                   // Initialize Isotope Navigation Filters
        Wolmart.calendar('.calendar-container');                            // Initialize Calendar
        Wolmart.countDown('.product-countdown, .countdown');                // Initialize CountDown
        Wolmart.initPopup();                                                // Initialize Popup
        Wolmart.initNotificationAlert();                                    // Initialize Notification Alert
        Wolmart.countTo('.count-to');                                       // Initialize CountTo
        Wolmart.initCartAction('.cart-offcanvas .cart-toggle');             // Initialize Product Cart
        Wolmart.Minipopup.init();                                           // Initialize minipopup
        Wolmart.headerToggleSearch('.hs-toggle');                           // Initialize Header toggle search
        Wolmart.initVendor('.store');                                       // Initialize Vendor
        Wolmart.slideContent('.login-toggle');                              // Initialize Slide Content
        Wolmart.slideContent('.coupon-toggle');
        Wolmart.slideContent('.checkbox-toggle');
        Wolmart.initLoginVendor('.user-checkbox');                          // Initialize Vendor's Login
    };
})(jQuery);


/**
 * Wolmart Theme Initializer
 */
(function ($) {
    'use strict';

    // Prepare Wolmart Theme
    Wolmart.prepare();

    // Initialize Wolmart Theme
    document.onreadystatechange = function () {
        if (document.readyState === "complete") {
        }
    }

    window.onload = function () {
        // loaded
        Wolmart.status = 'loaded';
        document.body.classList.add('loaded');

        Wolmart.call(Wolmart.initLayout);
        Wolmart.call(Wolmart.init);
        Wolmart.status = 'complete';
        Wolmart.$window.trigger('wolmart_complete');
    }
    
    const wishList = $('.wishlist');
    wishList.on("click", function () {
        const userId = $('#userId').value;
        if (userId === '') {
            alert("You have to login First");
        }
    });
    

})(jQuery);


// offer-slider js 
$('.offer-slider').slick({
    infinite: true,
    slidesToShow: 7,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
    nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
    // autoplay: true,
    // cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    // speed: 1000,
    // autoplaySpeed: 1000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
            slidesToShow: 5,
            dots: true,
            arrows: false,
            infinite: false,
            swipeToSlide: true
        }
      },
      {
        breakpoint: 992,
        settings: {
            slidesToShow: 2,
            dots: true,
            arrows: false,
            infinite: false,
            swipeToSlide: true
        }
      },
      {
        breakpoint: 768,
        settings: {
            slidesToShow: 2,
            dots: true,
            arrows: false,
            infinite: false,
            swipeToSlide: true
        }
      },
      {
        breakpoint: 480,
        settings: {
            slidesToShow: 2,
            dots: true,
            arrows: false,
            infinite: false,
            swipeToSlide: true
        }
      }
    ]
  });
  


// brand-slider
$('.brand-slider').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
    nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
    // autoplay: true,
    // cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    // speed: 2000,
    // autoplaySpeed: 1000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        }
      }
    ]
  });

// category-top-slider
$('.category-top-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
    nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
    // autoplay: true,
    // cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    // speed: 2000,
    // autoplaySpeed: 1000,
});


// banner-slider js 
$('.banner-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    prevArrow: $('.banner-slider-left-arrow'),
    nextArrow: $('.banner-slider-right-arrow'),
    autoplay: true,
    cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    speed: 2000,
    autoplaySpeed: 1000,
});


jQuery(function($) {
    $('.header-left .category-dropdown').hover( function(){
        $('.main').toggleClass('overlay-active');
    });

    $('.footer-menu-widget .title').each(function(){
        $(this).on('click', function(){
            $(this).siblings('.footer-menu-list').slideToggle();
            $(this).toggleClass('active');
        })
    })

    // // banner-category-slider
    // $('.banner-category-slider').slick({
    //     infinite: true,
    //     slidesToShow: 12,
    //     slidesToScroll: 1,
    //     dots: false,
    //     arrows: true,
    //     mobileFirst: true,
    //     prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
    //     nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
    //     // autoplay: true,
    //     // cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    //     // speed: 1000,
    //     // autoplaySpeed: 1000,
    //     responsive: [
    //         {
    //         breakpoint: 1400,
    //         settings: {
    //           slidesToShow: 10,
    //         }
    //       },
    //       {
    //         breakpoint: 1200,
    //         settings: {
    //           slidesToShow: 9,
    //         }
    //       },
    //       {
    //         breakpoint: 992,
    //         settings: {
    //             rows: 2,
    //             slidesToShow: 8,
    //             // dots: true,
    //             // arrows: false,
    //             infinite: false,
    //             swipeToSlide: true
    //         }
    //       },
    //       {
    //         breakpoint: 768,
    //         settings: {
    //             rows: 2,
    //           slidesToShow: 4,
    //         //   dots: true,
    //         //     arrows: false,
    //             infinite: false,
    //             swipeToSlide: true
    //         }
    //       },
    //       {
    //         breakpoint: 576,
    //         settings: {
    //             rows: 2,
    //           slidesToShow: 4,
    //             // dots: true,
    //             // arrows: false,
    //             infinite: false
    //         }
    //       },
    //       {
    //         breakpoint: 480,
    //         settings: {
    //             rows: 2,
    //           slidesToShow: 4,
    //         //   dots: true,
    //         //     arrows: false,
    //             infinite: false,
    //             swipeToSlide: true
    //         }
    //       },
    //       {
    //         breakpoint: 380,
    //         settings: {
    //             rows: 2,
    //           slidesToShow: 4,
    //         //   dots: true,
    //         //     arrows: false,
    //             infinite: false,
    //             swipeToSlide: true
    //         }
    //       }
    //     ]
    // });

    // featured-pro-slider
    $('.featured-pro-slider').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
        nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
        // autoplay: true,
        // cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
        // speed: 1000,
        // autoplaySpeed: 1000,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
                slidesToShow: 5,
                dots: true,
                arrows: false,
                infinite: false
                // swipeToSlide: true
            }
          },
          {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows: false,
                infinite: false
                // swipeToSlide: true
            }
          },
          {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows: false,
                infinite: false
                // swipeToSlide: true
            }
          },
          {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows: false,
                infinite: false
                // swipeToSlide: true
            }
          }
        ]
    });

    // row-8-slider
    $('.row-8-slider').slick({
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        arrows: true,
        prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
        nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
        mobileFirst: true,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 3,
              arrows: false,
              dots: false,
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              arrows: false,
              dots: false,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              arrows: false,
              dots: false,
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              arrows: false,
              dots: false,
            }
          }
        ]
    });
    // row-7-slider
    $('.row-7-slider').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        arrows: true,
        prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
        nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              arrows: false,
              dots: true,
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              arrows: false,
              dots: true,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              arrows: false,
              dots: true,
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              arrows: false,
              dots: true,
            }
          }
        ]
    });

    var fixed_top = $(".header-bottom");
        $(window).on("scroll", function(){
            if( $(window).scrollTop() > 10){  
                fixed_top.addClass("fixed-two");
            }
            else {
                fixed_top.removeClass("fixed-two");
            }
        });
})