    <?php
    /**
     * The template used for displaying page content
     *
     * @package WordPress
     * @subpackage Twenty_Fifteen
     * @since Twenty Fifteen 1.0
     */
    $id = get_the_ID();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </div><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
            <?php get_room_rate($id); ?>
            <a href="/bookings" class="btn-check-avail">Check Availability and Bookings</a>
            <?php get_room_gallery_thumb_list($id); ?>
            <div class="nav-links">
                <?php
                $prev_post = get_previous_post();
                if (!empty($prev_post)) {
                    echo '<a href="/bookings/' . $prev_post->post_name . '" class="previous"><i class="fa fa-chevron-left"></i><span>Prevous Room<span class="title">' . $prev_post->post_title . '</span></span></a>';
                } else {
                    $last_post = get_posts('posts_per_page=1&order=DESC&post_status=publish&post_type=rooms');
                    if (!empty($last_post)) {
                        echo '<a href="/bookings/' . $last_post[0]->post_name . '" class="previous"><i class="fa fa-chevron-left"></i><span>Prevous Room<span class="title">' . $last_post[0]->post_title . '</span></span></a>';
                    }
                }
                $next_post = get_next_post();
                if (!empty($next_post)) {
                    echo '<a href="/bookings/' . $next_post->post_name . '" class="next"><i class="fa fa-chevron-right"></i><span>Next Room<span class="title">' . $next_post->post_title . '</span></span></a>';
                } else {
                    $first_post = get_posts('posts_per_page=1&order=ASC&post_status=publish&post_type=rooms');
                    if (!empty($first_post)) {
                        echo '<a href="/bookings/' . $first_post[0]->post_name . '" class="next"><i class="fa fa-chevron-right"></i><span>Next Room<span class="title">' . $first_post[0]->post_title . '</span></span></a>';
                    }
                }
                ?>
            </div>
            <div id="gallery-image-modal" class="reveal-modal" data-reveal aria-labelledby="secondModalTitle" aria-hidden="true" role="dialog">
                <img id="modal-image" />
                <div class="modal-image-description"><span id="image-description"></span><span id="image-index"></span></div>
                <a class="btn-arrow btn-modal-prev"><i class="fa fa-angle-left"></i></a><a class="btn-arrow btn-modal-next"><i class="fa fa-angle-right"></i></a>
                <a class="close-reveal-modal" aria-label="Close">Close <span>&#215;</span></a>
            </div>
        </div><!-- .entry-content -->

    </article><!-- #post-## -->