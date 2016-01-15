<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MWS_2016
 */
global $mws_options;

$container_class = 'container';
if($mws_options['footer_fullwidth']) {
    $container_class = 'container-fluid';
}
?>
			</div><!-- #container -->
		</div><!-- #content -->

		<footer id="colophon" class="footer<?php echo ' ' . $container_class; ?>">
			<div class="container">
				<div class="row gap">
					<div class="col-md-12">
						<div class="pull-left">
							<?php 
							if (!empty($mws_options['contact_company'])) { 
								echo $mws_options['contact_company'] . '&nbsp;|&nbsp;'; 
							}

							if (!empty($mws_options['contact_additional_info'])) { 
								echo $mws_options['contact_additional_info'] . '&nbsp;|&nbsp;'; 
							}

							if (!empty($mws_options['contact_street'])) { 
								echo $mws_options['contact_street'] . '&nbsp;|&nbsp;';
							} 

							if (!empty($mws_options['contact_zip'])) { 
								echo $mws_options['contact_zip'] . '&nbsp;'; 
							} 

							if (!empty($mws_options['contact_city'])) { 
								echo $mws_options['contact_city'] . '&nbsp;|&nbsp;'; 
							}

							echo "Tel.: {regiohelden.proxy.number}&nbsp;|&nbsp;";

							if( !empty(get_page_by_path('/datenschutz')) ) {
								$privacy = get_page_by_path('/datenschutz');
								echo '<a href="/datenschutz" title="' . $privacy->post_title . '">' . $privacy->post_title . '</a>&nbsp;|&nbsp;';
							} 

							if( !empty(get_page_by_path('/impressum')) ) {
								$imprint = get_page_by_path('/impressum');
								echo '<a href="/impressum" title="' . $imprint->post_title . '">' . $imprint->post_title . '</a>';
							} 
							?>
						</div>

                        <div class="pull-right">
                        	<?php if ($mws_options['whitelabel'] == 2) { ?>
                                <a href="http://www.regiohelden.de" target="_blank">Lokale Internetwerbung</a> 
                                von den <a href="http://www.regiohelden.de" target="_blank">RegioHelden</a>
                            <?php } elseif ($mws_options['whitelabel'] == 4) { ?>
                                Präsentiert von
                                <a href="http://unser-stuttgart.de" target="_blank">Unser-Stuttgart.de</a>
                            <?php } ?>
                            &copy; <?php echo date("Y"); ?>
                        </div>
                        <div class="clearfix"></div>
					</div>
				</div>
			</div>	

			<div class="<?php echo $container_class; ?>">
				<div class="row">
					<?php dynamic_sidebar('sidebar-footer');  ?>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?>
		
		<script>
			var gaProperty = '<?php echo $mws_options["ga"]; ?>',
				disableStr = 'ga-disable-' + gaProperty,
				clickConv = '<?php !empty($mws_options["form_conversion"]) ? $mws_options["form_conversion"] : "" ?>',
				google_conversion_id = '<?php if (!empty($mws_options["form_conversion_id"])) { echo $mws_options["form_conversion_id"]; } ?>',
                google_conversion_label = '<?php if (!empty($mws_options["form_conversion_label"])) { echo $mws_options["form_conversion_label"]; } ?>';

			if (document.cookie.indexOf(disableStr + '=true') > -1) {
			  	window[disableStr] = true;
			}
			 
			function gaOptout() {
				console.log('optout successful');
			  	document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
			  	window[disableStr] = true;
			}

			<?php if (!is_user_logged_in()) { ?>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	            ga('create', gaProperty, 'auto');
	            ga('set', 'anonymizeIp', true);
	            ga('send', 'pageview');
            <?php } ?>
		</script>

		<?php echo $mws_options['code_footer'] ?>
	</body>
</html>
