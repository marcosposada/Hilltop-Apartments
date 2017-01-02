<?php
if (have_posts()): while (have_posts()) : the_post();
    $post = get_post( the_id() );
    header('location: /rooms/' . $post->post_name);
    exit();
endwhile;
endif;
?>
