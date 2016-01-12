<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MWS_2016
 */
global $mws_options;

/**
 * if additional mobile campaign exist redirect and track campaign ID
 */
if (   $mws_options['mobile_switcher']
    && !empty($mws_options['mobile_campaign'])
    && function_exists('is_mobile')
    && is_mobile()
    && !isset($_COOKIE['is_mobile'])) 
{
    setcookie('is_mobile', true);
    $redirect_url = get_permalink( $post->ID ) . '?campaignId=' . $mws_options['mobile_campaign'];
    wp_redirect( $redirect_url, 301 );
    
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            <?php wp_title('|', true, 'right'); ?>
            <?php if (!empty($mws_options['page_title'])) { 
                echo $mws_options['page_title']; 
            } ?>
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"> 

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php wp_head(); ?>
        <?php echo $mws_options['code_header'] ?>
    </head>

    <body <?php body_class(); ?>>
        <?php $container_class = 'container'; ?>

        <div class="header">
            <?php if($mws_options['logo_row']) { ?>
                <div class="logo-row hidden-xs<?php echo (($mws_options['header_fixed'] && $mws_options['nav_fullwidth']) ? ' fixed' : ''); ?>">
                    <div class="<?php echo $container_class; ?>">
                        <a href="<?php echo (!empty($mws_options['logo_url']) ? esc_url($mws_options['logo_url']) : esc_url(home_url( '/' ))); ?>" 
                           class="navbar-brand" title="<?php echo get_bloginfo( 'name' ); ?>">
                            <?php 
                            if(!empty($mws_options['logo']['url'])) {
                                echo '<img class="navbar-logo" src="' . $mws_options['logo']['url'] . '" alt="' . get_bloginfo( 'name' ) . '">';
                            } else {
                                bloginfo( 'name' );
                            }
                            ?>
                        </a>

                        <div class="phonebox text-primary pull-right clearfix">
                            <b>Jetzt unverbindlich anfragen</b>
                            <i class="glyphicon glyphicon-earphone"></i> 
                            <?php echo do_shortcode( '[ProxyNumber]' ); ?>
                        </div>
                    </div>
                </div>
            <?php  } ?>
            
            <nav class="navbar navbar-default<?php echo (($mws_options['header_fixed'] && $mws_options['nav_fullwidth']) ? ' navbar-fixed-top' : ''); ?>">
                <div class="<?php echo $container_class; ?>">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
                                data-target="#mainNav" aria-expanded="false">
                            <span class="sr-only">Menü</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a href="<?php echo (!empty($mws_options['logo_url']) ? esc_url($mws_options['logo_url']) : esc_url(home_url( '/' ))); ?>" 
                           class="navbar-brand<?php echo ($mws_options['logo_row']) ? ' hidden-lg hidden-md hidden-sm' : ''; ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
                            <?php 
                            if(!empty($mws_options['logo']['url'])) {
                                echo '<img class="navbar-logo" src="' . $mws_options['logo']['url'] . '" alt="' . get_bloginfo( 'name' ) . '">';
                            } else {
                                bloginfo( 'name' );
                            }
                            ?>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="mainNav">
                        <?php
                        $nav = 'main';
                        if(is_page_template( 'page-adwords.php' )) {
                            $nav = 'adwords';
                        }

                        $menu_settings = array(
                            'theme_location' => $nav, 
                            'container' => false,
                            'menu_class' => 'nav navbar-nav',
                            'depth' => 2,
                            'walker' => new wp_bootstrap_navwalker()
                        );
                        wp_nav_menu( $menu_settings ); 
                        ?>
                    </div>

                    <?php if($mws_options['badge'] && !empty($mws_options['badge_html'])) {
                        echo $mws_options['badge_html'];
                    } ?>
                </div>
            </nav>
        </div>

        <?php 
        $container_class = 'container';
        if($mws_options['fullwidth']) {
            $container_class = 'container-fluid';
        }
        ?>
        <div id="content" class="content<?php echo (!$mws_options['header_fixed'] ? ' content-static' : ''); ?>">
            <?php
            if(!$mws_options['image_fullwidth']) {
                echo '<div class="container">';
            }

            if(!empty($mws_options['keyvisual']['url']) && !has_post_thumbnail($post->ID)) {
                echo '<div class="keyvisual" data-parallax="scroll" data-image-src="' . $mws_options['keyvisual']['url'] . '"></div>';
            } elseif(has_post_thumbnail($post->ID)) {
                echo '<div class="keyvisual" style="background-image:url(' . wp_get_attachment_image_src(get_post_thumbnail_id(), 'full') . ')"></div>';
            }

            if(!$mws_options['image_fullwidth']) {
                echo '</div>';
            }
            ?>

            <div class="main <?php echo $container_class; ?>">