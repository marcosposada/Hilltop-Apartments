<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div><!-- .entry-header -->

    <div class="entry-content">
        <ul class="rates-tab-links">
            <li id="peak-rates" data-for="" class="selected"><a href="#">Peak Rates</a></li>
            <li id="off-peak-rates"><a href="#">Off-Peak Rates</a></li>
        </ul>
        <?php the_content(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
