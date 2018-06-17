/* ---------------------------------------------------------------------
Global Js
Target Browsers: All
------------------------------------------------------------------------ */

var NG = (function(NG, $) {


    /**
     * Doc Ready
     */
    $(function() {
        // TODO: Add Modules needed for build. Remove unused modules
    });


    $(window).load(function() {
        // TODO: Uncomment if using smooth scrolling anchors
        // NG.SmoothAnchors.init();
    });



    /**
     * Example Code Block - This should be removed
     * @type {Object}
     */
    NG.CodeBlock = {
    	init: function() {

    	}
    };

    /**
     * Force External Links to open in new window.
     * @type {Object}
     */
    NG.ExternalLinks = {
        init: function() {
            var siteUrlBase = NG.siteurl.replace(/^https?:\/\/((w){3})?/,'')

            $('a[href*="//"]:not([href*="'+siteUrlBase+'"])')
                .not('.ignore-external') // ignore class for excluding
                .addClass('external')
                .attr('target', '_blank');
        }
    };


    /**
     * Custom Social Share icons open windows
     * @type {Object}
     */
    NG.Social = {
        init: function() {
            $(".js-social-share").on("click", this.open);
        },

        open: function(event) {
          event.preventDefault();

          NG.Social.windowPopup($(this).attr("href"), 500, 300);
        },

        windowPopup: function (url, width, height) {
            var left = (screen.width / 2) - (width / 2),
                top = (screen.height / 2) - (height / 2);

            window.open(
                url,
                "",
                "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left
            );
        }
    };

    /**
     * ImAHuman
     * Hidden Captchas for forms
     * @type {Object}
     */
    NG.ImAHuman = {
        num: "0xFF9481",
        forms: void 0,

        init: function() {
            this.setup()
        },

        setup: function() {
            this.forms = document.getElementsByTagName("form");
            this.bind();
        },

        bind: function() {
            for (var i = 0; this.forms.length > i; i++) {
                $(this.forms[i]).on("focus click", this.markAsHuman);
            }
        },

        markAsHuman: function() {
            $(this).find('.imahuman, [name="imahuman"]').attr("value", parseInt(NG.ImAHuman.num, 16))
        }
    };


    /**
     * Affix
     * Fixes sticky items on scroll
     * @type {Object}
     */
    NG.Affix = {
        windowHeight: 0,

        init: function() {
            this.windowHeight = $(window).height();
            this.bind();
        },

        bind: function(e) {
            $(window).on('scroll', this.scroll);
            $(window).on('resize', this.updateWindowHeight);
        },

        scroll: function(e) {
            var scrolltop = $(this).scrollTop(),
                fixPoint  = NG.Affix.windowHeight - $('#masthead').height();

            if(scrolltop >= fixPoint) {
                $('body').addClass('affix-head');
            } else {
                $('body').removeClass('affix-head');
            }
        },

        updateWindowHeight: function(e) {
            NG.Affix.windowHeight = $(window).height();
        }
    };



    /**
     * NG.Parallax
     * Parallax effect for images
     * @type {Object}
     */
    NG.Parallax = {
        init: function() {
            this.bind();
        },

        bind: function() {
            $(window).scroll(this.scroll);
        },

        scroll: function(e) {
            $('.js-parallax').each(function(){

                var $this   = $(this),
                    $speed  = $this.data('speed') || 6,
                    $window = $(window),
                    yPos    = -($window.scrollTop() / $speed),
                    coords  = 'center '+ yPos + 'px';

                $this.css({ backgroundPosition: coords });

            });
        }
    };



    /**
     * NG.SmoothAnchors
     * Smoothly Scroll to Anchor ID
     * @type {Object}
     */
    NG.SmoothAnchors = {
        init: function() {
            this.hash = window.location.hash;

            if ( this.hash != '' ) {
                this.scrollToSmooth(this.hash);
            }

            this.bind();
        },

        bind: function() {
            $('a[href^=#]').on('click', $.proxy(this.onClick, this));
        },

        onClick: function(event) {
            event.preventDefault;

            var $target = $(event.currentTarget).attr('href');

            this.scrollToSmooth($target);
        },

        scrollToSmooth: function($target) {
            $target = $($target);
            $target = ($target.length) ? $target : $('[name=' + this.hash.slice(1) +']');

            var headerHeight = 0; // TODO: if using sticky header change 0 to
                                  // $('#page-header').outerHeight(true)

            if ($target.length)
            {
                var targetOffset = $target.offset().top - headerHeight;
                $('html,body').animate({scrollTop: targetOffset}, 600);

                return false;
            }
        }
    };



    /**
     * Tab Content
     * @type {Object}
     */
    NG.Tabs = {
        init: function() {
            $('.js-tabs').on('click touchstart', 'a', this.switchTab)
        },

        switchTab: function(event) {
            event.preventDefault();

            var $this = $(this),
                $tab  = $($this.attr('href'));

            $this.parent()
                 .addClass('active')
                 .siblings()
                 .removeClass('active');

            $tab.addClass('active')
                .siblings()
                .removeClass('active');
        }
    };

    return NG;
}(NG || {}, jQuery));