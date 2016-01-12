<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MWS_2016
 */
get_header(); ?>

	<div class="row">
		<?php
			$content_class = 'col-lg-8 col-sm-7';
			if (!is_active_sidebar('sidebar-main') || $mws_options['fullwidth']):
				$content_class = 'col-lg-12';
			endif;
		?>
		<main id="main" class="<?php echo $content_class; ?> col-xs-12" role="main">
			<?php 
				while ( have_posts() ) : 
					the_post();

					get_template_part( 'template-parts/content', 'single' );

					/**
					 * comments are always disabled
					 * uncomment to enable comments
					 */
					/* if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif */;
				endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
