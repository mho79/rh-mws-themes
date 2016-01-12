<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MWS_2016
 */
global $mws_options;

if (!is_active_sidebar('sidebar-main')) {
	return;
}

$class = 'sidebar col-lg-4 col-sm-5';
if ($mws_options['fullwidth']) {
	$class = 'sidebar col-md-12';
}

if ($mws_options['fullwidth']) {
	echo '<div class="row">';
}
?>
	<div id="sidebar" class="<?php echo $class; ?> col-xs-12" role="complementary">
		<?php 
		if ($mws_options['fullwidth']) {
			echo '<div class="container">';
		}

		dynamic_sidebar('sidebar-main');

		if ($mws_options['fullwidth']) {
			echo '</div>';
		} 
		?>
	</div>
<?php if ($mws_options['fullwidth']) {
	echo '</div';
}
?>