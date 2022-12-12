<?php
/**
 * USTR functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package USTR
 */

ini_set('display_errors', 'On');

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'ustr_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ustr_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on USTR, use a find and replace
		 * to change 'ustr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ustr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'ustr' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'ustr_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'ustr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ustr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ustr_content_width', 640 );
}
add_action( 'after_setup_theme', 'ustr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ustr_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ustr' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ustr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ustr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ustr_scripts() {



    $jsonContents = file_get_contents(__DIR__ . '/dist/assets-manifest.json');

    $manifest = json_decode($jsonContents);

    //echo $manifest;

    //print_r('wut');

    // print_r($manifest);

    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');


    wp_enqueue_style('ustr-vendors', get_template_directory_uri() . "/dist/" . $manifest->{'vendors.css'}, [], null, 'all');
  wp_enqueue_style('ustr-main', get_template_directory_uri() . "/dist/" . $manifest->{'main.css'}, ['ustr-vendors'], null, 'all');
  wp_enqueue_script('ustr-main', get_template_directory_uri() . "/dist/" . $manifest->{'main.js'}, ['ustr-vendors'], null, true);
  wp_enqueue_script('ustr-vendors', get_template_directory_uri() . "/dist/" . $manifest->{'vendors.js'}, [], null, true);


    if (is_front_page()) {


        $template = 'index';
      wp_enqueue_style('ustr-index', get_template_directory_uri() . "/dist/" . $manifest->{$template . '.css'}, ['ustr-vendors'], null, 'all');
      wp_enqueue_script('ustr-index', get_template_directory_uri() . "/dist/" . $manifest->{$template . '.js'}, ['ustr-vendors'], null, true);
    }





	//wp_enqueue_style( 'ustr-style', get_stylesheet_uri(), array(), _S_VERSION );
	//wp_style_add_data( 'ustr-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'ustr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'ustr_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/* Secure REST API here */


/* Disable things */

remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);







function disable_emoji_feature() {

	// Prevent Emoji from loading on the front-end
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Remove from admin area also
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Remove from RSS feeds also
	remove_filter( 'the_content_feed', 'wp_staticize_emoji');
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji');

	// Remove from Embeds
	remove_filter( 'embed_head', 'print_emoji_detection_script' );

	// Remove from emails
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Disable from TinyMCE editor. Currently disabled in block editor by default
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );

	/** Finally, prevent character conversion too
         ** without this, emojis still work
         ** if it is available on the user's device
	 */

	add_filter( 'option_use_smilies', '__return_false' );

}

function disable_emojis_tinymce( $plugins ) {
	if( is_array($plugins) ) {
		$plugins = array_diff( $plugins, array( 'wpemoji' ) );
	}
	return $plugins;
}

add_action('init', 'disable_emoji_feature');


add_action( 'init', 'remove_dns_prefetch' );
function  remove_dns_prefetch () {
   remove_action( 'wp_head', 'wp_resource_hints', 2, 99 );
}






remove_action ('wp_head', 'rsd_link');




// remove_action( 'wp_head', 'wp_shortlink_wp_head');









function add_tags_to_pages() {
register_taxonomy_for_object_type( 'post_tag', 'page' );
}
add_action( 'init', 'add_tags_to_pages');


//
// add_theme_support( 'featured-content', array(
//   'featured_content_filter' => 'ustr_get_featured_content',
// ));

add_theme_support( 'featured-content', array(
    'filter'     => 'ustr_get_featured_content',
    'max_posts'  => 20,
    'post_types' => array( 'page' ),
) );


add_theme_support( 'post-formats',
	array(
		'link',
		'video',
		'audio',
	)
);
add_post_type_support( 'post', 'post-formats' );
// add_post_type_support( 'page', 'post-formats' );






add_action( 'init', 'wpse31629_init' );
function wpse31629_init()
{
	add_post_type_support( 'post', 'page-attributes' );

}







/* Queries */






function be_exclude_category_from_blog( $query ) {

	if( $query->is_main_query() && ! is_admin() && $query->is_home() ) {
		$query->set( 'cat', '-2' );
        $query->set('ignore_sticky_posts', true);
        // $query->set('post__not_in', get_option('sticky_posts'));
        // $query->set('posts_per_page', 4);
	}



}
add_action( 'pre_get_posts', 'be_exclude_category_from_blog' );















/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
