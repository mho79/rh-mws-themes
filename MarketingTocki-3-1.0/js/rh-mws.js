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
			this.page.pinLogo();
		},

		tracking: {
			init: function () {
				if(clickConv !== '') {
					$('.kontaktformular button, .kontaktformular submit').on('click', function () {
						MT.tracking.conversion();
					});
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
			},

			pinLogo: function () {
				var t = $("#nav").offset().top;

	            $(document).scroll(function () {
	                if($(this).scrollTop() > t) {   
	            	   $('#nav').addClass('fixed', 1000);
	                } else {
	            	   $('#nav').removeClass('fixed', 1000);
	                }
	            });
			}
		}
	};

	MT.init();
});