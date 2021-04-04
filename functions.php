<?php
/**
 * franks functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package franks
 */
if ( ! function_exists( 'franks_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function franks_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on franks, use a find and replace
		 * to change 'franks' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'franks', get_template_directory() . '/languages' );
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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'franks' ),
		) );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'franks_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'franks_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function franks_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'franks_content_width', 640 );
}
add_action( 'after_setup_theme', 'franks_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function franks_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'franks' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'franks' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'franks_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function franks_scripts() {
	wp_enqueue_style( 'franks-style', get_stylesheet_uri() );
	wp_enqueue_script( 'franks-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'franks-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'franks-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'franks_scripts' );
//FIX: All orders not showing up in woocommerce version <3.5.2 after udpating to wordpress 5.0.3 - Can be removed when Woocommerce is upgraded to V3.5.2
// if(version_compare(get_option( 'woocommerce_version' ),"3.5.2","<=") && version_compare(get_bloginfo( 'version' ),"5.0.3","=") ){
function fix_request_query_args_for_woocommerce( $query_args ) {
	if ( isset( $query_args['post_status'] ) && empty( $query_args['post_status'] ) ) {
		unset( $query_args['post_status'] );
	}
	return $query_args;
}
add_filter( 'request', 'fix_request_query_args_for_woocommerce', 1, 1 );
// }
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
/*	Hook into the init action and call wine_boutique_brands_categories when it fires.
	This creates the category which is specific and unique to Wine Boutique Events which 
	is then connected by the taxonomy within the Custom Post Type
*/
// add_action( 'init', 'wine_boutique_brands_categories', 0 );
 
/*	Create a custom taxonomy name it topics for your posts
*/
// function wine_boutique_brands_categories() {
 
// 	/*	Add new taxonomy, make it hierarchical like categories
// 		first do the translations part for GUI
// 	*/
 
//   $labels = array(
//     'name' => _x( 'Wine Boutique Brands Categories', 'taxonomy general name' ),
//     'singular_name' => _x( 'Wine Boutique Brand Category', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Search Wine Boutique Brands Categories' ),
//     'all_items' => __( 'All Wine Boutique Brands Categories' ),
//     'parent_item' => __( 'Parent Wine Boutique Brand Category' ),
//     'parent_item_colon' => __( 'Parent Wine Boutique Brand Category:' ),
//     'edit_item' => __( 'Edit Wine Boutique Brand Category' ), 
//     'update_item' => __( 'Update Wine Boutique Brand Category' ),
//     'add_new_item' => __( 'Add New Wine Boutique Brand Category' ),
//     'new_item_name' => __( 'New Wine Boutique Brand Category Name' ),
//     'menu_name' => __( 'Wine Boutique Brands Categories' ),
//   );    
 
// /*	Registering the taxonomy with name brandscat for Wine Boutique Brands
// */
 
//   register_taxonomy('brandscat',array('post'), array(
//     'hierarchical' => true,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'brandcat' ),
//   ));
 
// }
/*	Creation of the Franks Wine Boutique Brands category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type.
	*/
// function franks_wine_boutique_brands() {
// 	$labels = array(
// 		'name' => _x('Wine Boutique Brands', 'post type general name'),
// 		'singluar_name' => _x('Wine Boutique Brands', 'post type singular name'),
// 		'add_new' => _x('Add New', 'Brands'),
// 		'add_new_item' => __('Add New Brands'),
// 		'edit_item' => __('Edit Brands'),
// 		'new_item' => __('New Brands'),
// 		'all_items' => __('All Brands'),
// 		'view_item' => __('View Brands'),
// 		'search_items' => __('Search Brands'),
// 		'not_found' => __('No Brands found'),
// 		'not_found_in_trash' => __('No Brands found in Trash'),
// 		'parent_item_colon' => '',
// 		'menu_name' => 'Wine Boutique Brands'
// 	);
// 	$args = array(
// 		'labels' => $labels,
// 		'description' => 'Holds our Brands and wb_brand specific data',
// 		'menu_icon' => 'dashicons-star-empty',
// 		'public' => true,
// 		'menu_position' => 10,
// 		'supports' => array('title', 'page_attributes', 'thumbnail'),
// 		'has_archive' => true,
// 		/*	Categories created for this specific CPT*/
// 		'taxonomies' => array( 'brandscat' )
// 	);
	
// 	/*		Registers the post type mentioned above to be hooked by init
// 	*/
// 	register_post_type('wb_brand', $args);
// }
// /*	Initialisation of the new custom post type
// 	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
// 	*/
// add_action('init', 'franks_wine_boutique_brands');
	
/*	Hook into the init action and call wine_boutique_events_categories when it fires.
	This creates the category which is specific and unique to Wine Boutique Events which 
	is then connected by the taxonomy within the Custom Post Type
*/
add_action( 'init', 'wine_boutique_events_categories', 0 );
 
/*	Create a custom taxonomy name it topics for your posts
*/
function wine_boutique_events_categories() {
 
	/*	Add new taxonomy, make it hierarchical like categories
		first do the translations part for GUI
	*/
 
  $labels = array(
    'name' => _x( 'Wine Boutique Events Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Wine Boutique Event Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Wine Boutique Events Categories' ),
    'all_items' => __( 'All Wine Boutique Events Categories' ),
    'parent_item' => __( 'Parent Wine Boutique Event Category' ),
    'parent_item_colon' => __( 'Parent Wine Boutique Event Category:' ),
    'edit_item' => __( 'Edit Wine Boutique Event Category' ), 
    'update_item' => __( 'Update Wine Boutique Event Category' ),
    'add_new_item' => __( 'Add New Wine Boutique Event Category' ),
    'new_item_name' => __( 'New Wine Boutique Event Category Name' ),
    'menu_name' => __( 'Wine Boutique Events Categories' ),
  );    
 
/*	Registering the taxonomy with name eventscat for Wine Boutique Events
*/
 
  register_taxonomy('eventscat',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'eventcat' ),
  ));
 
}
/*	Creation of the Franks Wine Boutique Events category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type.
	*/
	
function franks_wine_boutique_events() {
	$labels = array(
		'name' => _x('Wine Boutique Events', 'post type general name'),
		'singluar_name' => _x('Wine Boutique Events', 'post type singular name'),
		'add_new' => _x('Add New', 'Events'),
		'add_new_item' => __('Add New Events'),
		'edit_item' => __('Edit Events'),
		'new_item' => __('New Events'),
		'all_items' => __('All Events'),
		'view_item' => __('View Events'),
		'search_items' => __('Search Events'),
		'not_found' => __('No Events found'),
		'not_found_in_trash' => __('No Events found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Wine Boutique Events'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Events and its specific data',
		'menu_icon' => 'dashicons-star-filled',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
		/*	Categories created for this specific CPT*/
		'taxonomies' => array( 'eventscat' )
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('events', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_wine_boutique_events');
/*	Creation of the Franks Brands category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type*/
function franks_brands() {
	$labels = array(
		'name' => _x('Franks Brands', 'post type general name'),
		'singluar_name' => _x('Franks Brands', 'post type singular name'),
		'add_new' => _x('Add New', 'Brands'),
		'add_new_item' => __('Add New Brands'),
		'edit_item' => __('Edit Brands'),
		'new_item' => __('New Brands'),
		'all_items' => __('All Brands'),
		'view_item' => __('View Brands'),
		'search_items' => __('Search Brands'),
		'not_found' => __('No Brands found'),
		'not_found_in_trash' => __('No Brands found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Franks Brands'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Brands and its specific data',
		'menu_icon' => 'dashicons-admin-multisite',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('brands', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_brands');
/*	Creation of the Franks Shops category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type
	*/
function franks_shops() {
	$labels = array(
		'name' => _x('Franks Shops', 'post type general name'),
		'singluar_name' => _x('Franks Shops', 'post type singular name'),
		'add_new' => _x('Add New', 'Shops'),
		'add_new_item' => __('Add New Shops'),
		'edit_item' => __('Edit Shops'),
		'new_item' => __('New Shops'),
		'all_items' => __('All Shops'),
		'view_item' => __('View Shops'),
		'search_items' => __('Search Shops'),
		'not_found' => __('No Shops found'),
		'not_found_in_trash' => __('No Shops found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Franks Shops'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Shops and its specific data',
		'menu_icon' => 'dashicons-building',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('shops', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_shops');
/*	Hook into the init action and call franks_top_products_categories when it fires.
	This creates the category which is specific and unique to Franks Top Products which 
	is then connected by the taxonomy within the Custom Post Type
*/
add_action( 'init', 'franks_top_products_categories', 0 );
 
/*	Create a custom taxonomy name it topics for your posts
*/
function franks_top_products_categories() {
 
	/*	Add new taxonomy, make it hierarchical like categories
		first do the translations part for GUI
	*/
 
  $labels = array(
    'name' => _x( 'Franks Top Items Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Franks Top Item Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Franks Top Items Categories' ),
    'all_items' => __( 'All Franks Top Items Categories' ),
    'parent_item' => __( 'Parent Franks Top Item Category' ),
    'parent_item_colon' => __( 'Parent Franks Top Item Category:' ),
    'edit_item' => __( 'Edit Franks Top Item Category' ), 
    'update_item' => __( 'Update Franks Top Item Category' ),
    'add_new_item' => __( 'Add New Franks Top Item Category' ),
    'new_item_name' => __( 'New Franks Top Item Category Name' ),
    'menu_name' => __( 'Franks Top Items Categories' ),
  );    
 
/*	Registering the taxonomy with name topproductscat for Franks Top Products
*/
 
  register_taxonomy('topproductscat',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'topproductcat' ),
  ));
 
}
/*	Creation of the Franks Top Items category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type.
	*/
function franks_top_products() {
	$labels = array(
		'name' => _x('Franks Top Items', 'post type general name'),
		'singluar_name' => _x('Franks Top Items', 'post type singular name'),
		'add_new' => _x('Add New', 'Franks Top Item'),
		'add_new_item' => __('Add New Franks Top Item'),
		'edit_item' => __('Edit Franks Top Item'),
		'new_item' => __('New Franks Top Item'),
		'all_items' => __('All Franks Top Item'),
		'view_item' => __('View Franks Top Item'),
		'search_items' => __('Search Franks Top Item'),
		'not_found' => __('No Franks Top Item found'),
		'not_found_in_trash' => __('No Franks Top Item found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Franks Top Items'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Franks Top Item specific data',
		'menu_icon' => 'dashicons-awards',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => true,
		/*	Categories created for this specific CPT*/
		'taxonomies' => array( 'topproductscat' )
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('top-products', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_top_products');
/*	Creation of the Franks Loyalty Cards category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type
	*/
function franks_loyalty_cards() {
	$labels = array(
		'name' => _x('Loyalty Cards', 'post type general name'),
		'singluar_name' => _x('Loyalty Card', 'post type singular name'),
		'add_new' => _x('Add New', 'Loyalty Card'),
		'add_new_item' => __('Add New Loyalty Card'),
		'edit_item' => __('Edit Loyalty Card'),
		'new_item' => __('New Loyalty Card'),
		'all_items' => __('All Loyalty Cards'),
		'view_item' => __('View Loyalty Card'),
		'search_items' => __('Search Loyalty Cards'),
		'not_found' => __('No Loyalty Card found'),
		'not_found_in_trash' => __('No Loyalty Card found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Loyalty Cards'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds the loyalty cards',
		'menu_icon' => 'dashicons-id',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
	);
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('loyalty-card', $args);
}

/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_loyalty_cards');

/*	Creation of the Franks Loyalty Cards category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type
	*/
function franks_careers() {
	$labels = array(
		'name' => _x('Careers', 'post type general name'),
		'singluar_name' => _x('Career', 'post type singular name'),
		'add_new' => _x('Add New', 'Career'),
		'add_new_item' => __('Add New Career'),
		'edit_item' => __('Edit Career'),
		'new_item' => __('New Career'),
		'all_items' => __('All Careers'),
		'view_item' => __('View Careers'),
		'search_items' => __('Search Careers'),
		'not_found' => __('No Careers found'),
		'not_found_in_trash' => __('No Careers found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Careers'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds the Franks Careers',
		'menu_icon' => 'dashicons-groups',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
	);
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('careers', $args);
}

/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_careers');
/*	Hook into the init action and call wine_boutique_brands_categories when it fires.
	This creates the category which is specific and unique to Wine Boutique Events which 
	is then connected by the taxonomy within the Custom Post Type
*/
add_action( 'init', 'video_categories', 0 );
 
/*	Create a custom taxonomy name it topics for your posts
*/
function video_categories() {
 
	/*	Add new taxonomy, make it hierarchical like categories
		first do the translations part for GUI
	*/
 
  $labels = array(
    'name' => _x( 'Videos Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Video Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Video Categories' ),
    'all_items' => __( 'All Video Categories' ),
    'parent_item' => __( 'Parent Video Category' ),
    'parent_item_colon' => __( 'Parent Video Category:' ),
    'edit_item' => __( 'Edit Video Category' ), 
    'update_item' => __( 'Update Video Category' ),
    'add_new_item' => __( 'Add New Video Category' ),
    'new_item_name' => __( 'New Video Category Name' ),
    'menu_name' => __( 'Videos Categories' ),
  );    

 
  register_taxonomy('videoscat',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'videocat' ),
  ));
 
}
function franks_videos() {
	$labels = array(
		'name' => _x('How To Use Videos', 'post type general name'),
		'singluar_name' => _x('How To Use Videos', 'post type singular name'),
		'add_new' => _x('Add New', 'Videos'),
		'add_new_item' => __('Add New Videos'),
		'edit_item' => __('Edit Videos'),
		'new_item' => __('New Videos'),
		'all_items' => __('All Videos'),
		'view_item' => __('View Videos'),
		'search_items' => __('Search Videos'),
		'not_found' => __('No Videos found'),
		'not_found_in_trash' => __('No Videos found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'How To Use Videos'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Shops and its specific data',
		'menu_icon' => 'dashicons-editor-video',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
		'taxonomies' => array( 'videoscat' )
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('video', $args);
}

add_action('init', 'franks_videos');

/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_heritage');

function franks_heritage() {
	$labels = array(
		'name' => _x('Franks Heritage', 'post type general name'),
		'singluar_name' => _x('Franks Heritage', 'post type singular name'),
		'add_new' => _x('Add New', 'Heritage'),
		'add_new_item' => __('Add New Heritage post'),
		'edit_item' => __('Edit Heritage'),
		'new_item' => __('New Heritage'),
		'all_items' => __('All Heritage'),
		'view_item' => __('View Heritage'),
		'search_items' => __('Search Heritage'),
		'not_found' => __('No Posts found'),
		'not_found_in_trash' => __('No Posts found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Heritage'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Shops and its specific data',
		'menu_icon' => 'dashicons-clock',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor',  'page_attributes', 'thumbnail'),
		'has_archive' => false
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('heritage', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'franks_heritage');


function makeup_academy() {
	$labels = array(
		'name' => _x('Franks Make-Up Academy', 'post type general name'),
		'singluar_name' => _x('Franks Make-Up Academy', 'post type singular name'),
		'add_new' => _x('Add New', 'Make-Up Academy'),
		'add_new_item' => __('Add New Make-Up Academy'),
		'edit_item' => __('Edit Make-Up Academy'),
		'new_item' => __('New Make-Up Academy'),
		'all_items' => __('All Make-Up Academy'),
		'view_item' => __('View Make-Up Academy'),
		'search_items' => __('Search Make-Up Academy'),
		'not_found' => __('No Make-Up Academy found'),
		'not_found_in_trash' => __('No Make-Up Academy found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Franks Make-Up Academy'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds Make-Up Academy posts',
		'menu_icon' => 'dashicons-art',
		'public' => true,
		'menu_position' => 11,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('make-up-academy', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'makeup_academy');

function other_services() {
	$labels = array(
		'name' => _x('Franks Services', 'post type general name'),
		'singluar_name' => _x('Franks Services', 'post type singular name'),
		'add_new' => _x('Add New', 'Services'),
		'add_new_item' => __('Add New Services'),
		'edit_item' => __('Edit Services'),
		'new_item' => __('New Services'),
		'all_items' => __('All Services'),
		'view_item' => __('View Services'),
		'search_items' => __('Search Services'),
		'not_found' => __('No Services found'),
		'not_found_in_trash' => __('No Services found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Franks Services'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds Services posts',
		'menu_icon' => 'dashicons-hammer',
		'public' => true,
		'menu_position' => 12,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => false,
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('services', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'other_services');
/*	Hook into the init action and call franks_top_products_categories when it fires.
	This creates the category which is specific and unique to Franks Top Products which 
	is then connected by the taxonomy within the Custom Post Type
*/

add_action( 'init', 'dior_expertise_categories', 0 );
 
/*	Create a custom taxonomy name it topics for your posts
*/
function dior_expertise_categories() {
 
	/*	Add new taxonomy, make it hierarchical like categories
		first do the translations part for GUI
	*/
 
  $labels = array(
    'name' => _x( 'Dior Expertise Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Dior Expertise Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Dior Expertise Categories' ),
    'all_items' => __( 'All Dior Expertise Categories' ),
    'parent_item' => __( 'Parent Dior Expertise Category' ),
    'parent_item_colon' => __( 'Parent Dior Expertise Category:' ),
    'edit_item' => __( 'Edit Dior Expertise Category' ), 
    'update_item' => __( 'Update Franks Top Item Category' ),
    'add_new_item' => __( 'Add New Dior Expertise Category' ),
    'new_item_name' => __( 'New Dior Expertise Category Name' ),
    'menu_name' => __( 'Dior Expertise Categories' ),
  );    
 
/*	Registering the taxonomy with name topproductscat for Franks Top Products
*/
 
  register_taxonomy('diorexpertisecat',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'diorexpertisecat' ),
  ));
 
}
/*	Creation of the Dior Expertise category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type.
	*/
function dior_expertise() {
	$labels = array(
		'name' => _x('Dior Expertise', 'post type general name'),
		'singluar_name' => _x('Dior Expertise', 'post type singular name'),
		'add_new' => _x('Add New', 'Dior Expertise Item'),
		'add_new_item' => __('Add New Dior Expertise Item'),
		'edit_item' => __('Edit Dior Expertise Item'),
		'new_item' => __('New Dior Expertise Item'),
		'all_items' => __('All Dior Expertise Items'),
		'view_item' => __('View Dior Expertise Item'),
		'search_items' => __('Search Dior Expertise Item'),
		'not_found' => __('No Dior Expertise Item found'),
		'not_found_in_trash' => __('No Dior Expertise Item found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Dior Expertise'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Dior Expertise Item specific data',
		'menu_icon' => 'dashicons-image-filter',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => true,
		/*	Categories created for this specific CPT*/
		'taxonomies' => array( 'diorexpertisecat' )
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('dior-expertise', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'dior_expertise');



add_action( 'init', 'tips_categories', 0 );
 
/*	Create a custom taxonomy name it topics for your posts
*/
function tips_categories() {
 
	/*	Add new taxonomy, make it hierarchical like categories
		first do the translations part for GUI
	*/
 
  $labels = array(
    'name' => _x( 'Tips & Tricks Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Tips & Tricks Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Tips & Tricks Categories' ),
    'all_items' => __( 'All Tips & Tricks Categories' ),
    'parent_item' => __( 'Parent Tips & Tricks Category' ),
    'parent_item_colon' => __( 'Parent Tips & Tricks Category:' ),
    'edit_item' => __( 'Edit Tips & Tricks Category' ), 
    'update_item' => __( 'Update Tips & Tricks Category' ),
    'add_new_item' => __( 'Add New Tips & Tricks Category' ),
    'new_item_name' => __( 'New Tips & Tricks Category Name' ),
    'menu_name' => __( 'Tips & Tricks Categories' ),
  );    
 
/*	Registering the taxonomy with name topproductscat for Franks Top Products
*/
 
  register_taxonomy('tips_category',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tips_category' ),
  ));
 
}

/*	Creation of the Dior Expertise category within the Wordpress backend
	Information that is inserted into this category is via Advanced Custom Fields
	such as images, links, text etc...
	From here we are just initialising the custom post type.
	*/
function tips_tricks() {
	$labels = array(
		'name' => _x('Tips & Tricks', 'post type general name'),
		'singluar_name' => _x('Tips & Tricks', 'post type singular name'),
		'add_new' => _x('Add New', 'Tips & Tricks Item'),
		'add_new_item' => __('Add New Tips & Tricks Item'),
		'edit_item' => __('Edit Tips & Tricks Item'),
		'new_item' => __('New Tips & Tricks Item'),
		'all_items' => __('All Tips & Tricks Items'),
		'view_item' => __('View Tips & Tricks Item'),
		'search_items' => __('Search Tips & Tricks Item'),
		'not_found' => __('No Tips & Tricks Item found'),
		'not_found_in_trash' => __('No Tips & Tricks Item found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Tips & Tricks'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Holds our Tips & Tricks Item specific data',
		'menu_icon' => 'dashicons-lightbulb',
		'public' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor', 'page_attributes', 'thumbnail'),
		'has_archive' => true,
		/*	Categories created for this specific CPT*/
		'taxonomies' => array( 'tips_category' )
	);
	
	/*		Registers the post type mentioned above to be hooked by init
	*/
	register_post_type('tips', $args);
}
/*	Initialisation of the new custom post type
	The init method of the $wp object is called next to setup the current user’s settings and the hook add_action( 'init' ) is run.
	*/
add_action('init', 'tips_tricks');


add_filter('acf/settings/remove_wp_meta_box', '__return_false');
add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerce_output_related_products', 20 );
/* Start - Code used to set up Woocommerce to use our custom woocommerce templates under franks/woocommerce/ */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
/* end */
//Number of products to show per page
add_filter('loop_shop_per_page', create_function('$cols', 'return 15;'));
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_add_to_cart', 25 );
add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerce_output_related_products', 20 );
add_filter( 'auth_cookie_expiration', 'keep_me_logged_in_for_1_year' );
function keep_me_logged_in_for_1_year( $expirein ) {
    return 31556926; // 1 year in seconds
}
function get_brand($post_name) {    
	$args = array(
		'name' => $post_name,
		'post_type' => 'brands',
	);
	$query = new WP_Query($args);
	return $query;
}
function get_how_to_use_link($category_id) {
    // get parent category
    $parent_cat = get_category(get_parent_category($category_id));
    // find category with the same name in How to Use Videos custom post
    $link = get_term_link($parent_cat->slug, 'video-category');
    // var_dump($parent_cat);
    $how_to_container;
    if (!isset($link->errors)) {
        $how_to_container = how_to_use_html($link);
    }
    return $how_to_container;
}
function get_parent_category($category_id) {
    while ($category_id) {
        $cat = get_category($category_id); // get the object for the catid
        $category_id = $cat->category_parent; // assign parent ID (if exists) to $catid
        // the while loop will continue whilst there is a $catid
        // when there is no longer a parent $catid will be NULL so we can assign our $catParent
        $catParent = $cat->cat_ID;
    }
    return $catParent;
}
function how_to_use_html($link) {
    $html = '<div class="how-to-use-link">' . "\n";
    $html .= '<a href="' . $link . '">How to Use</a>' . "\n";
    $html .= '</div>' . "\n";
    return $html;
}

function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}

add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 50 );

/* START: Extra checkout fields*/ 
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );
function my_custom_checkout_field( $checkout ) {
	$field = get_field('gift_message_options','option');
	//Keys of array
	$itemKeys = array();
	$default = array("No Message" => "Select a Message:");

	foreach($field as $message){
		$itemKeys[] = $message['message'];
	}

	$final = array_combine($itemKeys, $itemKeys);
	$final = array_merge($default, $final);

    echo '<div id="my_custom_checkout_field"><h2>' . __('Gift') . '</h2>';
    woocommerce_form_field( 'gift_wrapping', array(
        'type'          => 'checkbox',
        'class'         => array('form-row-wide'),
        'label'         => __('Gift Wrapping'),
        'required'  => false,
		), $checkout->get_value( 'gift_wrapping' ));
	
	woocommerce_form_field( 'gift_wrap_message', array(
		'type'          => 'select',
		'class'         => array('form-row-wide'),
		'label'         => __('Gift Message'),
		'clear'			=> false,
		'placeholder' 	=> _x('', 'placeholder', 'woocommerce'),
		'options'     	=> $final,
		), $checkout->get_value( 'gift_wrap_message' ));

    woocommerce_form_field( 'gift_receipt', array(
        'type'          => 'checkbox',
        'class'         => array('form-row-wide'),
        'label'         => __('Gift Receipt'),
        'required'  => false,
		), $checkout->get_value( 'gift_receipt' ));
		
    woocommerce_form_field( 'personalized_note', array(
        'type'          => 'textarea',
        'class'         => array('form-row-wide'),
        'label'         => __('Personalized Note'),
        'required'  => false,
		), $checkout->get_value( 'personalized_note' ));

	woocommerce_form_field( 'goldcard_number', array(
		'type'          => 'text',
		'class'         => array('form-row-wide'),
		'label'         => __('Gold Card'),
		'required'  => false,
		), $checkout->get_value( 'goldcard_number' ));
    
    echo '</div>';
}

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['gift_wrapping'] ) ) {
        update_post_meta( $order_id, 'Gift Wrapping', sanitize_text_field( $_POST['gift_wrapping'] ) );
    }
    
    if ( ! empty( $_POST['gift_receipt'] ) ) {
        update_post_meta( $order_id, 'Gift Receipt', sanitize_text_field( $_POST['gift_receipt'] ) );
    }

	if ( ! empty( $_POST['gift_wrap_message'] ) ) {
        update_post_meta( $order_id, 'Gift Message', esc_attr($_POST['gift_wrap_message'] ) );
    }

	if ( ! empty( $_POST['shop-collect'] ) ) {
        update_post_meta( $order_id, 'Collect From', sanitize_text_field( $_POST['shop-collect'] ) );
    }
	
	if ( ! empty( $_POST['shop-collect1'] ) ) {
        update_post_meta( $order_id, 'Collect From Shop', sanitize_text_field( $_POST['shop-collect1'] ) );
    }

	if ( ! empty( $_POST['personalized_note'] ) ) {
        update_post_meta( $order_id, 'Personalized Note', sanitize_text_field( $_POST['personalized_note'] ) );
	}
	
	if ( ! empty( $_POST['goldcard_number'] ) ) {
        update_post_meta( $order_id, 'Gold Card', sanitize_text_field( $_POST['goldcard_number'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
    $gift_wrapping = (get_post_meta( $order->id, 'Gift Wrapping', true ) == "" ) ? "No" : "Yes";
	$gift_message = get_post_meta($order->id, 'Gift Message', true);
	$gift_receipt = (get_post_meta( $order->id, 'Gift Receipt', true ) == "" ) ? "No" : "Yes";
    $collect_loc = get_post_meta( $order->id, 'Collect From', true );
	$collect_loc1 = get_post_meta( $order->id, 'Collect From Shop', true );
	$personalized_note = get_post_meta( $order->id, 'Personalized Note', true );
	$goldcard_number = get_post_meta( $order->id, 'Gold Card', true );
    
	echo '<p><strong>'.__('Gift Wrapping').':</strong> ' . $gift_wrapping . '</p>';
	echo '<p><strong>'.__('Gift Message').':</strong> ' . $gift_message . '</p>';
    echo '<p><strong>'.__('Gift Receipt').':</strong> ' . $gift_receipt . '</p>';
	echo '<p><strong>'.__('Personalized Note').':</strong> ' . $personalized_note . '</p>';
	echo '<p><strong>'.__('Gold Card').':</strong> ' . $goldcard_number . '</p>';
	if ($collect_loc !== "") {
        echo '<p><strong>'.__('Collect From').':</strong> ' . $collect_loc . '</p>';        
    }
	if ($collect_loc1 !== "") {
        echo '<p><strong>'.__('Collect From Shop').':</strong> ' . $collect_loc1 . '</p>';        
    }
}

add_filter( 'woocommerce_gateway_icon', 'custom_payment_gateway_icons', 10, 2 );
function custom_payment_gateway_icons( $icon, $gateway_id ){

    foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway )
        if( $gateway->id == $gateway_id ){
            $title = $gateway->get_title();
            // break;
        }

    // The path (subfolder name(s) in the active theme)
    $path = get_stylesheet_directory_uri(). '/images';

    // Setting (or not) a custom icon to the payment IDs
    if($gateway_id == 'apcopay')
        $icon = '<img src="' . WC_HTTPS::force_https_url( "$path/card-logos.png" ) . '" alt="' . esc_attr( $title ) . '" />';
    elseif( $gateway_id == 'ppec_paypal' || 'paypal' )
        return $icon;

    return $icon;
}

function get_all_careers() {
	$args = array(
		'post_type' => 'careers',
		'posts_per_page' => -1,
		'order' => 'ASC'
	);

	$query = new WP_Query($args);
	return $query;
}

function get_all_shops() {
	$args = array(
		'post_type' => 'shops',
		'posts_per_page' => -1,
		'orderby' => 'date',
	);

	$query = new WP_Query($args);
	return $query;
}

function get_all_services() {
	$args = array(
		'post_type' => 'services',
		'posts_per_page' => -1,
		'order' => 'ASC'
		// 'tax_query' => array(
		// 		array(
		// 			'taxonomy' => 'services_category',
		// 			'field' => 'slug',
		// 			'terms' => $category_name
		// 		)
		// 	)
	);

	$query = new WP_Query($args);
	return $query;
}

	function get_all_tips() {
		$args = array(
			'post_type' => 'tips',
			'posts_per_page' => -1,
            'order' => 'ASC'
			// 'tax_query' => array(
			// 		array(
			// 			'taxonomy' => 'tips_category',
			// 			'field' => 'slug',
			// 			'terms' => $category_name
			// 		)
			// 	)
		);

		$query = new WP_Query($args);
		return $query;
	}


		function get_tips($category_name) {
		$args = array(
			'post_type' => 'tips',
			'posts_per_page' => -1,
			'tax_query' => array(
					array(
						'taxonomy' => 'tips_category',
						'field' => 'slug',
						'terms' => $category_name
					)
				)
		);

		$query = new WP_Query($args);
		return $query;
	}

function get_heritage($category_name) {
	$args = array(
		'post_type' => 'heritage',
		'posts_per_page' => -1,
		'tax_query' => array(
				array(
					'taxonomy' => 'heritage_category',
					'field' => 'slug',
					'terms' => $category_name
				)
			)
	);

	$query = new WP_Query($args);
	return $query;
}

function get_top($category_name) {
	$args = array(
		'post_type' => 'top-products',
		'posts_per_page' => 10,
		'post_status' => 'publish',
		'meta_key' => 'top_items_ranking_position',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'tax_query' => array(
				array(
					'taxonomy' => 'topproductscat',
					'field' => 'slug',
					'terms' => $category_name
				)
			)
	);

	$query = new WP_Query($args);
	return $query;
}

function get_heritage_all() {
	$args = array(
		'post_type' => 'heritage',
		'posts_per_page' => -1,
		'orderby' => 'meta_value_num',
		'meta_key'  => 'heritage_post_year',
		'order' => 'ASC'
		// 'tax_query' => array(
		// 		array(
		// 			'taxonomy' => 'heritage_category',
		// 			'field' => 'slug',
		// 			'terms' => $category_name
		// 		)
		// 	)
	);

	$query = new WP_Query($args);
	return $query;
}
/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'processing' );
}


add_action( 'woocommerce_email_after_order_table', 'woocommerce_custom_invoice_fields' );
function woocommerce_custom_invoice_fields( $order ) {
    if ( get_post_meta( $order->id, 'Collect From', true ) !== "" ) {        
    ?>
        <h2><?php _e('Collect From', 'woocommerce'); ?></h2>
        <ul><li><span><?php echo get_post_meta( $order->id, 'Collect From', true ); ?></span></li></ul>
    <?php
	}
	if ( get_post_meta( $order->id, 'Collect From Shop', true ) !== "" ) {        
    ?>
        <h2><?php _e('Collect From Shop', 'woocommerce'); ?></h2>
        <ul><li><span><?php echo get_post_meta( $order->id, 'Collect From Shop', true ); ?></span></li></ul>
    <?php
	}
	if ( get_post_meta( $order->id, 'Personalized Note', true ) !== "" ) {        
    ?>
        <h2><?php _e('Personalized Note', 'woocommerce'); ?></h2>
        <ul><li><span><?php echo get_post_meta( $order->id, 'Personalized Note', true ); ?></span></li></ul>
    <?php
	}
	if ( get_post_meta( $order->id, 'Gold Card', true ) !== "" ) {        
    ?>
        <h2><?php _e('Gold Card', 'woocommerce'); ?></h2>
        <ul><li><span><?php echo get_post_meta( $order->id, 'Gold Card', true ); ?></span></li></ul>
    <?php
	}
	if ( get_post_meta( $order->id, 'Gift Wrapping', true ) !== "" ) {        
    ?>
        <h2><?php _e('Gift Wrapping', 'woocommerce'); ?></h2>
        <ul><li><span><?php echo get_post_meta( $order->id, 'Gift Wrapping', true ); ?></span></li></ul>
    <?php
	}
	
	if ( get_post_meta( $order->id, 'Gift Receipt', true ) !== "" ) {        
    ?>
        <h2><?php _e('Gift Receipt', 'woocommerce'); ?></h2>
        <ul><li><span><?php echo get_post_meta( $order->id, 'Gift Receipt', true ); ?></span></li></ul>
    <?php
    }
}


/**
 * Add a custom field (in an order) to the emails
 */
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );

function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['meta_key'] = array(
        'label' => __( 'Label' ),
        'value' => get_post_meta( $order->id, 'meta_key', true ),
    );
    return $fields;
}
add_filter( 'woocommerce_product_add_to_cart_text', function( $text ) {
	global $product;
	if($product !== NULL){
	 	$type = $product->get_type();
		if ( $type ==  'variable' ) {
			$text = $product->is_purchasable() ? __( 'Add To Cart', 'woocommerce' ) : __( 'Add To Cart', 'woocommerce' );
		}}
	return $text;
}, 10 );



add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2); 

function custom_variation_price( $price, $product ) { 

     $price = '';

     $price .= wc_price($product->get_price()); 

     return $price;
}

//Reposition WooCommerce breadcrumb 

function woocommerce_remove_breadcrumb(){

	remove_action(
	
		'woocommerce_before_main_content', 'woocommerce_breadcrumb', 10);
	
	}
	
	add_action(
	
		'woocommerce_before_main_content', 'woocommerce_remove_breadcrumb'
	
	);
	
	
	
	function woocommerce_custom_breadcrumb(){
	
		woocommerce_breadcrumb();
	
	}
	
	
	
	add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

	
	add_filter('gettext', 'translate_reply');
add_filter('ngettext', 'translate_reply');
function translate_reply($translated) {
    $translated = str_ireplace('Shipping', 'Delivery', $translated);
    return $translated;
}

add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3);
function woocommerce_custom_sale_text($text, $post, $_product)
{
    return '<span class="onsale">Special Offer!</span>';
}

function your_add_to_cart_message() {
    if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :
        $message = sprintf( '%s<a href="%s" class="your-style">%s</a>', __( 'Successfully added to cart.', 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Shopping', 'woocommerce' ) );
    else :
        $message = sprintf( '%s<a href="%s" class="view-cart">%s</a>', __( 'Successfully added to cart.' , 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'woocommerce' ) );
//        $message = sprintf( '%s <a href="%s" class="continue-shopping">Continue Shopping</a> <a href="%s" class="view-cart">%s</a>', __( 'Successfully added to cart.' , 'woocommerce' ), wp_safe_redirect( wp_get_referer() ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'woocommerce' ) );
    endif;
    return $message;
}
add_filter( 'wc_add_to_cart_message', 'your_add_to_cart_message' );

add_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );


/* Loyalty Card Form Custom Save Function */

function custom_acf_save_post($post_id) {

	if( get_post_type($post_id) !== 'loyalty-card' ) {

		return;

	}

	if( is_admin() ) {

		return;	

	}

	if( empty($_POST['acf']) ) {

		return;

	}

	$data['ID'] = $post_id;

	// Get Full Name from fields

	$thetitle = get_field('title', $post_id);

	$first_name = get_field('first_name', $post_id);

	$last_name = get_field('last_name', $post_id);

	$idcard = get_field('id_card', $post_id);

	$dob = get_field('date_of_birth', $post_id);

	$email = get_field('e-mail', $post_id);

	$address = get_field('address', $post_id);

	$city = get_field('city', $post_id);

	$contact = get_field('contact_number', $post_id);

	// Combine first name and last name to create the post title

	$title = trim($first_name) . " " . trim($last_name);

	$data['post_title'] = $title;

	$data['post_name'] = sanitize_title( $title );

	// Send E-mail to Applicant

	global $woocommerce;

	$mailer = $woocommerce->mailer();

	$client_subject = 'NEW Franks Gold Card Subscription';

	$client_salutation = nl2br('Dear ' . $first_name . " " . $last_name . ',<br><br>');

	$client_body = clientBodyText();

	$client_message_body = $client_salutation . $client_body;

	$client_message = $mailer->wrap_message($client_subject, $client_message_body);

	$mailer->send($email, $client_subject, $client_message);

	// E-mail confirmation to back office

	$office_to = 'ymicallef@franks.com.mt, imuscat@franks.com.mt';

	$office_subject = 'NEW Franks Gold Card Subscription - ' . $title;

	$office_salutation = nl2br('A new customer applied for the FRANKS Gold Card.<br><br>');

	$office_body = officeBodyText($thetitle, $first_name, $last_name, $idcard, $email, $dob, $address, $city, $contact);

	$office_message_body = $office_salutation . $office_body;

	$office_message = $mailer->wrap_message($office_subject, $office_message_body);

	$mailer->send($office_to, $office_subject, $office_message);

	wp_update_post($data);

}

add_action('acf/save_post', 'custom_acf_save_post', 20);

function clientBodyText() {

	$result = "Thank you for subscribing to the FRANKS Gold Card. <br><br>";
	
	$result .= "This loyalty scheme has been designed to enhance your shopping experience at FRANKS and to reward you for your loyalty.  You should be receiving your card in a few days. <br><br>";

	$result .= "The FRANKS Gold Card can be used in all FRANKS outlets and you will be rewarded a point for every €1 spent. Points will be accumulated from your initial purchase and have no expiry date. You have the option to either collect the reward according to the reward tiers below or else continue accumulating points to benefit from the rewards in other tiers: <br><br>";

	$result .= "<u>Reward Points Tiers:</u><br>";

	$result .= "<u>500 Points</u> €15 voucher<br>";

	$result .= "<u>700 Points</u> €25 voucher<br>";

	$reuslt .= "<u>1500 Points</u> €75 voucher + exclusive invites to FRANKS events**<br>";

	$result .= "<u>3500 Points</u> €175 voucher + exclusive invites to FRANKS events + Special Birthday Gift<br><br>";

	$result .= "<i>**If one opts to continue accumulating points to reach the 3500 reward, the first transaction after the €1500 spent will be given double points</i><br><br>";

	$result  .= "Should you have any queries, please feel free to drop us a line on <a href='mailto: info@franks.com.mt'>info@franks.com.mt</a> We look forward to see you soon,<br><br> FRANKS";

	return $result;

}

function officeBodyText($thetitle, $first_name, $last_name, $idcard, $email, $dob, $address, $city, $contact) {

	$result = "The Customers details are: <br>";

	$result .= "Full Name: " . $thetitle . " " . $first_name . " " . $last_name . "<br>";

	$result .= "ID Card: " . $idcard . "<br>";

	$result .= "E-mail: " . $email . "<br>";

	$result .= "Contact Number: " . $contact . "<br>";

	$result .= "Date of Birth: " . $dob . "<br>";

	$result .= "City: " . $city . "<br>";

	$result .= "Address: " . $address . "<br>";

	return $result;

}


/* ====================== 07-11-2019 ===================== */
// Code for ACF option page.
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

// for upload svg file
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


//  For breadcrumb
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Voice Overs'
    $defaults['home'] = 'Shop';
    return $defaults;
}

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    return home_url().'/shop-main/';
}

add_action( 'woocommerce_cart_calculate_fees', 'custom_fee_for_tinkoff', 20, 1 );

function custom_fee_for_tinkoff ( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( ! ( is_checkout() && ! is_wc_endpoint_url() ) )
        return; // Only checkout page

    $payment_method = WC()->session->get( 'chosen_payment_method' );
	$free_delivery = WC()->cart->get_subtotal();

	// We concatenate the string with additional sub-strings
	$option_value_free_shipping = 'woocommerce_free_shipping_3_settings';
	$option_value_flat_rate = 'woocommerce_flat_rate_1_settings';

	// Now we can get the options values with that formatted string
	$free_shipping_settings = get_option($option_value_free_shipping);
	$flat_rate_settings = get_option($option_value_flat_rate);

	// Here we get the value of the order min amount (Finally!)
	$order_min_amount = $free_shipping_settings['min_amount'];
	$order_delivery_charge = $flat_rate_settings['cost'];

	$order_min_amount = (int)$order_min_amount;
	$order_delivery_charge = (int)$order_delivery_charge;

    if ('cheque' == $payment_method && $free_delivery < $order_min_amount) {
		$surcharge = $cart->subtotal - $cart->subtotal - $order_delivery_charge;
		$cart->add_fee( 'Minus delivery charge', $surcharge, true );
    }
	
	if ('apcopay' == $payment_method && $free_delivery < $order_min_amount) {
		$surcharge = $cart->subtotal - $cart->subtotal - $order_delivery_charge;
		$cart->add_fee( 'Minus Fee', $surcharge, true );
    }
	
}

// jQuery - Update checkout on methode payment change  
add_action( 'wp_footer', 'custom_checkout_jqscript' );
function custom_checkout_jqscript() {
    if ( ! ( is_checkout() && ! is_wc_endpoint_url() ) )
        return; // Only checkout page
    ?>
    <script type="text/javascript">
    jQuery( function($){
        $('form.checkout').on('change', 'input[name="payment_method"]', function(){
            $(document.body).trigger('update_checkout');
        });
    });
    </script>
    <?php
}

function wpb_sender_email( $original_email_address ) {
    return 'info@franks.com.mt';
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'FRANKS';
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
add_filter( 'wp_mail_content_type', 'set_html_content_type' );
function set_html_content_type() {

    return 'text/html';
}

add_filter( 'wp_new_user_notification_email_admin', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
	$wp_new_user_notification_email['subject'] = sprintf( '[%s] New user registration.', $blogname, $user->user_login );
	$image = 'http://franks.com.mt/wp-content/uploads/2019/08/franks-logo.png';
	$facebook_image = 'https://franks.com.mt/wp-content/themes/franks/images/facebook.png';
	$twitter_image = 'https://franks.com.mt/wp-content/themes/franks/images/twitter.png';
	$instagram_image = 'https://franks.com.mt/wp-content/themes/franks/images/instagram-2.png';
	$youtube_image = 'https://franks.com.mt/wp-content/themes/franks/images/youtube.png';
	$pinterest_image = 'https://franks.com.mt/wp-content/themes/franks/images/pinterest.png';
	$message = sprintf("<img src=%s><br/><br/>",$image);
	$message .= sprintf("New user registration on your site %s :<br/><br/>", $blogname);
	$message .= sprintf("Username: %s<br/><br/>", $user->user_login);
	$message .= sprintf("Email: %s<br/><br/>", $user->user_email);
	$message .= sprintf('<ul style="list-style: none; padding-left: 0px;text-align:center;max-width:1024px;">
		<li style="display: inline-block; margin: 0px 10px;">
			<a target="_blank" href="https://www.facebook.com/FranksPerfumery">
				<img src=%s style="width: 30px; margin-right: 0px;">
			</a>
		</li>', $facebook_image);
	$message .= sprintf('
		<li style="display: inline-block; margin: 0px 10px;">
			<a target="_blank" href="https://twitter.com/FRANKS_Malta">
				<img src=%s style="width: 30px; margin-right: 0px;">
			</a>
		</li>', $twitter_image);
	$message .= sprintf('
		<li style="display: inline-block; margin: 0px 10px;">
			<a target="_blank" href="https://www.instagram.com/franksmalta/">
				<img src=%s style="width: 30px; margin-right: 0px;">
			</a>
		</li>', $instagram_image);
	$message .= sprintf('
	<li style="display: inline-block; margin: 0px 10px;">
		<a target="_blank" href="https://www.youtube.com/user/FranksMalta">
			<img src=%s style="width: 30px; margin-right: 0px;">
		</a>
	</li>', $youtube_image);
	$message .= sprintf('
	<li style="display: inline-block; margin: 0px 10px;">
		<a target="_blank" href="https://www.pinterest.com/franksmalta/">
			<img src=%s style="width: 30px; margin-right: 0px;">
		</a>
	</li></ul>', $pinterest_image);
	$wp_new_user_notification_email['message'] = $message;
    // $wp_new_user_notification_email['message'] = sprintf( "%s ( %s ) has registerd to your test blog %s.", $user->user_login, $user->user_email, $blogname );
    return $wp_new_user_notification_email;
}

// add_filter( 'wp_new_user_notification_email_admin', 'custom_wp_new_user_notification_email', 10, 3 );

// function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
// 	$wp_new_user_notification_email['subject'] = sprintf( '[%s] New user registration.', $blogname, $user->user_login );
// 	$message = sprintf("New user registration on your site %s :", $blogname) . "\r\n\r\n\t";
// 	$message .= sprintf("Username: %s", $user->user_login) . "\r\n\r\n\t";
// 	$message .= sprintf("Email: %s", $user->user_email) . "\r\n\r\n";
// 	$wp_new_user_notification_email['message'] = $message;
//     // $wp_new_user_notification_email['message'] = sprintf( "%s ( %s ) has registerd to your test blog %s.", $user->user_login, $user->user_email, $blogname );
//     return $wp_new_user_notification_email;
// }

add_filter("retrieve_password_message", "mapp_custom_password_reset", 99, 4);

function mapp_custom_password_reset($message, $key, $user_login, $user_data )    {

    $message = "Someone has requested a password reset for the following account:

" . sprintf(__('%s'), $user_data->user_email) . "

If this was a mistake, just ignore this email and nothing will happen.

To reset your password, visit the following address:

" . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";


    return $message;

}

function custom_wc_ajax_variation_threshold( $qty, $product ) { return 700; } 
add_filter( 'woocommerce_ajax_variation_threshold', 'custom_wc_ajax_variation_threshold', 100, 2 );

define( 'WC_MAX_LINKED_VARIATIONS', 100 );

add_action('wp_head', 'fouc_protect_against');
/**
 * Combat FOUC in WordPress
 * @link https://stackoverflow.com/questions/3221561/eliminate-flash-of-unstyled-content
 */
function fouc_protect_against () {
    ?>
        <style type="text/css">
            .hidden {display:none;}
        </style>
        <script type="text/javascript">
         jQuery('html').addClass('hidden');
	            
	 jQuery(document).ready(function($) {		            
	    $('html').removeClass('hidden');	            
	 });  
        </script>
    <?php

}

add_filter( 'formatted_woocommerce_price', 'span_custom_prc', 10, 5 );
function span_custom_prc( $number_format, $price, $decimals, $decimal_separator, $thousand_separator){
    return '<h4 class="custom-prc">'.$number_format.'</h4>';
}
/**
** Remove the shipping row from woocommerce_get_order_item_totals array 
**/ 
// function ymcode_remove_shipping_details_from_woocommerce_email($total_rows, $obj, $tax_display){
// 	// $sss1 = WC()->session->get( 'radio_chosen' );
// 	// $sss1 = WC()->session->get('chosen_payment_method');
// 	// var_dump($sss1);

// 	// returns label and value
// 	// var_dump($total_rows['shipping']);
// 	if (isset($total_rows['shipping'])){
// 		if($sss1 == '0'){
// 			unset($total_rows['shipping']);
// 		}
// 	}
// 	return $total_rows;
// }
// add_filter( 'woocommerce_get_order_item_totals', 'ymcode_remove_shipping_details_from_woocommerce_email', 10, 3 );

add_filter('wpseo_title', 'filter_product_wpseo_title');
function filter_product_wpseo_title($title) {
	
	if(  is_singular( 'product') ) {
		$title  = str_replace("*"," - ", $title);
	}
	
	$title = str_replace("Archives","", $title);
	
    return $title;
}