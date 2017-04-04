<?php	
	/*	
	*	CrunchPress function.php
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   The Bookish Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all important functions and features of the theme.
	*	---------------------------------------------------------------------
	*/

	// constants
	define('THEME_NAME_S','cp');                                   // Short name of theme (used for various purpose in CP framework)
	define('THEME_NAME_F','Bookish');                              // Full name of theme (used for various purpose in CP framework)
	define('CP_THEME_PATH_URL', get_template_directory_uri());           
	define('CP_THEME_PATH_SER', get_template_directory() );
	define('TH_FW_BE_URL', CP_THEME_PATH_URL. '/framework');             // Define URL path of framework directory
	define('TH_FW_BE_SER', CP_THEME_PATH_SER. '/framework');             // Define server path of framework directory
	define( 'FW_FE_JS', CP_THEME_PATH_URL . '/javascript' );             // Define fron-end javascript directory
	define( 'FW_FE_CSS', CP_THEME_PATH_URL . '/stylesheet' );  			 // Define fron-end stylesheet directory
	define('CP_PATH_URL', get_template_directory_uri());           // logical location for CP framework
	define('CP_PATH_SER', get_template_directory());              // Physical location for CP framework
	define('CP_FW_URL', CP_PATH_URL . '/framework');             // Define URL path of framework directory
	define('CP_FW', CP_PATH_SER . '/framework');                 // Define server path of framework directory                   
	define('AJAX_URL', admin_url( 'admin-ajax.php' ));             // Define admin url
	define('FONT_SAMPLE_TEXT', 'Font Family'); 				       // Demo font text of the CrunchPress panel

	$date_format = get_option(THEME_NAME_S.'_default_date_format','F d, Y');                     // Get default date format
	$widget_date_format = get_option(THEME_NAME_S.'_default_widget_date_format','M d, Y');       // Get default date format for widgets
	define('GDL_DATE_FORMAT', $date_format);
	define('GDL_WIDGET_DATE_FORMAT', $widget_date_format);

	$cp_is_responsive = 'enable';
	$cp_is_responsive = ($cp_is_responsive == 'enable')? true: false;
	$default_post_sidebar = get_option(THEME_NAME_S.'_default_post_sidebar','post-no-sidebar');   // Get default post sidebar
	$default_post_sidebar = str_replace('post-', '', $default_post_sidebar);               
	$default_post_left_sidebar = get_option(THEME_NAME_S.'_default_post_left_sidebar','');        // Get option for left sidebar
	$default_post_right_sidebar = get_option(THEME_NAME_S.'_default_post_right_sidebar','');      // Get option for right sidebar

	if( !function_exists('get_root_directory') ){                                                 // Get file path ( to support child theme )
		function get_root_directory( $path ){
			if( file_exists( get_stylesheet_directory() . '/' . $path ) ){
				return get_stylesheet_directory() . '/';
			}else{
				return get_stylesheet_directory() . '/';
			}
		}
	}
	
	
	
	
// Register CP Theme all stylesheet
function register_cp_theme_styles(){

		global $post;

		wp_enqueue_style('DefaultStylesheet',CP_PATH_URL.'/bassets/css/custom.css');
		wp_enqueue_style('color',CP_PATH_URL.'/bassets/css/color.css');
		wp_enqueue_style('bootstrap',CP_PATH_URL.'/bassets/css/bootstrap.css');
		wp_enqueue_style('bootstrap-responsive',CP_PATH_URL.'/bassets/css/bootstrap-responsive.css');
		wp_enqueue_style('Shortcodes',CP_PATH_URL.'/stylesheet/shortcodes.css');
		wp_enqueue_style('font-awesome-min',CP_PATH_URL.'/bassets/css/font-awesome.min.css');
		wp_enqueue_style('jquery-bxslider',CP_PATH_URL.'/bassets/css/jquery.bxslider.css');
		wp_enqueue_style('bookblock',CP_PATH_URL.'/bassets/css/bookblock.css');
		wp_enqueue_style('demo-bookblock',CP_PATH_URL.'/bassets/css/demo_bookblock.css');
		wp_enqueue_style('smoothDivScrol',CP_PATH_URL.'/bassets/css/smoothDivScroll.css');
		wp_enqueue_style('prettyPhoto',CP_PATH_URL.'/bassets/css/prettyPhoto.css');

}

// Register CP Theme scripts
function register_cp_theme_scripts(){
		
		wp_register_script('bootstrap', CP_PATH_URL.'/bassets/js/bootstrap.js', false, '1.8.3', true);
		wp_enqueue_script('bootstrap');
		wp_register_script('jquery-bxslider-min', CP_PATH_URL.'/bassets/js/jquery.bxslider.min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery-bxslider-min');
		wp_register_script('jquery-stellar-min', CP_PATH_URL.'/bassets/js/jquery.stellar.min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery-stellar-min');
		wp_register_script('modernizr-custom', CP_PATH_URL.'/bassets/js/modernizr.custom.js', false, '1.8.3', true);
		wp_enqueue_script('modernizr-custom');
		
		wp_register_script('jquery-bookblock', CP_PATH_URL.'/bassets/js/jquery.bookblock.js', false, '1.8.3', true);
		wp_enqueue_script('jquery-bookblock');
		wp_register_script('jQueryui', CP_PATH_URL.'/bassets/js/jquery-ui-1.10.3.custom.min.js', false, '1.8.3', true);
		wp_enqueue_script('jQueryui');
		wp_register_script('jquery-mousewheel', CP_PATH_URL.'/bassets/js/jquery.mousewheel.min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery-mousewheel');
		wp_register_script('jquery-kinetic', CP_PATH_URL.'/bassets/js/jquery.kinetic.min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery-kinetic');	
		wp_register_script('jquery.smoothdivscroll-1.3-min', CP_PATH_URL.'/bassets/js/jquery.smoothdivscroll-1.3-min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery.smoothdivscroll-1.3-min');
		wp_register_script('prettyPhoto', CP_PATH_URL.'/javascript/jquery.prettyPhoto.js', false, '1.0', true);
		wp_enqueue_script('prettyPhoto');
		wp_register_script('refine-slider', CP_PATH_URL.'/javascript/jquery.refineslide.js', false, '1.0', true);
		wp_enqueue_script('refine-slider');
		wp_register_script('custom', CP_PATH_URL.'/bassets/js/custom.js', false, '1.8.3', true);
		wp_enqueue_script('custom');
			
}
	
	// Include essential files to enhance framework functionality
	include_once(CP_FW.	'/script-handler.php');							 // It includes all javacript and style in theme
	include_once(CP_FW.	'/extensions/super-object.php'); 				 // Super object function
	include_once(CP_FW.	'/extensions/seo_module.php'); 					 // Register seo module
	include_once(CP_FW.	'/cp-functions.php'); 							 // Registered CP framework functions
	include_once(CP_FW.	'/cp-option.php');								 // CP framework control panel
	include_once(CP_FW.	'/extensions/fontloader.php');					 // Load necessary font
	//include_once(CP_FW.	'/extensions/shortcodes/shortcodes.php'); 		 // Register shortcode
	include_once( CP_FW . '/extensions/register-menu-walker.php' ); 	 // Register walker menu			
	include_once(CP_FW.	'/extensions/cutom_meta_boxes.php'); 			 // Register meta boxes 
	include_once(CP_FW.	'/extensions/breadcrumbs.php');                  // Register breadcrumbs navigation
	include_once(CP_FW.	'/extensions/plugins.php');	                     // Register plugin installer
	
	// Dashboard option
	include_once(CP_FW. '/options/meta-template.php'); 					// templates for post portfolio and gallery
	include_once(CP_FW. '/options/post-option.php');					// Register meta fields for post_type
	include_once(CP_FW. '/options/page-option.php'); 					// Register meta fields page post_type
	//include_once(CP_FW. '/options/bx-slider-options.php');				// Register meta fields bx-slider post_type
	//include_once(CP_FW. '/options/price-table-option.php');				// Register meta fields bx-slider post_type
	//include_once(CP_FW. '/options/reviews-option.php');					// Register meta fields review post_type
	//include_once(CP_FW. '/options/feature-options.php');					// Register meta fields testimonial post_type
	include_once(CP_FW. '/extensions/author-bio.php');                  // Author Bio box
	//include_once(CP_FW. '/options/gallery-option.php');
	//include_once(CP_FW. '/options/sneakpeak-options.php');
	//include_once(CP_FW. '/options/mobileready-options.php');

	
	// Exterior plugins
	include_once(CP_FW. '/extensions/filosofo-image/filosofo-custom-image-sizes.php'); // Custom image size plugin

	if(!is_admin()){
		
		include_once(CP_FW. '/extensions/sliders.php');	                            // Functions to print sliders
		include_once(CP_FW. '/options/page-elements.php');	                        // Organize page item element
		include_once(CP_FW. '/options/blog-elements.php');							// Organize blog item element
		include_once(CP_FW. '/extensions/social-shares.php'); 						// Register social shares 

	}

	

	// Include custom widget
	include_once(CP_FW. '/extensions/widgets/custom-blog-widget.php');              // Register blog wight 
	include_once(CP_FW. '/extensions/widgets/contact-widget.php');              	// Register Contact Form Widget 
	include_once(CP_FW. '/extensions/widgets/popular-post-widget.php');             // Register Popular Post Widget
	include_once(CP_FW. '/extensions/widgets/contact-social-widget.php');           // Register Contact Us Widget
	//include_once(CP_FW. '/extensions/widgets/twitter-widget.php');                  // Register Twitter Widget
	//include_once(CP_FW. '/extensions/widgets/facebook-pagelike-box-widget.php');    // Register Facebook Widget 
	//include_once(CP_FW. '/extensions/widgets/tabber-tabs.php');    					// Register Tabbber Widget 
	//include_once(CP_FW. '/extensions/widgets/tabber-widget.php');    				// Register Tabbber Widget 
	//include_once(CP_FW. '/extensions/widgets/flickr-widget.php');    				// Register Flickr Widget 
	include_once(CP_FW. '/extensions/widgets/subscribe-widget.php');    			// Register Feed Subscription Widget 
	include_once(CP_FW. '/extensions/widgets/image-widget/image-widget.php');		// Register Image Widget
	include_once(CP_FW. '/extensions/pagination/bookish-paginate.php');             // Register Blog Pagination 
	include_once(CP_FW. '/extensions/widgets/cp-archive-widget.php');              	// Register Blog Archives
	include_once(CP_FW. '/extensions/widgets/cp-category-widget.php');              // Register Blog Categories 
	include_once(CP_FW. '/extensions/widgets/cp-review-widget.php');              	// Register Review Carousel Widget 

	

	if(!is_admin()){

		

		include_once( 'woocommerce/config.php' );

	}

	//Theme Dummy Data Installation	
	function themeple_ajax_dummy_data(){
		require_once CP_FW . '/extensions/importer/dummy_data.inc.php';
		die('themeple_dummy');
	}

	add_action('wp_ajax_themeple_ajax_dummy_data', 'themeple_ajax_dummy_data');

	/* Image Sizes */
	add_image_size('image-first', 570,350, true);
	add_image_size('image-first', 270,224, true);
	add_image_size('feature-post-option-inside-thumbnial-image', 189,165, true);
	
	
	/* Over Riding Jquery Cookie */

	add_action( 'wp_enqueue_scripts', 'custom_frontend_scripts' );
	
	function custom_frontend_scripts() {
	
		global $post, $woocommerce;
	
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_deregister_script( 'jquery-cookie' );
			wp_register_script( 'jquery-cookie', CP_PATH_URL . '/javascript/woocomerce/jquery_cookie' . $suffix . '.js', array( 'jquery' ), '1.3.1', true );
	
	}
	
	function crunchpress_wp_title( $title, $sep ) {
		global $paged, $page;
	
		if ( is_feed() )
			return $title;
	
		// Add the site name.
		$title .= get_bloginfo( 'name' );
	
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
	
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'crunchpress' ), max( $paged, $page ) );
	
		return $title;
	}
	add_filter( 'wp_title', 'crunchpress_wp_title', 10, 2 );
?>