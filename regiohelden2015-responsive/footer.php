<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>
	</main>
</div>
<!-- Content Wrapper End -->
<div id="footer">
	<div class="container-fluid footer">
		<div class="row">
			<div class="col-md-12">
				<div class="footer-logos-box">
					Proud to be part of <a class="footer-logos-stroeer" href="/ueber-uns/investoren/"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/stroeer-logo.svg" alt="RegioHelden und Ströer"></a> 
                    <div class="footer-social">
                        <a href="https://www.facebook.com/regiohelden" class="fb-link" target="_blank" rel="nofollow" title="RegioHelden auf Facebook"><i class="fa fa-facebook-square"></i></a> 
                        <a href="https://plus.google.com/102816584998659016237/posts" class="gp-link" target="_blank" rel="nofollow" title="RegioHelden auf Google+"><i class="fa fa-google-plus-square"></i></a> 
                        <a href="https://twitter.com/regiohelden" class="tw-link" target="_blank" rel="nofollow" title="RegioHelden auf Twitter"><i class="fa fa-twitter-square"></i></a> 
                        <a href="https://www.youtube.com/user/RegioHelden" class="yt-link" target="_blank" rel="nofollow" title="RegioHelden auf YouTube"><i class="fa fa-youtube-square"></i></a> 
                        <a href="https://www.xing.com/companies/regioheldengmbh" class="xi-link" target="_blank" rel="nofollow" title="RegioHelden auf Xing"><i class="fa fa-xing-square"></i></a> 
                        <a href="http://www.kununu.com/de/all/de/pr/regiohelden" class="ku-link" target="_blank" rel="nofollow" title="RegioHelden auf Kununu"><i class="fa fa-kununu-square"></i></a> 
                    </div>
				<?php wp_nav_menu( array( 'container_class' => 'footer-misc', 'theme_location' => 'footer' ) ); ?>
				</div>
				<a href="/ueber-uns/partner/" title="Google Partnerschaft"><img class="partner-logo" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/kombi-google-logo.png" alt="RegioHelden KMU Premium Partner Auszeichnung"></a></div>
			<div style="clear:both;"></div></div></div><div style="clear:both;"></div></div>
<div id="map_canvas"></div>
<!-- MMENU -->
<?php wp_nav_menu( array( 'container_id' => 'mmenu-navi', 'theme_location' => 'mobile-hauptnavi' ) ); ?>
<?php wp_footer(); ?>
<?php if ( is_user_logged_in() ) { ?>
    <!-- kein Analytics für eingeloggte User -->
<?php } else { ?>
    <script>
    var gaProperty = 'UA-10176826-7';
    var disableStr = 'ga-disable-' + gaProperty;
    if (document.cookie.indexOf(disableStr + '=true') > -1) {
      window[disableStr] = true;
    }
    function gaOptout() {
      document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
      window[disableStr] = true;
      alert("Google Analytics erfolgreich deaktiviert (OptOut).");
    }
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
        ga('create', 'UA-10176826-7', 'auto');
        ga(‘set’, ‘anonymizeIp’, true);
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
        
        ga('create', 'UA-10176826-1', 'auto', {'name': 'newTracker'});  // alter Account für regiohelden.de.
        ga('newTracker.send', 'pageview'); // Send page view for new tracker.
        ga(‘set’, ‘anonymizeIp’, true);
        
        // ga('create', 'UA-31780252-6', 'auto', {'name': 'newTracker1'});  // Account für ADWORDS KAMPAGNE STUTTGART.
        // ga('newTracker1.send', 'pageview'); // Send page view for new tracker.
    </script>
<?php } ?>
<div style="height: 0px; overflow: hidden;">

        <!-- Google Code für ein Remarketing-Tag -->
        <!--------------------------------------------------
        Remarketing-Tags dürfen nicht mit personenbezogenen Daten verknüpft oder auf Seiten platziert werden, die sensiblen Kategorien angehören. Weitere Informationen und Anleitungen zur Einrichtung des Tags erhalten Sie unter: http://google.com/ads/remarketingsetup
        --------------------------------------------------->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 974062212;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/974062212/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
        
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5V44VK"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5V44VK');</script>
        <!-- End Google Tag Manager -->

        <!-- Google Code für ein Remarketing-Tag -->
        <!--------------------------------------------------
        Remarketing-Tags dürfen nicht mit personenbezogenen Daten verknüpft oder auf Seiten platziert werden, die sensiblen Kategorien angehören. Weitere Informationen und Anleitungen zur Einrichtung des Tags erhalten Sie unter: http://google.com/ads/remarketingsetup
        --------------------------------------------------->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 973286189;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/973286189/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
        
        <!-- Google Code für ein Remarketing-Tag -->
        <!--------------------------------------------------
        Remarketing-Tags dürfen nicht mit personenbezogenen Daten verknüpft oder auf Seiten platziert werden, die sensiblen Kategorien angehören. Weitere Informationen und Anleitungen zur Einrichtung des Tags erhalten Sie unter: http://google.com/ads/remarketingsetup
        --------------------------------------------------->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 979990715;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/979990715/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
        
        <!-- Google Code für ein Remarketing-Tag -->
        <!--------------------------------------------------
        Remarketing-Tags dürfen nicht mit personenbezogenen Daten verknüpft oder auf Seiten platziert werden, die sensiblen Kategorien angehören. Weitere Informationen und Anleitungen zur Einrichtung des Tags erhalten Sie unter: http://google.com/ads/remarketingsetup
        --------------------------------------------------->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 978848985;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/978848985/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
        
        <!-- Google Code für ein Remarketing-Tag -->
        <!--------------------------------------------------
        Remarketing-Tags dürfen nicht mit personenbezogenen Daten verknüpft oder auf Seiten platziert werden, die sensiblen Kategorien angehören. Weitere Informationen und Anleitungen zur Einrichtung des Tags erhalten Sie unter: http://google.com/ads/remarketingsetup
        --------------------------------------------------->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 976942188;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>

        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/976942188/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>

        <script type="text/javascript">
        !function(i,n,s,p,e,c,t,o,r){
            if(!p.getElementById(c))
            {
                r=String(new Date().getTime()/1000);e=("//-/-").replace(/-/,c.replace(/-/g,".")).replace(/-/,
                e.replace(/#/,i).replace(/#/,r));n=p.createElement(s);n.type=t;n.async=true;n.src=e;n.id=c;o=
                p.getElementsByTagName(s)[0];o.parentNode.insertBefore(n,o);
            }
        }( 
            "ccbkCedcbDehdjkBCkEgCDCA-ffFEEHGDeGhkgmikeDHjFgFD",null,
            "script",document,"javascript/#/simple-15072014.js?_=#","js-leadinspector-de","text/javascript"
        );
        </script>

</div>
</body>
</html>

<!-- backup font, loads last
<link href='http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'> -->