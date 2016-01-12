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
?>
			</div><!-- #container -->
		</div><!-- #content -->

		<footer id="colophon" class="footer">
			<div class="<?php echo $container_class; ?>">
				<div class="row">
					<div class="col-md-12">
						<?php dynamic_sidebar('sidebar-footer');  ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="pull-left">
							<?php 
							if( !empty(get_page_by_path('/datenschutz')) ) {
								$privacy = get_page_by_path('/datenschutz');
								echo '<a href="/datenschutz" title="' . $privacy->post_title . '">' . $privacy->post_title . '</a>&nbsp;&nbsp;&nbsp;&nbsp;';
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
                        </div>
                        <div class="clearfix"></div>
					</div>
				</div>
			</div>	
		</footer>

		<?php wp_footer(); ?>
		<?php echo $mws_options['code_footer'] ?>
	</body>
</html>
