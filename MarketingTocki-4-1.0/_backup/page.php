<?php 
if (   ($tocki_redux_themeoptions['tocki_redux_mobile_switcher'] == 1)
    && !empty($tocki_redux_themeoptions["tocki_redux_mobile_campaign"])
    && is_mobile()
    && !isset($_COOKIE['MobileCookie'])) 
{
    // A cookie will be set that the user won't be redirected anymore
    setcookie('MobileCookie', 'true');
    $_COOKIE['MobileCookie'] = 'true';
    // Creating of the redirect URL
    $redirect_url = get_permalink( $post->ID ) . '?campaignId=' . $tocki_redux_themeoptions["tocki_redux_mobile_campaign"];
    // Redirect
    wp_redirect( $redirect_url, 301 ); exit;
} else { 
	get_header(); ?>

	<main role="main" class="content">
		<!-- section -->
		<section>
			<?php if (have_posts()): 
				while (have_posts()) : 
					the_post(); ?>
					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article><!-- /article -->
				<?php endwhile; ?>
			<?php else: ?>
				<!-- article -->
				<article>
					<div class="bg-parallax gambit-bg-parallax parallax" data-bg-align="" data-direction="none" data-velocity="-0.8" data-mobile-enabled="" data-break-parents="" data-bg-height="" data-bg-width="" data-bg-image="" data-bg-size-adjust="dont-scale" data-bg-repeat="false" style="display: none;"></div>
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
				</article><!-- /article -->
			<?php endif; ?>
		</section>
		<!-- /section -->
	</main>

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
<?php } ?>