$(document).ready(function () {
	var MT = {
		init: function () {
			this.tracking.init();
			/* farbige Liste-Squares */
			this.page.lists();
			/* toggles imprint, privacy and image info */
			this.page.toggles.imprint();
			this.page.toggles.privacy();
			this.page.toggles.imageCredits();
			/* nach unten scrollen, beim Click auf "Impressum" */
			this.page.scrollDown('a.open-close');
			/* nach unten scrollen, beim Click auf "Datenschutz" */
			this.page.scrollDown('a.datenschutz-open-close');
		},

		tracking: {
			init: function () {
				if(logged !== '') {
					this.bugherd.load();
				} else {
					this.analytics.load();
				}

				if(clickConv !== '') {
					$('.kontaktformular button, .kontaktformular submit').on('click', function () {
						this.conversion();
					});
				}
			},

			bugherd: {
				load: function () {
	                var bh = document.createElement('script'),
	                    s = document.getElementsByTagName(t)[0];
	                bh.async = 'async';
	                bh.src = '//www.bugherd.com/sidebarv2.js?apikey=mng5yi483ff6nwtbayoasq';
	                s.parentNode.insertBefore(bh, s);
				}
			},

			analytics: {
				load: function () {
					var gaProperty = 'UA-63619645-1',
	                	disableStr = 'ga-disable-' + gaProperty;

		            if (document.cookie.indexOf(disableStr + '=true') > -1) {
		                window[disableStr] = true;
		            }

		            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			        ga('create', gaProperty, 'auto');
			        ga('set', 'anonymizeIp', true);
			        ga('send', 'pageview');
				},

				optout: function () {
					document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
	                window[disableStr] = true;
	                alert("OptOut war erfolgreich!");
				}
			},

			conversion: function () {
				var image = new Image();
	            image.src = "http://www.googleadservices.com/pagead/conversion/"+google_conversion_id+"/?label="+google_conversion_label+"&script=0";
			}
			
		},

		page: {
			lists: function () {
				$('.content .leistungen ul li').each(function (i, e) {
					$(e).contents().wrap('<span class="list-text"></span>');
				});
			},

			toggles: {
				imprint: function () {
					$("#impressum").hide();
					$("a.open-close").click(function (e) {   
						$("#impressum").fadeSliderToggle("slow");
						return false;
					});
				},

				privacy: function () {
					$("#datenschutz").hide();
					$("a.datenschutz-open-close").click(function (e) {   
						$("#datenschutz").fadeSliderToggle("slow");
						return false;
					});
				},

				imageCredits: function () {
					$("#bildnachweis").hide();
					$("a.bildnachweis-open-close").click(function (e) {   
						$("#bildnachweis").fadeSliderToggle("slow");
						return false;
					});
				}
			},

			scrollDown: function (trigger) {
				var $elem = $('.page');

				$(trigger).click(function (e) {
					$('html, body').animate({scrollTop: $elem.height()}, 800);
				});
			}
		}
	};

	MT.init();
});