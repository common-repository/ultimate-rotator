<?php

function get_cycle_loop( $posts_per_page = 6, $position = "", $name = "advert", $key = "adcount", $order = "", $allposts = "", $item_width, $item_height, $rotator_width, $rotator_height, $echo = true ){
	
	$output = "";
	global $wp_query;
	$temp = $wp_query;
	
	//reset the count session
	if (isset($_SESSION["$key"])):	
		if ($_SESSION["$key"] >= $posts_per_page)
			$_SESSION["$key"] = 0;
	endif;
	
	$args = array( 'post_type' => 'ulrotator', 'posts_per_page' => $posts_per_page, 'paged' => "", 'ultimate_rotator_position' => $position, 'orderby' => $order, 'post_status' => 'publish' );
	$wp_query = new WP_Query( $args );
	
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$content = strip_tags( get_the_content(), "<p><a><img><object><embed><param><iframe>" );
			
			$desc = htmlspecialchars_decode( get_post_meta( get_the_ID(), 'ulrotator_item_description', true ) );
			if ( $desc != "" )
				$content .= '<div class="ulrotator-item-description">'. $desc .'</div>';
										
			//save advert into session
			$session_name = isset( $_SESSION["$name"] ) ? $_SESSION["$name"] : 0; 
			if ( count( $session_name ) < $wp_query->post_count )
				$_SESSION["$name"][] = $content;
				
		endwhile;		
	endif;
	
	if ( $allposts == "all" )
		$output .= '<div class="ulrotator-wrap ulrotator-wrap-widget ulrotator-wrap-cycle ulrotator-widget-all" style="width: '. $rotator_width .'px; height: '. $rotator_height .'px;">';
	else
		$output .= '<div class="ulrotator-wrap ulrotator-wrap-widget ulrotator-wrap-cycle" style="width: '. $rotator_width .'px; height: '. $rotator_height .'px;">';
	
	$output .= '<div class="ulrotator-content" style="width: '. $rotator_width .'px; height: '. $rotator_height .'px;">';
	$output .= '<div class="ulrotator-box">';
	
	
	//display the advert by cycling the session data
	$wp_queryInd = 0;
	$session_key = isset( $_SESSION["$key"] ) ? $_SESSION["$key"] : 0;
	for( $i = intval( $session_key ); $i < $posts_per_page; $i++ ){
		
		if ( $wp_queryInd == 0 )
			$output .= '<div class="ulrotator-item ulrotator-first-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
		else
			$output .= '<div class="ulrotator-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
			
		$output .= isset( $_SESSION["$name"][$i] ) ? $_SESSION["$name"][$i] : "";
		$output .= '</div>';		
		$wp_queryInd++;
	}

	//rewp_query the session to display the adverts remained above
	$Ind = $posts_per_page - $wp_queryInd;		
	if ( $wp_queryInd < $posts_per_page ){
		for( $lc = 0; $lc < $Ind; $lc++){
			$output .= '<div class="ulrotator-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
			$output .= isset( $_SESSION["$name"][$lc] ) ? $_SESSION["$name"][$lc] : "";
			$output .= '</div>';
		}
	}
	
	$output .= '</div></div></div>';
	
	$wp_query = null;
	$wp_query = $temp;
	wp_reset_query();
		
	//setup session data
	isset( $_SESSION["$key"] ) ? $_SESSION["$key"]++ : $_SESSION["$key"] = 1;
		
	if ( $echo )
		echo apply_filters( 'the_content', $output );
	else
		return apply_filters( 'the_content', $output );
			
}

/** end */