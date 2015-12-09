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
			this.menu();
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
		},

		menu: function () {
			var $menu = $('nav#mmenu'),
                $html = $('body');

            $menu.mmenu({
                classes: "mm-slide"
            });

            $menu.find( 'li > a' ).on('click', function() {
                var href = $(this).attr( 'href' );

                //  if the clicked link is linked to an anchor, scroll the page to that anchor 
                if ( href.slice( 0, 1 ) == '#' ) {
                    $menu.one('closed.mm', function() {
                        setTimeout(function() {
                            $html.animate({
                                scrollTop: $( href ).offset().top
                            }); 
                        }, 10);  
                    });                      
                }
            });

            // toggle shrink class when scrolled down
            $(window).scroll(function () {
                if ($(document).scrollTop() > 1 ) {
                    $('body').addClass('shrink', 500);
                } else {
                    $('body').removeClass('shrink', 500);
                }
            });
		}
	};

	MT.init();
});