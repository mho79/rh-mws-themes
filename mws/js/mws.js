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
            this.analytics.optout();
		},

        analytics: {
            optout: function() {
                $('.ga-optout').on('click', function (e) {
                    console.log('optout from google analytics');
                    e.preventDefault();
                    gaOptout();
                });
            }
        }
	};

	mws.init();
	w.mws = mws;
}(window, document, jQuery));