<?php
/**
 * Template Name: Sidebar rechts
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
 get_header(); ?>
 
<!-- Main Wrapper -->
<div class="wrapper sidebar-content-wrapper">
	<!-- Sidebar -->
	<aside class="sidebar">
		<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
	</aside>

	<main role="main" class="content sidebar-content">
		<!-- section -->
		<section>
			<?php if (have_posts()): 
				while (have_posts()) : the_post(); ?>
					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
					<!-- /article -->
				<?php endwhile;
			else: ?>
				<!-- article -->
				<article>
					<div class="bg-parallax gambit-bg-parallax parallax" data-bg-align="" data-direction="none" 
					     data-velocity="-0.8" data-mobile-enabled="" data-break-parents="" data-bg-height="" 
					     data-bg-width="" data-bg-image="" data-bg-size-adjust="dont-scale" data-bg-repeat="false" 
					     style="display: none;"></div>

					<div class="wpb_row vc_row-fluid vc_custom_1426868540828 bg-parallax-parent" style="color: rgb(255, 255, 255); background-attachment: scroll; background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
						<div class="vc_span12 wpb_column column_container">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element  tocki-spacer">
									<div class="wpb_wrapper">
										<h1 style="text-align: center;"><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
									</div> 
								</div> 
							</div> 
						</div>
					</div>
				</article>
				<!-- /article -->
			<?php endif; ?>
		</section>
		<!-- /section -->
	</main>

	<aside class="sidebar mobile-sidebar">
		<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
	</aside>
</div>
<!-- /mainwrapper -->

<?php get_footer(); ?>
