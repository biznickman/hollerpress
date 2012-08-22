<?php
/* This image will be used for sharing on Facebook, it should be a square */
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
	set_post_thumbnail_size( 140 , 140 ); //Default post thumbnail size
}

/* Create theme options:
 * - Facebook app id for comments - fb_app_id
 * - Facebook user id - fb_user_id
 * - Header text (accepts HTML) - site_description
 * - Facebook Page or profile (Subscribe vs like) - 
 * - Twitter username
 * - Copyright by - copyright
 * - RSS URL - 
 * - Logo - logo
 * - Google Analytics - google_analytics
 */

add_action( 'admin_init', 'hp_options_init' );
add_action( 'admin_menu', 'hp_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function hp_options_init(){
	register_setting( 'hollerpress_options' , 'hp_options', 'hollerpress_options_validate'  );
	//register_setting( 'hollerpress_options' , 'facebook_url' , 'hollerpress_options_validate'  );
	//register_setting( 'hollerpress_options' , 'fb_page_or_profile' , 'hollerpress_options_validate'  ); //Set whether or not the FB url is page or profile
	//register_setting( 'hollerpress_options' , 'twitter_username' , 'hollerpress_options_validate'  );
	//register_setting( 'hollerpress_options' , 'rss_url' , 'hollerpress_options_validate'  );
	//register_setting( 'hollerpress_options' , 'logo_url' , 'hollerpress_options_validate'  );
}

/**
 * Load up the menu page
 */
function hp_options_add_page() {
	add_theme_page( __( 'HollerPress Options', 'hollerpress_theme' ), __( 'HollerPress Options', 'hollerpress_theme' ), 'edit_theme_options', 'hp_options', 'hp_options_do_page' );
}

/**
 * Create the options page
 */
function hp_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'hollerpress_theme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'hollerpress_theme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'hollerpress_options' ); ?>
			<?php $options = get_option( 'hp_options' ); ?>

			<table class="form-table">
				<!-- Site description html -->
				<tr valign="top"><th scope="row"><?php _e( 'Site description', 'hollerpress_theme' ); ?></th>
					<td>
						<input id="hp_options[site_description]" class="regular-text" type="text" name="hp_options[site_description]" value="<?php esc_attr_e( $options['site_description'] ); ?>" />
						<label class="description" for="hp_options[site_description]"><?php _e( 'Enter the description that will sit at the top of the site. (HTML optional)', 'hollerpress_theme' ); ?></label>
					</td>
				</tr>

				<!-- Facebook App ID for comments -->
				<tr valign="top"><th scope="row"><?php _e( 'Facebook App ID', 'hollerpress_theme' ); ?></th>
					<td>
						<input id="hp_options[fb_app_id]" class="regular-text" type="text" name="hp_options[fb_app_id]" value="<?php esc_attr_e( $options['fb_app_id'] ); ?>" />
						<label class="description" for="hp_options[fb_app_id]"><?php _e( 'Enter your Facebook App ID', 'hollerpress_theme' ); ?></label>
					</td>
				</tr>
				
				<!-- Copyright tag -->
				<tr valign="top"><th scope="row"><?php _e( 'Copyright tag', 'hollerpress_theme' ); ?></th>
					<td>
						<input id="hp_options[copyright]" class="regular-text" type="text" name="hp_options[copyright]" value="<?php esc_attr_e( $options['copyright'] ); ?>" />
						<label class="description" for="hp_options[copyright]"><?php _e( 'This is the text that will be displayed after the copyright tag.', 'hollerpress_theme' ); ?></label>
					</td>
				</tr>

				<!-- Google Analytics Tag -->
				<tr valign="top"><th scope="row"><?php _e( 'Google Analytics Tag', 'hollerpress_theme' ); ?></th>
					<td>
						<input id="hp_options[google_analytics]" class="regular-text" type="text" name="hp_options[google_analytics]" value="<?php esc_attr_e( $options['google_analytics'] ); ?>" />
						<label class="description" for="hp_options[google_analytics]"><?php _e( 'Your Google Analytics account. (e.g. UA-XXXXXXXXX-X)', 'hollerpress_theme' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'hollerpress_theme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	return $input;
}


/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function hollerpress_options_validate( $input ) {
	
	//$input['aweber_list'] = wp_filter_nohtml_kses( $input['aweber_list'] );
	return $input;
}