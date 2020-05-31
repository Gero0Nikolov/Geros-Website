<?php
/**
 * Gero\'s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gero\'s
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'geros_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function geros_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gero\'s, use a find and replace
		 * to change 'geros' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'geros', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'geros' ),
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
				'geros_custom_background_args',
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
add_action( 'after_setup_theme', 'geros_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function geros_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'geros_content_width', 640 );
}
add_action( 'after_setup_theme', 'geros_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function geros_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'geros' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'geros' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'geros_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function geros_scripts() {
	$_ASSETS_VERSION = "1";

	// Default Styling
	wp_enqueue_style( 'geros-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'geros-style', 'rtl', 'replace' );
	wp_enqueue_style( "geros-animations", get_template_directory_uri() ."/assets/styles/animate.css", array(), $_ASSETS_VERSION );

	// Load Device Styles
	if ( 
		!is_mobile() &&
		!is_tablet()
	) {
		wp_enqueue_style( "geros-desktop", get_template_directory_uri() ."/assets/styles/desktop.css", array(), $_ASSETS_VERSION );
	} else if ( is_mobile() ) {
		wp_enqueue_style( "geros-mobile-portrait", get_template_directory_uri() ."/assets/styles/mobile-portrait.css", array(), $_ASSETS_VERSION );
		wp_enqueue_style( "geros-mobile-landscape", get_template_directory_uri() ."/assets/styles/mobile-landscape.css", array(), $_ASSETS_VERSION );
		wp_enqueue_script( "geros-mobile-main", get_template_directory_uri() ."/assets/scripts/mobile-main.js", array( "jquery" ), $_ASSETS_VERSION, false );
	} else if ( is_tablet() ) {
		wp_enqueue_style( "geros-tablet-portrait", get_template_directory_uri() ."/assets/styles/tablet-portrait.css", array(), $_ASSETS_VERSION );
		wp_enqueue_style( "geros-tablet-landscape", get_template_directory_uri() ."/assets/styles/tablet-landscape.css", array(), $_ASSETS_VERSION );
		wp_enqueue_script( "geros-tablet-main", get_template_directory_uri() ."/assets/scripts/tablet-main.js", array( "jquery" ), $_ASSETS_VERSION, false );
	}

	// Load Fonts
	wp_enqueue_style( "geros-fonts", get_template_directory_uri() ."/assets/styles/fonts.css", array(), $_ASSETS_VERSION );

	// Load Scripts
	wp_enqueue_script( "geros-main", get_template_directory_uri() ."/assets/scripts/main.js", array( "jquery" ), $_ASSETS_VERSION, false );
}
add_action( 'wp_enqueue_scripts', 'geros_scripts' );

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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Get View Method
function get_view( $view_name ) {
	$path = get_template_directory();

	// Set the correct path
	if (
		!is_mobile() &&
		!is_tablet()
	) { // Desktop
		$path .= "/views/desktop/". $view_name .".php";
	} elseif ( is_mobile() ) { // Mobile
		$path .= "/views/mobile/". $view_name .".php";
	} elseif ( is_tablet() ) { // Tablet
		$path .= "/views/tablet/". $view_name .".php";
	}

	// Check if the View exists and require the view
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

// Get Default Thumbnail Method
function get_default_thumbnail() {
	return get_template_directory_uri() ."/assets/images/wav.jpg";
}

// Search for Method
add_action( "wp_ajax_search_for", "search_for" );
add_action( "wp_ajax_nopriv_search_for", "search_for" );
function search_for() {
	$query = isset( $_POST[ "query" ] ) && !empty( $_POST[ "query" ] ) ? sanitize_text_field( $_POST[ "query" ] ) : false;
	$response = false;
	
	if ( $query != false ) {
		global $wpdb;
		$posts = $wpdb->prefix ."posts";

		$sql_ = "SELECT ID, post_title, post_type FROM $posts WHERE post_title LIKE '%$query%' AND post_status='publish' AND (post_type='page' OR post_type='post' OR post_type='projects') ORDER BY ID DESC";
		$results_ = $wpdb->get_results( $sql_, OBJECT );

		if ( !empty( $results_ ) ) {
			$response = array();

			foreach ( $results_ as $result_ ) {
				$object_ = new stdClass;
				$object_->id = $result_->ID;
				$object_->title = $result_->post_title;
				$object_->url = get_permalink( $result_->ID );
				$object_->icon = get_result_icon( $result_->post_type );
				$object_->color = get_result_color( $result_->post_type );
				array_push( $response, $object_ );
			}
		}
	}

	echo json_encode( $response );
	die( "" );
}

// Make Contact Method
add_action( "wp_ajax_make_contact", "make_contact" );
add_action( "wp_ajax_nopriv_make_contact", "make_contact" );
function make_contact() {
	$data = isset( $_POST[ "data" ] ) && !empty( $_POST[ "data" ] ) ? (object) $_POST[ "data" ] : false;
	$response = false;

	if (
		!empty( $data->name ) &&
		(
			!empty( $data->email ) &&
			is_email( $data->email )
		) &&
		!empty( $data->reason ) &&
		!empty( $data->message )
	) {
		$homepage_id = get_option( "page_on_front" );
		$email = get_field( "admin_email", $homepage_id );	
		wp_mail(
			$email,
			"New Contact Request from GeroNikolov.com",
			"Name: ". $data->name ." (". $data->email .")\r\nReason: ". ucfirst( $data->reason ) ."\r\nMessage: \r\n". $data->message
		);
		$response = true;
	}

	echo json_encode( $response );
	die( "" );
}

function get_result_icon( $post_type ) {
	$result = false;

	if ( $post_type == "post" ) {
		$page = get_page_by_path( "articles" );
		$result = get_field( "page_icon", $page->ID );
	} elseif ( $post_type == "projects" ) {
		$page = get_page_by_path( "projects" );
		$result = get_field( "page_icon", $page->ID );
	}

	return $result;
}

function get_result_color( $post_type ) {
	$result = false;

	if ( $post_type == "post" ) {
		$page = get_page_by_path( "articles" );
		$result = get_field( "page_color", $page->ID );
	} elseif ( $post_type == "projects" ) {
		$page = get_page_by_path( "projects" );
		$result = get_field( "page_color", $page->ID );
	}

	return $result;
}

function get_default_title() {
	$result = "";

	if ( is_singular( "post" ) ) {
		$result = "Enjoy the read!";
	} elseif ( is_singular( "projects" ) ) {
		$result = "Feel the idea!";
	}

	return $result;
}