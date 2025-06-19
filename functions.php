<?php

/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_Starter
 */

if (!function_exists('wp_bootstrap_starter_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_bootstrap_starter_setup()
    {
        /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
	 * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
	 */
        load_theme_textdomain('wp-bootstrap-starter', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
        add_theme_support('title-tag');

        /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'wp-bootstrap-starter'),
        ));

        /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('wp_bootstrap_starter_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        function wp_boostrap_starter_add_editor_styles()
        {
            add_editor_style('custom-editor-style.css');
        }
        add_action('admin_init', 'wp_boostrap_starter_add_editor_styles');
    }
endif;
add_action('after_setup_theme', 'wp_bootstrap_starter_setup');


/**
 * Add Welcome message to dashboard
 */
function wp_bootstrap_starter_reminder()
{
    $theme_page_url = 'https://afterimagedesigns.com/wp-bootstrap-starter/?dashboard=1';

    if (!get_option('triggered_welcomet')) {
        $message = sprintf(
            __('Welcome to WP Bootstrap Starter Theme! Before diving in to your new theme, please visit the <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">theme\'s</a> page for access to dozens of tips and in-depth tutorials.', 'wp-bootstrap-starter'),
            esc_url($theme_page_url)
        );

        printf(
            '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>',
            $message
        );
        add_option('triggered_welcomet', '1', '', 'yes');
    }
}
add_action('admin_notices', 'wp_bootstrap_starter_reminder');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wp_bootstrap_starter_content_width', 1170);
}
add_action('after_setup_theme', 'wp_bootstrap_starter_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts()
{
    // load bootstrap css
    wp_enqueue_style('wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css');

    // fontawesome cdn
    wp_enqueue_style('wp-bootstrap-pro-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/font-awsome.css');
    // load bootstrap css

    // load WP Bootstrap Starter styles
    wp_enqueue_style('wp-bootstrap-starter-style', get_stylesheet_uri());

    // ============= Load Custom stylesheets =============

    wp_enqueue_style('swiper', get_template_directory_uri() . '/inc/assets/css/swiper.min.css');

    if (is_front_page()) {
        // wp_enqueue_style( 'animate_headlines', get_template_directory_uri() . '/inc/assets/css/animate_headlines.css' );
    }
    // $current_language = apply_filters('wpml_current_language', NULL);
    // if($current_language === 'ar'){
        // wp_enqueue_style('custom_style_rtl', get_template_directory_uri() . '/inc/assets/css/rtl.css', array(), '2.21');
        // wp_enqueue_style('responsive_style_rtl', get_template_directory_uri() . '/inc/assets/css/responsive_rtl.css', array(), '2.21');

    // } else{
        wp_enqueue_style('custom_style', get_template_directory_uri() . '/inc/assets/css/custom_style.css', array(), '1.41');
        wp_enqueue_style('responsive_style', get_template_directory_uri() . '/inc/assets/css/responsive.css', array(), '1.41');
    // }

    wp_enqueue_script('jquery');

    // Internet Explorer HTML5 support
    wp_enqueue_script('html5hiv', get_template_directory_uri() . '/inc/assets/js/html5.js', array(), '3.7.0', false);
    wp_script_add_data('html5hiv', 'conditional', 'lt IE 9');

    // load bootstrap js
    wp_enqueue_script('wp-bootstrap-starter-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', false);
    wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', false);

    // ========================================================================
    // Add all custom js libraries here
	wp_enqueue_script('swiper', get_template_directory_uri() . '/inc/assets/js/swiper.min.js', array(), '1', false);

    // query loader
    // wp_enqueue_script('queryloader2-js', get_template_directory_uri() . '/inc/assets/js/queryloader2.min.js', array(), '1', true);
    // jquery visibale
    // wp_enqueue_script('queryvisible-js', get_template_directory_uri() . '/inc/assets/js/jquery.visible.js', array(), '1', true);
    // wp_enqueue_script('wp-bootstrap-starter-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.js', array(), '', true );
    // wp_enqueue_script('wp-bootstrap-starter-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true);
}
add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_scripts');


// // add boostrap min js
// function enqueue_bootstrap_cdn() {
//     wp_enqueue_script(
//         'bootstrap-cdn', // Handle name
//         'https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js',
//         array(), // Dependencies
//         null,    // Version
//         true     // Load in footer
//     );

//     // Optional: Add integrity and crossorigin attributes
//     wp_script_add_data('bootstrap-cdn', 'integrity', 'sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO');
//     wp_script_add_data('bootstrap-cdn', 'crossorigin', 'anonymous');
// }
// add_action('wp_enqueue_scripts', 'enqueue_bootstrap_cdn');


function wp_bootstrap_starter_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <div class="d-block mb-3">' . __("To view this protected post, enter the password below:", "wp-bootstrap-starter") . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __("Password:", "wp-bootstrap-starter") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit", "wp-bootstrap-starter") . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter('the_password_form', 'wp_bootstrap_starter_password_form');

function my_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);



// PHP Check if time is between two times regardless of date
function TimeIsBetweenTwoTimes($from, $till, $input)
{
    $f = DateTime::createFromFormat('H:i', $from);
    $t = DateTime::createFromFormat('H:i', $till);
    $i = DateTime::createFromFormat('H:i', $input);
    if ($f > $t) $t->modify('+1 day');
    return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
}
function wpb_custom_new_menu()
{
    register_nav_menus(array(
        'main-menu' => __('Main-Menu'),
    ));
}
add_action('init', 'wpb_custom_new_menu');
function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
function overrideSubmenuClasses($classes)
{
    $classes[] = 'dropdown-menu';
    $classes[] = '';

    return $classes;
}
add_action('nav_menu_submenu_css_class', 'overrideSubmenuClasses');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title' => 'Website Settings',
            'menu_title' => 'Website Settings',
            'menu_slug' => 'website-settings',
            'capabality' => 'edit_posts'
        )
    );
}

add_image_size('main_homepage_img', 1903, 690, true);
add_image_size('main_img_company_services', 1903, 300, true);
add_image_size('services_img', 656, 580, true);
add_image_size('footer_img', 1903, 340, true);


// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');

function gutenberg_editor_assets()
{
    // Load the theme styles within Gutenberg.
    wp_enqueue_style('my-gutenberg-editor-styles', get_theme_file_uri('/assets/gutenberg-editor-styles.css'), FALSE);
}
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a testimonial block.
        // acf_register_block_type(
        //     array(
        //         'name'              => 'Block1',
        //         'title'             => __('Block1'),
        //         'description'       => __('This is the first Block of Homepage'),
        //         'render_template'   => 'blocks/Homepage_Blocks/block_1.php',
        //         'category'          => 'formatting',
        //         'icon'              => 'admin-comments',
        //         'keywords'          => array('testimonial', 'quote'),
        //     )
        // );
        acf_register_block_type(
            array(
                'name'              => 'Block1',
                'title'             => __('Block1'),
                'description'       => __('This is the first Block of About us'),
                'render_template'   => 'blocks/about-us/block_one.php',
                'category'          => 'formatting',
                'icon'              => 'admin-comments',
                'keywords'          => array('testimonial', 'quote'),
            )
        );
        acf_register_block_type(
            array(
                'name'              => 'Block2',
                'title'             => __('Block2'),
                'description'       => __('This is the second Block of About us'),
                'render_template'   => 'blocks/about-us/block_two.php',
                'category'          => 'formatting',
                'icon'              => 'admin-comments',
                'keywords'          => array('testimonial', 'quote'),
            )
        );
        acf_register_block_type(
            array(
                'name'              => 'Block3',
                'title'             => __('Block3'),
                'description'       => __('This is the three Block of About us'),
                'render_template'   => 'blocks/about-us/block_three.php',
                'category'          => 'formatting',
                'icon'              => 'admin-comments',
                'keywords'          => array('testimonial', 'quote'),
            )
        );
    }
}

// Rename the "Post" post type labels
function rename_post_type_labels() {
    global $wp_post_types;

    // Get the post object to modify its labels
    if (isset($wp_post_types['post'])) {
        $labels = $wp_post_types['post']->labels;

        // Change the desired labels
        $labels->name               = 'Articles'; // General name for the post type
        $labels->singular_name      = 'Article';  // Singular name
        $labels->add_new            = 'Add New Article';
        $labels->add_new_item       = 'Add New Article';
        $labels->edit_item          = 'Edit Article';
        $labels->new_item           = 'New Article';
        $labels->view_item          = 'View Article';
        $labels->search_items       = 'Search Articles';
        $labels->not_found          = 'No Articles found';
        $labels->not_found_in_trash = 'No Articles found in Trash';
        $labels->all_items          = 'All Articles';
        $labels->menu_name          = 'Articles';
        $labels->name_admin_bar     = 'Article';
    }
}
add_action('init', 'rename_post_type_labels');

function limitWords($text, $limit = 5) {
    $words = explode(' ', $text);
    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }
    return $text;
}

function getPostWithCatAndTag($cat_id, $tag_ids) {
    $results = array();
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' =>  -1,
        'cat'            => $cat_id,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tag__in'        => $tag_ids,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            array_push($results, $post_id);
        }
    }
    wp_reset_postdata();
    return $results;
}

function getPostWithCatAndTagAndSearch($cat_id, $tag_ids, $search) {
    $results = array();
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' =>  -1,
        's'              => $search,
        'tax_query'      => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => array($cat_id),
            ),
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tag_ids,
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            array_push($results, $post_id);
        }
    }
    wp_reset_postdata();
    ?>
    <?php
    return $results;
}

function load_more_posts_search() {
    $category_id = $_POST['category_id'];
    $search = $_POST['search'];
    $get_fields = get_fields('category_' . $category_id);
    ?>
    <div id="search-container" class="container">
        <div class="row justify-content-between d-lg-flex d-none">
            <?php foreach ($get_fields['tags'] as $key => $tag) {
                $results = getPostWithCatAndTagAndSearch($category_id, array($tag), $search);
            ?>
                <div class="col-3">
                    <h5>
                        <?php
                            $tag = get_term_by('id', $tag, 'post_tag');
                            echo $tag -> name;
                        ?>
                    </h5>
                    <?php foreach ($results as $post) { ?>
                        <a href="<?php echo get_permalink($post); ?>">
                            <?php echo get_the_title($post); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="row d-lg-none d-flex">
            <div class="col-12">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <?php foreach ($get_fields['tags'] as $key => $tag) {
                        $results = getPostWithCatAndTagAndSearch($category_id, array($tag), $search);
                    ?>
                        <div class="accordion-item">
                            <h5 class="accordion-header mb-0" id="flush-heading<?php echo $key; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $key; ?>" aria-expanded="false" aria-controls="flush-collapse-<?php echo $key; ?>">
                                    <?php
                                        $tag = get_term_by('id', $tag, 'post_tag');
                                        echo $tag -> name;
                                    ?>
                                </button>
                            </h5>
                            <div id="flush-collapse-<?php echo $key; ?>" class="accordion-collapse collapse show" aria-labelledby="flush-heading<?php echo $key; ?>" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <?php foreach ($results as $post) { ?>
                                        <a href="<?php echo get_permalink($post); ?>">
                                            <?php echo get_the_title($post); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    wp_die();
}
add_action('wp_ajax_load_more_posts_search', 'load_more_posts_search');
add_action('wp_ajax_nopriv_load_more_posts_search', 'load_more_posts_search');

//filter on the videos page based on tags
function filter_videos_based_tags() {
    $tags_video_ids = $_POST['videoTags'];
    $video_parts = new WP_Query(
        array(
            'post_type'      => 'video',
            'posts_per_page' =>  -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'tag__in'        => $tags_video_ids,
        )
    );
    ?>
    <div id="video-filter-container" class="row">
        <?php if ( $video_parts->have_posts() ) {
                while ( $video_parts->have_posts() ) {
                    $video_parts->the_post();
                    $video_id = get_the_ID();
                    $url = get_field('youtube_url', $video_id);
                    $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                    $parts = explode('/', $path);
                    $video_embed_id = end($parts);
                    $count++;
        ?>
            <div class="col-lg-3 col-12 mb-3 px-2">
                <div class="openPopup <?php echo $count > 8 ? 'fade-in' : ''?>" data-key="<?php echo $video_id; ?>" data-key-url="<?php echo $video_embed_id; ?>">
                    <img class="w-100 d-block single-article-video" style="cursor: pointer;" src="<?php echo get_the_post_thumbnail_url($video_id);?>" alt="<?php echo get_the_title($video_id);?>">
                    <img class="arrow-play" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/play.ico" alt="play">
                </div>
                <div class="overlay videoOverlay-<?php echo $video_id; ?>">
                    <div class="position-relative w-100 h-100">
                        <div class="popup">
                            <button class="close-btn" data-key="<?php echo $video_id; ?>">
                                <span aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#fff"><path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z"/></svg>
                                </span>
                            </button>
                            <iframe
                                    frameborder="0"
                                    width="360" height="640"
                                    allowfullscreen
                                    allow="autoplay; encrypted-media">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
            wp_reset_postdata();
        }?>
    </div>
    <?php
    wp_die();
}
add_action('wp_ajax_filter_videos_based_tags', 'filter_videos_based_tags');
add_action('wp_ajax_nopriv_filter_videos_based_tags', 'filter_videos_based_tags');

//filter on the homepage based on tags
function filter_post_based_tags() {
    $tags_ids = $_POST['tags'];
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' =>  -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tag__in'        => $tags_ids,
    );
    $query = new WP_Query($args);
    ?>
    <div id="filter-container" class="container py-5">
        <div class="row">
            <?php
                $count=0;
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                    $query->the_post();
                    $article_id = get_the_ID();
                    $article_title = get_the_title($article_id);
                    $image_url = get_the_post_thumbnail_url($article_id);
                    $count++;
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <a href="<?php echo get_permalink($article_id);?>" class="<?php echo $count > 8 ? 'fade-in' : ''?>">
                        <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                    </a>
                </div>
            <?php }
                wp_reset_postdata();
            }?>
        </div>
    </div>
    <?php
    wp_die();
}
add_action('wp_ajax_filter_post_based_tags', 'filter_post_based_tags');
add_action('wp_ajax_nopriv_filter_post_based_tags', 'filter_post_based_tags');

function isMob(){
    return is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
}
//search results base on tag
function load_filtered_articles() {
    $selectedCategories = $_POST['selectedCategories'];
    $selectedTags = $_POST['selectedTags'];
    $search = $_POST['search'];
    $date = $_POST['date'];

    if (isset($selectedCategories) && isset($selectedTags) && isset($search) && !empty($date)){
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            's'              => $search,
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $selectedCategories,
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'term_id',
                    'terms'    => $selectedTags,
                ),
            ),
            'date_query' => [
                [
                    'year'  => date('Y', strtotime($date)),
                    'month' => date('m', strtotime($date)),
                    'day'   => date('d', strtotime($date)),
                ]
            ],
        );
    } else if (isset($selectedCategories) && isset($search)) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            's'              => $search,
            'category__in'   => $selectedCategories,
        );
    } else if (isset($selectedTags) && isset($search)) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            's'              => $search,
            'tag__in' => $selectedTags,
        );
    } else if (isset($selectedCategories) && isset($selectedTags)) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $selectedCategories,
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'term_id',
                    'terms'    => $selectedTags,
                ),
            ),
        );
    } else if (isset($selectedCategories)) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            'category__in' => $selectedCategories,
        );
    } else if (isset($selectedTags)) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            'tag__in' => $selectedTags,
        );
    } else if (isset($search)){
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
            's'              => $search,
        );
    } else {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' =>  -1,
        );
    }
    if(!empty($date)){
        $timestamp = strtotime($date);
        $formatted_date = date('F jS, Y', $timestamp);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'date_query' => array(
                array(
                    'after'     => $formatted_date,
                    'inclusive' => true, // Set to true to include posts published on 2025-05-18
                ),
            ),
        );
    }
    $query = new WP_Query($args);
    ?>
    <div id="filter-container" class="row">
        <?php
            if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $article_id = get_the_ID();
                $article_title = get_the_title($article_id);
                $image_url = get_the_post_thumbnail_url($article_id);
                $count++;
        ?>
            <div class="col-lg-3 col-12 mb-2 px-1">
                <a href="<?php echo get_permalink($article_id);?>" class="<?php echo $count > 8 ? 'fade-in' : ''?>">
                    <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                </a>
            </div>
        <?php
            }
        }
        wp_reset_postdata();
        ?>
    </div>
    <?php
    wp_die();
}
add_action('wp_ajax_load_filtered_articles', 'load_filtered_articles');
add_action('wp_ajax_nopriv_load_filtered_articles', 'load_filtered_articles');
// load more for filterd articles
function load_more_products() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1; // Start with page 2 for the next load
    $args = array(
        'post_type' 		=> 		'post',
        'posts_per_page'    => 		12,
        'order'             =>      'DESC',
		'post_status'    	=> 		'publish',
        'offset'         	=> 		8 + (($paged - 1) * 12), // Increase offset for each page
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $article_id = get_the_ID();
            $article_title = get_the_title($article_id);
            $image_url = get_the_post_thumbnail_url($article_id);
            $count++;
        ?>
        <div class="col-lg-3 col-12 mb-2 px-1">
            <a href="<?php echo get_permalink($article_id);?>" class="<?php echo $count > 8 ? 'fade-in' : ''?>">
                <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
            </a>
        </div>
        <?php
        }
    }
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');

// increment count when post/ video is viewed
function track_post_views($post_id) {

    $post_type = get_post_type($post_id);
    if (!in_array($post_type, ['post', 'video'])) return;

    global $wpdb;
    $table_name = 'dnaq_view_counter';

    $wpdb->query($wpdb->prepare("
        INSERT INTO $table_name (post_id, count)
        VALUES (%d, 1)
        ON DUPLICATE KEY UPDATE count = count + 1
    ", $post_id));
}
add_action('wp', function () {
    if (is_singular('post')) {
        global $post;
        track_post_views($post->ID);
    }
});

//reset every month
function schedule_monthly_reset() {
    if (!wp_next_scheduled('monthly_views_reset')) {
        wp_schedule_event(strtotime('first day of next month midnight'), 'monthly', 'monthly_views_reset');
    }
}
register_activation_hook(__FILE__, 'schedule_monthly_reset');

// Add custom interval if not already available
add_filter('cron_schedules', function ($schedules) {
    $schedules['monthly'] = [
        'interval' => 30 * DAY_IN_SECONDS,
        'display'  => __('Once Monthly')
    ];
    return $schedules;
});
function reset_monthly_views() {
    global $wpdb;
    $table_name = 'dnaq_view_counter';
    $wpdb->query("UPDATE $table_name SET count = 0");
}
add_action('monthly_views_reset', 'reset_monthly_views');

// get top 3 views
function get_top_3_most_visited($type = 'post') {
    global $wpdb;

    $table_name = 'dnaq_view_counter';

    $results = $wpdb->get_results($wpdb->prepare("
        SELECT p.ID, p.post_title, vc.count
        FROM $wpdb->posts p
        INNER JOIN $table_name vc ON p.ID = vc.post_id
        WHERE p.post_type = %s AND p.post_status = 'publish'
        ORDER BY vc.count DESC
        LIMIT 3
    ", $type));

    return $results;
}
function get_top_5_most_visited($type = 'post') {
    global $wpdb;

    $table_name = 'dnaq_view_counter';

    $results = $wpdb->get_results($wpdb->prepare("
        SELECT p.ID, p.post_title, vc.count
        FROM $wpdb->posts p
        INNER JOIN $table_name vc ON p.ID = vc.post_id
        WHERE p.post_type = %s AND p.post_status = 'publish'
        ORDER BY vc.count DESC
        LIMIT 5
    ", $type));

    return $results;
}

// handle ajax for video view counter
function add_counter_view_video() {
    $video_id = $_POST['id'];
    track_post_views($video_id);
    wp_die();
}
add_action('wp_ajax_add_counter_view_video', 'add_counter_view_video');
add_action('wp_ajax_nopriv_add_counter_view_video', 'add_counter_view_video');