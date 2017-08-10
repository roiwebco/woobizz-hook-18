<?php
/*
Plugin Name: Woobizz Hook 18
Plugin URI: http://woobizz.com
Description: Add widget content after cart table on cart page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook18
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook18_load_textdomain' );
function woobizzhook18_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook18', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	//Hook(s) 18
	add_action( 'widgets_init', 'woobizzhook18_widget',118);
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook18_admin_notice' );
}
//Add Hook 18
function woobizzhook18_widget() {
	$args = array(
				'id'            => 'woobizzhook18_id',
				'name'          => __( 'Woobizz Hook 18', 'woobizzhook18' ),
				'description'   => __( 'Add widget content after cart table on cart page','woobizzhook18' ),
				'before_title'  => '<h2 class="widgettitle">',
				'before_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'before_widget'  => '</li>',
	);
	register_sidebar( $args );
	add_action( 'woocommerce_after_cart_table', 'woobizzhook18_display',20);
	function woobizzhook18_display(){
		?>
		<div class="woobizzhook18-widget-div">
			<div class="woobizzhook18-widget-content">
				<?php dynamic_sidebar( 'Woobizz Hook 18' ); ?>
			</div>
		</div>
		<?php
	}
}
//Hook18 Notice
function woobizzhook18_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 18 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook18' ); ?></p>
    </div>
    <?php
}