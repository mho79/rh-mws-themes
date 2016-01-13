<?php
/**
 * Template Name: Datenschutz
 * The template for displaying the privacy page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
			<header>
				<?php the_title( '<h1>', '</h1>' ); ?>
			</header>

			<?php 
				while (have_posts()) : 
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>