/**
 * Avoid `console` errors in browsers that lack a console.
 */
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/**
 * mws functionsy
 */
(function(w, d, $) {
	var mws = {
		init: function () {
			console.log('mws initialized');
            this.analytics.init();
            this.forms.init();
		},

        analytics: {
            init: function () {
                mws.analytics.optout();
            },

            optout: function() {
                $('.ga-optout').on('click', function (e) {
                    console.log('optout from google analytics');
                    e.preventDefault();
                    w.gaOptout();
                });
            }
        },

        forms: {
            init: function () {
                if(w.clickConv !== '') {
                    $('.kontaktformular button, .kontaktformular submit').on('click', function () {
                        console.log('form conversion triggered');
                        mws.forms.conversion();
                    });
                }
            },

            conversion: function () {
                var image = new Image();
                image.src = "http://www.googleadservices.com/pagead/conversion/" + w.google_conversion_id + "/?label=" + w.google_conversion_label + "&script=0";
            }
        }
	};

	mws.init();
	w.mws = mws;
}(window, document, jQuery));