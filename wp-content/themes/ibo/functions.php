<?php

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

if (!file_exists(get_template_directory() . '/class-wp-bootstrap-navwalker.php')) {
    // File does not exist... return an error.
    return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
    // File exists... require it.
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}


// Add featured image to theme function
add_theme_support('post-thumbnails');

/*
        ** Add stylesheet function
        ** Added by ibrahim ashour
    */

function ibo_add_styles()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/all.min.css');
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/style.css');
}

/** 
 * Add scripts function
 * Added by ibrahim ashour
 */


function ibo_add_scripts()
{
    //Remove jquery registration
    wp_deregister_script('jquery');
    //Register jquery again but in another place
    wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), array(), false, true);
    //enqueue jquery
    wp_enqueue_script('jquery');
    wp_enqueue_script('fontawesome-js', get_template_directory_uri() . '/js/all.min.js', array(), false, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array(), false, true);
}



/** 
 * Add custom menu to theme function
 */

function ibo_add_menu()
{
    register_nav_menus(array(
        'navbar-menu' => 'Display in navbar',
        'footer-menu' => 'Display in footer',
    ));
}


/**
 * Add nav menu function
 */
function ibo_show_bootsrap_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'navbar-menu',
        'container' => false,
        'menu_class' => '',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
        'depth' => 2,
        'walker' => new bootstrap_5_wp_nav_menu_walker()
    ));
}

/** 
 * Add actions
 */

add_action('wp_enqueue_scripts', 'ibo_add_styles');
add_action('wp_enqueue_scripts', 'ibo_add_scripts');
add_action('after_setup_theme', 'ibo_add_menu');


//Modify read more link style function
function modify_read_more_link()
{
    return '<a class="more-link btn btn-outline-primary" href="' . get_permalink() . '" role="button">Continue Reading</a>';
}
add_filter('the_content_more_link', 'modify_read_more_link');


/**
 * custom excerpt length function
 * custom excerpt more string function
 */

function ibo_custom_excerpt_length()
{
    if (is_author()) {
        return 30;
    } else if (is_category()) {
        return 40;
    } else {
        return 60;
    }
}

function ibo_custom_more_excerpt_text()
{
    return ' ...';
}

add_filter('excerpt_length', 'ibo_custom_excerpt_length');

add_filter('excerpt_more', 'ibo_custom_more_excerpt_text');


/**
 * Pagination function
 */
function ibo_custom_pagination()
{
    global $wp_query; //Get Wp_Query global variable
    $number_of_pages = $wp_query->max_num_pages; //Get number of pages
    $current_page = get_query_var('paged', 1); //Get current page number
    if ($number_of_pages > 1) {
        return paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'total' => $number_of_pages,
            'current' => $current_page,
            'prev_text' => '<i class="fas fa-backward"></i>',
            'next_text' => '<i class="fas fa-forward"></i>',
            'mid_size' => 2,
            'end_size' => 2
        ));
    }
}


/**
 * Register sidebar function
 */

function ibo_register_sidebar()
{
    //Main sidebar
    $main_sidebar_arguments = array(
        'name' => 'Main Sidebar',
        'id' => "main-sidebar",
        'description' => 'This is main sidebar',
        'class' => 'main-sidebar-container',
        'before_widget' => '<div id="%1$s"class="widget %2$s card mb-3 p-3">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="alert alert-secondary border-0 rounded-0 h5 category-header" role="alert">',
        'after_title' => '</h3>',

    );
    register_sidebar($main_sidebar_arguments);
}

add_action('widgets_init', 'ibo_register_sidebar');


/**
 * Get the number of comments for current category function
 */


function ibo_comments_num_for_curr_cat()
{
    $comments_count = 0;
    $all_comments = get_comments(array(
        'status' => 'approve'
    ));
    foreach ($all_comments as $comment) {
        $post_id = $comment->comment_post_ID;
        if (!in_category(get_queried_object()->term_id, $post_id)) {
            continue;
        } else {
            $comments_count++;
        }
    }
    echo $comments_count;
}
