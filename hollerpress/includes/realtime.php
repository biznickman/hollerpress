<?php

/********
 * Real-time configurations (Pubnub, etc)
 ********/
define('HP_PUBNUB_PUBLISH_KEY' ,  'pub-ecb6db0c-19a9-47dc-8dbc-a2a7055be4e6');
define('HP_PUBNUB_SUBSCRIBE_KEY' , 'sub-1ca1b1c7-9fa0-11e0-b3a4-e75a79a44cb1');
//$bloginfo = get_bloginfo( 'wpurl' );
//$bloginfo = preg_replace('/\W/','',$bloginfo);
define('HP_PUBNUB_CHANNEL' , 'nickoneill');

define('HP_POST_PERMALINK' , 'permalink');
define('HP_POST_TITLE' ,'title');
define('HP_POST_EXCERPT', 'excerpt');
define('HP_POST_DATE','date');
define('HP_POST_AUTHOR', 'author_name');


require('pubnub/Pubnub.php');

/********
 * Actions
 ********/

//triggered whenever a post or page is created or updated
add_action('save_post' , 'hp_post_created');

function is_new_post( $post_id )
{
	$isnew = get_post_meta($post_id, '_isnew', true);
  	if ($isnew != 'no') {
  		update_post_meta($post_id, '_isnew', 'no');
    	return true;
  	} else {
    	return false;
  	}
}

function hp_post_created( $post_id )
{
	if( !wp_is_post_revision($post_id) )
	{
		$post = get_post( $post_id );
		if( $post->post_status == 'publish' ){

			$pubnub = new Pubnub( HP_PUBNUB_PUBLISH_KEY , HP_PUBNUB_SUBSCRIBE_KEY );
			$pubnub->publish(array(
				'channel' => HP_PUBNUB_CHANNEL,
				'message' => array(
					'notify_type' => ( is_new_post($post_id) ) ? 'new_post' : 'updated_post',
					'post_id' => $post_id , 
					'permalink' => get_permalink( $post_id ) ,
					'title' => $post->post_title,
					'post_date' => $post->post_date,
					'excerpt' => $post->post_excerpt
					)
			));
		}
	}
	
}

add_action( 'delete_post', 'hp_post_deleted' );
function hp_post_deleted()
{
	$pubnub = new Pubnub( HP_PUBNUB_PUBLISH_KEY , HP_PUBNUB_SUBSCRIBE_KEY );
}