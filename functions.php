<?php
/* Create theme options:
 * - Facebook app id for comments
 * - Header text (accepts HTML)
 * - Facebook Page or profile (Subscribe vs like)
 * - Twitter username
 * - RSS URL - 
 * - Logo
 */

add_action( 'admin_init', 'tp_options_init' );
add_action( 'admin_menu', 'tp_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function tp_options_init(){
	register_setting( 'textpress_options' , 'tp_options', 'textpress_options_validate'  );
	//register_setting( 'textpress_options' , 'facebook_url' , 'textpress_options_validate'  );
	//register_setting( 'textpress_options' , 'fb_page_or_profile' , 'textpress_options_validate'  ); //Set whether or not the FB url is page or profile
	//register_setting( 'textpress_options' , 'twitter_username' , 'textpress_options_validate'  );
	//register_setting( 'textpress_options' , 'rss_url' , 'textpress_options_validate'  );
	//register_setting( 'textpress_options' , 'logo_url' , 'textpress_options_validate'  );
}

/**
 * Load up the menu page
 */
function tp_options_add_page() {
	add_theme_page( __( 'World\'s Best Options', 'textpress_theme' ), __( 'World\'s Best Options', 'textpress_theme' ), 'edit_theme_options', 'tp_options', 'tp_options_do_page' );
}

/**
 * Create the options page
 */
function tp_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'textpress_theme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'textpress_theme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'textpress_options' ); ?>
			<?php $options = get_option( 'tp_options' ); ?>

			<table class="form-table">
				
				<!-- Text box: AWeber List -->
				<tr valign="top"><th scope="row"><?php _e( 'AWeber List Name', 'textpress_theme' ); ?></th>
					<td>
						<input id="tp_options[aweber_list]" class="regular-text" type="text" name="tp_options[aweber_list]" value="<?php esc_attr_e( $options['aweber_list'] ); ?>" />
						<label class="description" for="tp_options[aweber_list]"><?php _e( 'This is the list name as registered via AWeber', 'textpress_theme' ); ?></label>
					</td>
				</tr>
				
				<!-- Facebook settings -->
				<tr valign='top'><th scope='row'><?php _e( 'Facebook Settings' , 'textpress_theme' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Facebook Settings' , 'textpress_theme' ); ?></span></legend>
							<!-- Text box: Facebook URL -->
							<?php _e( 'Facebook Page/Profile URL', 'textpress_theme' ); ?>: <br /> <input id="tp_options[facebook_url]" class="regular-text" type="text" name="tp_options[facebook_url]" value="<?php esc_attr_e( $options['facebook_url'] ); ?>" />
										<label class="description" for="tp_options[facebook_url]"><?php _e( 'This is the URL of your Facebook profile or Facebook Page', 'textpress_theme' ); ?></label>
							<!-- FB Page or Profile -->
							<?php _e( 'Facebook profile?', 'textpress_theme' ); ?>: <br /> 
							<label class='description'><input name="tp_options[fb_page_or_profile]" type="radio" value="<?php esc_attr_e( 'profile' ); ?>" <?php echo ($options['fb_page_or_profile'] != 'page') ? 'checked="checked"' : '' ?>  /> You've entered a Facebook Profile URL above</label><br />
							<label class='description'><input name="tp_options[fb_page_or_profile]" type="radio" value="<?php esc_attr_e( 'page' ); ?>" <?php echo ($options['fb_page_or_profile'] == 'page' ) ? 'checked="checked"' : '' ?>  /> You've entered a Facebook Page URL above</label>
						</fieldset>
					</td>
				</tr>
				
				<!-- Text box: Twitter Username -->
				<tr valign="top"><th scope="row"><?php _e( 'Twitter Username', 'textpress_theme' ); ?></th>
					<td>
						<input id="tp_options[twitter_username]" class="regular-text" type="text" name="tp_options[twitter_username]" value="<?php esc_attr_e( $options['twitter_username'] ); ?>" />
						<label class="description" for="tp_options[twitter_username]"><?php _e( 'Enter your twitter username', 'textpress_theme' ); ?></label>
					</td>
				</tr>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'textpress_theme' ); ?>" />
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
function textpress_options_validate( $input ) {
	
	//$input['aweber_list'] = wp_filter_nohtml_kses( $input['aweber_list'] );
	//$input['facebook_username'] = 1;
	//$input['fb_page_or_profile'] = 1;
	//$input['twitter_username'] = 1;
	//$input['rss_url'] = 1;
	//$input['logo_url'] = 1;
	
	return $input;
}