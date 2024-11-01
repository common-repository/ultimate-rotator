<?php

// enable session
if(session_id() == '') {
	add_action('init', 'ulrotator_init_session');
}

function ulrotator_init_session(){
	session_start();
}


// add scripts to head
add_action('wp_head', 'ulrotator_script');
function ulrotator_script(){
	
	wp_enqueue_script( 'jQueryScrollTo', ULTIMATE_ROTATOR_URL . 'script/jquery.scrollTo-1.4.3.1-min.js', array('jquery'), '1.4.3.1' );
	wp_enqueue_script( 'jQuerySerialScroll', ULTIMATE_ROTATOR_URL . 'script/jquery.serialScroll-1.2.2-min.js', array('jquery'), '1.2.2' );
	
	wp_enqueue_script( 'jquery-cycle-all', ULTIMATE_ROTATOR_URL . 'script/jquery.cycle.all.js', array('jquery'), '3.0.3' );
	wp_enqueue_style( 'ultimate-rotator',  ULTIMATE_ROTATOR_URL . 'ultimate-rotator.css', '', '1.0.0' );
	wp_enqueue_script( 'ultimate-rotator-js', ULTIMATE_ROTATOR_URL . 'script/ultimate-rotator-1.0.0.js', array('jquery'), '1.0.0' );
	
}


//list specific terms, support 3 types of outputs: option, array and li
function ulrotator_list_terms( $name, $output = "li", $hide_empty = 0, $selected = "" ){
	
	$terms = get_terms( "$name", 'hide_empty=' . $hide_empty );
	$count = count($terms);
	if ( $count > 0 ):
	
		$result = "";		
		//option
		if ( $output == "option" ):
			foreach ( $terms as $term ){
				
				if ( $term->term_id == $selected )
					$result .= '<option selected="selected" value="'. $term->term_id .'">'. $term->name .'</option>';
				else
					$result .= '<option value="'. $term->term_id .'">'. $term->name .'</option>';
			}
			return $result;
			
		//array
		elseif ( $output == "array" ):
			$arr_terms = array();
			foreach ( $terms as $term ):
				$arr_terms[ $term->term_id ] = $term->name;
			endforeach;
			return $arr_terms;
		
		//li
		else:		
			foreach ( $terms as $term ){
				$result .= '<li><a href="'. get_term_link( $term ) .'" >' . $term->name . '</a></li>';
			}
			return $result;
		endif;
		
	endif;
	
}

/** end */