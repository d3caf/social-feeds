<?php 

defined( 'ABSPATH' ) or die( 'Get OUT!' );

/**
 * Plugin Name: Social Feeds
 * Plugin URI: http://andrewanguiano.com
 * Description: This plugin allows for the display of social media feeds.
 * Version: 1.0.0
 * Author: Andrew Anguiano
 * Author URI: http://andrewanguiano.com
 * License: C
 */

/*===============================
=            Globals            =
===============================*/
define('PATH', plugin_dir_url(__FILE__));
define('PLUG_DIR', plugin_dir_path(__FILE__));

// Facebook
define('FB_ENABLED', get_option('sf_facebook_enabled'));
define('FB_PID', esc_attr(get_option('sf_facebook_pageid')));
define('FB_POST_COUNT', esc_attr(get_option('sf_facebook_post_count')));

$fb_auth = get_option('sf_facebook_auth');
define('FB_APP_ID', esc_attr($fb_auth['appid']));
define(FB_APP_SECRET, esc_attr($fb_auth['app_secret']));

/*=============================================
=            Facebook feed request            =
=============================================*/
if(FB_ENABLED && FB_PID && FB_APP_ID && FB_APP_SECRET){
	$fb_req = curl_init();
	curl_setopt_array($fb_req, array(
		CURLOPT_URL => 'https://graph.facebook.com/' . FB_PID . '/posts?access_token=' . FB_APP_ID . '|' . FB_APP_SECRET,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERAGENT => 'Social Feeds WP Plugin'
	));
	$fb_resp = curl_exec($fb_req);
}

/*======================================
=            Shortcode Init            =
======================================*/
function social_feeds_function(){
	ob_start(); ?>
	<div id="sf-wrapper">
		<ul class="sf-post-wrapper">
			<h2 class="sf-loading">Loading posts...</h2>
		</ul>
	</div>
<?php return ob_get_clean(); }

add_shortcode('social-feeds', 'social_feeds_function');


/*================================
=            Enqueues            =
================================*/
if(get_option('sf_facebook_enabled')){ // only enqueue assets if plugin is setup.
	function social_feeds_scripts(){
			wp_enqueue_script('anchorme', PATH . 'vendor/anchorme.min.js', array('jquery'), '', true);
			wp_enqueue_script('timeago', PATH . 'vendor/timeago.js', array('jquery'), '', true);
			wp_enqueue_script('plugin-js', PATH . 'scripts.js', array('jquery', 'anchorme', 'timeago'), '', true);

			// Localize FB data from cURL
			global $fb_resp;
			wp_localize_script('plugin-js', 'fb_data', array(
				'feed' => $fb_resp,
				'fb_post_count' => FB_POST_COUNT
			));
	}
	add_action('wp_enqueue_scripts', 'social_feeds_scripts');

	function social_feeds_styles(){
		wp_enqueue_style('sf_core', PATH . 'style.css');
	}
	add_action('wp_enqueue_scripts', 'social_feeds_styles');
}

require_once(PLUG_DIR . 'admin.php');
?>