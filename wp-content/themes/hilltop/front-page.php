<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div id="home" class="content-area">
    <div class="entry-header"></div>

    <main class="home-main entry-content" role="main">

        <ul class="accordion" data-accordion>
            <li class="accordion-navigation ">

                    <a href="#panel1a" class="mobile-accordion-button rooms" ><span class="section-overlay"><b>Rooms</b></span></a>


                <div id="panel1a" class="content">
                    <?php wp_nav_menu( array('menu' => 'Mobile rooms menu' )); ?>
                </div>
            </li>
        </ul>

        <section class="rates">
            <a href="rates/">
                <span class="section-overlay">
                    <b>Rates</b>
                </span>
            </a>
        </section>
        <section class="about">
            <a href="about/">
                <span class="section-overlay">
                    <b>About</b>
                </span>
            </a>
        </section>
        <section class="contact">
            <a href="contact/">
                <span class="section-overlay">
                    <b>Contact</b>
                </span>
            </a>
        </section>

    </main>
</div>


<?php get_footer(); ?>
