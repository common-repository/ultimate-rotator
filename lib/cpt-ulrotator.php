<?php

function get_ultimate_rotator( 	$position = "", $rand = "", $orientation = "", $nav = "", $items_per_cycle = 1, 
								$item_width = "", $item_height = "", $slide_width = "", $slide_height = "", $class="ulrotator-wrap-slide", $echo = true, $numpost = -1 ){
	
	$output = "";
	
	//Make the pagination works
	global $wp_query;
	global $paged;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();		
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;		
	
	$args = array( 'post_type' => 'ulrotator', 'posts_per_page' => $numpost, 'paged' => $paged, 'ultimate_rotator_position' => $position, 'orderby' => $rand, 'post_status' => 'publish' );
	$wp_query = new WP_Query( $args );
	
	if ( $wp_query->have_posts() ) :
		$count = 1;
		
		if ( $items_per_cycle > 1 )
			$output .= '<div class="ulrotator-wrap ulrotator-wrap-cpt '. $class .' '. $class .'-multiple" style="width: '. $slide_width .'px; height: '. $slide_height .'px;">';
		else
			$output .= '<div class="ulrotator-wrap ulrotator-wrap-cpt '. $class .' '. $class .'-single" style="width: '. $slide_width .'px; height: '. $slide_height .'px;">';
		
		// show/hide navigation
		if ( $nav == "np" ){
		
			$output .= '<a href="#" class="ulrotator-prev ulrotator-prev-'. $position .'"></a>';
			$output .= '<a href="#" class="ulrotator-next ulrotator-next-'. $position .'"></a>';
		
		}elseif ( $nav == "pager" ){
		
			$output .= '<input type="hidden" id="navpager" value="pager" />';
		
		}
		
		$output .= '<div class="ulrotator-content" style="width: '. $slide_width .'px; height: '. $slide_height .'px; ">';
		$output .= '<div class="ulrotator-box ulrotator-box-'. $orientation .'">';
		
		//multiple items per cycle
		if ( $items_per_cycle > 1 ){
			
			//trigger index to add group div
			$startGroup = array();		
			$endGroup = array();
			for ( $i=0; $i <= $wp_query->found_posts; $i += $items_per_cycle ){
				$startGroup[] = $i;
				
				if ( $i > 0)
					$endGroup[] = $i - 1;
				
				
				if ( $i == $wp_query->found_posts )
					$endGroup[] = $i;
				
			}
					
			$ind = 0;
			
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
				//start group
				if ( in_array( $ind, $startGroup ) )
					$output .= '<div class="ulrotator-item-group" style="width: '. $slide_width .'px; height: '. $slide_height .'px; ">';
												
				//slide item
				$item_wrap = ( in_array( $ind, $startGroup ) ) ? '<div class="ulrotator-item ulroator-item-first" style="width: '. $item_width .'px; height: '. $item_height .'px;">' : '<div class="ulrotator-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
				$output .= $item_wrap;
								
				$output .= strip_tags( get_the_content(), "<p><a><img><object><embed><param><iframe>" );
								
				$desc = htmlspecialchars_decode( get_post_meta( get_the_ID(), 'ulrotator_item_description', true ) );
				if ( $desc != "" )
					$output .= '<div class="ulrotator-item-description">'. $desc .'</div>';
				
				$output .= '</div>';
						
				//end group
				if ( in_array( $ind, $endGroup ) ){
					$output .= '<div class="clearBoth"></div>';
					$output .= '</div>';
				}
								
				$ind++;
			endwhile;
		
		//single item per cycle
		}else{
		
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
				if ( $count == 1 ):
					$output .= '<div class="ulrotator-item ulrotator-first-item"';
					$output .= ' style="width: '. $item_width .'px; height: '. $item_height .'px;">';			
				else:
					$output .= '<div class="ulrotator-item"';
					$output .= ' style="width: '. $item_width .'px; height: '. $item_height .'px;">';
				endif;
				
				$output .= strip_tags( get_the_content(), "<p><a><img><object><embed><param><iframe>" );
				
				$desc = htmlspecialchars_decode( get_post_meta( get_the_ID(), 'ulrotator_item_description', true ) );
				if ( $desc != "" )
					$output .= '<div class="ulrotator-item-description">'. $desc .'</div>';
				
				$output .= ( '</div>' );
				
				$count++;			
			endwhile;		
		
		}
		
		$output .= '</div></div></div>';
		
		$wp_query = null;
		$wp_query = $temp;
		wp_reset_query();
	
	endif;
	
	if ( $echo )
		echo apply_filters( 'the_content', $output );
	else
		return apply_filters( 'the_content', $output );
		
}

	
//CPT: ULROTATOR
add_action('init', 'ultimate_rotator_post_type', 9);
function ultimate_rotator_post_type(){	
				
	register_post_type( "ulrotator",
	array(
		'labels' => array(
			'name' => __( "Ultimate Rotator" ),
			'singular_name' => __( 'Ultimate Rotator' ),
			'add_new' => __( "Add Rotator Item" ),
			'add_new_item' => __( "Add Rotator Item" ),
			'edit_item' => __( "Edit Rotator Item" ),
			'view_item' => __( "View Rotator Item" )
		),
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => true,
		'rewrite' => array('slug' => "ulrotator", 'with_front' => false),
		'capability_type' => 'post',
		'show_in_nav_menus' => false,
		'has_archive' => false,
		'taxonomies' => array( 'ultimate_rotator_position' ),
		'menu_position' => 100,
		'supports' => array("title", "editor", "thumbnail") )
	);
	

	//register taxonomy
	$labels = array(
		'name'                          => "Rotator Position",
		'singular_name'                 => 'Position',
		'search_items'                  => "Search positions",
		'popular_items'                 => "Popular positions",
		'all_items'                     => "All positions",
		'parent_item'                   => "Parent positions",
		'edit_item'                     => "Edit position",
		'update_item'                   => "Update position",
		'add_new_item'                  => "Add position",
		'new_item_name'                 => "New position",
		'separate_items_with_commas'    => "Seperate positions with commas",
		'add_or_remove_items'           => "Add or remove position",
		'choose_from_most_used'         => "Choose from the most used positions"
		);

		$args = array(
			'label'                         => "Positions",
			'labels'                        => $labels,
			'public'                        => true,
			'hierarchical'                  => true,
			'show_ui'                       => true,
			'show_in_nav_menus'             => false,
			'rewrite'                       => array( 'slug' => "ulposition", 'with_front' => false ),
			'query_var'                     => true
		);

	register_taxonomy( "ultimate_rotator_position", 'ulrotator', $args );
	
}


/** end */