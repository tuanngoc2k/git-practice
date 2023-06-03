<?php
/**
 * GN Publisher
 * 
 * @copyright 2020 Chris Andrews
 * 
 * Plugin Name: GN Publisher
 * Plugin URI: https://gnpublisher.com/
 * Description: GN Publisher: The easy way to make Google News Publisher compatible RSS feeds.
 * Version: 1.5.7
 * Author: Chris Andrews
 * Author URI: https://gnpublisher.com/
 * Text Domain: gn-publisher
 * Domain Path: /languages
 * License: GPL v3 or later
 * 
 * GN Publisher is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * GN Publisher is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GN Publisher. If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//gn publisher----------

function gnpub_feed_bootstrap() {
	
	if ( defined( 'GNPUB_VERSION' ) ) {
		return;
	}
 
	define( 'GNPUB_VERSION', '1.5.7' );
	define( 'GNPUB_PATH', plugin_dir_path( __FILE__ ) );
    define( 'GNPUB_URL', plugins_url( '', __FILE__) );
	define( 'GNPUB_PLUGIN_FILE', __FILE__ );

	add_action( 'plugins_loaded', 'gnpub_load_textdomain' );

	require_once GNPUB_PATH . 'utilities.php';
	require_once GNPUB_PATH . 'controllers/class-gnpub-feed.php';
	require_once GNPUB_PATH . 'controllers/class-gnpub-posts.php';
	require_once GNPUB_PATH . 'controllers/class-gnpub-websub.php';
	require_once GNPUB_PATH . 'class-gnpub-compat.php';
	require_once GNPUB_PATH . 'class-gnpub-rss-url.php';


	new GNPUB_Feed();
	new GNPUB_Posts();
	new GNPUB_Websub();
	GNPUB_Compat::init();
	Gnpub_Rss_Url::on_load();

	if ( is_admin() ) {
		require_once GNPUB_PATH . 'class-gnpub-installer.php';
		require_once GNPUB_PATH . 'class-gnpub-notices.php';
		require_once GNPUB_PATH . 'controllers/admin/class-gnpub-menu.php';
		require_once GNPUB_PATH . 'controllers/admin/class-gnpub-settings.php';
		require_once GNPUB_PATH . 'includes/mb-helper-function.php';
		require_once GNPUB_PATH . 'controllers/admin/newsletter.php';


		register_activation_hook( __FILE__, array( 'GNPUB_Installer', 'install' ) );
		register_deactivation_hook( __FILE__, array( 'GNPUB_Installer', 'uninstall' ) );
		add_action('wp_ajax_gn_send_query_message', 'gn_send_query_message');

		$admin_notices = new GNPUB_Notices();

		new GNPUB_Menu( $admin_notices );
		new GNPUB_Settings( $admin_notices );
	}

}

gnpub_feed_bootstrap();

function gnpub_load_textdomain() {
	load_plugin_textdomain( 'gn-publisher', false, basename( dirname( GNPUB_PLUGIN_FILE ) ) . '/languages/' );
}

function gnpub_admin_style($hook_suffix ) {
	if($hook_suffix=="settings_page_gn-publisher-settings")
	{
		wp_enqueue_style('gn-admin-styles', GNPUB_URL .'/assets/css/gn-admin.css', array(),GNPUB_VERSION);
		wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_style('gn-admin-promo-style', GNPUB_URL .'/assets/css/promotional-popup.css', array(),GNPUB_VERSION);
		
		wp_enqueue_script('gn-admin-script', GNPUB_URL . '/assets/js/gn-admin.js', array('jquery'), GNPUB_VERSION, 'true' );
		
		wp_localize_script('gn-admin-script', 'gn_script_vars', array(
			'nonce' => wp_create_nonce( 'gn-admin-nonce' ),
		)
		);
		wp_enqueue_script('gn-admin-promo-script', GNPUB_URL . '/assets/js/promotional-popup.js', array(), GNPUB_VERSION);
	}
}


add_action('admin_enqueue_scripts', 'gnpub_admin_style');

function gnpub_admin_newsletter_script($hook_suffix ) {
	if($hook_suffix=="settings_page_gn-publisher-settings")
	{
		wp_enqueue_script('gn-admin-newsletter-script', GNPUB_URL . '/assets/js/gn-admin-newsletter.js', array('jquery'), GNPUB_VERSION, 'true' );
		
		$current_screen = get_current_screen(); 
       
        if(isset($current_screen->post_type)){                  
            $post_type = $current_screen->post_type;                
        }

		$post_id = get_the_ID();
        if(isset($_GET['tag_ID'])){
                $post_id = intval($_GET['tag_ID']);
        }

		

		$data = array(     
			'current_url'                  => gnpub_get_current_url(), 
			'post_id'                      => $post_id,
			'ajax_url'                     => admin_url( 'admin-ajax.php' ),            
			'post_type'                    => $post_type,   
			'page_now'                     => $hook_suffix,
			'gnpub_security_nonce'         => wp_create_nonce('gnpub_ajax_check_nonce'),
		);
						
		$data = apply_filters('gnpub_localize_filter',$data,'gnpub_localize_data');		
	
		wp_localize_script( 'gn-admin-newsletter-script', 'gnpub_localize_data', $data );
		
	}	

}
add_action('admin_enqueue_scripts', 'gnpub_admin_newsletter_script');


register_activation_hook(__FILE__, 'gnpub_activate');

add_action('admin_init', 'gnpub_redirect');

function gnpub_activate() {
    add_option('gnpub_activation_redirect', true);
}

function gnpub_redirect() {
    if (get_option('gnpub_activation_redirect', false)) {
        delete_option('gnpub_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("options-general.php?page=gn-publisher-settings&tab=welcome");
        }
    }
}

