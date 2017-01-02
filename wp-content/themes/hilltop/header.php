<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
$GLOBALS['bg_image_vars'] = get_random_background_image();

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <script>(function(){document.documentElement.className='js'})();</script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <div class="sticky">
            <nav class="tab-bar hide-for-medium-up" data-topbar role="navigation" data-options="sticky_on: small">
                <section class="left-small">
                    <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
                </section>
                <section class="right tab-bar-section">
                    <a class="logo" href="<?php bloginfo('url'); ?>" alt="<?php bloginfo('description'); ?>" title="<?php bloginfo('name'); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/images/hilltop-sticky-logo.png"/>
                    </a>
                </section>
            </nav>
        </div>

        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list">
                <li><label><?php bloginfo('name'); ?></label></li>
                <?php
                $menuParameters = array(
                    'theme_location'  => 'header-menu',
                    'container'       => false,
                    'echo'            => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 0,
                    'walker'          => new Off_Canvas_Walker_Nav_Menu()
                );

                $off_canvas_menu = wp_nav_menu( $menuParameters );
                echo $off_canvas_menu;
                ?>
            </ul>
            <a class="follow-fb"><span class="fb-logo"><i class="fa fa-facebook"></i></span><span class="fb-text">Follow on Facebook</span></a>
            <a href="http://www.smithandrowe.com.au" target="_blank" class="sr-logo" alt="Designed and developed by Smith and Rowe"></a>
        </aside>
        <div class="container full-width">
            <header class="page-header">
                <a href="/" class="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" class="logo-image"/><span>Hilltop Apartment - Phillip Island</span></a>
                <nav>
                    <?php show_nav('header-menu'); ?>
                </nav>
                <a href="https://www.facebook.com/HilltopAccom" class="follow-fb" target="_blank"><span class="fb-logo"><i class="fa fa-facebook"></i></span><span class="fb-text">Follow on Facebook</span></a>
                <a href="http://www.smithandrowe.com.au" target="_blank" class="sr-logo" alt="Designed and developed by Smith and Rowe"></a>
            </header>
