<?php
/* ================================================================================
ADD THUMBNAIL SUPPORT AND ADDITIONAL IMAGE SIZES
================================================================================ */
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 250, 200, true ); // default Post Thumbnail dimensions (cropped)
}	
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'portfolio-thumb', 68, 68, false );
}

/* ================================================================================
ADD MENUS AND POST FORMAT SUPPORT
================================================================================ */
if ( ! function_exists( 'gs_wp_setup' ) ) {

	function gs_wp_setup() {
		register_nav_menus( array( 'main' => 'Main Menu' ) );

		add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'audio', 'video') );
	}

}

add_action( 'after_setup_theme', 'gs_wp_setup' );


/* ================================================================================
REGISTER OUR SIDEBARS AND WIDGETIZED AREAS.
================================================================================ 
function manitou_widgets_init() {

	register_sidebar(
		array(
			'id' => 'page',
			'name' => __( 'Page' ),
			'description' => __( 'Pages sidebar' ),
			'before_widget' => '<div id="%1$s" class="sidebar-item sidebar-home widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title widget-title">',
			'after_title' => '</div>'
		)
	);
}
add_action( 'widgets_init', 'manitou_widgets_init' );
*/


/* ================================================================================
SET CONTENT WIDTH DEPENDING ON PAGE
================================================================================ */
if( in_category( 'blog' ) ){
	$content_width = 660;
}else{
	$content_width = 660;
}


/* ================================================================================
SHORTCODE TO CREATE BUTTON IN WYSWYG EDITOR
================================================================================ */
function standard_button( $atts, $content = null ) {
	extract( shortcode_atts(
		array(
			'url' => '',
		), $atts )
	);

	return '<div><a class="page-btn " href="' . $url . '" target="_blank">' . $content . '</a></div>';
}

add_shortcode( 'post_button', 'standard_button' );

/* ================================================================================
OVERRIDE IMG CAPTION SHORTCODE TO FIX 10PX ISSUE.
================================================================================ */
add_filter('img_caption_shortcode', 'fix_img_caption_shortcode', 10, 3);

function fix_img_caption_shortcode($val, $attr, $content = null) {
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) ) return $val;

    return '<div id="' . $id . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}


/* ================================================================================
COUNTS THE NUMBER OF DATABASE HITS PER PAGE
================================================================================ 
add_action( 'wp_footer', 'tcb_note_server_side_page_speed' );
function tcb_note_server_side_page_speed() {
	date_default_timezone_set( get_option( 'timezone_string' ) );
	$content  = '[ ' . date( 'Y-m-d H:i:s T' ) . ' ] ';
	$content .= 'Page created in ';
	$content .= timer_stop( $display = 0, $precision = 2 );
	$content .= ' seconds from ';
	$content .= get_num_queries();
	$content .= ' queries';
	if( ! current_user_can( 'administrator' ) ) $content = "<!-- $content -->";
	echo $content;
}
*/

/* ================================================================================
FUNCTIONS FOR ADDING JAVASCRIPTS
================================================================================ */
add_action( 'template_redirect', 'my_script_enqueuer' );

function my_script_enqueuer() {

	wp_enqueue_script('jquery');

	$modernizr_url = get_bloginfo('template_directory') . '/js/modernizr-2.6.1.min.js';
	wp_enqueue_script('modernizr', $modernizr_url);

	$bootstrap_url = get_bloginfo('template_directory') . '/js/bootstrap.min.js';
	wp_enqueue_script('bootstrap', $bootstrap_url, array('jquery', 'modernizr'), '', true);

	// $slick_url = get_bloginfo('template_directory') . '/js/jquery.slicknav.min.js';
	// wp_enqueue_script('slick', $slick_url, array('jquery', 'modernizr'), '', true);

	$display_script_url = get_bloginfo('template_directory') . '/js/display-0.1.js';
	$plugins = get_bloginfo('template_directory') . '/js/plugins-0.1.js';
	wp_enqueue_script('plugins', $plugins, array('jquery', 'modernizr'), '', true);
	wp_enqueue_script('display_script', $display_script_url, array('jquery', 'modernizr', 'plugins'), '', true);

	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	// wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/css/slicknav.css' );

	if( is_front_page() ){
		$edge_animate = get_bloginfo('template_directory') . '/js/animation/GSD_HomeIntroAnimation_042414_ap2_edgePreload.js';
		wp_enqueue_script('edge', $edge_animate, array('jquery', 'modernizr'), '', true);
	}
}

?>