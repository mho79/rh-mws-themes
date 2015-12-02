<?php get_header(); ?>
	
<main role="main">
	<!-- section -->
	<section>
		<!-- article -->
		<article id="post-404">
			<div class="bg-parallax gambit-bg-parallax parallax corporate-color" data-bg-align="" 
				 data-direction="none" data-velocity="-0.8" data-mobile-enabled="" data-break-parents="" 
				 data-bg-height="" data-bg-width="" data-bg-image="" data-bg-size-adjust="dont-scale" 
				 data-bg-repeat="false" style="display: none;"></div>

			<div class="wpb_row vc_row-fluid vc_custom_1426868540828 bg-parallax-parent corporate-color" style="color: rgb(255, 255, 255);">
				<div class="vc_span12 wpb_column column_container">
					<div class="wpb_wrapper">
						<div class="wpb_text_column wpb_content_element tocki-spacer">
							<div class="wpb_wrapper">
								<h1 style="text-align: center;"><?php _e( 'Page not found', 'html5blank' ); ?></h1>
								<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'html5blank' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article>
		<!-- /article -->
	</section>
	<!-- /section -->
</main>

<?php 
get_sidebar();
get_footer();
?>