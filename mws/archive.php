<?php
/**
 * The template for displaying archive pages.
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
				<?php
					the_archive_title( '<h1>', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>

			<?php 
				if ( have_posts() ) :
					while (have_posts()) : 
						the_post();
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;

					rh_the_posts_navigation();
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>