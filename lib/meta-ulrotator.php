<?php

add_action( 'add_meta_boxes', 'ulrotator_description_metabox' );
add_action( 'save_post', 'ulrotator_save_postdata' );
function ulrotator_description_metabox(){
	add_meta_box( 
        'ulrotator_item_description',
        __( 'Item description', 'ultimate_rotator' ),
        'ulrotator_item_description',
        'ulrotator'
    );
}

function ulrotator_item_description( $post ){

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ulrotator_item' );
	
	// The actual fields for data entry
	// Use get_post_meta to retrieve an existing value from the database and use the value for the form
	$value = get_post_meta( get_the_ID(), 'ulrotator_item_description', true );
			
	echo '<p>';
	echo '<label for="ulrotator_item_description">';
	   _e("", 'ultimate_rotator' );
	echo '</label> ';
	echo '<textarea name="ulrotator_item_description" id="ulrotator_item_description" style="min-width: 600px; min-height: 100px;">'. $value .'</textarea>';
	echo '</p>';
}

function ulrotator_save_postdata(){

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	  return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	$post_item = isset( $_POST['ulrotator_item'] ) ? $_POST['ulrotator_item'] : "";
	if ( !wp_verify_nonce( $post_item, plugin_basename( __FILE__ ) ) )
	  return;

	if ( !current_user_can( 'edit_post', get_the_ID() ) )
		return;
	
	// OK, we're authenticated: we need to find and save the data

	//if saving in a custom table, get post_ID
	$post_ID = get_the_ID();
	
	//sanitize user input
	$ulrotator_desc = esc_html( $_POST['ulrotator_item_description'] );

	// Update or save $ulrotator_item 
	update_post_meta($post_ID, 'ulrotator_item_description', $ulrotator_desc);	
	
}

/** end */