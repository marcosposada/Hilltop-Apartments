<?php

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here


/*------------------------------------*\
	Functions
\*------------------------------------*/

class Off_Canvas_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="left-submenu"><li class="back"><a href="#">Back</a></li>';
    }
}

class My_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu">';
    }
}
// HTML5 Blank navigation
function show_nav($nav_menu)
{
    $menus = wp_nav_menu(
        array(
            'theme_location'  => $nav_menu,
            'echo'            => false,
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => '',
            'walker'          => new My_Walker_Nav_Menu()
        )
    );

    echo $menus;

}


// Load HTML5 Blank scripts (header.php)
function sr_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('sr_scripts', get_template_directory_uri() . '/js/min/scripts-min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('sr_scripts'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function sr_styles()
{

    wp_register_style('sr_style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('sr_style'); // Enqueue it!
}


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}


// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}


// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'sr_header_scripts'); // Add Custom Scripts to wp_head
add_action('init', 'register_menus'); // Add  Menu
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'sr_styles'); // Add Theme Stylesheet
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
//add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
//add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
//add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


// Register HTML5 Blank Navigation
function register_menus()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' =>  'Header Menu',
    ));
}


add_image_size( 'room-gallery-thumb', 94, 62, true );
add_image_size( 'room-gallery-large', 960, 640);
add_image_size( 'page-background-image', 1920);

function get_room_gallery_thumb_list($id) {
    $images = get_field('gallery_images', $id);
    $post = get_post($id);
    $gallery_images_loader = NULL;
    if (!empty($images)) {
        $large_images_html_str = $thumb_images_html_str = NULL;
        $image_ctr = 0;
        foreach ($images as $image) {
            if ($image_ctr == 0) $default_image = $image['image']['url'];
            $this_thumb = (isset($image['image']['sizes']['room-gallery-thumb']) && !empty($image['image']['sizes']['room-gallery-thumb'])) ? $image['image']['sizes']['room-gallery-thumb'] : $image['image']['sizes']['thumb'];
            $this_large = (isset($image['image']['sizes']['room-gallery-large']) && !empty($image['image']['sizes']['room-gallery-large'])) ? $image['image']['sizes']['room-gallery-large'] : $image['image']['url'];
            $thumb_images_html_str .= '<li><a href="' . $this_large . '" ><img src="' . $this_thumb . '" title="Hilltop Apartments - Rooms - ' . $post->post_title . '" /></a></li>';
            //$large_images_html_str .= '<li><img src="' . $this_large . '" /></li>';

            $gallery_images_loader .= 'var img_' . $image_ctr . ' = new Image();' . "\n";
            $gallery_images_loader .= 'img_' . $image_ctr . '.src = "' .  $this_large  . '"' . ";\n";
            $image_ctr++;
        }
        if ($thumb_images_html_str) {
            echo  '<h3>Gallery</h3><ul class="room-thumb-list">' . $thumb_images_html_str . '</ul>' . '';
        }
    }
}


function get_room_rate($id) {
    $weekend_rates = get_field('weekend_rates', $id)[0];
    $weekday_rates = get_field('weekday_rates', $id)[0];
    $event_rates = get_field('event_rates', $id)[0];

    $rate_html = '<table cellpadding="0" cellspacing="0" class="table-rate"><tr><th class="th-rate">RATES <span>per night</span></th><th class="th-peak">PEAK</th><th class="th-off-peak">OFF-PEAK</th></tr>';
    $rate_html .= '<tr><td class="td-rate">Weekend (Fri-Sat)</td><td class="td-peak">' . get_dollar_sign_prefix($weekend_rates['peak_price']) . '</td><td class="td-off-peak">' . get_dollar_sign_prefix($weekend_rates['off_peak_price']) . '</td></tr>';
    $rate_html .= '<tr><td class="td-rate">Weekday</td><td class="td-peak">' . get_dollar_sign_prefix($weekday_rates['peak_price']) . '</td><td class="td-off-peak">' . get_dollar_sign_prefix($weekday_rates['off_peak_price']) . '</td></tr>';
    $rate_html .= '<tr><td class="td-rate">Events</td><td class="td-peak">' . get_dollar_sign_prefix($event_rates['peak_price']) . '</td><td class="td-off-peak">' . get_dollar_sign_prefix($event_rates['off_peak_price']) . '</td></tr>';
    $rate_html .= '</table>';
    echo $rate_html;
    /*
     if (!empty($rates)) {
        $rate_html = '<table cellpadding="0" cellspacing="0" class="table-rate"><tr><th class="th-rate">RATES <span>per night</span></th><th class="th-peak">PEAK</th><th class="th-off-peak">OFF-PEAK</th></tr>';
        foreach ($rates as $rate) {
            $rate_html .= '<tr><td class="td-rate">' . $rate['rates_per_night'] . '</td><td class="td-peak">' . $rate['peak_price'] . '</td><td class="td-off-peak">' . $rate['off_peak_price'] . '</td></tr>';
        }
        $rate_html .= '</table>';
        echo $rate_html;
     }
     */
}
function get_dollar_sign_prefix($value){
    if (is_numeric($value)){
        return '$' . $value;
    } else {
        return $value;
    }
}

function get_rates() {

    $rooms = get_posts(array('post_type' => 'rooms', 'orderby' => 'name', 'order' => 'ASC', 'numberposts' => -1));
    //print_r($rooms);
    $rooms_peak_html_array = array();
    $rooms_off_peak_html_array = array();
    if (!empty($rooms)) {;
        foreach ($rooms as $room) {
            $this_category = get_the_category( $room->ID)[0];

            //print_r($room);
            $weekend_rates = get_field('weekend_rates', $room->ID)[0];
            $weekday_rates = get_field('weekday_rates', $room->ID)[0];
            $event_rates = get_field('event_rates', $room->ID)[0];

            if (!isset($rooms_peak_html_array[$this_category->name])) {
                $rooms_peak_html_array[$this_category->name][] = '<table cellpadding="0" cellspacing="0" class="table-list-rates"><tr><th class="th-apartment">' . $this_category->name . '</th><th class="th-weekend">Weekend</th><th class="th-weekday">Weekday</th><th class="th-events">Events</th></tr>';
            }
            $rooms_peak_html_array[$this_category->name][] = '<tr><td class="td-apartment"><a href="' .get_permalink( $room->ID ) . '">' . $room->post_title . '</a></td><td class="td-weekend">' . get_dollar_sign_prefix($weekend_rates['peak_price']) . '</td><td class="td-weekday">' . get_dollar_sign_prefix($weekday_rates['peak_price']) . '</td><td class="td-events">' . get_dollar_sign_prefix($event_rates['peak_price']) . '</td></tr>';

            if (!isset($rooms_off_peak_html_array[$this_category->name])) {
                $rooms_off_peak_html_array[$this_category->name][] = '<table cellpadding="0" cellspacing="0" class="table-list-rates"><tr><th class="th-apartment">' . $this_category->name . '</th><th class="th-weekend">Weekend</th><th class="th-weekday">Weekday</th><th class="th-events">Events</th></tr>';
            }
            $rooms_off_peak_html_array[$this_category->name][] = '<tr><td class="td-apartment"><a href="' .get_permalink( $room->ID ) . '">' . $room->post_title . '</a></td><td class="td-weekend">' . get_dollar_sign_prefix($weekend_rates['off_peak_price']) . '</td><td class="td-weekday">' . get_dollar_sign_prefix($weekday_rates['off_peak_price']) . '</td><td class="td-events">' . get_dollar_sign_prefix($event_rates['off_peak_price']) . '</td></tr>';

        }
        if (!empty($rooms_peak_html_array)) {
            echo '<div id="tab-peak-rates" class="rates-tab">';
            foreach ($rooms_peak_html_array as $rooms_html) {
                echo implode("\n", $rooms_html) . '</table>';
            }
            echo '</div>';
        }

        if (!empty($rooms_off_peak_html_array)) {
            echo '<div id="tab-off-peak-rates" class="rates-tab">';
            foreach ($rooms_off_peak_html_array as $rooms_html) {
                echo implode("\n", $rooms_html) . '</table>';

            }
            echo '</div>';
        }

        //echo $rate_html;
    }



}
add_shortcode('room_rates', 'get_rates');

function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }

    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


function get_random_background_image() {
    $bg_images = get_field('background_images', 'option');
    $rand_bg_image = $bg_images[ array_rand( $bg_images ) ]; // get a random row
    if ($rand_bg_image) {
        $return = array(
            'style' => ' style="background: url(\'' . $rand_bg_image['image']['sizes']['page-background-image'] . '\') no-repeat 0 0; background-size: cover;"',
            'text' => '<h2>' . $rand_bg_image['main_text'] . '</h2>' . $rand_bg_image['sub_text']
        );
        return $return;

    } else {
        return false;
    }

}