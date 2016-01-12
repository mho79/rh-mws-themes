<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
		<main id="main" class="adwords <?php echo $content_class; ?> col-xs-12" role="main">
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