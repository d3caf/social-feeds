<?php
/*=======================================
=            Admin interface            =
=======================================*/
add_action('admin_init', 'social_feeds_settings');
function social_feeds_settings(){
	// Facebook
	register_setting('social_feeds_facebook_settings', 'sf_facebook_enabled');
	register_setting('social_feeds_facebook_settings', 'sf_facebook_pageid');
	register_setting('social_feeds_facebook_settings', 'sf_facebook_auth');
	register_setting('social_feeds_facebook_settings', 'sf_facebook_post_count');

	// // Twitter
	// register_setting('social_feeds_twitter_settings', 'twitter_enabled');
	// register_setting('social_feeds_twitter_settings', 'twitter_handle');
	// register_setting('social_feeds_twitter_settings', 'twitter_auth');
}

add_action('admin_menu', 'social_feeds_menu');

function social_feeds_menu(){
	add_menu_page('Social Feeds Settings', 'Social Feeds', 'administrator', 'social-feeds-settings', 'social_feeds_settings_page', 'dashicons-admin-generic');
}

function social_feeds_settings_page(){ ?>
	<div class="wrap">
		<h1>Social Feeds</h1>

		<form method="post" action="options.php">
		    <?php settings_fields( 'social_feeds_facebook_settings' ); //settings_fields('social_feeds_twitter_settings'); ?>
		    <?php do_settings_sections( 'social_feeds_facebook_settings' ); //do_settings_sections('social_feeds_twitter_settings'); ?>
		    <h2 class="title">Facebook</h2>
		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row">Enable Facebook</th>
		        <td><input type="checkbox" name="sf_facebook_enabled"  <?php if(esc_attr(get_option('sf_facebook_enabled')) == true){ echo 'checked';} ?> /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Number of posts to show</th>
		        <td><input type="number" name="sf_facebook_post_count" value="<?php echo esc_attr(get_option('sf_facebook_post_count')); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">Page ID</th>
		        <td><input type="text" name="sf_facebook_pageid" value="<?php echo esc_attr( get_option('sf_facebook_pageid') ); ?>" /></td>
		        </tr>
		        
				<?php $facebook_auth = get_option('sf_facebook_auth'); ?>

		        <tr valign="top">
		        <th scope="row">App ID</th>
		        <td><input type="text" name="sf_facebook_auth[appid]" value="<?php echo $facebook_auth['appid']; ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row">App Secret</th>
		        <td><input type="text" name="sf_facebook_auth[app_secret]" value="<?php echo $facebook_auth['app_secret']; ?>" /></td>
		        </tr>
		    </table>

<!-- 			<h2 class="title">Twitter</h2>
		    <table class="form-table">
		    	<tr valign="top">
		    		<th scope="row">Enable Twitter</th>
		    		<td><input type="checkbox" name="twitter_enabled" value="<?php echo esc_attr(get_option('twitter_enabled')); ?>"/></td>
		    	</tr>
		    	<tr valign="top">
		    		<th scope="row">App Consumer Key</th>
		    		<td><input type="text" name="twitter_auth[consumer_key]" value="<?php echo esc_attr(get_option('twitter_auth[consumer_key]')); ?>"/></td>
		    	</tr>

		    	<tr valign="top">
		    		<th scope="row">App Consumer Secret</th>
		    		<td><input type="text" name="twitter_auth[consumer_secret]" value="<?php echo esc_attr(get_option('twitter_auth[consumer_secret]')); ?>"/></td>
		    	</tr>
		    </table> -->
		    
		    <?php submit_button(); ?>

		</form>
	</div>
<?php } ?>
