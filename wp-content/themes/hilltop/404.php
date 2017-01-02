<?php get_header(); ?>
<div class="content-area">
    <main id="main" class="site-main" role="main">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-header">
                <h1 class="entry-title">404 Error</h1>
            </div><!-- .entry-header -->

            <div class="entry-content">
               <p>The page you are looking for is not found.</p>
            </div><!-- .entry-content -->

        </article><!-- #post-## -->


    </main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
